<?php
namespace Controlador;

use \Modelo\Carro;

class CarroControlador extends Controlador
{
  public function index()
  {
    $carros = Carro::buscarTodos();
    $this->visao('carros/index.php', [
      'carros' => $carros
    ]);
  }

  public function mostrar($id)
  {
    $carro = Carro::buscarId($id);
    $this->visao('carros/mostrar.php', [
      'carro' => $carro
    ]);
  }

  public function criar()
  {
    $this->visao('carros/criar.php');
  }

  public function armazenar()
  {
    $carro = new Carro($_POST['modelo'],
      $_POST['precoDeCompra'],
      $_POST['precoDeVenda'],
      $_POST['descricao']
    );
    $carro->salvar();
    $this->redirecionar(URL_RAIZ . 'carros');
  }

  public function editar($id)
  {
    $carro = Carro::buscarId($id);
    $this->visao('carros/editar.php', [
      'carro' => $carro
    ]);
  }

  public function atualizar($id)
  {
    $carro = Carro::buscarId($id);
    $carro->setModelo($_POST['modelo']);
    $carro->setPrecoDeCompra($_POST['precoDeCompra']);
    $carro->setPrecoDeVenda($_POST['precoDeVenda']);
    $carro->setDescricao($_POST['descricao']);
    $carro->salvar();
    $this->redirecionar(URL_RAIZ . 'carros');
  }

  public function vender($id)
  {
    $carro = Carro::buscarId($id);
    $carro->vender();
    $this->redirecionar(URL_RAIZ . 'carros');
  }

  public function destruir($id)
  {
    Carro::destruir($id);
    $this->redirecionar(URL_RAIZ . 'carros');
  }

  public function relatorio()
  {
    $carros = Carro::buscarVendidos();
    $this->visao('carros/relatorio.php', [
        'carros' => $carros
    ]);
  }
}
