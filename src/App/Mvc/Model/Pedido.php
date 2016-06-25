<?php
namespace App\Mvc\Model;

/**
*
*/
class Pedido extends Conexao {

	private $pe_id;
	private $fk_produto;
	private $fk_cliente;


	#
	# Métodos Gets
	#

	public function getId(){ return $this->pe_id; }
	public function getFkProduto(){ return $this->fk_produto; }
	public function getFkCliente(){ return $this->fk_cliente; }


	#
	# Métodos
	#


	public function __construct($pe_id = null, $fk_produto = null, $fk_cliente = null) {

		# inicia a conexão
		$this->__con = parent::conectar();

		# código, para alguns casos
		if (!empty($pe_id) && is_numeric($pe_id)) {
			$this->pe_id = $pe_id;
		}

		# id do produto
		if (!empty($fk_produto) && is_numeric($fk_produto)) {
			$this->fk_produto = $fk_produto;
		}

		# id do cliente
		if (!empty($fk_cliente) && is_numeric($fk_cliente)) {
			$this->fk_cliente = $fk_cliente;
		}

	}

	public function __destruct() {
		$this->__con = null;
	}


	public function inserir() {

		$params =  array (
			"fk_produto" => $this->fk_produto,
			"fk_cliente" => $this->fk_cliente
		);

		# insert("tabela","dados")
		$this->pe_id = $this->__con->insert('pedido', $params);

		if ($this->pe_id) {

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

		throw new Exception("Nenhum pedido cadastrado", 1);
		
	}


	public function obter_dados($pe_id = null) {
		if (empty($pe_id)) {
			if (empty($this->pe_id)) {
				throw new Exception("Esperado o id do pedido para verificar, mas não foi recebido.", 1);			
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

		throw new Exception("Pedido não encontrado.", 1);
		
	}


}