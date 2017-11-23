<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function definirMensagem($nome, $tipo, $titulo, $mensagem){
    $msg = array(
        'tipo'   => $tipo,
        'titulo' => $titulo,
        'msg'    => $mensagem
    );

    $CI =& get_instance();

    $CI->session->set_flashdata($nome, $msg);
}

function buscarMensagem($nome){
    $CI =& get_instance();

    $msg = $CI->session->flashdata($nome);
    if($msg){
        $html = '<div class="alert alert-' . $msg['tipo'] . ' alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>' . $msg['titulo'] . '</strong> 
                    <br>' . $msg['msg'] .
                '</div>';
        return $html;
    }
}

function verificarUsuarioLogado(){
    $CI =& get_instance();

    if($CI->session->userdata('esta_logado')){
        return true;
    }
    else {
        return false;
    }
}

/*
  Retorna se o usuário pode acessar a página atual,
  através da lista de páginas que o usuário pode acessar
*/

function verificarAcesso(){
    $CI =& get_instance();

    $paginas            = $CI->session->userdata('paginas');
    $url_pagina_atual   = uri_string();
    $array_pagina_atual = explode('/', $url_pagina_atual);
    $pagina_atual       = $array_pagina_atual[0];

    $pode_acessar = in_array($pagina_atual, $paginas);

    return $pode_acessar;
}

function carregarEstadosCidades(){
    $CI =& get_instance();

    $CI->load->model('estado_model');
    $dados['estados'] = $CI->estado_model->buscarTodos();

    return $dados;
}

function inverterData($dados, $atributo){
    $i = 0;
    foreach($dados as $doador){
        $dados[$i][$atributo] = date('d/m/Y', strtotime($doador[$atributo]));

        // $dados[$i]['data_cadastro'] = implode('/', array_reverse(explode('-', $doador['data_cadastro'])));

        $i++;
    }
    return $dados;
}

function pegarPrimeiroNome($nome){
    $nome = explode(' ', $nome);
    return $nome[0];
}

/*
  Função para retirar _model do nome do arquivo
*/

function retiraModelNome($nome){
    $nome = explode('_', $nome);
    $tam  = count($nome) - 1;

    $result = '';

    for($i = 0; $i < $tam; $i++){
        $result .= $nome[$i];
        if($i < $tam - 1){
            $result .= '_';
        }
    }

    return $result;
}

function debug($arr){
    echo '<pre>';
    var_dump($arr);
    die();
}
