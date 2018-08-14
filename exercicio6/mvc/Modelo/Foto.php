<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Foto extends Modelo
{
    const BUSCAR_TODOS = 'SELECT f.id, AVG(v.nota) AS media 
                            FROM fotos f 
                            LEFT JOIN votos v ON (f.id = v.foto_id) 
                            GROUP BY f.id 
                            ORDER BY f.id DESC 
                            LIMIT ? OFFSET ?';    
    const BUSCAR_RANKING = 'SELECT f.id, AVG(v.nota) AS media
                            FROM fotos f 
                            JOIN votos v ON (f.id = v.foto_id) 
                            GROUP BY v.foto_id
                            ORDER BY AVG(v.nota) DESC 
                            LIMIT ?';        
    const BUSCAR_ID = 'SELECT * FROM fotos WHERE id = ? LIMIT 1';    
    const INSERIR = 'INSERT INTO fotos VALUES ()';    
    const CONTAR_TODOS = 'SELECT count(id) FROM fotos';         
    private $id;
    private $foto;
    private $media;        

    public function __construct(
        $id = null,
        $foto = null,
        $media = null
    ) {
        $this->id = $id;
        $this->foto = $foto;
        $this->media = $media;        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        return $imagemNome;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);           
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }
     
     private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Foto(
                $registro['id'],
                null,
                $registro['media']               
            );
        }        
        return $objetos;
    }


    public static function buscarRanking($limit = 3)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_RANKING);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);        
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Foto(
                $registro['id'],
                null,
                $registro['media']  
            );
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    protected function verificarErros()
    {
        if (DW3ImagemUpload::existeUpload($this->foto)
            && !DW3ImagemUpload::isValida($this->foto)) {
            $this->setErroMensagem('foto', 'Deve ser de no máximo 500 KB.');
        }
    }
}
