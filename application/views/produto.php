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
            <?php if(isset($produtos) && $produtos): ?>
                <table class="table table-hover table-no-bordered">
                    <thead>
                        <tr>
                            <?php if(isset($todos) && $todos == true): ?>
                                <th>Dono do produto</th>
                            <?php endif; ?>
                            <th>Nome do produto</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Detalhes</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produtos as $produto): ?>
                            <tr>
                                <?php
                                $i = 0;
                                foreach($produto as $chave => $valor):
                                    if($i == 0 || $chave == 'foto'){
                                        $i = 1;
                                        continue;
                                    }

                                    if($chave == 'status'):
                                ?>
                                        <td><?php echo ($valor == 0) ? 'Doado' : 'Não doado' ?></td>
                              <?php else: ?>
                                        <td><?php echo ($valor != null) ? $valor : 'Não consta'; ?></td>
                              <?php endif; ?>

                          <?php endforeach; ?>

                                <td>
                                    <a class="btn btn-default btn-sm px-3" data-toggle="modal" data-target="#detalhes" style="align-self: center;" onclick="buscarDetalhesProduto(<?php echo $produto['id']; ?>)">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <?php if($produto['status'] == 1): ?>
                                    <td>
                                        <a class="btn btn-primary btn-sm px-3" href="<?php echo base_url('produtos/editar/') . $produto['id']; ?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                     <!--<td><a class="btn btn-danger btn-sm" href="<?php //echo base_url('usuario/excluirUsuario/') . $doador['id'];  ?>"><span class="glyphicon glyphicon-remove"></span></a></td> ;-->

                                    <td>
                                        <a class="btn btn-danger btn-sm px-3" data-toggle="modal" data-target="#confirmar-delecao" data-id="<?php echo $produto['id']; ?>">
                                            <i class="fa fa-remove" aria-hidden="true"></i>
                                        </a>
                                    </td>

                                <?php else: ?>
                                    <td>
                                        <div class="tooltip-wrapper" data-title="Este produto já foi doado">
                                            <a class="btn btn-primary btn-sm px-3 disabled">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="tooltip-wrapper" data-title="Este produto já foi doado">
                                            <a class="btn btn-danger btn-sm px-3 disabled">
                                                <i class="fa fa-remove" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>

                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                if(isset($links)){
                    echo $links;
                }
                ?>  
            <?php else: ?>
                <br>
                <p>Não há produtos cadastrados.</p>
            <?php endif; ?>
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
                <p>Deseja mesmo <strong>excluir</strong> esse produto?</p>
                <p>Obs.: Este processo é irreversível e remove também todos os interesses e doações associados a este produto.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="linha-id" value="">
                <button type="button" class="btn btn-outline-default" data-dismiss="modal">Cancelar</button>
                <a id="botao-excluir" class="btn btn-danger btn-ok">Excluir</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
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