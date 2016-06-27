<?php
	$produto = $this->vars;
?>
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Editar Produto</strong></div>

			<?php if (!empty($produto)) { ?>
			<form action="<?php echo URL_APP; ?>?controller=produto&acao=editar&codigo=<?php echo $produto['p_id']; ?>" method="post">
				<input type="hidden" name="p_id" value="<?php echo $produto['p_id']; ?>">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-center"><strong>#</strong></td>
							<td class="text-center"><strong>nome</strong></td>
							<td class="text-center"><strong>descricao</strong></td>
							<td class="text-center"><strong>preço</strong></td>
							<td class="text-center"><strong>ações</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><?php echo $produto['p_id']; ?></td>
							<td><input class="col-xs-12" type="text" name="p_nome" value="<?php echo $produto['p_nome']; ?>"></td>
							<td><input class="col-xs-12" type="emil" name="p_descricao" value="<?php echo $produto['p_descricao']; ?>"></td>
							<td><input class="col-xs-12" type="phone" name="p_preco" value="<?php echo $produto['p_preco']; ?>"></td>
							<td class="text-center">
								<button class="btn btn-sm btn-primary" type="submit" name="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar dados</button>
								<a href="<?php echo URL_APP; ?>?controller=produto&acao=excluir&codigo=<?php echo $produto['p_id']; ?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php } ?>
		</div>
	</div>
</div>