<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endereco_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'endereco';
		parent::__construct();
	}

	public function buscarEnderecoPeloUsuario($id){
		$this->db->select('endereco.*')
				 ->from($this->tabela)
				 ->join('usuario', 'usuario.endereco_id = endereco.id', 'inner')
				 ->where('usuario.id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else {
			return false;
		}
	}

	public function buscarEnderecoCompleto($id){
		$this->db->select('endereco.logradouro,
						   endereco.numero,
						   endereco.complemento,
						   endereco.bairro,
						   cidade.nome as cidade,
						   estado.nome as estado')
				 ->from($this->tabela)
				 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
				 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
				 ->where('endereco.id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else {
			return false;
		}
	}

	public function atualizar($endereco){
		$this->db->set('logradouro', $endereco['logradouro'])
				 ->set('numero', $endereco['numero'])
				 ->set('complemento', $endereco['complemento'])
				 ->set('bairro', $endereco['bairro'])
				 ->set('cidade_id', $endereco['cidade_id'])
				 ->where($endereco['id'] . ' = endereco.id')
				 ->update($this->tabela);
	}

}