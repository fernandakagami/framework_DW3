<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    public function testeInserir()
    {
        $mensagem = new Mensagem('7', '3');
        $mensagem->salvar();
        $query = DW3BancoDeDados::getPdo()->query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['quantidade'] === $mensagem->getQuantidade());
    }

    public function testeBuscarTodos()
    {
        (new Mensagem('5', '1'))->salvar();
        (new Mensagem('6', '5'))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }
}
