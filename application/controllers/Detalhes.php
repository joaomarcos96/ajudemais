<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhes extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function buscarDetalhes($produto_id){
        if($this->input->is_ajax_request() == false){
            show_404();
        }

        $produto = $this->produto->buscarProdutoPeloId($produto_id);
        ?>

        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <img class="img-fluid" src="<?php
                                            if($produto['foto']){
                                                echo base_url('assets/img/' . $produto['foto']);
                                            }
                                            else {
                                                echo base_url('assets/img/sem-foto.gif');
                                            }
                                            ?>"
                                       alt="<?php echo $produto['produto']; ?>" >
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <h5><?php echo $produto['categoria']; ?></h5>
                <h4><?php echo $produto['produto']; ?></h4>
                <p>
                    <?php
                    if($produto['descricao']){
                        echo $produto['descricao'];
                    }
                    else {
                        echo 'Sem descrição';
                    }
                    ?>
                </p>
                <?php

                if($produto['usuario_id'] != $this->session->userdata('usuario_id')){

                    $produtos = $this->produto->buscarProdutosDoacao();

                    $interesses = $this->interesse->buscarTodos();

                    $produtos_interesses = array();

                    foreach($interesses as $interesse){
                        if($interesse['usuario_id'] == $this->session->userdata('usuario_id')){
                            $produtos_interesses[$interesse['produto_id']] = true;
                        }
                    }

                    foreach($produtos as $produto){
                        if(key_exists($produto['id'], $produtos_interesses) == false){
                            $produtos_interesses[$produto['id']] = false;
                        }
                    }

                    if($produtos_interesses[$produto_id]):
                        ?>
                        <a class="btn btn-danger" href="<?php echo base_url('produtos/cancelarinteresse/') . $produto_id; ?>">
                            Cancelar interesse
                        </a>
                    <?php
                    else:
                    ?>
                        <a class="btn btn-default" href="<?php echo base_url('produtos/mostrarinteresse/') . $produto_id; ?>">
                            Mostrar interesse
                        </a>
                    <?php
                    endif;
                }

                ?>
            </div>
        </div>

        <?php
    }

    public function filtrar($interesse = null){
        $categoria = $this->input->post('categoria');
        $estado    = $this->input->post('estado');
        $cidade    = $this->input->post('cidade');
        
        $usuario_id = $this->session->userdata('usuario_id');

        if($categoria == null && $estado == null && $cidade == null){
            if($interesse == 1){
                $dados['produtos'] = $this->produto->buscarProdutosInteressado($usuario_id, 1);
            }
            else if($interesse == 2){
                $dados['produtos'] = $this->produto->buscarProdutosInteressado($usuario_id, 2);
            }
            else {
                $dados['produtos'] = $this->produto->buscarProdutosDisponiveis();
            }
        }
        else {
            $dados['produtos'] = $this->produto->buscarProdutoFiltros($categoria, $estado, $cidade, $usuario_id, $interesse);
        }
        
        if($interesse == 1){
            $dados['titulo_pagina'] = 'Produtos que mostrei interesse';
        }
        else if($interesse == 2){
            $dados['titulo_pagina'] = 'Produtos que não mostrei interesse';
        }
        else {
            $dados['titulo_pagina'] = 'Produtos disponíveis para doação';
        }

        $dados['titulo'] = 'Produtos';

        $dados['interesses'] = $this->interesse->buscarTodos();
        
        $dados['interesse'] = $interesse;

        $dados['produtos_interesses'] = array();
        
        if($dados['interesses']){
            foreach($dados['interesses'] as $interesse){
                if($interesse['usuario_id'] == $this->session->userdata('usuario_id')){
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

}
