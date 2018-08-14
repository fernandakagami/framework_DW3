<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        $usuario = new Usuario('nome-teste', 'senha');
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE nome = 'nome-teste'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}

    public function testeBuscarEmail()
    {
        $usuario = new Usuario('nome-teste', 'senha');
        $usuario->salvar();
        $usuario = Usuario::buscarNome('nome-teste');
        $this->verificar($usuario !== false);
    }
}
