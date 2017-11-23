		
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-xs-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center cyan-text">
                        <h3><i class="fa fa-lock cyan-text"></i> Login</h3>
                        <hr class="my-4">
                    </div>

                    <?php
                    echo buscarMensagem('msg_erro');

                    echo buscarMensagem('msg_sucesso');
                    ?>

                    <form class="form-signin" method="POST" action="<?php echo base_url('login/logarUsuario'); ?>">
                        <fieldset>
                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="email" id="email" class="form-control" name="email" autofocus required>
                                <label for="email">E-mail de usuário</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <input type="password" id="senha" class="form-control" name="senha" pattern=".{3,}" required title="A senha deve conter no mínimo 3 caracteres">
                                <label for="senha">Senha</label>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-info" name="login">Entrar</button>
                            </div>

                        </fieldset>
                    </form>							

                </div>

                <div class="modal-footer">
                    <div class="options">
                        <p>Novo usuário?
                            <a href="<?php echo base_url('login/cadastrar'); ?>">Crie sua conta</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>