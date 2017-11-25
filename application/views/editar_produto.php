		<div class="card mx-auto col-md-8 col-sm-8 col-xs-8 col-lg-6">
			<div class="card-body">
			<?php
				echo buscarMensagem('msg_erro');

				echo buscarMensagem('msg_sucesso');
			?>

				<div class="card-title">
					<h2>Editar produto</h2>
				</div>

				<br>

				<form method="POST" action="<?php echo base_url('produtos/atualizar/') . $id; ?>" enctype="multipart/form-data">
					<div class="md-form">
						<input type="text" id="nome" class="form-control" name="nome" value="<?php echo $nome; ?>" autofocus required>
						<label for="nome">Nome: </label>
					</div>

					<div class="md-form">
						<textarea type="text" id="descricao" class="md-textarea" rows="3" name="descricao"><?php echo $descricao; ?></textarea>
						<label for="descricao">Descrição: </label>
					</div>

					<div class="md-form">
						<label for="categoria">Categoria: </label><br><br>
						<select id="categoria" class="form-control" name="categoria" required>
							<option value="" selected hidden>Selecione uma categoria</option>
							<?php foreach ($categorias as $categoria): ?>
									<option value=<?php echo $categoria['id'];?> <?php if($categoria['id'] == $categoria_id){ echo 'selected'; } ?>><?php echo $categoria['nome']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Foto atual: </label><br>
						<img class="img-fluid" src="<?php echo base_url('assets/img/' . $foto); ?>" alt="<?php echo $nome; ?>">
						<br><br>
						<label for="foto">Alterar foto: </label>
						<input type="file" id="foto" class="form-control-file" name="foto" value="foto" accept="image/*">
					</div>

					<br>

					<button type="submit" class="btn btn-primary">Atualizar</button>
				</form>
			</div>
		</div>