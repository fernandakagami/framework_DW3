<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Foto;
use \Modelo\Voto;

class FotoControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $fotos = Foto::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Foto::contarTodos() / $limit);        
        return compact('pagina', 'fotos', 'ultimaPagina');
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('fotos/index.php', [
            'fotos' => $paginacao['fotos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $foto = new Foto( DW3Sessao::get('usuario'), $foto);
        if ($foto->isValido()) {
            $foto->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Foto Publicada.');
            $this->redirecionar(URL_RAIZ . 'fotos');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($foto->getValidacaoErros());
            $this->visao('fotos/index.php', [
                'fotos' => $paginacao['fotos'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function ranking()
    {
        $this->verificarLogado();
        $limit = 3;
        $fotos = Foto::buscarRanking($limit);        
        $this->visao('fotos/ranking.php', [
            'fotos' => $fotos
        ]);
    }        
}
