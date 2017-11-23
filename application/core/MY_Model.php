<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $tabela;

	public function __construct(){
		parent::__construct();
	}

	public function buscarTodos(){
		$query = $this->db->get($this->tabela);
		return $query->result_array();
	}

	public function buscarPorId($id){
		$this->db->select('*')
				 ->from($this->tabela)
				 ->where('id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else {
			return false;
		}
	}

	public function buscarUltimoRegistro(){
		$this->db->select('*')
				 ->from($this->tabela)
				 ->order_by('id', 'desc')
				 ->limit(1);

		$ultimo = $this->db->get();

		return $ultimo->row_array();
	}

	public function inserir($dados){
		if(key_exists('id', $dados)){
			$existente = $this->buscarPorId($dados['id']);

			if($existente){ // já existe, atualizar
				$this->db->replace($this->tabela, $dados);
			}
			else { // cadastrar
				$this->db->insert($this->tabela, $dados);
			}
		}
		else {
			$this->db->insert($this->tabela, $dados);
		}
	}

	public function excluir($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tabela);
	}

}