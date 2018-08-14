<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Aluno;
use \Modelo\Relatorio;
use \Framework\DW3BancoDeDados;

class TesteRelatorio extends Teste
{
	public function antes()
    {
        $aluno = new Aluno('Maria', '7.8');
        $aluno->salvar();        
    }

    public function testeBuscarRegistros()
    {
        $registros = Relatorio::buscarRegistros();
        $this->verificar(count($registros) == 1);
    }
}
