<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
  const BUSCAR_TODOS = 'SELECT m.texto, m.id m_id, u.id u_id, u.nome FROM mensagens m JOIN usuarios u ON (m.usuario_id = u.id) ORDER BY m.id DESC LIMIT ?';
  const BUSCAR_ID = 'SELECT * FROM mensagens WHERE id = ? LIMIT 1';
  const INSERIR = 'INSERT INTO mensagens(texto, usuario_id) VALUES (?, ?)';
  const DELETAR = 'DELETE FROM mensagens WHERE id = ?';
  private $id;
  private $texto;
  private $usuarioId;
  private $usuario;

  public function __construct(
    $texto,
    $usuarioId,    
    $usuario = null,
    $id = null
  ) {
    $this->setTexto($texto);
    $this->usuarioId = $usuarioId; 
    $this->usuario = $usuario; 
    $this->id = $id;
  }

  public function getTexto()
  {

    return $this->texto;
  }

  public function getUsuarioId()
  {
    return $this->usuarioId;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setTexto($texto)
  {
    $this->texto = strip_tags($texto);
  }

  public function salvar()
  {
    DW3BancoDeDados::getPdo()->beginTransaction();
    $comando = DW3BancoDeDados::prepare(self::INSERIR);
    $comando->bindParam(1, $this->texto, PDO::PARAM_STR, 255);
    $comando->bindParam(2, $this->usuarioId, PDO::PARAM_INT);
    $comando->execute();
    $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
    DW3BancoDeDados::getPdo()->commit();
  }

  public static function buscarTodos($limit = 10)
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
    $comando->bindParam(1, $limit, PDO::PARAM_INT);
    $comando->execute();
    $registros = $comando->fetchAll();
    $objetos = [];
    foreach ($registros as $registro) {
      $usuario = new Usuario(
        $registro['nome'],
        '',        
        $registro['u_id']
      );
      $objetos[] = new Mensagem(
        $registro['texto'],
        $registro['u_id'],
        $usuario,
        $registro['m_id']
      );
    }
    return $objetos;
  }

  public static function buscarId($id) 
  {
    $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
    $objeto = null;
    $registro = $comando->fetch();
    if ($registro) {
      $objeto = new Mensagem(
        $registro['texto'],
        $registro['usuario_id'],
        null,
        $registro['id']
      );
    }
    return $objeto;
  }

  public static function destruir($id)
  {
    $comando = DW3BancoDeDados::prepare(self::DELETAR);
    $comando->bindParam(1, $id, PDO::PARAM_INT);
    $comando->execute();
  }
}
