<div class="card mx-auto col-md-8 col-sm-10 col-xs-8 col-lg-6">
    <div class="card-body mx-3 my-4">

        <?php
        echo buscarMensagem('msg_erro');

        echo buscarMensagem('msg_sucesso');
        ?>

        <div class="card-title">
            <h3>Cadastrar produto para doação</h3>
        </div>

        <br>

        <p class="obrigatorio">*Obrigatório</p>

        <br>

        <form method="POST" action="<?php echo base_url('produtos/cadastrar'); ?>" enctype="multipart/form-data">
            <div class="md-form">
                <input type="text" id="nome" class="form-control" name="nome" autofocus required>
                <label for="nome">Nome: <span class="obrigatorio">*</span></label>
            </div>

            <div class="md-form">
                <textarea type="text" id="descricao" class="md-textarea" rows="3" name="descricao"></textarea>
                <label for="descricao">Descrição: </label>
            </div>

            <div class="md-form">
                <label for="categoria">Categoria: <span class="obrigatorio">*</span></label><br><br>
                <select id="categoria" class="form-control" name="categoria" required>
                    <option value="" selected hidden>Selecione uma categoria</option>
                    <?php foreach($categorias as $categoria): ?>
                        <option value=<?php echo $categoria['id']; ?>>
                            <?php echo $categoria['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto: <span class="obrigatorio">*</span></label>
                <input type="file" id="foto" class="form-control-file" name="foto" value="foto" accept="image/*" required>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>
</div>