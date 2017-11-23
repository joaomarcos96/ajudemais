	

<div class="card mx-auto col-md-10 col-sm-10 col-xs-12 col-lg-10">
    <div class="card-body">
        <?php
        echo buscarMensagem('msg_erro');

        echo buscarMensagem('msg_sucesso');
        ?>

        <div class="card-title">
            <h2><?php echo $titulo_tabela; ?></h2>
        </div>

        <div class="table-responsive">
            <?php if($usuarios): ?>
                <table id="table_id" class="table table-hover table-no-bordered">
                    <thead>
                        <tr>
                            <th hidden="true">Id</th>
                            <th>Nome</th>
                            <th hidden="true">Celular</th>
                            <th>E-mail</th>
                            <th hidden="true">Logradouro</th>
                            <th hidden="true">Número</th>
                            <th hidden="true">Complemento</th>
                            <th hidden="true">Bairro</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Data de Cadastro</th>
                            <th class="config">Alterar</th>
                            <th class="config">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <?php
                                $i = 1;
                                foreach($usuario as $atributo):
                                    if(in_array($i, array(1, 3, 5, 6, 7, 8)) == false):
                                        ?>
                                        <td><?php echo $atributo; ?></td>
                                        <?php
                                    endif;
                                    $i++;
                                endforeach;
                                ?>
                                <td>
                                    <a class="btn btn-primary btn-sm px-3" href="<?php echo base_url($url) . $usuario['id']; ?>">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td>
                                    <a class="btn btn-danger btn-sm px-3" data-toggle="modal" data-target="#confirmar-delecao" data-id="<?php echo $usuario['id']; ?>">
                                        <i class="fa fa-remove" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                if(isset($links)){
                    echo $links;
                }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmar-delecao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-bold">Confirmação de exclusão</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <p><?php echo $msg_exclusao; ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="linha-id" value="">
                    <button type="button" class="btn btn-outline-default" data-dismiss="modal">Cancelar</button>
                    <!-- <a class="btn btn-danger btn-ok" href="<php //echo base_url('usuario/excluirUsuario/') . $doador['id']; ?>">Excluir</a> -->
                    <a id="botao-excluir" class="btn btn-danger btn-ok">Excluir</a>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <br>
    <p><?php echo $msg_nenhum_registro; ?></p>
<?php endif; ?>

<!-- <hr> -->