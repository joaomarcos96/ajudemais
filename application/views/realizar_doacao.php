<div class="card mx-auto col-md-6 col-sm-6 col-xs-8 col-lg-6">
    <div class="card-body mx-3 my-4">
        <?php
        echo buscarMensagem('msg_erro');

        echo buscarMensagem('msg_sucesso');
        ?>

        <div class="card-title">
            <h2>Realizar doação</h2>
        </div>

        <br>

        <form method="POST" action="<?php echo base_url('produtos/doar/' . $interesse['produto_id'] . '/' . $interesse['donatario_id']) ?>">
            <div class="md-form">
                <p><strong>Nome do donatário: </strong><?php echo $interesse['nome']; ?></p>
            </div>

            <?php if($interesse['celular']): ?>
                <div class="md-form">
                    <p><strong>Celular: </strong><?php echo $interesse['celular']; ?></p>
                </div>
            <?php endif; ?>

            <div class="md-form">
                <p><strong>Cidade: </strong><?php echo $interesse['cidade']; ?></p>
            </div>

            <div class="md-form">
                <p><strong>Estado: </strong><?php echo $interesse['estado']; ?></p>
            </div>

            <div class="md-form">
                <p><strong>E-mail: </strong><?php echo $interesse['email']; ?></p>
            </div>

            <div class="md-form">
                <p><strong>Produto: </strong><?php echo $interesse['produto']; ?></p>
            </div>

            <div class="md-form">
                <p><strong>Categoria: </strong><?php echo $interesse['categoria']; ?></p>
            </div>

            <?php if($interesse['descricao']): ?>
                <div class="md-form">
                    <p><strong>Descrição: </strong><?php echo $interesse['descricao']; ?></p>
                </div>
            <?php endif; ?>
            
            <div class="md-form">
                <p><strong>Foto: </strong></p>
                <img class="img-fluid" src="<?php echo base_url('assets/img/' . $interesse['foto']); ?>" alt="<?php echo $interesse['nome']; ?>">
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Doar</button>
        </form>
    </div>
</div>