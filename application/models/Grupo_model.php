<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'grupo';
		parent::__construct();
	}

	public function buscarGrupoPeloUsuario($id){
		$this->db->select('grupo.id,
						   grupo.nome')
				 ->from($this->tabela)
				 ->join('usuario', 'usuario.grupo_id = grupo.id', 'inner')
				 ->where('usuario.id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else {
			return false;
		}
	}
}