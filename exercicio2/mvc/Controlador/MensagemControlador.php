<?php
namespace Controlador;

use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    public function index()
    {
        $mensagens = Mensagem::buscarTodos();
        $this->visao('mensagens/index.php', [
            'mensagens' => $mensagens
        ]);
    }

    public function armazenar()
    {
        $mensagem = new Mensagem($_POST['mesa'], $_POST['quantidade']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ . 'pedido');
    }

    public function pedido()
    {
      $mensagens = Mensagem::buscarTodos();
      $this->visao('mensagens/pedido.php', [
          'mensagens' => $mensagens
      ]);
    }
}
