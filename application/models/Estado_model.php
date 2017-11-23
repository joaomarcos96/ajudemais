<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends MY_Model {

	public function __construct(){
		$this->tabela = 'estado';
		parent::__construct();
	}

}