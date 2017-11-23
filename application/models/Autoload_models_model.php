<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autoload_models_model extends CI_Model {

	public function __construct(){
		parent::__construct();

		$arquivos_model = scandir(__DIR__);

		foreach($arquivos_model as $arquivo){
			$arquivo = strtolower($arquivo);
			$nome_arquivo = explode('.', $arquivo)[0];
			$extensao = explode('.', $arquivo)[1];

			if($nome_arquivo !== strtolower(__CLASS__) && $extensao === 'php'){
				$apelido = retiraModelNome($nome_arquivo);
				$this->load->model($nome_arquivo, $apelido);
			}
		}
	}
}