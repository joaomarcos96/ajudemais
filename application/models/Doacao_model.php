<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doacao_model extends MY_Model {

    public function __construct(){
        $this->tabela = 'doacao';
        parent::__construct();
    }

    public function buscarDoacoesHome(){
        $this->db->select('produto.nome,
                           produto.descricao,
                           produto.foto')
                 ->from($this->tabela)
                 ->join('produto', 'produto.id = doacao.produto_id', 'join')
                 ->order_by('doacao.id', 'desc')
                 ->limit(4);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarTodasDoacoes(){
        $sql = 'select doacao.id,
		produto.nome as produto,
		tabela.doador,
		usuario.nome_completo as donatario,
		doacao.data_doacao
		from
                    (
                        select doacao.id as doacao_id,
                               usuario.nome_completo as doador
                        from doacao
                        inner join usuario on usuario.id = doacao.usuario_donatario_id
                    )
                    as tabela
                inner join doacao on doacao.id = tabela.doacao_id
                inner join produto on produto.id = doacao.produto_id
                inner join usuario on usuario.id = doacao.usuario_doador_id
                order by produto;';

        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarDoacaoExistente($donatario_id, $doador_id){
        $this->db->select('*')
                 ->from($this->tabela)
                 ->where('usuario_donatario_id', $donatario_id)
                 ->where('usuario_doador_id', $doador_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarDoacoesPeloDoador($doador_id){
        $this->db->select('doacao.id,
                           produto.nome as produto,
                           usuario.nome_completo as donatario,
                           doacao.data_doacao')
                 ->from($this->tabela)
                 ->join('produto', 'produto.id = doacao.produto_id', 'inner')
                 ->join('usuario', 'usuario.id = doacao.usuario_donatario_id', 'inner')
                 ->where('doacao.usuario_doador_id', $doador_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarDoacoesPeloDonatario($donatario_id){
        $this->db->select('doacao.id,
                           produto.nome as produto,
                           usuario.nome_completo as doador,
                           doacao.data_doacao')
                 ->from($this->tabela)
                 ->join('produto', 'produto.id = doacao.produto_id', 'inner')
                 ->join('usuario', 'usuario.id = doacao.usuario_doador_id', 'inner')
                 ->where('doacao.usuario_donatario_id', $donatario_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

}
