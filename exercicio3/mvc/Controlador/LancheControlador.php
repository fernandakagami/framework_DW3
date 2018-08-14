<?php
namespace Controlador;

use \Modelo\Lanche;

class LancheControlador extends Controlador
{
  public function lanche()
  {
    $lanches = Lanche::buscarTodos();
    $this->visao('lanches/lanche.php', [
        'lanches' => $lanches
    ]);
  }

  public function criar()
  {
    $this->visao('lanches/criar.php');
  }

  public function armazenar()
  {
    $lanche = new Lanche($_POST['nome']);
    $lanche->salvar();
    $this->redirecionar(URL_RAIZ . 'lanches');
  }

  public function destruir($id)
  {
    Lanche::destruir($id);
    $this->redirecionar(URL_RAIZ . 'lanches');
  }
}
