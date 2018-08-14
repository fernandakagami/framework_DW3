<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
  const BUSCAR_TODOS = 'SELECT id, quantidade, mesa FROM mensagens ORDER BY id';
  const INSERIR = 'INSERT INTO mensagens(mesa,quantidade) VALUES (?, ?)';
  private $id;
  private $quantidade;
  private $mesa;

  public function __construct(
      $mesa,
      $quantidade,
      $id = null
  ) {
      $this->mesa = $mesa;
      $this->quantidade = $quantidade;
      $this->id = $id;
  }

  public function getId()
  {
      return $this->id;
  }

  public function getQuantidade()
  {
      return $this->quantidade;
  }

  public function getMesa()
  {
      return $this->mesa;
  }

  public function salvar()
  {
      DW3BancoDeDados::getPdo()->beginTransaction();
      $comando = DW3BancoDeDados::prepare(self::INSERIR);
      $comando->bindParam(1, $this->mesa, PDO::PARAM_STR, 255);
      $comando->bindParam(2, $this->quantidade, PDO::PARAM_STR, 255);
      $comando->execute();
      $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
      DW3BancoDeDados::getPdo()->commit();
  }

  public static function buscarTodos()
  {
      $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
      $objetos = [];
      foreach ($registros as $registro) {
          $objetos[] = new Mensagem(
              $registro['mesa'],
              $registro['quantidade'],
              $registro['id']
          );
      }
      return $objetos;
  }
}
