<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;

class TesteRaiz extends Teste
{
    public function testeAcessarSemDados()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Lanches') !== false);
    }

    public function testeAcessarComDados()
    {
        (new Mensagem('1', '2'))->salvar();
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], '1') !== false);
    }

    public function testeCadastrar()
    {
        $resposta = $this->post(URL_RAIZ, [
            'mesa' => '10',
            'quantidade' => '5'
        ]);
        $this->verificar($resposta['redirecionar'] == URL_RAIZ . 'pedido');
        $resposta = $this->get(URL_RAIZ . 'pedido');
        $this->verificar(strpos($resposta['html'], '10') !== false);
   }
}
