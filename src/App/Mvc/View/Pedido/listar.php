<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Pedidos cadastrados</strong></div>
			<table class="table table-striped table-bordered table-hover">

				<?php
					$pedidos = $this->vars;
					if (!empty($pedidos)) {
				?>

				<thead>
					<tr>
						<td class="text-center"><strong>id</strong></td>
						<td class="text-center"><strong>cliente</strong></td>
						<td class="text-center"><strong>id(s) produto(s)</strong></td>
						<td class="text-center"><strong>editar</strong></td>
					</tr>
				</thead>
				<tbody>
				<?php

					foreach ($pedidos as $indice => $pedido) {
						echo "<tr>";
							echo '<td class="text-center"><strong>'. $pedido['pe_id'] .'</strong></td>';
							echo '<td>'. $pedido['c_nome'] .'</td>';
							echo '<td>'. $pedido['fk_produto'] .'</td>';
							echo '<td class="text-center"><a href="'. URL_APP .'?controller=pedido&acao=editar&codigo='. $pedido['pe_id'] .'" class="btn btn-block btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
						echo "</tr>";
					}

				?>
				</tbody>

				<?php
					} else {
						echo '<tr class="text-center"><td><div class="label label-primary">Nenhum produto cadastrado</div></td></tr>';
					}
				?>
			</table>
		</div>
	</div>
</div>