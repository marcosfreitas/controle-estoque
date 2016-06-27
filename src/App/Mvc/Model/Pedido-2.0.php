<?php
namespace App\Mvc\Model;

/**
*
*/
class Pedido extends Conexao {

	private $pe_id;
	private $fk_cliente;
	private $fk_produto;
	private $pp_quantidade;
	private $pp_custo_unitario;


	#
	# Métodos
	#


	public function __construct($pe_id = null, $fk_cliente = null, $fk_produto = array(), $pp_quantidade = null, $pp_custo_unitario = null) {

		# inicia a conexão
		$this->__con = parent::conectar();

		# código, para alguns casos
		if (!empty($pe_id) && is_numeric($pe_id)) {
			$this->pe_id = $pe_id;
		}
		
		# id do cliente
		if (!empty($fk_cliente) && is_numeric($fk_cliente)) {
			$this->fk_cliente = $fk_cliente;
		}

		# id do produto
		if (!empty($fk_produto) && is_numeric($fk_produto)) {
			$this->fk_produto = $fk_produto;
		}

		# quantidade de determinado produto no pedido
		if (!empty($pp_quantidade) && is_numeric($pp_quantidade)) {
			$this->pp_quantidade = $pp_quantidade;
		}

		# custo por produto, armazenado pois o preço pode mudar com o tempo e os registros passados não devem ser alterados
		if (!empty($pp_custo_unitario) && is_numeric($pp_custo_unitario)) {
			$this->pp_custo_unitario = $pp_custo_unitario;
		}


	}

	public function __destruct() {
		$this->__con = null;
	}


	public function inserir() {

		# inserindo na tabela de pedido, um pedido novo
		$params =  array (
			"fk_cliente" => $this->fk_cliente
		);

		# insert("tabela","dados")
		$this->pe_id = $this->__con->insert('pedido', $params);

		if ($this->pe_id > 0) {

			# inserindo na tabela pedido_produto, um conjunto de registros do pedido atual
			$params = array(
				"fk_pedido"         => $this->pe_id,
				"fk_produto"        => $this->fk_produto,
				"pp_quantidade"     => $this->pp_quantidade,
				"pp_custo_unitario" => $this->pp_custo_unitario
			);

			$this->pp_id = $this->__con->insert('pedido_produto', $params);

			# retorna o id do pedido
			return $this->pe_id;

		} else {
			throw new \Exception("Verifique os parâmetros da query de inserção.", 1);
		}

	}

	# - precisa ter definido o id do cliente
	public function atualizar() {

		$params =  array (
			"fk_produto" => $this->fk_produto,
			"fk_cliente" => $this->fk_cliente
		);

		# where c_id = $this->c_id
		$this->__con->where('pe_id', $this->pe_id);
		$atualizar = $this->__con->update('pedido', $params);

		if ($atualizar>0) {

			return $atualizar;

		} else {
			throw new \Exception("Verifique os parâmetros da query de atualização.", 1);
		}
	
	}

	public function excluir() {

		# where c_id = $this->c_id
		$this->__con->where('pe_id', $this->pe_id);
		$excluir = $this->__con->delete('pedido');

		if ($excluir>0) {

			return $excluir;

		} else {
			throw new \Exception("Não foi possível excluir o pedido.", 1);
		}
	
	}

	public function todos_pedidos() {
		$todos = $this->__con->get('pedido');
		if ($this->__con->count>0) {
			return $todos;
		}

		return null;
		
	}


	public function obter_dados($pe_id = null) {
		if (empty($pe_id)) {
			if (empty($this->pe_id)) {
				throw new \Exception("Esperado o id do pedido para verificar, mas não foi recebido.", 1);			
			}

			$pe_id = $this->pe_id;
		}

		$this->__con->join('cliente', 'c_id=fk_cliente', 'INNER');
		$this->__con->join('produto', 'p_id=fk_produto', 'INNER');
		$this->__con->where('pe_id', $pe_id);
		$pedido = $this->__con->getOne('pedido');

		if ($this->__con->count > 0) {
			return $pedido;
		}

		throw new \Exception("Pedido não encontrado.", 1);
		
	}


}