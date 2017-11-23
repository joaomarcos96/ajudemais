<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
        if($this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('usuario/perfil'));
        }
        redirect(base_url('usuario/todos'));
    }
    
    public function todos(){
        if($this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('usuario/perfil'));
        }
        
        $limite_por_pagina = 5;
        $comeco = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_registros = $this->usuario->quantidadeUsuarios();
        
        if($total_registros > 0){
            $dados['usuarios'] =  $this->usuario->buscarUsuariosPaginacao($limite_por_pagina, $comeco);
            
            $config['base_url'] = base_url('usuario/todos');
            $config['total_rows'] = $total_registros;
            $config['per_page'] = $limite_por_pagina;
            
            $config['full_tag_open'] = '<div class="d-flex"><ul class="mx-auto pagination pagination-circle pg-blue mb-0">';
            $config['full_tag_close'] = '</ul></div>';
            
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
            
            $config['first_link'] = 'Primeira Página';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            
            $config['last_link'] = 'Última Página';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
             
            $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            
            $config['attributes'] = array('class' => 'page-link');
            
            $this->pagination->initialize($config);
            
            $dados['links'] = $this->pagination->create_links();
        }
        
        $dados['titulo'] = 'Usuários';
        
        if($dados['usuarios']){
            $dados['usuarios'] = inverterData($dados['usuarios'], 'data_cadastro');
        }

        //
        $dados['titulo_tabela']       = 'Usuários';
        $dados['url']                 = 'usuario/editar/';
        $dados['msg_exclusao']        = '<p>Deseja mesmo <strong>excluir</strong> esse usuário?</p>
					 <p>Obs.: Este processo é irreversível e remove todos os produtos e doações associadas a este usuário.</p>';
        $dados['msg_nenhum_registro'] = '<p>Não há usuários cadastrados.</p>';
        //

        $this->load->view('header', $dados);
        $this->load->view('usuario', $dados);
        $this->load->view('footer');
    }
    
    public function perfil(){
        $dados['titulo'] = 'Perfil de Usuário';

        $usuario_endereco_id = $this->session->userdata('usuario_endereco');

        $endereco = $this->endereco->buscarEnderecoCompleto($usuario_endereco_id);

        $grupo = $this->grupo->buscarPorId($this->usuario_logado_grupo);

        $celular = $this->session->userdata('usuario_celular');

        $usuario_logado = array(
            'nome'        => $this->session->userdata('usuario_nome'),
            'celular'     => ($celular) ? $celular : '',
            'email'       => $this->session->userdata('usuario_email'),
            'logradouro'  => $endereco['logradouro'],
            'numero'      => $endereco['numero'],
            'complemento' => $endereco['complemento'],
            'bairro'      => $endereco['bairro'],
            'cidade'      => $endereco['cidade'],
            'estado'      => $endereco['estado'],
            'grupo'       => $grupo['nome']
        );

        $dados['usuario_logado'] = $usuario_logado;

        $this->load->view('header', $dados);
        $this->load->view('perfil_usuario', $dados);
        $this->load->view('footer');
    }
    
    public function cadastro(){
        if($this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('usuario/perfil'));
        }
        
        $dados['titulo'] = 'Cadastrar usuário';

        $estados_cidades = carregarEstadosCidades();

        $dados = array_merge($dados, $estados_cidades);

        $dados['titulo_cadastro'] = 'usuário';
        $dados['grupo']           = '2';

        $this->load->view('header', $dados);
        $this->load->view('cadastro_usuario', $dados);
        $this->load->view('footer');
    }

    public function cadastrarUsuario(){
        if($this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('usuario/perfil'));
        }

        if(empty($this->input->post()) || $this->form_validation->run('cadastro') == false){
            definirMensagem('msg_erro', 'danger', 'Erro', 'Algum erro ocorreu. Tente novamente.');

            redirect(base_url('usuario/cadastro'));
        }

        if(empty($this->input->post('cidade'))){
            definirMensagem('msg_erro', 'danger', 'Selecione uma cidade', 'É obrigatório selecionar uma cidade.');

            redirect(base_url('usuario/cadastro'));
        }

        $usuario['email'] = $this->input->post('email');

        // Verifica se existe usuário com o mesmo e-mail //
        if($this->usuario->buscarUsuarioPeloEmail($usuario['email'])){
            definirMensagem('msg_erro', 'danger', 'E-mail existente', 'E-mail já cadastrado no sistema.');

            redirect(base_url('usuario/cadastro'));
        }

        $usuario['nome_completo'] = $this->input->post('nome');
        
        $celular = $this->input->post('celular');
        if($celular){
            $usuario['celular'] = $celular;
        }

        $usuario['senha'] = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);
        
        $usuario['grupo_id'] = $this->input->post('grupo');        
        
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

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Usuário cadastrado com sucesso.');

        redirect(base_url('usuario'));
    }

    public function editar($id = null){
        if($id == null || ($this->usuario_logado_grupo != ADMINISTRADOR && $id != $this->usuario_logado_id)){
            redirect(base_url('usuario/perfil'));
        }
        
        $grupo = $this->usuario->buscarGrupoPeloUsuario($id)['grupo_id'];

        if($this->usuario_logado_id == $id && $this->usuario_logado_grupo == $grupo){
            $dados['titulo'] = $dados['titulo_edicao'] = 'Atualizar informações';
        }
        else {
            if($this->usuario_logado_grupo == ADMINISTRADOR){
                $dados['titulo'] = $dados['titulo_edicao'] = 'Editar usuário';
            }
            else {
                redirect(base_url('usuario/perfil'));
            }
        }
        
        $dados = array_merge($dados, $this->usuario->buscarUsuarioPeloIdGrupo($id, $grupo));

        if($dados == false){
            redirect(base_url('usuario/perfil'));
        }       

        $estados_cidades = carregarEstadosCidades();

        $dados = array_merge($dados, $estados_cidades);

        $cidade['cidade_id'] = $dados['cidade_id'];
        $this->session->set_flashdata($cidade);

        $dados['grupo_id'] = $grupo;

        $this->load->view('header', $dados);
        $this->load->view('editar_usuario', $dados);
        $this->load->view('footer');
    }

    public function atualizar($id = null){
        if($id == null || empty($this->input->post()) || ($this->usuario_logado_grupo != ADMINISTRADOR && $id != $this->usuario_logado_id)){
            redirect(base_url('usuario/perfil'));
        }

        if(empty($this->input->post('cidade'))){
            definirMensagem('msg_erro', 'danger', 'Selecione uma cidade', 'É obrigatório selecionar uma cidade.');
            
            $url = $this->uri->segment_array();
            $url[2] = 'editar';
            redirect(base_url($url));
        }

        if($this->form_validation->run('alteracao') == true){
            $usuario_buscado = $this->usuario->buscarUsuarioPeloId($id);

            foreach($usuario_buscado as $atributo => $valor){
                $usuario[$atributo] = $valor;
            }

            $nome = $this->input->post('nome');
            if($nome){
                $usuario['nome_completo'] = $nome;
            }

            $celular = $this->input->post('celular');
            if($celular != $usuario_buscado['celular']){
                $usuario['celular'] = $celular;
            }

            $senha = $this->input->post('senha');
            if($senha){
                $usuario['senha'] = password_hash($senha, PASSWORD_DEFAULT);
            }
            
            $grupo = $this->input->post('grupo');
            if($grupo && $grupo != $usuario_buscado['grupo_id']){
                $usuario['grupo_id'] = $grupo;
            }

            $this->usuario->atualizar($usuario);

            $endereco_buscado = $this->endereco->buscarEnderecoPeloUsuario($id);

            foreach($endereco_buscado as $atributo => $valor){
                $endereco[$atributo] = $valor;
            }

            $logradouro = $this->input->post('logradouro');
            if($logradouro != $endereco_buscado['logradouro']){
                $endereco['logradouro'] = $logradouro;
            }

            $numero = $this->input->post('numero');
            if($numero != $endereco_buscado['numero']){
                $endereco['numero'] = $numero;
            }

            $complemento = $this->input->post('complemento');
            if($complemento != $endereco_buscado['complemento']){
                $endereco['complemento'] = $complemento;
            }

            $bairro = $this->input->post('bairro');
            if($bairro != $endereco_buscado['bairro']){
                $endereco['bairro'] = $bairro;
            }

            $cidade_id = $this->input->post('cidade');
            if($cidade_id){
                $endereco['cidade_id'] = $cidade_id;
            }

            $this->endereco->atualizar($endereco);

            if($id == $this->usuario_logado_id){
                $dados_usuario = array(
                    'usuario_nome'     => $usuario['nome_completo'],
                    'usuario_celular'  => $usuario['celular'],
                    'usuario_email'    => $usuario['email'],
                    'usuario_senha'    => $usuario['senha'],
                    'usuario_endereco' => $usuario['endereco_id']
                );

                $this->session->set_userdata($dados_usuario);

                definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Informações atualizadas com sucesso.');

                redirect(base_url('usuario/perfil'));
            }

            definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Usuário atualizado com sucesso.');
        }
        else {
            definirMensagem('msg_erro', 'danger', 'Erro', 'Algum erro ocorreu. Tente novamente.');

            $url    = $this->uri->segment_array();
            $url[2] = 'editar';
            redirect(base_url($url));
        }

        redirect(base_url('usuario/todos'));
    }

    public function excluirUsuario($id = null){
        if($id == null || $this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('usuario'));
        }

        $endereco = $this->endereco->buscarEnderecoPeloUsuario($id);
        
        if($endereco){
            $this->endereco->excluir($endereco['id']);

            definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Usuário removido com sucesso.');
        }
        else {
            definirMensagem('msg_erro', 'danger', 'Erro', 'Usuário não existe.');
        }

        redirect(base_url('usuario'));
    }
}
