<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doacoes extends CI_Controller {

    private $usuario_logado_grupo,
            $usuario_logado_id;

    public function __construct(){
        parent::__construct();

        if(verificarUsuarioLogado() == false){
            redirect(base_url('login'));
        }

        $this->usuario_logado_grupo = $this->session->userdata('usuario_grupo');
        $this->usuario_logado_id    = $this->session->userdata('usuario_id');
    }

    public function index(){
        redirect(base_url('doacoes/todas'));
    }

    public function todas(){
        $dados['grupo'] = $this->usuario_logado_grupo;

        $dados['doacoes'] = $this->doacao->buscarTodasDoacoes();

        $dados['titulo'] = 'Doações';

        if($this->usuario_logado_grupo == ADMINISTRADOR){
            $dados['titulo_tabela'] = 'Todas as doações';
        }
        else {
            $dados['titulo_tabela'] = 'Doações realizadas e recebidas';
        }

        $dados['msg_nenhum_registro'] = 'Nenhuma doação realizada e nem recebida.';

        if($dados['doacoes']){
            $dados['doacoes'] = inverterData($dados['doacoes'], 'data_doacao');
        }

        $dados['msg_exclusao'] = '<p>Deseja mesmo <strong>excluir</strong> essa doação?</p>
                                  <p>Obs.: Este processo é irreversível.</p>';

        $dados['tabela'] = 'todas';

        $this->load->view('header', $dados);
        $this->load->view('doacoes', $dados);
        $this->load->view('footer', $dados);
    }
    
    public function realizadas(){
        $dados['grupo'] = $this->usuario_logado_grupo;

        $dados['doacoes'] = $this->doacao->buscarDoacoesPeloDoador($this->usuario_logado_id);

        $dados['titulo'] = 'Doações';

        $dados['titulo_tabela'] = 'Doações que realizei';

        $dados['msg_nenhum_registro'] = 'Nenhuma doação realizada.';

        if($dados['doacoes']){
            $dados['doacoes'] = inverterData($dados['doacoes'], 'data_doacao');
        }

        $dados['tabela'] = 'realizadas';

        $this->load->view('header', $dados);
        $this->load->view('doacoes', $dados);
        $this->load->view('footer', $dados);
    }
    
    public function recebidas(){
        $dados['grupo'] = $this->usuario_logado_grupo;

        $dados['doacoes'] = $this->doacao->buscarDoacoesPeloDonatario($this->usuario_logado_id);

        $dados['titulo'] = 'Doações';

        $dados['titulo_tabela'] = 'Doações que recebi';

        $dados['msg_nenhum_registro'] = 'Nenhuma doação recebida.';

        if($dados['doacoes']){
            $dados['doacoes'] = inverterData($dados['doacoes'], 'data_doacao');
        }

        $dados['tabela'] = 'recebidas';

        $this->load->view('header', $dados);
        $this->load->view('doacoes', $dados);
        $this->load->view('footer', $dados);
    }
    
    public function excluir($id = null){
        if($id == null || $this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('doacoes'));
        }

        $produto = $this->produto->buscarProdutoPelaDoacao($id);

        $produto['status'] = 1;

        $this->produto->atualizar($produto);

        $this->doacao->excluir($id);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Doação removida com sucesso.');

        redirect(base_url('doacoes'));
    }

}
