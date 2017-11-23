<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'categoria';
		parent::__construct();
	}

	public function buscarCategorias(){
		$this->db->select('*')
			     ->from($this->tabela)
			     ->order_by('categoria.nome', 'asc');

		$query = $this->db->get();

		return $query->result_array();
	}
}