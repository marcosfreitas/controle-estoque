<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Produtos cadastrados</strong></div>
			<table class="table table-striped table-bordered table-hover">

				<?php
					if (!empty($this->vars[0])) {
				?>

				<thead>
					<tr>
						<td class="text-center"><strong>#</strong></td>
						<td class="text-center"><strong>nome</strong></td>
						<td class="text-center"><strong>descrição</strong></td>
						<td class="text-center"><strong>preço</strong></td>
						<td class="text-center"><strong>ações</strong></td>
					</tr>
				</thead>
				<tbody>
				<?php

					foreach ($this->vars as $indice => $produto) {
						echo "<tr>";
							echo '<td class="text-center"><strong>'. $produto['p_id'] .'</strong></td>';
							echo '<td>'. $produto['p_nome'] .'</td>';
							echo '<td>'. $produto['p_descricao'] .'</td>';
							echo '<td>'. \App\Core\Moeda::formata_moeda_br($produto['p_preco']) .'</td>';
							echo '<td class="text-center"><a href="'. URL_APP .'?controller=produto&acao=editar&codigo='. $produto['p_id'] .'" class="btn btn-block btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>';
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