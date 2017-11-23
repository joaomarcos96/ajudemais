<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interesse_model extends MY_Model {

    public function __construct(){
        $this->tabela = 'interesse';
        parent::__construct();
    }

    public function buscarInteresse($usuario_id, $produto_id){
        $this->db->select('*')
                ->from($this->tabela)
                ->where('usuario_id', $usuario_id)
                ->where('produto_id', $produto_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarInteressePeloDonatario($donatario_id, $produto_id){
        $this->db->select('usuario.id as donatario_id,
                           produto.id as produto_id,
                           usuario.nome_completo as nome,
                           usuario.celular,
                           cidade.nome as cidade,
                           estado.nome as estado,
                           usuario.email,
                           produto.nome as produto,
                           categoria.nome as categoria,
                           produto.descricao,
                           produto.foto')
                 ->from($this->tabela)
                 ->join('usuario', 'usuario.id = interesse.usuario_id', 'inner')
                 ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                 ->join('produto', 'produto.id = interesse.produto_id', 'inner')
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->where('usuario.id', $donatario_id)
                 ->where('produto.id', $produto_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarTodosInteresses($usuario_id){
        $sql = 'select usuario.id as donatario_id,
		produto.id as produto_id,
                usuario.nome_completo as donatario_nome,
                produto.nome as produto_nome,
                produto.descricao,
                categoria.nome as categoria
                from
                    (
                        select interesse.usuario_id,
                               produto.id as produto_id,
                               categoria.id as categoria_id
                        from interesse
                        inner join produto on produto.id = interesse.produto_id
                        inner join usuario on produto.usuario_id = usuario.id
                        inner join categoria on categoria.id = produto.categoria_id
                        where usuario.id = ' . $usuario_id . '
                    )
                    as tabela
	            inner join usuario on usuario.id = tabela.usuario_id
	            inner join produto on produto.id = tabela.produto_id
	            inner join categoria on categoria.id = tabela.categoria_id
	            order by donatario_nome';

        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function excluirInteresse($usuario_id, $produto_id){
        $this->db->where('usuario_id', $usuario_id)
                 ->where('produto_id', $produto_id);

        $this->db->delete($this->tabela);
    }

    public function excluirInteressesPeloProduto($produto_id){
        $this->db->where('produto_id', $produto_id);
        $this->db->delete($this->tabela);
    }

}
