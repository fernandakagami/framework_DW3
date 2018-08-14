<?php
namespace Teste;

use \Framework\DW3Teste;
use \Framework\DW3Sessao;
use \Modelo\Aluno;

class Teste extends DW3Teste
{
	protected $aluno;

	public function testar()
	{
		$this->aluno = new Aluno('alunoTeste', '2.4');
		$this->aluno->salvar();		
	}
}
