<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
  const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
  const BUSCAR_NOME = 'SELECT * FROM usuarios WHERE nome = ?';
  const INSERIR = 'INSERT INTO usuarios(nome, senha) VALUES (?, ?)';
  private $id;
  private $nome;
  private $senha;
  private $senhaPlana;

  public function __construct(
    $nome = null,
    $senhaPlana = null,
    $id = null
  ) {
    $this->nome = $nome;
    $this->senhaPlana = $senhaPlana;
    $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function setSenha($senhaPlana)
  {
    $this->senhaPlana = $senhaPlana;
    $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
  }

  public function verificarSenha($senhaPlana)
  {
    return password_verify($senhaPlana, $this->senha);
  }

  public function salvar()
  {
    $this->inserir();
  }

  public function inserir()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindParam(1, $this->nome, PDO::PARAM_STR, 255);
    $comando->bindParam(2, $this->senha, PDO::PARAM_STR, 255);
    $comando->execute();
    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
  }

  public static function buscarId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registro = $comando->fetch();
    return new Usuario(
      $registro['nome'],
      null,
      $registro['id']
    );
  }

  public static function buscarNome($nome)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME);
    $comando->bindParam(1, $nome, PDO::PARAM_STR);
    $comando->execute();
    $registro = $comando->fetch();
    $usuario = null;
    if ($registro) {
      $usuario = new Usuario(
        $registro['nome'],
        null,
        $registro['id']
      );
      $usuario->senha = $registro['senha'];
    }
      return $usuario;
  }
}
