<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Voto extends Modelo
{
	const BUSCAR_AVALIACAO = 'SELECT * FROM votos WHERE usuario_id = ? AND foto_id = ? LIMIT 1';		           
    const INSERIR = 'INSERT INTO votos(nota, usuario_id, foto_id) VALUES (?, ?, ?)';  
    private $nota;
    private $usuarioId;
    private $fotoId;    
    private $usuario;        

    public function __construct(
        $nota = null,
        $usuarioId = null,        
        $fotoId = null,
        $usuario = null        
    ) {
        $this->nota = $nota;
        $this->usuarioId = $usuarioId;
        $this->fotoId = $fotoId;
        $this->usuario = $usuario;                
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function getUsuarioId()
	{
	   return $this->usuarioId;
	}

	public function getUsuario()
	{
	   if ($this->usuario == null) {
        $this->usuario = Usuario::buscarId($this->usuarioId);
    }
    return $this->usuario;
	}

	public function getFotoId()
	{
	   return $this->fotoId;
	}
	
	public function salvar()
	{
	   DW3BancoDeDados::getPdo()->beginTransaction();
	   $comando = DW3BancoDeDados::prepare(self::INSERIR);
	   $comando->bindValue(1, $this->nota, PDO::PARAM_STR);
	   $comando->bindValue(2, $this->usuarioId, PDO::PARAM_INT);
	   $comando->bindValue(3, $this->fotoId, PDO::PARAM_INT);
	   $comando->execute();
	   $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
	   DW3BancoDeDados::getPdo()->commit();
	}

	public static function verificarAvaliador($usuarioId, $fotoId)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_AVALIACAO);
        $comando->bindValue(1, $usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $fotoId, PDO::PARAM_INT);
        $comando->execute();                        
        $registro = $comando->fetch();        
        return $registro;	    
    }

    protected function verificarErros()
    {
        if ($this->nota > -1 && $this->nota < 10) {
            $this->setErroMensagem('nota', 'Dê uma nota entre 0,0 e 10,0');
        }
    }
}