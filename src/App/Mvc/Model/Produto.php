<?php
namespace App\Mvc\Model;

/**
*
*/
class Produto extends Conexao {
	
	private $p_id;
	private $p_nome;
	private $p_descricao;
	private $p_preco = 0.00;

	#
	# M�todos
	#


	public function __construct($p_id = null, $p_nome = null, $p_descricao = null, $p_preco = null) {

		# inicia a conex�o
		$this->__con = parent::conectar();

		# c�digo, para alguns casos
		if (!empty($p_id) && is_numeric($p_id)) {
			$this->p_id = $p_id;
		}

		# nome
		$p_nome = trim($p_nome);
		if (!empty($p_nome)) {
			$this->p_nome = $p_nome;
		}

		# descricao
		$p_descricao = trim($p_descricao);
		if (!empty($p_descricao)) {
			$this->p_descricao = $p_descricao;
		}

        # pre�o
		if ($p_preco) {
			$this->p_preco = \App\Core\Moeda::formata_decimal($p_preco);
		}

	}

	public function __destruct() {
		$this->__con = null;
	}


	public function inserir() {

		$params =  array (
			"p_nome" => $this->p_nome,
			"p_descricao" => $this->p_descricao,
			"p_preco" => $this->p_preco
		);

		# insert("tabela","dados")
		$this->p_id = $this->__con->insert('produto', $params);

		if ($this->p_id) {

			return $this->p_id;

		} else {
			throw new \Exception("Verifique os par�metros da query de inser��o.", 1);
		}

	}

	# - precisa ter definido o id do cliente
	public function atualizar() {

		$params =  array (
			"p_nome" => $this->p_nome,
			"p_descricao" => $this->p_descricao,
			"p_preco" => $this->p_preco
		);

		# where c_id = $this->c_id
		$this->__con->where('p_id', $this->p_id);
		$atualizar = $this->__con->update('produto', $params);


		var_dump($this->__con->getLastQuery());
		if ($atualizar>0) {

			return $atualizar;

		}
		
		throw new \Exception("Verifique os par�metros da query de atualiza��o.", 1);
	
	}

	public function excluir() {

		# where c_id = $this->c_id
		$this->__con->where('p_id', $this->p_id);
		$excluir = $this->__con->delete('produto');

		if ($excluir>0) {

			return $excluir;

		} else {
			throw new \Exception("N�o foi poss�vel excluir o produto.", 1);
		}
	
	}

	public function todos_produtos() {
		$todos = $this->__con->get('produto');
		if ($this->__con->count>0) {
			return $todos;
		}

		return null;
		
	}

	public function obter_dados($p_id = null) {
		if (empty($p_id)) {
			if (empty($this->p_id)) {
				throw new \Exception("Esperado o id do produto para verificar, mas n�o foi recebido.", 1);			
			}

			$p_id = $this->p_id;
		}

		$this->__con->where('p_id', $p_id);
		$produto = $this->__con->getOne('produto');

		if ($this->__con->count > 0) {
			return $produto;
		}

		throw new \Exception("Produto n�o encontrado.", 1);
		
	}


}