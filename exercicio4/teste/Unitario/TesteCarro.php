<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Carro;
use \Framework\DW3BancoDeDados;

class TesteCarro extends Teste
{
    public function testeArmazenar()
    {
        $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
        $carro->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM carros');
        $bdCarro = $query->fetch();
        $this->verificar($bdCarro['modelo'] === $carro->getModelo());
    }

    public function testeAtualizar()
    {
        $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
        $carro->salvar();
        $carro->setModelo('HB 20 Sedan');
        $carro->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM carros');
        $bdCarro = $query->fetch();
        $this->verificar($bdCarro['modelo'] === $carro->getModelo());
    }

    public function testeDestruir()
    {
        $carro = new Carro('HB 20', '35000', '40000', 'otimo', false);
        $carro->salvar();
        Carro::destruir($carro->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM carros');
        $registros = $query->fetchAll();
        $this->verificar(count($registros) === 0);
    }

    public function testeBuscarId()
    {
        $carro1 = new Carro('HB 20', '35000', '40000', 'otimo', false);
        $carro1->salvar();
        $carro2 = Carro::buscarId($carro1->getId());
        $this->verificar($carro1->getModelo() == $carro2->getModelo());
    }

    public function testeBuscarTodos()
    {
        (new Carro('HB 20', '35000', '40000', 'otimo', false))->salvar();
        (new Carro('Gol', '35000', '40000', 'otimo', false))->salvar();
        $carros = Carro::buscarTodos();
        $this->verificar(count($carros) == 2);
    }
}
