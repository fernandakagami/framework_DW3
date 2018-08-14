<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_POR_NOME = 'SELECT * FROM usuarios WHERE nome = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome,senha) VALUES (?, ?)';
    private $id;
    private $nome;
    private $senha;
    private $senhaPlana;    

    public function __construct(
        $nome = null,
        $senha = null,
        $id = null
    ) {
        $this->nome = $nome;
        $this->senhaPlana = $senha;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->Nome;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    protected function verificarErros()
    {
        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('nome', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }        
    }

    public function salvar()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarNome($nome)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                '',                
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
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
}
