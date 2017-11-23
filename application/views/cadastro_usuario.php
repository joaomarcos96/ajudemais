<div class="card mx-auto col-md-8 col-sm-8 col-xs-8 col-lg-6">
    <div class="card-body mx-3 my-4">

        <?php
        echo buscarMensagem('msg_erro');

        echo buscarMensagem('msg_sucesso');
        ?>

        <div class="card-title">
            <h3>Cadastrar <?php echo $titulo_cadastro; ?></h3>
        </div>

        <br>

        <p class="obrigatorio">*Obrigatório</p>

        <br>

        <form method="POST" action="<?php echo base_url('usuario/cadastrarUsuario'); ?>">
            <div class="md-form">
                <input type="text" id="nome" class="form-control" name="nome" autofocus required>
                <label for="nome">Nome: <span class="obrigatorio">*</span></label>
            </div>

            <div class="md-form">
                <input type="text" id="celular" class="form-control" name="celular">
                <label for="celular">Celular: </label>
            </div>

            <div class="md-form">
                <label for="estado">Estado: <span class="obrigatorio">*</span></label><br><br>
                <select id="estado" class="form-control" name="estado" required>
                    <option value="" selected hidden>Selecione um estado</option>
                    <?php foreach($estados as $estado): ?>
                        <option value=<?php echo $estado['id']; ?>>
                            <?php echo $estado['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="md-form">
                <label for="cidade">Cidade: <span class="obrigatorio">*</span></label><br><br>
                <select id="cidade" class="form-control" name="cidade" disabled required>
                    <option value="" selected hidden>Selecione um estado primeiro</option>
                </select>
            </div>

            <div class="md-form">
                <input type="text" id="logradouro" class="form-control" name="logradouro">
                <label for="logradouro">Logradouro: </label>
            </div>

            <div class="md-form">
                <input type="number" id="numero" class="form-control" name="numero">
                <label for="numero">Número: </label>
            </div>

            <div class="md-form">
                <input type="text" id="complemento" class="form-control" name="complemento">
                <label for="complemento">Complemento: </label>
            </div>

            <div class="md-form">
                <input type="text" id="bairro" class="form-control" name="bairro">
                <label for="bairro">Bairro: </label>
            </div>

            <div class="md-form">
                <input type="email" id="email" class="form-control" name="email" required>
                <label for="email">E-mail: <span class="obrigatorio">*</span></label>
            </div>

            <div class="md-form">
                <input type="password" id="senha" class="form-control" name="senha" pattern=".{3,}" required title="A senha deve conter no mínimo 3 caracteres.">
                <label for="senha">Senha: <span class="obrigatorio">*</span></label>
            </div>

            <div class="md-form">
                <label for="grupo">Tipo de usuário: <span class="obrigatorio">*</span></label><br><br>
                <select id="grupo" class="form-control" name="grupo" required>
                    <option value="" selected hidden>Selecione um tipo de usuário</option>
                    <option value="2">Comum</option>
                    <option value="1">Administrador</option>
                </select>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>