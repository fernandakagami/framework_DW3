<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Lanche extends Modelo
{
  const BUSCAR_TODOS = 'SELECT * FROM lanches ORDER BY nome';
  const BUSCAR_ID = 'SELECT * FROM lanches WHERE id = ?';
  const INSERIR = 'INSERT INTO lanches(nome) VALUES (?)';
  const DELETAR = 'DELETE FROM lanches WHERE id = ?';
  private $id;
  private $nome;

  public function __construct(
    $nome = null,
    $id = null
  ) {
    $this->id = $id;
    $this->nome = $nome;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function salvar()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindParam(1, $this->nome, PDO::PARAM_STR, 255);
    $comando->execute();
    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
}

  public static function buscarTodos()
  {
    $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
    $objetos = [];
    foreach ($registros as $registro) {
        $objetos[] = new Lanche(
            $registro['nome'],
            $registro['id']
        );
    }
    return $objetos;
  }

  public static function buscarId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registro = $comando->fetch();
    return new Lanche(
        $registro['nome'],
        $registro['id']
    );
  }

  public static function destruir($id)
  {
    $comando = DW3BancoDeDados::prepare(self::DELETAR);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
  }
}
