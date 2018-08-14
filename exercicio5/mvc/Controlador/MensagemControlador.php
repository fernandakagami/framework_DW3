<?php
namespace Controlador;

use \Modelo\Mensagem;
use \Framework\DW3Sessao;

class MensagemControlador extends Controlador
{
  public function index()
  {
    $this->verificarLogado();
    $limit = 10;
    $mensagens = Mensagem::buscarTodos($limit);
    $this->visao('mensagens/index.php', [
        'mensagens' => $mensagens,
    ]);
  }

  public function armazenar()
  {
    $this->verificarLogado();
    $mensagem = new Mensagem(
      $_POST['texto'],
      $this->getUsuario()
    );
    $mensagem->salvar();
    $this->redirecionar(URL_RAIZ . 'mensagens');        
  }  

  public function destruir($id)
  {
    $this->verificarLogado();
    $mensagem = Mensagem::buscarId($id);
    if ($mensagem->getUsuarioId() == $this->getUsuario()) {
        Mensagem::destruir($id);            
    }
    $this->redirecionar(URL_RAIZ . 'mensagens');
  }
}
