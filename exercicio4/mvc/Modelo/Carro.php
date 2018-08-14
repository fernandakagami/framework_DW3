<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Carro extends Modelo
{
  const BUSCAR_TODOS = 'SELECT * FROM carros ORDER BY modelo';
  const BUSCAR_ID = 'SELECT * FROM carros WHERE id = ?';
  const BUSCAR_VENDIDOS = 'SELECT * FROM carros WHERE vendido = true';
  const INSERIR = 'INSERT INTO carros(modelo, preco_de_compra, preco_de_venda, descricao, vendido) VALUES (?, ?, ?, ?, ?)';
  const ATUALIZAR = 'UPDATE carros SET modelo = ?, preco_de_compra = ?, preco_de_venda = ?, descricao = ? WHERE id = ?';
  const ATUALIZAR_VENDIDO = 'UPDATE carros SET vendido = true WHERE id = ?';
  const DELETAR = 'DELETE FROM carros WHERE id = ?';
  private $id;
  private $modelo;
  private $precoDeCompra;
  private $precoDeVenda;
  private $descricao;
  private $vendido;

  public function __construct(
    $modelo = null,
    $precoDeCompra = null,
    $precoDeVenda = null,
    $descricao = null,
    $vendido = false,
    $id = null
  ) {
    $this->id = $id;
    $this->modelo = $modelo;
    $this->precoDeCompra = $precoDeCompra;
    $this->precoDeVenda = $precoDeVenda;
    $this->descricao = $descricao;
    $this->vendido = $vendido;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getModelo()
  {
    return $this->modelo;
  }

  public function getPrecoDeCompra()
  {
    return $this->precoDeCompra;
  }

  public function getPrecoDeVenda()
  {
    return $this->precoDeVenda;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function getVendido()
  {
    return $this->vendido;
  }

  public function getLucro()
  {
    return $this->precoDeVenda - $this->precoDeCompra;
  }

  public function setModelo($modelo)
  {
    $this->modelo = $modelo;
  }

  public function setPrecoDeCompra($precoDeCompra)
  {
    $this->precoDeCompra = $precoDeCompra;
  }

  public function setPrecoDeVenda($precoDeVenda)
  {
    $this->precoDeVenda = $precoDeVenda;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  public function setVendido($vendido)
  {
    $this->vendido = $vendido;
  }

  public function salvar()
  {
    if ($this->id == null) {
      $this->inserir();
    } else {
      $this->atualizar();
    }
  }

  public function inserir()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindParam(1, $this->modelo, PDO::PARAM_STR, 255);
    $comando->bindParam(2, $this->precoDeCompra, PDO::PARAM_STR);
    $comando->bindParam(3, $this->precoDeVenda, PDO::PARAM_STR);
    $comando->bindParam(4, $this->descricao, PDO::PARAM_STR, 255);
    $comando->bindParam(5, $this->vendido, PDO::PARAM_BOOL);
    $comando->execute();
    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
  }

  public function atualizar()
  {
    $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
    $comando->bindParam(1, $this->modelo, PDO::PARAM_STR, 255);
    $comando->bindParam(2, $this->precoDeCompra, PDO::PARAM_STR);
    $comando->bindParam(3, $this->precoDeVenda, PDO::PARAM_STR);
    $comando->bindParam(4, $this->descricao, PDO::PARAM_STR, 255);
    $comando->bindParam(5, $this->id, PDO::PARAM_INT);
    $comando->execute();
  }

  public function vender()
  {
    $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_VENDIDO);
    $comando->bindParam(1, $this->id, PDO::PARAM_INT);
    $comando->execute();
  }

  public static function buscarTodos()
  {
    $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
    $objetos = [];
    foreach ($registros as $registro) {
      $objetos[] = new Carro(
        $registro['modelo'],
        $registro['preco_de_compra'],
        $registro['preco_de_venda'],
        $registro['descricao'],
        $registro['vendido'],
        $registro['id']
      );
    }
    return $objetos;
  }

  public static function buscarId($id)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $registro = $comando->fetch();
    return new Carro(
      $registro['modelo'],
      $registro['preco_de_compra'],
      $registro['preco_de_venda'],
      $registro['descricao'],
      $registro['vendido'],
      $registro['id']
    );
  }

  public static function buscarVendidos()
  {
    $registros = DW3BancoDeDados::query(self::BUSCAR_VENDIDOS);
    $objetos = [];
    foreach ($registros as $registro) {
      $objetos[] = new Carro(
        $registro['modelo'],
        $registro['preco_de_compra'],
        $registro['preco_de_venda'],
        $registro['descricao'],
        $registro['vendido'],
        $registro['id']
      );
    }
    return $objetos;
  }

  public static function destruir($id)
  {
    $comando = DW3BancoDeDados::prepare(self::DELETAR);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
  }
}
