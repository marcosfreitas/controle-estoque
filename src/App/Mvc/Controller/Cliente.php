<?php

namespace App\Mvc\Controller;

/**
 * Controller dos clientes
 * -- 
 */
class Cliente extends Controller {

	private $c_id;
	private $c_nome;
	private $c_email;
	private $c_telefone;
	

	// métodos para definirem as variáveis
	public function listar() {

		return $this->model->todos_clientes();

		// cria variaveis de acordo com as variaveis retornadas
		parent::define_vars();

	}

	// métodos para definirem as variáveis
	public function exibir($c_id = null) {

		// populando as propriedades do model que foi instanciado no __contruct da classe Controller
		return $this->model->obter_dados($c_id);

		// cria variaveis de acordo com as variaveis retornadas
		parent::define_vars();

	}

	public function adicionar() {

	}

	public function atualizar() {

	}

	public function excluir() {

	}
}

