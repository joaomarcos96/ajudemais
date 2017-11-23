<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $dados['doacoes'] = $this->doacao->buscarDoacoesHome();

        $this->load->view('home', $dados);
    }

}
