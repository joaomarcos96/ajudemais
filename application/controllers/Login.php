<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if(verificarUsuarioLogado() == true){
            redirect(base_url('produtos/disponiveis'));
        }

        $dados['titulo'] = 'Login';

        $this->load->view('header', $dados);
        $this->load->view('login', $dados);
        $this->load->view('footer');
    }

    public function logarUsuario(){
        if(verificarUsuarioLogado() == true){
            redirect(base_url('produtos/disponiveis'));
        }

        $usuario_login = array(
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha')
        );

        if($this->form_validation->run('login') == false){
            definirMensagem('msg_erro', 'danger', 'Acesso negado', 'E-mail de usuário e/ou senha incorretos.');

            redirect(base_url('login'), 'refresh');
        }

        $usuario_buscado = $this->usuario->logarUsuario($usuario_login['email'], $usuario_login['senha']);

        if($usuario_buscado){
            $usuario_id = $usuario_buscado['id'];
            $grupo_id   = $usuario_buscado['grupo_id'];

            $paginas        = $this->usuario->buscarPaginas($grupo_id);
            $paginas_acesso = array();

            if($paginas){
                foreach($paginas as $pagina){
                    $paginas_acesso[] = $pagina['funcionalidades'];
                }
            }

            $dados_usuario = array(
                'paginas'               => $paginas_acesso,
                'usuario_id'            => $usuario_id,
                'usuario_nome'          => $usuario_buscado['nome_completo'],
                'usuario_celular'       => $usuario_buscado['celular'],
                'usuario_email'         => $usuario_buscado['email'],
                'usuario_senha'         => $usuario_buscado['senha'],
                'usuario_endereco'      => $usuario_buscado['endereco_id'],
                'usuario_grupo'         => $usuario_buscado['grupo_id'],
                'usuario_data_cadastro' => $usuario_buscado['data_cadastro'],
                'esta_logado'           => true
            );

            $this->session->set_userdata($dados_usuario);

            redirect(base_url('produtos/disponiveis'));
        }
        else {
            definirMensagem('msg_erro', 'danger', 'Acesso negado', 'E-mail de usuário e/ou senha incorretos.');

            redirect(base_url('login'));
        }
    }

    public function deslogarUsuario(){
        $this->session->sess_destroy();
        redirect(base_url('login'), 'refresh');
    }

    public function cadastrar(){
        if(verificarUsuarioLogado() == true){
            redirect(base_url('produtos/disponiveis'));
        }

        $dados['titulo'] = 'Cadastro';

        $estados_cidades = carregarEstadosCidades();

        $dados = array_merge($dados, $estados_cidades);

        $this->load->view('header', $dados);
        $this->load->view('cadastro', $dados);
        $this->load->view('footer', $dados);
    }

    public function cadastrarUsuario(){
        if(verificarUsuarioLogado() == true){
            redirect(base_url('produtos/disponiveis'));
        }

        if(empty($this->input->post()) || $this->form_validation->run('cadastro') == false){
            definirMensagem('msg_erro', 'danger', 'Erro', 'Algum erro ocorreu. Tente novamente.');

            redirect(base_url('login/cadastrar'));
        }

        if(empty($this->input->post('cidade'))){
            definirMensagem('msg_erro', 'danger', 'Selecione uma cidade', 'É obrigatório selecionar uma cidade.');

            redirect(base_url('login/cadastrar'));
        }

        $usuario['email'] = $this->input->post('email');

        // Verifica se existe usuário com o mesmo e-mail //
        if($this->usuario->buscarUsuarioPeloEmail($usuario['email'])){
            definirMensagem('msg_erro', 'danger', 'E-mail existente', 'E-mail já cadastrado no sistema.');

            redirect(base_url('login/cadastrar'));
        }

        $usuario['nome_completo'] = $this->input->post('nome');

        $celular = $this->input->post('celular');
        if($celular){
            $usuario['celular'] = $celular;
        }

        $usuario['senha']         = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);
        $usuario['grupo_id']      = COMUM;
        $usuario['data_cadastro'] = date('Y-m-d');

        $logradouro = $this->input->post('logradouro');
        if($logradouro){
            $endereco['logradouro'] = $logradouro;
        }

        $numero = $this->input->post('numero');
        if($numero){
            $endereco['numero'] = $numero;
        }

        $complemento = $this->input->post('complemento');
        if($complemento){
            $endereco['complemento'] = $complemento;
        }

        $bairro = $this->input->post('bairro');
        if($bairro){
            $endereco['bairro'] = $bairro;
        }

        $endereco['cidade_id'] = $this->input->post('cidade');

        $this->endereco->inserir($endereco);

        $endereco_usuario = $this->endereco->buscarUltimoRegistro();

        $usuario['endereco_id'] = $endereco_usuario['id'];

        $this->usuario->inserir($usuario);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Cadastro realizado com sucesso.');

        redirect(base_url('login'));
    }

}
