		<div class="card mx-auto col-md-10 col-sm-10 col-xs-8 col-lg-8">
			<div class="card-body">

			<?php
				echo buscarMensagem('msg_erro');

				echo buscarMensagem('msg_sucesso');
			?>

				<div class="card-title">
					<h2>Pessoas interessadas em meus produtos</h2>
				</div>

				<div class="table-responsive">
			<?php if($interessados): ?>
					<table class="table table-hover table-no-bordered">
						<thead>
							<tr>
								<th>Nome do donatário</th>
								<th>Nome do produto</th>
								<th>Descrição</th>
								<th>Categoria</th>
								<th>Doação</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($interessados as $interessado): ?>
							<tr>

							<?php
								$i = 0;
								foreach ($interessado as $atributo):
									if($i == 0 ||$i == 1){
										$i++;
										continue;
									}
							?>
								<td><?php echo ($atributo)? $atributo : 'Não consta'; ?></td>
							<?php endforeach; ?>

							<td>
								<a class="btn btn-primary btn-md" href="<?php echo base_url('produtos/realizardoacao/' . $interessado['produto_id'] . '/' . $interessado['donatario_id']); ?>">
									Doar
								</a>
							</td>

							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			<?php else:	?>
				<br>
				<p>Ainda não há pessoas interessadas em seus produtos.</p>
			<?php endif; ?>
			
			</div>
		</div>