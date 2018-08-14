<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Lanche;
use \Framework\DW3BancoDeDados;

class TesteLanche extends Teste
{
  public function testeArmazenar()
  {
      $lanche= new Lanche('x-salada');
      $lanche->salvar();
      $query = DW3BancoDeDados::getPdo()->query('SELECT * FROM lanches');
      $bdLanche = $query->fetch();
      $this->verificar($bdLanche['nome'] === $lanche->getNome());
  }

  public function testeBuscarTodos()
  {
      (new Lanche('x-salada'))->salvar();
      (new Lanche('x-egg'))->salvar();
      $lanches = Lanche::buscarTodos();
      $this->verificar(count($lanches) == 2);
  }

  public function testeBuscarId()
    {
        $lanche1 = new Lanche('x-salada');
        $lanche1->salvar();
        $lanche2 = Lanche::buscarId($lanche1->getId());
        $this->verificar($lanche1->getNome() == $lanche2->getNome());
    }

    public function testeDestruir()
    {
        $lanche = new Lanche('x-salada');
        $lanche->salvar();
        Lanche::destruir($lanche->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM lanches');
        $registros = $query->fetchAll();
        $this->verificar(count($registros) === 0);
    }
}
