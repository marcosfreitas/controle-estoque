<?php
	$clientes = $this->vars['clientes'];
	$produtos = $this->vars['produtos'];
?>

<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Adicionar Pedido</strong></div>

			<?php if (!empty($clientes) || !empty($produtos)) { ?>

				<form action="<?php echo URL_APP; ?>?controller=pedido&acao=adicionar" method="post">
					<div class="panel-body">
						<div class="col-xs-4">
							<div class="form-group">
								<label>Selecione o cliente</label>
								<select class="form-control" name="c_id" id="lista-clientes">
									<?php
										foreach ($clientes as $chave => $valor) {
											echo '<option value="'. $valor['c_id'] .'">'. $valor['c_nome'] .'</option>';
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-xs-3">
							<div class="form-group">
								<label>Adicione Produtos</label>
								<select class="form-control" id="lista-produtos">
									<?php
										foreach ($produtos as $chave => $valor) {
											echo '<option data-id="'. $valor['p_id'] .'" data-preco="'. $valor['p_preco'] .'">'. $valor['p_nome'] .'</option>';
										}
									?>
								</select>
							</div>
						</div>
						
						<!--<div class="col-xs-2">
							<div class="form-group">
								<label>Quantidade</label>
								<input class="form-control" type="number" id="qntd-prod">
							</div>
						</div>-->
						<div class="col-xs-2">
							<div class="form-group">
								<label for="">&nbsp;</label>
								<button type="button" class="form-control btn btn-primary btn-sm" id="add-qntd-prod"><span class="glyphicon glyphicon-plus"></span> adicionar</button>
							</div>
						</div>
					</div>
					<table id="tabela-prod" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-center"><strong>id</strong></td>
								<td class="text-center"><strong>nome</strong></td>
								<td class="text-center"><strong>valor</strong></td>
								<td class="text-center"><strong>remover</strong></td>
							</tr>
						</thead>
						<tbody></tbody>
						<br>
					</table>
					<div class="form-group text-right">
						<button style="margin-right: 10px;" class="btn btn-sm btn-primary" type="submit" name="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar dados</button>
					</div>
				</form>

				<script>
					(function($){

						var remover = function() {
							$('.remove-prod').on('click', function(){
								$(this).parent().closest('tr').remove();
							});
						}


						$('#add-qntd-prod').on('click', function() {
							var prod_id = $('#lista-produtos option:selected').attr('data-id'),
								prod_nome = $('#lista-produtos option:selected').text(),
								prod_preco = $('#lista-produtos option:selected').attr('data-preco');
							
							$('#tabela-prod tbody').append('<tr><td class="text-center">'+ prod_id +'<input type="hidden" name="produtos[]" value="'+ prod_id +'"></td><td>'+ prod_nome +'</td><td>'+ prod_preco +'</td><td class="text-center"><button type="button" class="remove-prod btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></td></tr>');

							remover();
						});
					})(jQuery);
				</script>

				<?php } else { ?>
					<div class="panel-body text-center"><p class="label label-primary">Não há clientes ou produtos cadastrados, você ainda não pode cadastrar um pedido.</p><div>
				<?php } ?>
		</div>
	</div>
</div>