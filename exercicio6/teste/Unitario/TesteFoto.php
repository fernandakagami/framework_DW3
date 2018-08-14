<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Foto;
use \Framework\DW3BancoDeDados;

class TesteFoto extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('nome-teste', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeBuscarTodos()
    {
        (new Foto('padrao.png'))->salvar();
        (new Foto('padrao.png'))->salvar();
        $fotos = Foto::buscarTodos();
        $this->verificar(count($fotos) == 2);
    }

    public function testeBuscarRanking()
    {
        (new Foto('padrao.png'))->salvar();
        (new Foto('padrao.png'))->salvar();
        $fotos = Foto::buscarRanking();
        $this->verificar(count($fotos) == 0);
    }

    public function testeContarTodos()
    {
        (new Foto('padrao.png'))->salvar();
        (new Foto('padrao.png'))->salvar();
        $total = Foto::contarTodos();
        $this->verificar($total == 2);
    }    
}
