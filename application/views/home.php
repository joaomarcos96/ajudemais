<!DOCTYPE html>
<html class="full-height">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Ajude+</title>
        
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
    <body id="page-top">

        <header>

            <nav class="mb-1 navbar navbar-expand-lg navbar-dark teal darken-4 fixed-top" id="mainNav">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Ajude+</a>
                <img class="navbar-brand js-scroll-trigger" src="<?php echo base_url('assets/img/favicon.png'); ?>" alt="logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#sobre">
                                Sobre o projeto
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#doacoes-recentes">
                                Doações recentes
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#contato">
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
                </div>
            </nav>

            <section class="view intro-1 hm-black-strong">
                <div class="full-bg-img flex-center">
                    <div class="container">
                        <ul>
                            <li>
                                <h1 class="h1-responsive font-bold wow fadeInDown" data-wow-delay="0.2s">Ajude+</h1></li>
                            <li>
                                <p class="lead mt-4 mb-5 wow fadeInDown">Ajude. Doe. Contribue. Uma pequena ação pode mudar a vida de outra pessoa.</p>
                            </li>
                            <li>
                                <a href="<?php echo base_url('login/cadastrar'); ?>" class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.2s" rel="nofollow">Faça parte!</a>
                                <a href="#sobre" class="btn btn-default btn-lg wow fadeInRight js-scroll-trigger" data-wow-delay="0.2s" rel="nofollow">Mais informações</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

        </header>

        <div class="container">

            <div id="sobre" class="divider-new pt-5">
                <h2 class="h2-responsive wow fadeIn" data-wow-delay="0.2s">Sobre o Projeto</h2>
            </div>

            <section id="about" class="text-center wow fadeIn" data-wow-delay="0.2s">
                <p>O Ajude+ foi criado inspirado na esperança de um mundo melhor. Através dele, queremos unir pessoas de todos os gêneros, raças, classes sociais e gostos, unidos por uma única causa: ajudar o próximo!</p>
            </section>

            <div id="doacoes-recentes" class="divider-new pt-5">
                <h2 class="h2-responsive wow fadeIn">Doações recentes</h2>
            </div>

            <section id="best-features">

                <div class="row pt-3 wow fadeIn" data-wow-delay="0.2s">
                    <?php
                    if($doacoes):
                        foreach($doacoes as $doacao):
                            ?>
                            <div class="col mb-r">
                                <div class="card-deck">
                                    <div class="card wow fadeIn d-flex align-items-stretch" data-wow-delay="0.2s">
                                        <img class="img-fluid card-img" src="<?php
                                        if($doacao['foto']){
                                            echo base_url('assets/img/' . $doacao['foto']);
                                        }
                                        else {
                                            echo base_url('assets/img/sem-foto.gif');
                                        }
                                        ?>" alt="<?php echo $doacao['nome']; ?>">
                                        <div class="card-body">
                                            <h4 class="card-title text-center"><?php echo $doacao['nome']; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <p class="mx-auto">Não há doações recentes</p>
                    <?php
                    endif;
                    ?>
                </div>

            </section>

            <div class="divider-new" id="contato">
                <h2 class="h2-responsive wow fadeIn">Contato</h2>
            </div>

            <section id="contact pb-5">
                <div class="row">
                    <div class="col-md-8 mb-5">
                        <div id="map-container" class="z-depth-1 wow fadeIn" style="height: 300px"></div>
                    </div>

                    <div class="col-md-4">
                        <ul class="text-center list-unstyled">
                            <li class="wow fadeIn" data-wow-delay="0.2s"><i class="fa fa-map-marker teal-text fa-lg"></i>
                                <p>IFSULDEMINAS - Campus Muzambinho</p>
                            </li>

                            <li class="wow fadeIn mt-5 pt-2" data-wow-delay="0.3s"><i class="fa fa-phone teal-text fa-lg"></i>
                                <p>(35) 3571 5051</p>
                            </li>

                            <li class="wow fadeIn mt-5 pt-2" data-wow-delay="0.4s"><i class="fa fa-envelope teal-text fa-lg"></i>
                                <p>12151002588@muz.ifsuldeminas.edu.br</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>

        <footer id="home-footer">
            <p>Copyright &copy; 2017, Ajude+</p>
        </footer>

        <?php
        $js = array(
            'jquery-3.2.1.min.js',
            'jquery.mask.min.js',
            'popper.min.js',
            'bootstrap.min.js',
            'mdb.min.js',
            'funcoes.js'
        );

        echo assets_js($js);
        ?>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSa_CZuFVTYbPuZTFIFeGgkT8RhZvl9YA&callback=initMap" type="text/javascript"></script>

    </body>
</html>