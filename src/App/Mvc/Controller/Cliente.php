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
	
	public function __contruct() {
		parent::__contruct();
	}

	// métodos para definirem as variáveis
	public function listar() {

		try {

			$clientes = $this->model->todos_clientes();
		
		} catch (Exception $e){
			$_SESSION['message'] = $e->getMessage();
		}

		// cria variaveis de acordo com as variaveis retornadas
		$this->template->define_vars($clientes);
		// a renderização acontece no destruct
	}

	public function editar() {
		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				foreach ($_POST as $chave => $valor) {
					$this->{$chave} = $valor;
				}

				$this->model->__construct($this->c_id, $this->c_nome, $this->c_email, $this->c_telefone);		
				
				if ($this->model->atualizar()){
					$_SESSION['message'] = "Cliente atualizado com sucesso";
				} else {
					$_SESSION['message'] = "Não foi possível atualizar os dados do cliente";
				}
				#header('Location: '. URL_APP .'?controller=cliente&acao=editar&codigo='. $this->c_id);
				#exit;
			
			} catch (Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		}

		$this->model->__construct($_GET['codigo']);
		$cliente = $this->model->obter_dados();

		$this->template->define_vars($cliente);
	}

	public function adicionar() {

		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				foreach ($_POST as $chave => $valor) {
					$this->{$chave} = $valor;
				}

				$this->model->__construct(null, $this->c_nome, $this->c_email, $this->c_telefone);		
				$this->c_id = $this->model->inserir();
				
				if (is_numeric($this->c_id)){
					$_SESSION['message'] = "Cliente cadastrado com sucesso";
				}
				
				header('Location: '. URL_APP .'?controller=cliente&acao=editar&codigo='. $this->c_id);
				exit;
			
			} catch (Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		}
	}

	public function excluir() {

		try {

			$this->model->__construct($_GET['codigo']);
			
			if ($this->model->excluir()){
				$_SESSION['message'] = "Cliente excluído com sucesso";
			}	
		
		} catch (Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
		
		$this->template->define_vars(null);
	}
}