<!-- <div class="container mx-auto col-md-8 col-sm-8 col-xs-8 col-lg-8 pt-3"> -->

<div class="container mx-auto col-md-12 pt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="container">
                <h3>Buscar produto</h3><br>                

                <form method="POST" action="<?php echo base_url('detalhes/filtrar/') . $interesse; ?>">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" class="form-control" name="categoria">
                        <option selected disabled>Selecione uma categoria</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option value=<?php echo $categoria['id']; ?>>
                                <?php echo $categoria['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="estado">Estado</label>
                    <select id="estado" class="form-control" name="estado">
                        <option selected disabled>Selecione um estado</option>
                        <?php foreach($estados as $estado): ?>
                            <option value=<?php echo $estado['id']; ?>>
                                <?php echo $estado['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="cidade">Cidade</label>
                    <select id="cidade" class="form-control" name="cidade" disabled>
                        <option selected>Selecione uma cidade</option>
                    </select>

                    <br>
                    <button type="submit" class="btn btn-primary">Filtrar resultados</button>
                </form>

                <br><br>
            </div>
        </div>
        <div class="col-md-9">

            <div class="container">
                <?php
                echo buscarMensagem('msg_erro');

                echo buscarMensagem('msg_sucesso');
                ?>


                <h2><?php echo $titulo_pagina; ?></h2>

                <?php
                if($produtos):
                    $usuario_logado_grupo = $this->session->userdata('usuario_grupo');
                ?>

                    <br>

                    <div class="row pt-3">
                        <?php foreach($produtos as $produto): ?>
                            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-4 mb-r">
                                <div class="card-deck text-center">
                                    <div class="card d-flex align-items-stretch">
                                        <a data-toggle="modal" data-target="#detalhes" style="color: inherit;" onclick="buscarDetalhesProduto(<?php echo $produto['id']; ?>)">
                                            <img class="img-fluid img-site card-img" src="<?php
                                                                                    if($produto['foto']){
                                                                                        echo base_url('assets/img/' . $produto['foto']);
                                                                                    }
                                                                                    else {
                                                                                        echo base_url('assets/img/sem-foto.gif');
                                                                                    }
                                                                                ?>" alt="<?php echo $produto['produto']; ?>">
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo $produto['produto']; ?></h4>									
                                                <a class="btn btn-md btn-primary" data-toggle="modal" data-target="#detalhes" style="align-self: center;" onclick="buscarDetalhesProduto(<?php echo $produto['id']; ?>)">Ver detalhes</a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <?php
                        if(isset($links)){
                            echo $links;
                        }
                        ?> 
                    </div>

                    <div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-bold"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="conteudo" class="modal-body mx-3">


                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    if(isset($links)){
                        echo $links;
                    }
                    ?>                   

                <?php else: ?>
                    <br>
                    <p>Nenhum produto encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>