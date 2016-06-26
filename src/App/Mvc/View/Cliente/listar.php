<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Clientes cadastrados</strong></div>
			<table class="table table-striped table-bordered table-hover">

				<?php
					if (!empty($this->vars[0])) {
				?>

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
				<?php

					foreach ($this->vars as $indice => $cliente) {
						echo "<tr>";
							echo '<td class="text-center"><strong>'. $cliente['c_id'] .'</strong></td>';
							echo '<td>'. $cliente['c_nome'] .'</td>';
							echo '<td>'. $cliente['c_email'] .'</td>';
							echo '<td>'. $cliente['c_telefone'] .'</td>';
							echo '<td class="text-center"><a href="'. URL_APP .'?controller=cliente&acao=editar&codigo='. $cliente['c_id'] .'" class="btn btn-block btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
						echo "</tr>";
					}

				?>
				</tbody>

				<?php
					} else {
						echo '<tr class="text-center"><td><div class="label label-primary">Nenhum cliente cadastrado</div></td></tr>';
					}
				?>
			</table>
		</div>
	</div>
</div>