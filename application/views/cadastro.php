<div class="card mx-auto col-md-8 col-sm-10 col-xs-8 col-lg-6">
	<div class="card-body mx-3 my-4">
		<div class="text-center cyan-text">
			<h3><i class="fa fa-user-plus cyan-text"></i> Cadastro</h3>
			<hr class="my-4">
		</div>

		<?php
		echo buscarMensagem('msg_erro');

		echo buscarMensagem('msg_sucesso');
		?>

		<p class="obrigatorio">*Obrigatório</p>

		<br>

		<form method="POST" action="<?php echo base_url('login/cadastrarUsuario/'); ?>">
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
				<input type="number" id="numero" class="form-control" name="numero" min="1">
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
				<input type="password" id="senha" class="form-control" name="senha" pattern=".{3,}" required
					   title="A senha deve conter no mínimo 3 caracteres">
				<label for="senha">Senha: <span class="obrigatorio">*</span></label>
			</div>

			<br>

			<button type="submit" class="btn btn-primary">Cadastrar</button>

			<br>
		</form>
	</div>
</div>


            