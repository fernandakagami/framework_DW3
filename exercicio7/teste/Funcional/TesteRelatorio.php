<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Aluno;
use \Framework\DW3BancoDeDados;

class TesteRelatorio extends Teste
{
    public function testeIndex()
    {
        $this->testar();
        $resposta = $this->get(URL_RAIZ . 'relatorios/notas');
        $this->verificarContem($resposta, 'Nome do Aluno');
        $this->verificarContem($resposta, '2,4');
        $this->verificarContem($resposta, '1');
    }

    public function testeFiltro()
    {
        $this->testar();
        $outroAluno = new Aluno('teste2', '6');
        $outroAluno->salvar();
        $resposta = $this->get(URL_RAIZ . 'relatorios/notas', [
            'nomePesquisa' => 'teste2'            
        ]);
        $this->verificarContem($resposta, 'teste2');
        $this->verificarContem($resposta, '6');
        $this->verificarNaoContem($resposta, 'Total de Alunos');        
    }
}
