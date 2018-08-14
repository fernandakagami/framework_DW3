<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Lanche;

class TesteLanche extends Teste
{
  public function testeAcessarSemDadosLanches()
  {
    $resposta = $this->get(URL_RAIZ. 'lanches');
    $this->verificar(strpos($resposta['html'], 'Lanches') !== false);
  }

  public function testeAcessarComDadosLanches()
  {
    (new Lanche('x-salada'))->salvar();
    $resposta = $this->get(URL_RAIZ . 'lanches');
    $this->verificar(strpos($resposta['html'], 'x-salada') !== false);
  }

  public function testeCriar()
  {
      $resposta = $this->get(URL_RAIZ . 'lanches/criar');
      $this->verificarContem($resposta, 'Cadastro de Novos Lanches');
  }

  public function testeCadastrarLanche()
  {
    $resposta = $this->post(URL_RAIZ . 'lanches', [
        'nome' => 'x-salada'
    ]);
    $this->verificar($resposta['redirecionar'] == URL_RAIZ . 'lanches');
    $resposta = $this->get(URL_RAIZ . 'lanches');
  $this->verificarContem($resposta, 'x-salada');
}

public function testeDestruir()
  {
      $lanche = new Lanche('x-bacon');
      $lanche->salvar();
      $resposta = $this->delete(URL_RAIZ . 'lanches/' . $lanche->getId());
      $this->verificarRedirecionar($resposta, URL_RAIZ . 'lanches');
      $resposta = $this->get(URL_RAIZ . 'lanches');
      $this->verificarNaoContem($resposta, 'x-bacon');
  }

}
