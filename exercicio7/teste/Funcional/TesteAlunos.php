<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteAlunos extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'alunos');
        $this->verificarContem($resposta, 'Incluir aluno');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'alunos', [
            'nome' => 'Aluno1',
            'nota' => '7.7'           
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $query = DW3BancoDeDados::query('SELECT * FROM alunos');
        $bdAlunos = $query->fetchAll();
        $this->verificar(count($bdAlunos) == 1);
    }
}
