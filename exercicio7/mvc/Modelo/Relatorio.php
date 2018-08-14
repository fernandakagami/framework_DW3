<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio
{
    const BUSCAR_TODOS = 'SELECT * FROM alunos WHERE true';
    const CONTAR_APROVADOS = 'SELECT count(id) FROM alunos WHERE nota >= 6';
    const CONTAR_REPROVADOS = 'SELECT count(id) FROM alunos WHERE nota < 6';
    const CONTAR_TODOS = 'SELECT count(id) FROM alunos';  

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $sqlOrder = '';
        $parametros = [];
        if (array_key_exists('nomePesquisa', $filtro) && $filtro['nomePesquisa'] != '') {
            $parametros[] = '%' . $filtro['nomePesquisa'] . '%';
            $sqlWhere .= ' AND nome LIKE ?';
        }
        if (array_key_exists('notaMin', $filtro) && $filtro['notaMin'] != '') {
            $parametros[] = $filtro['notaMin'];
            $sqlWhere .= ' AND nota >= ?';
        }
        if (array_key_exists('notaMax', $filtro) && $filtro['notaMax'] != '') {
            $parametros[] = $filtro['notaMax'];
            $sqlWhere .= ' AND nota <= ?';
        }
        if (array_key_exists('orientacao', $filtro) && $filtro['orientacao'] == 'desc') {
            $sqlOrder = ' ORDER BY nota DESC';
        } else {
            $sqlOrder = ' ORDER BY nota';
        }
        $sql = self::BUSCAR_TODOS . $sqlWhere . $sqlOrder;
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i+1, $parametro, PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        return $registros;       
    }


    public static function contarAprovados()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_APROVADOS);
        $total = $registros->fetch();        
        return intval($total[0]);
    }    

    public static function contarReprovados()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_REPROVADOS);
        $total = $registros->fetch();        
        return intval($total[0]);
    }    

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();        
        
        return intval($total[0]);
    }    

    
}
