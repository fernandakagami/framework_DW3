<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Voto;

class VotoControlador extends Controlador
{
    public function avaliar($id)
    {
        $this->verificarLogado();        
        $voto = Voto::verificarAvaliador($this->getUsuario(), $id);        
        if ($voto == false) {            
            $voto = new Voto(
                $_POST['nota'],
                $this->getUsuario(),
                $id
                );
            $voto->salvar();                                   
            DW3Sessao::setFlash('mensagemFlash', 'Avaliado.');
            $this->redirecionar(URL_RAIZ . 'fotos');
        } else {                       
            DW3Sessao::setFlash('mensagemFlash', 'Você já avaliou essa imagem.');
            $this->redirecionar(URL_RAIZ . 'fotos');
            }
    }

    
}