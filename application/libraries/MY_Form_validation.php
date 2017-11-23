<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	public function __construct($config = array()){
		parent::__construct($config);
	}

	public function alpha_spaces($str){
		if(strlen($str) < 3){
			return false;
		}
		return (!preg_match("/^[\p{L}\p{P}\p{Zs}`´]+$/u", $str))? false : true;
	}

	public function validacao_celular($str){
		$tam = strlen($str);
		if($tam > 0 && $tam < 14){
			return false;
		}
		else {
			return true;
		}
	}
}