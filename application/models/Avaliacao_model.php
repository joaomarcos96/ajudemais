<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'avaliacao';
		parent::__construct();
	}

}