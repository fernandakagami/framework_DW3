<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Foto;
use \Modelo\Voto;
use \Framework\DW3BancoDeDados;

class TesteVoto extends Teste
{
    private $usuarioId;

    public function testeAvaliar()
    {
        $usuario = new Usuario('nome-teste', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
        $foto = new Foto('padrao.png');
        $foto->salvar();
        $voto = new Voto(
                5,
                $this->usuarioId,
                $foto->getId()
                );
        $voto->salvar();              
        $this->verificar($voto->getNota() == 5);
    }   
}
