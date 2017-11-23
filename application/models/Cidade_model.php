<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'cidade';
		parent::__construct();
	}

	public function buscarCidadesPeloEstado($id){
		$this->db->select('cidade.id, cidade.nome')
				 ->from($this->tabela)
				 ->where('estado_id', $id)
				 ->order_by('cidade.nome', 'asc');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else {
			return false;
		}

	}

}