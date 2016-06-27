<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Adicionar Cliente</strong></div>

			<form action="<?php echo URL_APP; ?>?controller=cliente&acao=adicionar" method="post">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-center"><strong>nome</strong></td>
							<td class="text-center"><strong>e-mail</strong></td>
							<td class="text-center"><strong>telefone</strong></td>
							<td class="text-center"><strong>ações</strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input required class="col-xs-12" type="text" name="c_nome" value=""></td>
							<td><input required class="col-xs-12" type="email" name="c_email" value=""></td>
							<td><input required class="col-xs-12" type="phone" name="c_telefone" value=""></td>
							<td class="text-center">
								<button class="btn btn-sm btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar dados</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>