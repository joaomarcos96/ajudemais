<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

    private $usuario_logado_grupo,
            $usuario_logado_id;

    public function __construct(){
        parent::__construct();

        if(verificarUsuarioLogado() == false || verificarAcesso() == false){
            redirect(base_url('login'));
        }

        $this->usuario_logado_grupo = $this->session->userdata('usuario_grupo');
        $this->usuario_logado_id    = $this->session->userdata('usuario_id');
    }

    public function index(){
        $dados['titulo'] = 'Produtos';

        if($this->usuario_logado_grupo == COMUM){
            redirect(base_url('produtos/meus'));
        }
        else {
            redirect(base_url('produtos/todos'));
        }
    }
    
    public function meus(){
        $dados['titulo'] = $dados['titulo_tabela'] = 'Meus produtos';

        $dados['usuario_logado_grupo'] = $this->usuario_logado_grupo;
        
        $limite_por_pagina = 5;
        $comeco = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_registros = $this->produto->quantidadeProdutos($this->usuario_logado_id);
        
        if($total_registros > 0){
            $dados['produtos'] = $this->produto->buscarProdutosPaginacao($this->usuario_logado_id, $limite_por_pagina, $comeco);
            
            $config['base_url'] = base_url('produtos/meus');
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

        $this->load->view('header', $dados);
        $this->load->view('produto', $dados);
        $this->load->view('footer');
    }
    
    public function todos(){
        if($this->usuario_logado_grupo != ADMINISTRADOR){
            redirect(base_url('produtos/disponiveis'));
        }
        
        $dados['titulo'] = $dados['titulo_tabela'] = 'Todos produtos';

        $dados['usuario_logado_grupo'] = $this->usuario_logado_grupo;
        
        $dados['todos'] = true;
        
        $limite_por_pagina = 5;
        $comeco = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_registros = $this->produto->quantidadeProdutos();
        
        if($total_registros > 0){
            $dados['produtos'] = $this->produto->buscarProdutosPaginacao(null, $limite_por_pagina, $comeco);
            
            $config['base_url'] = base_url('produtos/todos');
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

        $this->load->view('header', $dados);
        $this->load->view('produto', $dados);
        $this->load->view('footer');
    }
    
    public function disponiveis($interesse = null){        
        if($interesse == 1){
            $dados['produtos'] = $this->produto->buscarProdutosInteressado($this->usuario_logado_id, 1);
            $dados['titulo_pagina'] = 'Produtos que mostrei interesse';
        }
        else if($interesse == 2){
            $dados['produtos'] = $this->produto->buscarProdutosInteressado($this->usuario_logado_id, 2);
            $dados['titulo_pagina'] = 'Produtos que não mostrei interesse';
        }
        else {
            $dados['produtos'] = $this->produto->buscarProdutosDisponiveis($this->usuario_logado_id);
            $dados['titulo_pagina'] = 'Produtos disponíveis para doação';
        }
        
        $dados['titulo'] = 'Produtos';

        $dados['interesses'] = $this->interesse->buscarTodos();
        
        $dados['interesse'] = $interesse;

        $dados['produtos_interesses'] = array();
        
        if($dados['interesses']){
            foreach($dados['interesses'] as $interesse){
                if($interesse['usuario_id'] == $this->usuario_logado_id){
                    $dados['produtos_interesses'][$interesse['produto_id']] = true;
                }
            }
        }
        
        if($dados['produtos']){
            foreach($dados['produtos'] as $produto){
                if(key_exists($produto['id'], $dados['produtos_interesses']) == false){
                    $dados['produtos_interesses'][$produto['id']] = false;
                }
            }
        }

        $dados['categorias'] = $this->categoria->buscarCategorias();

        $estados_cidades = carregarEstadosCidades();

        $dados = array_merge($dados, $estados_cidades);

        $this->load->view('header', $dados);
        $this->load->view('produtos_doacao', $dados);
        $this->load->view('footer', $dados);
    }
    
    public function mostrarInteresse($produto_id){
        if($produto_id == null){
            redirect(base_url('produtos/disponiveis'));
        }

        $produto = $this->produto->buscarPorId($produto_id);

        $interesse_produto = $this->interesse->buscarInteresse($usuario_id, $produto_id);

        if($produto == null || $interesse_produto != null){
            definirMensagem('msg_erro', 'danger', 'Erro', 'Erro ao mostrar interesse no produto.');

            redirect(base_url('produtos/disponiveis'));
        }

        $interesse['produto_id'] = $produto_id;
        $interesse['usuario_id'] = $this->usuario_logado_id;

        $this->interesse->inserir($interesse);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Interesse mostrado com sucesso.');

        redirect(base_url('produtos/disponiveis'));
    }

    public function cancelarInteresse($produto_id){
        if($produto_id == null){
            redirect(base_url('produtos/disponiveis'));
        }

        $produto = $this->produto->buscarPorId($produto_id);

        $interesse_produto = $this->interesse->buscarInteresse($this->usuario_logado_id, $produto_id);

        if($produto == null || $interesse_produto == null){
            definirMensagem('msg_erro', 'danger', 'Erro', 'Erro ao cancelar interesse no produto.');

            redirect(base_url('produtos/disponiveis'));
        }

        $this->interesse->excluirInteresse($this->usuario_logado_id, $produto_id);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Interesse cancelado com sucesso.');

        redirect(base_url('produtos/disponiveis'));
    }

    public function cadastro(){
        $dados['usuario_logado_grupo'] = $this->usuario_logado_grupo;

        $dados['titulo'] = 'Cadastrar produto';

        $dados['categorias'] = $this->categoria->buscarCategorias();

        $this->load->view('header', $dados);
        $this->load->view('cadastro_produto', $dados);
        $this->load->view('footer');
    }

    public function cadastrar(){
        if(empty($this->input->post()) || $this->form_validation->run('cadastro_produto') == false){
            definirMensagem('msg_erro', 'danger', 'Erro', 'Algum erro ocorreu. Tente novamente.');

            redirect(base_url('produtos/cadastro'));
        }

        $produto['usuario_id'] = $this->usuario_logado_id;

        $produto['nome'] = $this->input->post('nome');

        $descricao = $this->input->post('descricao');
        if($descricao){
            $produto['descricao'] = $descricao;
        }

        $produto['categoria_id'] = $this->input->post('categoria');

        $produto['status'] = 1;

        if($this->upload->do_upload('foto')){
            $produto['foto'] = $this->upload->data()['file_name'];

            $this->produto->inserir($produto);

            definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Produto cadastrado com sucesso.');

            redirect(base_url('produtos/cadastro'));
        }
        else {
            definirMensagem('msg_erro', 'danger', 'Erro', 'Algum erro ocorreu ao tentar cadastrar o produto. Tente novamente.');

            redirect(base_url('produtos/cadastro'));
        }
    }

    public function editar($id = null){
        if($id == null){
            redirect(base_url('produtos/meus'));
        }

        $dados = $this->produto->buscarPorId($id);

        if($dados == false || $dados['status'] == 0){
            redirect(base_url('produtos/meus'));
        }

        $dados['categorias'] = $this->categoria->buscarCategorias();

        $dados['titulo'] = 'Editar produto';

        $this->load->view('header', $dados);
        $this->load->view('editar_produto', $dados);
        $this->load->view('footer');
    }

    public function atualizar($id = null){
        if($id == null || empty($this->input->post())){
            redirect(base_url('produtos/disponiveis'));
        }

        if($this->form_validation->run('cadastro_produto') == true){

            $produto_buscado = $this->produto->buscarProdutoPeloId($id);

            foreach($produto_buscado as $atributo => $valor){
                $produto[$atributo] = $valor;
            }

            $nome = $this->input->post('nome');
            if($nome){
                $produto['nome'] = $nome;
            }

            $descricao = $this->input->post('descricao');
            if($descricao != $produto_buscado['descricao']){
                $produto['descricao'] = $descricao;
            }

            $categoria = $this->input->post('categoria');
            if($categoria){
                $produto['categoria_id'] = $categoria;
            }

            if($this->upload->do_upload('foto')){
                $produto['foto'] = $this->upload->data()['file_name'];

                $this->produto->atualizar($produto);
            }
            else {
                $this->produto->atualizar($produto);
            }
        }

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Produto atualizado com sucesso.');

        redirect(base_url('produtos/meus'));
    }

    public function excluir($id = null){
        if($id == null){
            redirect(base_url('produtos/meus'));
        }

        $produto = $this->produto->buscarPorId($id);

        if($produto['status'] == 0){
            redirect(base_url('produtos/meus'));
        }
        
        $foto = dirname(__FILE__) . '/../../assets/img/' . $produto['foto'];
        if(file_exists($foto)){
            unlink($foto);
        }
        else {
            definirMensagem('msg_erro', 'danger', 'Erro', 'Houve algum erro ao tentar excluir o produto. Tente novamente.');
            
            redirect(base_url('produtos/meus'));
        }

        $this->produto->excluir($id);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Produto removido com sucesso.');

        redirect(base_url('produtos/meus'));
    }

    public function interessados(){
        $dados['interessados'] = $this->interesse->buscarTodosInteresses($this->usuario_logado_id);

        $dados['titulo'] = 'Interessados nos seus produtos';

        $this->load->view('header', $dados);
        $this->load->view('produtos_interesse', $dados);
        $this->load->view('footer');
    }

    public function realizarDoacao($produto_id = null, $donatario_id = null){
        if($donatario_id == null || $produto_id == null){
            redirect(base_url('produtos/interessados'));
        }

        $interesse = $this->interesse->buscarInteresse($donatario_id, $produto_id);

        if($interesse == false){
            redirect(base_url('produtos/interessados'));
        }

        $dados['titulo'] = 'Realizar Doação';

        $dados['interesse'] = $this->interesse->buscarInteressePeloDonatario($donatario_id, $produto_id);

        $this->load->view('header', $dados);
        $this->load->view('realizar_doacao', $dados);
        $this->load->view('footer', $dados);
    }

    public function doar($produto_id = null, $donatario_id = null){
        if($donatario_id == null || $produto_id == null){
            show_404();
        }

        $produto = $this->produto->buscarPorId($produto_id);

        $produto['status'] = 0;

        $this->produto->atualizar($produto);

        $doacao['produto_id']           = $produto_id;
        $doacao['usuario_doador_id']    = $this->session->userdata('usuario_id');
        $doacao['usuario_donatario_id'] = $donatario_id;
        $doacao['data_doacao']          = date('Y-m-d');

        $this->doacao->inserir($doacao);

        $this->interesse->excluirInteressesPeloProduto($produto_id);

        definirMensagem('msg_sucesso', 'success', 'Sucesso', 'Doação realizada com sucesso.');

        redirect(base_url('produtos/interessados'));
    }

}
