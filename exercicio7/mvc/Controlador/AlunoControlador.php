<?php
namespace Controlador;

use \Modelo\Aluno;
use \Framework\DW3Sessao;

class AlunoControlador extends Controlador
{
    public function index()
    {
        $this->visao('alunos/index.php', [
            'sucesso' => DW3Sessao::getFlash('sucesso')
        ]);
    }

    public function armazenar()
    {
        $aluno = new Aluno(
            $_POST['nome'],
            $_POST['nota']            
        );

        if ($aluno->isValido()) {
            $aluno->salvar();
            DW3Sessao::setFlash('sucesso', 'Aluno cadastrado.');
            $this->redirecionar(URL_RAIZ);
        } else {
            $this->setErros($aluno->getValidacaoErros());
            $this->visao('alunos/index.php', [
                'sucesso' => null
            ]);
        }
    }
}
