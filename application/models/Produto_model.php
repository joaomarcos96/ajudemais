<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends MY_Model {

    public function __construct(){
        $this->tabela = 'produto';
        parent::__construct();
    }
    
    public function quantidadeProdutos($usuario_id = null, $interesse = null){
        if($usuario_id == null){
            return $this->db->count_all($this->tabela);
        }
        
        if($interesse == 1){
            $query = $this->db->join('interesse', 'interesse.produto_id = produto.id', 'inner')
                              ->where($usuario_id . ' = produto.usuario_id')
                              ->where('interesse.produto_id = produto.id')
                              ->get($this->tabela);
        }
        else if($interesse == 2){
            $sql = 'select produto_id from interesse';
            
            $query_sql = $this->db->query($sql)->result_array();
            
            $produtos_interesse = array();
            
            foreach($query_sql as $query){
                $produtos_interesse[] = $query['produto_id'];
            }
            
            $query = $this->db->where($usuario_id . ' = produto.usuario_id')
                              ->where_not_in('produto.id', $produtos_interesse)
                              ->get($this->tabela);
        }
        else {
            $query = $this->db->where($usuario_id . ' = produto.usuario_id')
                              ->get($this->tabela);
        }
        
        return $query->num_rows();
    }

    public function buscarProdutoFiltros($categoria = null, $estado = null, $cidade = null, $usuario_id, $interesse = null){
        $this->db->select('produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.foto')
                 ->from($this->tabela);
        
        if($interesse == 1){
            $this->db->join('interesse', 'interesse.produto_id = produto.id', 'inner');
        }

        if($categoria){
            if($estado){
                if($cidade){
                    $this->db->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                             ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                             ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                             ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                             ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                             ->where('categoria.id', $categoria)
                             ->where('estado.id', $estado)
                             ->where('cidade.id', $cidade);
                }
                else {
                    $this->db->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                             ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                             ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                             ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                             ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                             ->where('categoria.id', $categoria)
                             ->where('estado.id', $estado);
                }
            }
            else {
                $this->db->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                         ->where('categoria.id', $categoria);
            }
        }
        else if($estado){
            if($cidade){
                $this->db->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                         ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                         ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                         ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                         ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                         ->where('estado.id', $estado)
                         ->where('cidade.id', $cidade);
            }
            else {
                $this->db->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                         ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                         ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                         ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                         ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                         ->where('estado.id', $estado);
            }
        }
        
        if($interesse == 1){
            $this->db->where('interesse.produto_id = produto.id');
        }
        else if($interesse == 2){
            $sql = 'select produto_id from interesse';
            
            $query_sql = $this->db->query($sql)->result_array();
            
            $produtos_interesse = array();
            
            foreach($query_sql as $query){
                $produtos_interesse[] = $query['produto_id'];
            }
                    
            $this->db->where_not_in('produto.id', $produtos_interesse);
        }

        $this->db->where('produto.status', 1)
                 ->where($usuario_id . ' != produto.usuario_id')
                 ->order_by('produto.id', 'asc');


        $query = $this->db->get();
        
//        echo $this->db->last_query(); die();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarProdutoPelaDoacao($doacao_id){
        $this->db->select('produto.id,
                           produto.nome,
                           produto.descricao,
                           produto.categoria_id,
                           produto.status')
                 ->from($this->tabela)
                 ->join('doacao', 'doacao.produto_id = produto.id', 'inner')
                 ->where('doacao.id', $doacao_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarProdutosDoacao(){
        $this->db->select('produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.foto')
                 ->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->where('produto.status', 1)
                 ->order_by('produto.nome', 'asc');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarProdutosDisponiveis($usuario_id){
        $this->db->select('produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.foto')
                 ->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->where('produto.status', 1)
                 ->where($usuario_id . ' != produto.usuario_id')
                 ->order_by('produto.id', 'asc');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarProdutosInteressado($usuario_id, $interessado){
        if($interessado == 1){
            $this->db->select('produto.id,
                               produto.nome as produto,
                               produto.descricao,
                               categoria.nome as categoria,
                               produto.foto')
                     ->from($this->tabela)
                     ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                     ->join('interesse', 'interesse.produto_id = produto.id', 'inner')
                     ->where('produto.status', 1)
                     ->where($usuario_id . ' != produto.usuario_id')
                     ->where('interesse.produto_id = produto.id')
                     ->order_by('produto.id', 'asc');
            
            $query = $this->db->get();
        }
        else {
            $sql = 'select produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.foto
                    from produto 
                    inner join categoria on categoria.id = produto.categoria_id
                    where produto.status = 1
                    and ' . $usuario_id . ' != produto.usuario_id
                    and produto.id not in
                    (select produto_id from interesse)
                    order by produto.id;';
            
            $query = $this->db->query($sql);
        }
        
//        echo $this->db->last_query(); die();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarProdutosUsuarios(){
        $this->db->select('produto.id,
                           usuario.nome_completo as dono,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.status')
                 ->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                 ->order_by('dono', 'asc');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarProdutos($doador_id){
        $this->db->select('produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.nome as categoria,
                           produto.status')
                 ->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->join('usuario', 'usuario.id = produto.usuario_id', 'inner')
                 ->where('usuario.id', $doador_id)
                 ->order_by('produto.id', 'asc');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarProdutosPaginacao($usuario_id = null, $limite_por_pagina, $comeco){
        if($usuario_id == null){
            $this->db->select('produto.id,
                               usuario.nome_completo as dono,
                               produto.nome as produto,
                               produto.descricao,
                               categoria.nome as categoria,
                               produto.status,
                               produto.foto');
        }
        else {
            $this->db->select('produto.id,
                               produto.nome as produto,
                               produto.descricao,
                               categoria.nome as categoria,
                               produto.status,
                               produto.foto');
        }
        
        $this->db->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->join('usuario', 'usuario.id = produto.usuario_id', 'inner');
        
        if($usuario_id != null){
            $this->db->where('usuario.id', $usuario_id);
        }
        
        $this->db->order_by('produto.id', 'asc')
                 ->limit($limite_por_pagina, $comeco);
        
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarProdutoPeloId($id){
        $this->db->select('produto.id,
                           produto.nome as produto,
                           produto.descricao,
                           categoria.id as categoria_id,
                           categoria.nome as categoria,
                           produto.status,
                           produto.foto,
                           produto.usuario_id')
                 ->from($this->tabela)
                 ->join('categoria', 'categoria.id = produto.categoria_id', 'inner')
                 ->where('produto.id', $id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function atualizar($produto){
        $this->db->set('nome', $produto['nome'])
                 ->set('descricao', $produto['descricao'])
                 ->set('categoria_id', $produto['categoria_id'])
                 ->set('status', $produto['status'])
                 ->set('foto', $produto['foto'])
                 ->where($produto['id'] . ' = produto.id')
                 ->update($this->tabela);
    }

}
