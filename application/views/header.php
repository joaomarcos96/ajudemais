<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo $titulo; ?></title>
        
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">

        <?php
        $css = array(
            'font-awesome.css',
            'bootstrap.min.css',
            'mdb.min.css',
            'estilos.css'
        );

        echo assets_css($css);
        ?>

    </head>
    <body>
        <header>

            <?php
            $esta_logado = $this->session->userdata('esta_logado');
            $grupo_usuario = $this->session->userdata('usuario_grupo');
            $id_usuario = $this->session->userdata('usuario_id');
            ?>

            <nav class="mb-1 navbar navbar-expand-lg navbar-dark teal darken-4">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Ajude+</a>
                <img class="navbar-brand" src="<?php echo base_url('assets/img/favicon.png'); ?>" alt="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-3">

                    <?php if($esta_logado == true): ?>
                        <ul class="navbar-nav mr-auto">
                            
                            <?php
                            $urls_meus_produtos = array(
                                'produtos/meus',
                                'produtos/cadastro',
                                'produtos/interessados'
                            );
                            ?>
                            
                            <li class="nav-item dropdown <?php if(in_array(uri_string(), $urls_meus_produtos)){ echo 'active'; } ?>">
                                <a class="nav-link dropdown-toggle" id="meus-produtos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Meus produtos
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="meus-produtos">
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/meus'); ?>">Mostrar todos</a>
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/cadastro'); ?>">Cadastrar</a>
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/interessados'); ?>">Interessados</a>
                                </div>
                            </li>
                            
                            <?php
                            $urls_outros_produtos = array(
                                'detalhes/filtrar',
                                'detalhes/filtrar/1',
                                'detalhes/filtrar/2',
                                'produtos/disponiveis',
                                'produtos/disponiveis/1',
                                'produtos/disponiveis/2'
                            );
                            ?>

                            <li class="nav-item dropdown <?php if(in_array(uri_string(), $urls_outros_produtos)){ echo 'active'; } ?>">
                                <a class="nav-link dropdown-toggle" id="produtos-doacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Outros produtos
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="produtos-doacao">
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/disponiveis'); ?>">Para doação</a>
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/disponiveis/1'); ?>">Mostrei interesse</a>
                                    <a class="dropdown-item" href="<?php echo base_url('produtos/disponiveis/2'); ?>">Não mostrei interesse</a>
                                </div>
                            </li>
                            
                            <?php
                            $urls_doacoes = array(
                                'doacoes/todas',
                                'doacoes/realizadas',
                                'doacoes/recebidas'
                            );
                            ?>

                            <li class="nav-item dropdown <?php if(in_array(uri_string(), $urls_doacoes)){ echo 'active'; } ?>">
                                <a class="nav-link dropdown-toggle" id="doacoes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Doações
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="doacoes">
                                    <a class="dropdown-item" href="<?php echo base_url('doacoes/todas'); ?>">Mostrar todas</a>
                                    <a class="dropdown-item" href="<?php echo base_url('doacoes/realizadas'); ?>">Realizadas</a>
                                    <a class="dropdown-item" href="<?php echo base_url('doacoes/recebidas'); ?>">Recebidas</a>
                                </div>
                            </li>
                            
                            <?php
                            $urls_usuarios = array(
                                'usuario',
                                'usuario/cadastro'
                            );
                            ?>

                            <?php if($grupo_usuario == ADMINISTRADOR): ?>
                                <li class="nav-item dropdown <?php if(in_array(uri_string(), $urls_usuarios)){ echo 'active'; } ?>">
                                    <a class="nav-link dropdown-toggle" id="usuarios" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Usuários
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="usuarios">
                                        <a class="dropdown-item" href="<?php echo base_url('usuario'); ?>">Mostrar todos</a>
                                        <a class="dropdown-item" href="<?php echo base_url('usuario/cadastro'); ?>">Cadastrar</a>
                                    </div>
                                </li>

                                <li class="nav-item <?php if(uri_string() == 'produtos/todos'){ echo 'active'; } ?>">
                                    <a class="nav-link" href="<?php echo base_url('produtos'); ?>">Todos Produtos</a>
                                </li>
                            <?php endif; ?>

                        </ul>

                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user fa-fw"></i>
                                </a>
                                
                                <?php $nome = $this->session->userdata('usuario_nome'); ?>
                                
                                <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?php echo base_url('usuario/perfil'); ?>">
                                        <p style="text-align: center;"><em><?php echo pegarPrimeiroNome($nome); ?></em></p>
                                        <i class="fa fa-user fa-fw"></i> Perfil
                                    </a>									
                                    <a class="dropdown-item" href="<?php echo base_url('usuario/editar/' . $id_usuario); ?>">
                                        <i class="fa fa-gear fa-fw"></i> Configurações
                                    </a>
                                    <a class="dropdown-item" href="<?php echo base_url('login/deslogarUsuario'); ?>">
                                        <i class="fa fa-sign-out fa-fw"></i> Sair
                                    </a>
                                </div>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?php echo base_url('#sobre'); ?>">
                                    Sobre o projeto
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?php echo base_url('#doacoes-recentes'); ?>">
                                    Doações recentes
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?php echo base_url('#contato'); ?>">
                                    Contato
                                </a>
                            </li>

                        </ul>

                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="<?php
                                   if($this->session->userdata('esta_logado')){
                                       echo base_url('produtos/disponiveis');
                                   }
                                   else {
                                       echo base_url('login');
                                   }
                                   ?>">
                                    Entre na sua conta
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </nav>

        </header>

        <?php if($esta_logado == true): ?>

            <div id="wrapper">

            <?php endif;
					