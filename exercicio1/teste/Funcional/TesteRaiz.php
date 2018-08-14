<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRaiz extends Teste
{
    public function testeAcessarIndex()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Empresa RapidoSIM') !== false);
    }

    public function testeAcessarFormulario()
    {
        $resposta = $this->get(URL_RAIZ . 'formulario');
        $this->verificar(strpos($resposta['html'], 'Formulário') !== false);
    }
}
