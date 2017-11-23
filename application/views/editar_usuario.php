<div class="card mx-auto col-md-8 col-sm-8 col-xs-8 col-lg-6">
    <div class="card-body">
        <?php
        echo buscarMensagem('msg_erro');

        echo buscarMensagem('msg_sucesso');
        ?>

        <div class="card-title">
            <h2><?php echo $titulo_edicao; ?></h2>
        </div>

        <br>

        <form method="POST" action="<?php echo base_url('usuario/atualizar/') . $id; ?>">
            <div class="md-form">
                <input type="text" id="nome" class="form-control" name="nome" value="<?php echo $nome_completo; ?>" autofocus required>
                <label for="nome">Nome: </label>
            </div>

            <div class="md-form">
                <input type="text" id="celular" class="form-control" name="celular" value="<?php echo $celular; ?>">
                <label for="celular">Celular: </label>
            </div>

            <div class="md-form">
                <label for="estado">Estado: </label><br><br>
                <select id="estado" class="form-control" name="estado" required>
                    <option selected hidden>Selecione um estado</option>
                    <?php foreach($estados as $estado): ?>
                        <option value=<?php echo $estado['id']; ?> <?php if($estado['id'] == $estado_id){ echo 'selected'; } ?>>
                            <?php echo $estado['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="md-form">
                <label for="cidade">Cidade: </label><br><br>
                <select id="cidade" class="form-control" name="cidade" disabled required>
                    <option selected hidden>Selecione um estado primeiro</option>
                </select>
            </div>

            <div class="md-form">
                <input type="text" id="logradouro" class="form-control" name="logradouro" value="<?php if($logradouro){ echo $logradouro; } ?>">
                <label for="logradouro">Logradouro: </label>
            </div>

            <div class="md-form">
                <input type="number" id="numero" class="form-control" name="numero" value="<?php if($numero){ echo $numero; } ?>">
                <label for="numero">Número: </label>
            </div>

            <div class="md-form">
                <input type="text" id="complemento" class="form-control" name="complemento" value="<?php if($complemento){ echo $complemento; } ?>">
                <label for="complemento">Complemento: </label>
            </div>

            <div class="md-form">
                <input type="text" id="bairro" class="form-control" name="bairro" value="<?php if($bairro){ echo $bairro; } ?>">
                <label for="bairro">Bairro: </label>
            </div>

            <div class="md-form">
                <input type="password" id="senha" class="form-control" name="senha" pattern=".{3,}" title="A senha deve conter no mínimo 3 caracteres.">
                <label for="senha">Senha: </label>
            </div>
            
            <?php if($this->session->userdata('usuario_grupo') == ADMINISTRADOR && $this->session->userdata('usuario_id') != $id): ?>
                <div class="md-form">
                    <label for="grupo">Tipo de usuário: <span class="obrigatorio">*</span></label><br><br>
                    <select id="grupo" class="form-control" name="grupo" required>
                        <option value="2" <?php if($grupo_id == COMUM){ echo 'selected'; } ?> >Comum</option>
                        <option value="1" <?php if($grupo_id == ADMINISTRADOR){ echo 'selected'; } ?> >Administrador</option>
                    </select>
                </div>
            <?php endif; ?>

            <br>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</div>