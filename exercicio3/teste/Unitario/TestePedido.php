<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Pedido;
use \Modelo\Lanche;
use \Framework\DW3BancoDeDados;

class TestePedido extends Teste
{
  private $lancheId;

  /* Roda antes de cada teste */
  public function antes()
  {
      $lanche = new Lanche('x-salada');
      $lanche->salvar();
      $this->lancheId = $lanche->getId();
  }
  public function testeArmazenar()
  {
      $pedido= new Pedido('1', 1, $this->lancheId);
      $pedido->salvar();
      $query = DW3BancoDeDados::getPdo()->query('SELECT * FROM pedidos');
      $bdPedido = $query->fetchAll();
      $this->verificar(count($bdPedido) == 1);
  }

  public function testeAtualizar()
  {
      $pedido = new Pedido('1', 1, $this->lancheId);
      $pedido->salvar();
      $pedido->setMesa(2);
      $pedido->salvar();
      $query = DW3BancoDeDados::query('SELECT * FROM pedidos');
      $bdPedido = $query->fetch();
      $this->verificar($bdPedido['mesa'] != null);
  }

  public function testeBuscarId()
  {
      $pedido = new Pedido('1', 1, $this->lancheId);
      $pedido->salvar();
      $pedido2 = Pedido::buscarId($pedido->getId());
      $this->verificar($pedido->getMesa() == $pedido2->getMesa());
  }

  public function testeBuscarTodos()
  {
      (new Pedido('1', 1, $this->lancheId))->salvar();
      (new Pedido('2', 2, $this->lancheId))->salvar();
      $pedidos = Pedido::buscarTodos();
      $this->verificar(count($pedidos) == 2);
  }

  public function testeDestruir()
  {
      $pedido = new Pedido('1', 1, $this->lancheId);
      $pedido->salvar();
      Pedido::destruir($pedido->getId());
      $query = DW3BancoDeDados::query('SELECT * FROM pedidos');
      $registros = $query->fetchAll();
      $this->verificar(count($registros) === 0);
  }
}
