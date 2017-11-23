		<div class="card mx-auto col-md-8 col-sm-8 col-xs-10 col-lg-8">
			<div class="card-body">
				<?php
					echo buscarMensagem('msg_erro');

					echo buscarMensagem('msg_sucesso');
				?>

				<div class="card-title">
					<h2><?php echo $titulo_tabela; ?></h2>
				</div>

				<div class="table-responsive">
			<?php if($doacoes): ?>
					<table class="table table-hover table-no-bordered">
						<thead>
							<tr>
							<?php if($tabela == 'todas'): ?>
								<th>Produto</th>
								<th>Donatário</th>
								<th>Doador</th>
								<th>Data da Doação</th>
								<?php if($grupo == ADMINISTRADOR): ?>
									<th class="config">Excluir</th>
								<?php endif; ?>
							<?php elseif($tabela == 'realizadas'): ?>
								<th>Produto</th>
								<th>Donatário</th>
								<th>Data da Doação</th>
								<?php if($grupo == ADMINISTRADOR): ?>
									<th class="config">Excluir</th>
								<?php endif; ?>
							<?php else: ?>
								<th>Produto</th>
								<th>Doador</th>
								<th>Data da Doação</th>
								<?php if($grupo == ADMINISTRADOR): ?>
									<th class="config">Excluir</th>
								<?php endif; ?>
							<?php endif; ?>

							</tr>
						</thead>
						<tbody>
							<?php foreach($doacoes as $doacao): ?>
								<tr>
								<?php
									$i = 1;
									foreach ($doacao as $atributo): 
										if($i == 1){
											$i = 0;
											continue;
										}
								?>
										<td><?php echo ($atributo)? $atributo : 'Não consta'; ?></td>
								<?php endforeach; ?>
								<?php if($grupo == ADMINISTRADOR): ?>
									<td>
										<a class="btn btn-danger btn-sm px-3" data-toggle="modal" data-target="#confirmar-delecao" data-id="<?php echo $doacao['id']; ?>">
											<i class="fa fa-remove" aria-hidden="true"></i>
										</a>
									</td>
								<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
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
								<p><?php echo $msg_exclusao; ?></p>
							</div>
							<div class="modal-footer">
								<input type="hidden" id="linha-id" value="">
								<button type="button" class="btn btn-outline-default" data-dismiss="modal">Cancelar</button>
								<!-- <a class="btn btn-danger btn-ok" href="<php //echo base_url('usuario/excluirUsuario/') . $doador['id']; ?>">Excluir</a> -->
								<a id="botao-excluir" class="btn btn-danger btn-ok">Excluir</a>
							</div>
						</div>
					</div>
				</div>

		<?php else:	?>
				<br>
				<p><?php echo $msg_nenhum_registro; ?></p>
		<?php endif; ?>
		
		</div>
	</div>
