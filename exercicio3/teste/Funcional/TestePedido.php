<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Lanche;
use \Modelo\Pedido;

class TestePedido extends Teste
{
  public function antes()
  {
      $lanche = new Lanche('x-salada');
      $lanche->salvar();
  }

  public function testeAcessarSemDadosPedidos()
   {
      $resposta = $this->get(URL_RAIZ . 'pedidos');
      $this->verificarContem($resposta, 'Nenhum pedido cadastrado.');
   }

  public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'pedidos/criar');
        $this->verificarContem($resposta, 'Cadastro de Novos Pedidos');
    }

   public function testeCadastrarPedido()
   {
     $resposta = $this->post(URL_RAIZ . 'pedidos', [
        'mesa' => '2',
        'lancheId' => 1,
        'quantidade' =>  2
     ]);
     $this->verificar($resposta['redirecionar'] == URL_RAIZ . 'pedidos');
     $resposta = $this->get(URL_RAIZ . 'pedidos');
     $this->verificarContem($resposta, '2');
   }

   public function testeEditar()
    {
        $pedido = new Pedido('1', 1, 1);
        $pedido->salvar();
        $resposta = $this->get(URL_RAIZ . 'pedidos/' . $pedido->getId(). '/editar');
        $this->verificarContem($resposta, 'Edição de Pedido');
        $this->verificarContem($resposta, $pedido->getMesa());
    }

    public function testeAtualizar()
    {
        $pedido = new Pedido('1', 1, 1);
        $pedido->salvar();
        $resposta = $this->patch(URL_RAIZ . 'pedidos/' . $pedido->getId(), [
            'mesa' => '2',
            'lancheId' => 1,
            'quantidade' => 2,
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'pedidos');
        $resposta = $this->get(URL_RAIZ . 'pedidos');
        $this->verificarContem($resposta, '2');
        $this->verificarContem($resposta, 'x-salada');
    }

    public function testeDestruir()
    {
        $pedido = new Pedido('Mesa 1', 1, 1);
        $pedido->salvar();
        $resposta = $this->delete(URL_RAIZ . 'pedidos/' . $pedido->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'pedidos');
        $resposta = $this->get(URL_RAIZ . 'pedidos');
        $this->verificarNaoContem($resposta, 'Mesa 1');
    }
}
