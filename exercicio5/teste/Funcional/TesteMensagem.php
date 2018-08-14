<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    public function testeDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'mensagens');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeEnviarMensagem()
    {
        $this->logar();
        (new Mensagem('Oi', 1))->salvar();
        $resposta = $this->get(URL_RAIZ . 'mensagens');
        $this->verificarContem($resposta, 'Chat Online');
        $this->verificarContem($resposta, 'Mensagens');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'mensagens', [
            'texto' => 'Num ninho de mafagafos há sete mafagafinhos.'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');       
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagens = $query->fetchAll();
        $this->verificar(count($bdMensagens) == 1);
    }    

    public function testeDestruir()
    {
        $this->logar();
        $mensagem = new Mensagem('Olá', 1);
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'mensagens/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao === false);
    }    
}
