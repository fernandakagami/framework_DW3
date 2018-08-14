<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Aluno extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM alunos ORDER BY nome';
    const BUSCAR_ID = 'SELECT * FROM alunos WHERE id = ?';
    const INSERIR = 'INSERT INTO alunos(nome, nota) VALUES (?, ?)';
    private $id;
    private $nome;
    private $nota;

    public function __construct(
        $nome,
        $nota,
        $id = null
    ) {
        $this->nome = $nome;
        $this->nota = $nota;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function salvar()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->nota, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    protected function verificarErros()
    {
        if ($this->nome == null) {
            $this->setErroMensagem('nome', 'Informe o nome do aluno.');
        }
        if ($this->nota < 0) {
            $this->setErroMensagem('nota', 'A nota deve ser maior que 0.');
        }
        if ($this->nota > 10) {
            $this->setErroMensagem('nota', 'A nota deve ser menor que 10.');
        }
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Aluno(
                $registro['nome'],
                $registro['nota'],
                $registro['id']
            );
        }
        return $objetos;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        if ($registro != false) {
            return new Aluno(
                $registro['nome'],
                $registro['nota'],
                $registro['id']
            );
        }
        return null;
    }
}
