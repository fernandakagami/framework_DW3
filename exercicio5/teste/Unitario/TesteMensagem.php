<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    private $usuarioId;

    /* Roda antes de cada teste */
    public function antes()
    {
        $usuario = new Usuario('Dijair', '123');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeArmazenar()
    {
        $mensagem = new Mensagem('tudo bom', $this->usuarioId);
        $mensagem->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagens = $query->fetchAll();
        $this->verificar(count($bdMensagens) == 1);
    }

    public function testeBuscarTodos()
    {
        (new Mensagem('Ola pessoal', $this->usuarioId))->salvar();
        (new Mensagem('Segunda mensagem', $this->usuarioId))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeBuscarId()
    {
        $mensagem = new Mensagem('abacates', $this->usuarioId);
        $mensagem->salvar();
        $mensagem2 = Mensagem::buscarId($mensagem->getId());
        $this->verificar($mensagem->getTexto() == $mensagem2->getTexto());
    }

    public function testeDestruir()
    {
        $mensagem = new Mensagem($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        Mensagem::destruir($mensagem->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
}
}
