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

	$c = new App\Mvc\Controller\Cliente('Cliente', 'cliente', 'listar');

	var_dump($c->listar());
	var_dump($c->exibir(2));


} catch (Exception $e) {
	echo $e->getMessage();
}






