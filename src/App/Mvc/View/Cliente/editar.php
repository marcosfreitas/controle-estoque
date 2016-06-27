<?php
	$cliente = $this->vars;
?>
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Editar Cliente</strong></div>

			<?php if (!empty($cliente)) { ?>
			<form action="<?php echo URL_APP; ?>?controller=cliente&acao=editar&codigo=<?php echo $cliente['c_id']; ?>" method="post">
				<input type="hidden" name="c_id" value="<?php echo $cliente['c_id']; ?>">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-center"><strong>#</strong></td>
							<td class="text-center"><strong>nome</strong></td>
							<td class="text-center"><strong>e-mail</strong></td>
							<td class="text-center"><strong>telefone</strong></td>
							<td class="text-center"><strong>ações</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><?php echo $cliente['c_id']; ?></td>
							<td><input class="col-xs-12" type="text" name="c_nome" value="<?php echo $cliente['c_nome']; ?>"></td>
							<td><input class="col-xs-12" type="email" name="c_email" value="<?php echo $cliente['c_email']; ?>"></td>
							<td><input class="col-xs-12" type="phone" name="c_telefone" value="<?php echo $cliente['c_telefone']; ?>"></td>
							<td class="text-center">
								<button class="btn btn-sm btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar dados</button>
								<a href="<?php echo URL_APP; ?>?controller=cliente&acao=excluir&codigo=<?php echo $cliente['c_id']; ?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php } ?>
		</div>
	</div>
</div>