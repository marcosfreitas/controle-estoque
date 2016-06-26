<?php
namespace App\Mvc\Model;

/**
*
*/
class Cliente extends Conexao {
	private $c_id;
	private $c_nome;
	private $c_email;
	private $c_telefone;


	#
	# Métodos Gets
	#

	public function getId(){ return $this->c_id; }
	public function getNome(){ return $this->c_nome; }
	public function getEmail(){ return $this->c_email; }
	public function getTelefone(){ return $this->c_telefone; }

	#
	# Métodos
	#


	public function __construct($c_id = null, $c_nome = null, $c_email = null, $c_telefone = null) {

		# inicia a conexão
		$this->__con = parent::conectar();

		# código, para alguns casos
		if (!empty($c_id) && is_numeric($c_id)) {
			$this->c_id = $c_id;
		}

		# nome
		$c_nome = trim($c_nome);
		if (!empty($c_nome)) {
			$this->c_nome = $c_nome;
		}

		# e-mail
		$c_email = trim($c_email);
		if (!empty($c_email)) {
        	if (filter_var($c_email, FILTER_SANITIZE_EMAIL) !== false && filter_var($c_email, FILTER_VALIDATE_EMAIL) !== false) {
        		$this->c_email = $c_email;
	        }
        }

        # telefone
		if (!empty($c_telefone) && is_numeric($c_telefone)) {
			$this->c_telefone = $c_telefone;
		}

	}

	public function __destruct() {
		$this->__con = null;
	}


	public function inserir() {

		$params =  array (
			"c_nome" => $this->c_nome,
			"c_email" => $this->c_email,
			"c_telefone" => $this->c_telefone
		);

		if ($this->email_existe($this->c_email)) {
			throw new \Exception("Já existe um cliente com este e-mail", 1);	
		}

		# insert("tabela","dados")
		$this->c_id = $this->__con->insert('cliente', $params);

		if ($this->c_id) {

			return $this->c_id;

		} else {
			throw new \Exception("Verifique os parâmetros da query de inserção.", 1);
		}

	}

	# - precisa ter definido o id do cliente
	public function atualizar() {

		$params =  array (
			"c_nome" => $this->c_nome,
			"c_email" => $this->c_email,
			"c_telefone" => $this->c_telefone
		);

		# where c_id = $this->c_id
		$this->__con->where('c_id', $this->c_id);
		$atualizar = $this->__con->update('cliente', $params);

		if ($atualizar>0) {

			return $atualizar;

		} else {
			throw new \Exception("Verifique os parâmetros da query de atualização.", 1);
		}
	
	}

	public function excluir() {

		# where c_id = $this->c_id
		$this->__con->where('c_id', $this->c_id);
		$excluir = $this->__con->delete('cliente');

		if ($excluir>0) {
			return true;
		} else {
			throw new \Exception($this->__con->getLastError(), 1);
		}
	
	}

	public function todos_clientes() {
		$todos = $this->__con->get('cliente');
		if ($this->__con->count>0) {
			return $todos;
		}

		return null;
		
	}

	# verifica se já existe um cliente com o e-mail passado ou definido na propriedade da classe
	public function email_existe($c_email = null) {

		if (empty($c_email)) {
			if (empty($this->c_email)) {
				throw new \Exception("Esperado o id do cliente para verificar.", 1);			
			}

			$c_email = $this->c_email;
		}

		$this->__con->where('c_email', $c_email);
		$this->__con->getOne('cliente');

		if ($this->__con->count > 0) {
			return true;
		}

		return false;

	}

	public function obter_dados($c_id = null) {
		if (empty($c_id)) {
			if (empty($this->c_id)) {
				throw new \Exception("Esperado o id do cliente para verificar, mas não foi recebido.", 1);			
			}

			$c_id = $this->c_id;
		}

		$this->__con->where('c_id', $c_id);
		$cliente = $this->__con->getOne('cliente');

		if ($this->__con->count > 0) {
			return $cliente;
		}

		throw new \Exception("Cliente não encontrado.", 1);
		
	}


}