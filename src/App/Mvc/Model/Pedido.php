<?php
namespace App\Mvc\Model;

/**
*
*/
class Pedido extends Conexao {

	private $pe_id;
	private $fk_cliente;
	private $fk_produto;


	#
	# M�todos
	#


	public function __construct($pe_id = null, $fk_cliente = null, $fk_produto = array()) {

		# inicia a conex�o
		$this->__con = parent::conectar();

		# c�digo, para alguns casos
		if (!empty($pe_id) && is_numeric($pe_id)) {
			$this->pe_id = $pe_id;
		}
		
		# id do cliente
		if (!empty($fk_cliente) && is_numeric($fk_cliente)) {
			$this->fk_cliente = $fk_cliente;
		}

		# id do produto
		if (!empty($fk_produto) && is_array($fk_produto)) {
			$this->fk_produto = $fk_produto;
		}

	}

	public function __destruct() {
		$this->__con = null;
	}


	public function inserir() {

		# inserindo na tabela de pedido, um pedido novo
		$params =  array (
			"fk_cliente" => $this->fk_cliente,
			"fk_produto" => join(",", $this->fk_produto)
		);
		
		# insert("tabela","dados")
		$this->pe_id = $this->__con->insert('pedido', $params);

		if ($this->pe_id > 0) {

			# retorna o id do pedido
			return $this->pe_id;

		}

		throw new \Exception("Verifique os par�metros da query de inser��o.", 1);

	}

	# - precisa ter definido o id do cliente
	public function atualizar() {

		$params =  array (
			"fk_cliente" => $this->fk_cliente,
			"fk_produto" => join(",", $this->fk_produto)
		);

		# where c_id = $this->c_id
		$this->__con->where('pe_id', $this->pe_id);
		$atualizar = $this->__con->update('pedido', $params);

		if ($atualizar>0) {

			return $atualizar;

		} else {
			throw new \Exception("Verifique os par�metros da query de atualiza��o.", 1);
		}
	
	}

	public function excluir() {

		# where c_id = $this->c_id
		$this->__con->where('pe_id', $this->pe_id);
		$excluir = $this->__con->delete('pedido');

		if ($excluir>0) {

			return $excluir;

		} else {
			throw new \Exception("N�o foi poss�vel excluir o pedido.", 1);
		}
	
	}

	public function todos_pedidos() {
		$todos = $this->__con->get('pedido');
		if ($this->__con->count>0) {
			return $todos;
		}

		return 0;
		
	}


	public function obter_dados($pe_id = null) {
		if (empty($pe_id)) {
			if (empty($this->pe_id)) {
				throw new \Exception("Esperado o id do pedido para verificar, mas n�o foi recebido.", 1);			
			}

			$pe_id = $this->pe_id;
		}

		$this->__con->join('cliente', 'c_id=fk_cliente', 'INNER');
		$this->__con->where('pe_id', $pe_id);
		$pedido = $this->__con->getOne('pedido');

		if ($this->__con->count > 0) {
			return $pedido;
		}

		throw new \Exception("Pedido n�o encontrado.", 1);
		
	}


}