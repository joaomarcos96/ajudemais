<?php 
$config = array(
	'login' => array(
		array(
			'field'	=>	'email',
			'label'	=> 	'E-mail',
			'rules' =>	'' //'trim|required|valid_email'
		),
		array(
			'field'	=>	'senha',
			'label'	=> 	'Senha',
			'rules' =>	'required'
		)
	),
	'cadastro' => array(
		array(
			'field'	=>	'nome',
			'label'	=> 	'Nome',
			'rules' =>	'trim|required|alpha_spaces'
		),
		array(
			'field'	=>	'celular',
			'label'	=>	'Celular',
			'rules'	=>	'validacao_celular'
		),
		array(
			'field'	=>	'email',
			'label'	=> 	'E-mail',
			'rules' =>	'trim|required|valid_email'
		),
		array(
			'field'	=>	'senha',
			'label'	=> 	'Senha',
			'rules' =>	'required'
		)
	),
	'alteracao' => array(
		array(
			'field'	=>	'nome',
			'label'	=> 	'Nome',
			'rules' =>	'trim|alpha_spaces'
		),
		array(
			'field'	=>	'celular',
			'label'	=>	'Celular',
			'rules'	=>	'validacao_celular'
		),
		array(
			'field'	=>	'email',
			'label'	=> 	'E-mail',
			'rules' =>	'trim|valid_email'
		),
		array(
			'field'	=>	'senha',
			'label'	=> 	'Senha',
			'rules' =>	''
		)
	),
	'cadastro_produto' => array(
		array(
			'field'	=>	'nome',
			'label'	=> 	'Nome',
			'rules' =>	'trim|required'
		),
		array(
			'field'	=>	'quantidade',
			'label'	=> 	'Quantidade',
			'rules' =>	'numeric|greater_than[0]'
		)
	)

);