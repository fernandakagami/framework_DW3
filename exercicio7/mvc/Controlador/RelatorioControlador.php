<?php
namespace Controlador;

use \Modelo\Aluno;
use \Modelo\Relatorio;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorios/notas.php', [
            'alunos' => ALuno::buscarTodos(),
            'registros' => Relatorio::buscarRegistros($_GET),
            'aprovados' => Relatorio::contarAprovados(),
            'reprovados' => Relatorio::contarReprovados(),
            'total' => Relatorio::contarTodos()
        ]);
    }
}
