<?php
require '../config.php';
require ROOT.'vendor'. DS .'autoload.php';

try {

	/*$cliente = new App\Mvc\Model\Cliente(null, "Thomas", "tom@mail.com", "222222222");
		$c_id = $cliente->inserir();
		echo "Cliente Cadastrado<br>";

	$produto = new App\Mvc\Model\Produto(null, "Arroz Tio João 5 Kg", "Arroz integral de 5 kg", "10.00");
		$p_id = $produto->inserir();
		echo "Produto Cadastrado<br>";

		$pedido = new App\Mvc\Model\Pedido(null, $p_id, $c_id);

			$pedido->inserir();
			echo "Pedido Cadastrado<br>";

		$pedido = null;

	$produto = null;

	$cliente = null;

	$pedido = new App\Mvc\Model\Pedido();

		$p = $pedido->todos_pedidos();
		foreach($p as $i=>$v) {
			var_dump($pedido->obter_dados($v['pe_id']));
		}

	$pedido = null;
	*/

	$controller = isset($_GET['controller']) && !empty($_GET['controller']) ? $_GET['controller'] : null;
	$acao       = isset($_GET['acao']) && !empty($_GET['acao']) ? $_GET['acao'] : null;

	/*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

		if ($controller === 'cliente') {

			$c = new App\Mvc\Controller\Cliente('Cliente', $controller, $acao);
			$c->{$acao}();

		}



	} else {*/

		if (!empty($controller) && !empty($acao)) {

			if ($controller === 'cliente') {

				$c = new App\Mvc\Controller\Cliente('Cliente', $controller, $acao);

				$c->{$acao}();



			}/* elseif($controller === 'produto') {
				$c = new App\Mvc\Controller\Produto('Produto', $controller, $acao);
			} elseif($controller === 'pedido') {
				$c = new App\Mvc\Controller\Pedido('Pedido', $controller, $acao);
			}*/
		} else {
			$c = new App\Mvc\Controller\Cliente('Cliente', 'cliente', 'listar');
			$c->listar();
		}
	//}


} catch (Exception $e) {
	echo $e->getMessage();
}






