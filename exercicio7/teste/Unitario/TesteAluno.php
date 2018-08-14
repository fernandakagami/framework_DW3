<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Aluno;
use \Framework\DW3BancoDeDados;

class TesteAluno extends Teste
{
    public function antes()
    {
        $aluno = new Aluno('Aluno1', '5.6');
        $aluno->salvar();        
    }

    public function testeBuscarTodos()
    {
        $aluno = Aluno::buscarTodos();
        $this->verificar(count($aluno) == 1);
    }

    public function testeBuscarId()
    {
        $aluno = Aluno::buscarId(1);
        $this->verificar($aluno->getNome() == 'Aluno1');
    }
}
