<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionalidade_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'funcionalidade';
		parent::__construct();
	}

	public function buscarFuncionalidadePeloId($id){
		$this->db->select('funcionalidade.nome')
				 ->from($this->tabela)
				 ->where('funcionalidade.id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else {
			return false;
		}

	}

}