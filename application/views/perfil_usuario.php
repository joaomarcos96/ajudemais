	

	<div class="card mx-auto col-md-6 col-sm-8 col-xs-8 col-lg-6">
		<div class="card-body">
		<?php
			echo buscarMensagem('msg_erro');

			echo buscarMensagem('msg_sucesso');
		?>
			<div class="card-title">
				<h2>Perfil de Usuário</h2>
			</div>
			<br>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<!-- <tr>
							<th>Nome</th>
							<th>Celular</th>
							<th>E-mail</th>
							<th>Logradouro</th>
							<th>Número</th>
							<th>Complemento</th>
							<th>Bairro</th>
							<th>Cidade</th>
							<th>Estado</th>
							<th>Tipo de usuário</th>
						</tr> -->
					</thead>
					<tbody>
						<tr>
							<th>Nome</th>
							<td><?php echo $usuario_logado['nome']; ?></td>
						</tr>
						<tr>
							<th>Celular</th>
							<td><?php echo $usuario_logado['celular']; ?></td>
						</tr>
						<tr>
							<th>E-mail</th>
							<td><?php echo $usuario_logado['email']; ?></td>
						</tr>
						<tr>
							<th>Logradouro</th>
							<td><?php echo $usuario_logado['logradouro']; ?></td>
						</tr>
						<tr>
							<th>Número</th>
							<td><?php echo $usuario_logado['numero']; ?></td>
						</tr>
						<tr>
							<th>Complemento</th>
							<td><?php echo $usuario_logado['complemento']; ?></td>
						</tr>
						<tr>
							<th>Bairro</th>
							<td><?php echo $usuario_logado['bairro']; ?></td>
						</tr>
						<tr>
							<th>Cidade</th>
							<td><?php echo $usuario_logado['cidade']; ?></td>
						</tr>
						<tr>
							<th>Estado</th>
							<td><?php echo $usuario_logado['estado']; ?></td>
						</tr>
						<tr>
							<th>Tipo de usuário</th>
							<td><?php echo $usuario_logado['grupo']; ?></td>
						</tr>
						
						<!-- <tr>
						php foreach ($usuario_logado as $atributo): ?>
								<td>php echo $atributo; ?></td>
						php endforeach; ?>
						</tr> -->
					</tbody>
				</table>
			</div>
		</div>
	</div>