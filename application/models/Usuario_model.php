<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends MY_Model {

    public function __construct(){
        $this->tabela = 'usuario';
        parent::__construct();
    }
    
    public function quantidadeUsuarios(){
        return $this->db->count_all($this->tabela);
    }
    
    public function buscarTodosUsuarios(){
        $this->db->select('usuario.id,
                           usuario.nome_completo,
                           usuario.celular,
                           usuario.email,
                           endereco.logradouro,
                           endereco.numero,
                           endereco.complemento,
                           endereco.bairro,
                           cidade.nome,
                           estado.uf,
                           usuario.data_cadastro')
                 ->from($this->tabela)
                 ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                 ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarUsuariosPaginacao($limite, $comeco){
        $this->db->select('usuario.id,
                           usuario.nome_completo,
                           usuario.celular,
                           usuario.email,
                           endereco.logradouro,
                           endereco.numero,
                           endereco.complemento,
                           endereco.bairro,
                           cidade.nome,
                           estado.uf,
                           usuario.data_cadastro')
                 ->from($this->tabela)
                 ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                 ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner')
                 ->limit($limite, $comeco);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }
    
    public function buscarGrupoPeloUsuario($id){
        $this->db->select('usuario.grupo_id')
                 ->from($this->tabela)
                 ->where('usuario.id', $id);
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarUsuarioPeloId($id){
         $this->db->select('usuario.*')
                  ->from($this->tabela)
                  ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                  ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                  ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                  ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner')
                  ->where('usuario.id', $id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarUsuarioPeloEmail($email){
        $this->db->select('usuario.email')
                 ->from($this->tabela)
                 ->where('usuario.email', $email);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function atualizar($usuario){
        $this->db->set('nome_completo', $usuario['nome_completo'])
                 ->set('celular', $usuario['celular'])
                 ->set('senha', $usuario['senha'])
                 ->set('grupo_id', $usuario['grupo_id'])
                 ->where($usuario['id'] . ' = usuario.id')
                 ->update($this->tabela);
    }

    public function logarUsuario($email, $senha){
        // $this->db->select('*')
        // 		 ->from($this->tabela)
        // 		 ->where('email', $email)
        // 		 ->where('senha', $senha);
        // $query = $this->db->get();
        // if($query->num_rows() > 0){
        // 	return $query->row_array();
        // }
        // else {
        // 	return false;
        // }

        $this->db->select('*')
                ->from($this->tabela)
                ->where('email', $email);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            $usuario = $query->row_array();

            if(password_verify($senha, $usuario['senha']) == false){
                return false;
            }
            else {
                return $usuario;
            }
        }
        else {
            return false;
        }
    }

    public function buscarPaginas($id){
        $this->db->select('funcionalidade.nome as funcionalidades')
                 ->from('funcionalidade')
                 ->join('grupo_funcionalidade', 'grupo_funcionalidade.funcionalidade_id = funcionalidade.id', 'inner')
                 ->join('grupo', 'grupo_funcionalidade.grupo_id = grupo.id', 'inner')
                 ->where('grupo.id', $id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarTodosUsuariosPeloGrupo($grupo_id){
        $this->db->select('usuario.id,
                           usuario.nome_completo,
                           usuario.celular,
                           usuario.email,
                           endereco.logradouro,
                           endereco.numero,
                           endereco.complemento,
                           endereco.bairro,
                           cidade.nome,
                           estado.uf,
                           usuario.data_cadastro')
                 ->from($this->tabela)
                 ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                 ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner')
                 ->where('grupo.id', $grupo_id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else {
            return false;
        }
    }

    public function buscarUsuarioPeloIdGrupo($id, $grupo_id){
        $this->db->select('usuario.id,
                           usuario.nome_completo,
                           usuario.celular,
                           usuario.email,
                           usuario.data_cadastro,
                           endereco.id as endereco_id,
                           endereco.logradouro,
                           endereco.numero,
                           endereco.complemento,
                           endereco.bairro,
                           cidade.id as cidade_id,
                           estado.id as estado_id')
                 ->from($this->tabela)
                 ->join('endereco', 'endereco.id = usuario.endereco_id', 'inner')
                 ->join('cidade', 'cidade.id = endereco.cidade_id', 'inner')
                 ->join('estado', 'estado.id = cidade.estado_id', 'inner')
                 ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner')
                 ->where('grupo.id', $grupo_id)
                 ->where('usuario.id', $id);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else {
            return false;
        }
    }

    public function buscarUsuario($id, $grupo_id){
        $this->db->select('usuario.id,
                           usuario.nome_completo')
                ->from($this->tabela)
                ->join('grupo', 'grupo.id = usuario.grupo_id', 'inner')
                ->where('grupo.id', $grupo_id)
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
