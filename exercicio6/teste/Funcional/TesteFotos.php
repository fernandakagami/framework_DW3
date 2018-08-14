<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Foto;
use \Modelo\Voto;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteFotos extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'fotos');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeVotar()
    {
        $this->logar();        
        $foto = new Foto();
        $foto->salvar();
        $voto = new Voto(
                5,
                $this->usuario->getId(),
                $foto->getId()
                );
        $voto->salvar();
        $query = DW3BancoDeDados::query('SELECT 1 FROM votos');
        $bdVotos = $query->fetchAll();
        $this->verificar(count($bdVotos) == 1);       
    }    
}
