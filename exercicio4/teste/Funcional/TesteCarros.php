<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Carro;

class TesteCarros extends Teste
{
  public function testeIndexSemDados()
  {
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarContem($resposta, 'Nenhum carro para venda.');
  }

  public function testeIndexComDados()
  {
    (new Carro('HB 20', '35000', '40000', 'otimo', false))->salvar();
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarContem($resposta, 'HB 20');
    $this->verificarContem($resposta, '35000');
    $this->verificarContem($resposta, '40000');
    $this->verificarContem($resposta, 'otimo');
  }

  public function testeCriar()
  {
    $resposta = $this->get(URL_RAIZ . 'carros/criar');
    $this->verificarContem($resposta, 'Cadastro de Veículo');
  }

  public function testeEditar()
  {
    $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
    $carro->salvar();
    $resposta = $this->get(URL_RAIZ . 'carros/' . $carro->getId() . '/editar');
    $this->verificarContem($resposta, 'Edição de Veículo');
    $this->verificarContem($resposta, $carro->getModelo());
    $this->verificarContem($resposta, $carro->getPrecoDeCompra());
    $this->verificarContem($resposta, $carro->getPrecoDeVenda());
    $this->verificarContem($resposta, $carro->getDescricao());
  }

  public function testeMostrar()
  {
    $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
    $carro->salvar();
    $resposta = $this->get(URL_RAIZ . 'carros/' . $carro->getId());
    $this->verificarContem($resposta, 'Mostrando o Veículo');
    $this->verificarContem($resposta, $carro->getModelo());
    $this->verificarContem($resposta, $carro->getPrecoDeCompra());
    $this->verificarContem($resposta, $carro->getPrecoDeVenda());
    $this->verificarContem($resposta, $carro->getDescricao());
  }

  public function testeArmazenar()
  {
    $resposta = $this->post(URL_RAIZ . 'carros', [
      'modelo' => 'Gol',
      'precoDeCompra' => '20000',
      'precoDeVenda' => '22000',
      'descricao' => 'Beleza',
    ]);
    $this->verificarRedirecionar($resposta, URL_RAIZ . 'carros');
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarContem($resposta, 'Gol');
    $this->verificarContem($resposta, '20000');
    $this->verificarContem($resposta, '22000');
    $this->verificarContem($resposta, 'Beleza');
  }

  public function testeAtualizar()
  {
    $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
    $carro->salvar();
    $resposta = $this->patch(URL_RAIZ . 'carros/' . $carro->getId(), [
      'modelo' => 'Gol',
      'precoDeCompra' => '20000',
      'precoDeVenda' => '22000',
      'descricao' => 'Beleza',
    ]);
    $this->verificarRedirecionar($resposta, URL_RAIZ . 'carros');
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarContem($resposta, 'Gol');
    $this->verificarContem($resposta, '20000');
    $this->verificarContem($resposta, '22000');
    $this->verificarContem($resposta, 'Beleza');
  }

  public function testeVender()
  {
    $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
    $carro->salvar();
    $resposta = $this->patch(URL_RAIZ . 'carros/' . $carro->getId() . '/vender', [
      'vendido' => true,
    ]);
    $this->verificarRedirecionar($resposta, URL_RAIZ . 'carros');
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarContem($resposta, 'Vendido');
  }

  public function testeDestruir()
  {
    $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
    $carro->salvar();
    $resposta = $this->delete(URL_RAIZ . 'carros/' . $carro->getId());
    $this->verificarRedirecionar($resposta, URL_RAIZ . 'carros');
    $resposta = $this->get(URL_RAIZ . 'carros');
    $this->verificarNaoContem($resposta, 'HB 20');
  }

  public function testeRelatorioSemDados()
  {
    $resposta = $this->get(URL_RAIZ . 'carros/relatorio');
    $this->verificarContem($resposta, 'Nenhum carro vendido.');
  }

  public function testeRelatorioComDados()
  {
    (new Carro('HB 20', '35000', '40000', 'otimo', true))->salvar();
    $resposta = $this->get(URL_RAIZ . 'carros/relatorio');
    $this->verificarContem($resposta, 'HB 20');
    $this->verificarContem($resposta, '35000');
    $this->verificarContem($resposta, '40000');
    $this->verificarContem($resposta, '5000');
    $this->verificarContem($resposta, 'otimo');
  }
}
