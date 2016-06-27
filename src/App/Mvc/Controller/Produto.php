<?php

namespace App\Mvc\Controller;

/**
 * Controller dos produtos
 * -- 
 */
class Produto extends Controller {

	private $p_id;
	private $p_nome;
	private $p_descricao;
	private $p_preco;
	
	public function __contruct() {
		parent::__contruct();
	}

	// métodos para definirem as variáveis
	public function listar() {

		try {

			$produtos = $this->model->todos_produtos();
		
		} catch (\Exception $e){
			$_SESSION['message'] = $e->getMessage();
		}

		// cria variaveis de acordo com as variaveis retornadas
		$this->template->define_vars($produtos);
		// a renderização acontece no destruct
	}

	public function editar() {
		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				foreach ($_POST as $chave => $valor) {
					if (empty($valor) && $chave !== 'submit') {
						throw new \Exception("Preencha todos os campos.", 1);						
					}
					$this->{$chave} = $valor;
				}

				$this->model->__construct($this->p_id, $this->p_nome, $this->p_descricao, $this->p_preco);		
				
				if ($this->model->atualizar()){
					$_SESSION['message'] = "Produto atualizado com sucesso";
				} else {
					$_SESSION['message'] = "Não foi possível atualizar os dados do produto";
				}

				#header('Location: '. URL_APP .'?controller=produto&acao=editar&codigo='. $this->c_id);
				#exit;
			
			} catch (\Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		}

		$this->model->__construct($_GET['codigo']);
		$produto = $this->model->obter_dados();

		$this->template->define_vars($produto);
	}

	public function adicionar() {

		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				foreach ($_POST as $chave => $valor) {
					if (empty($valor) && $chave !== 'submit') {
						throw new \Exception("Preencha todos os campos.", 1);						
					}
					$this->{$chave} = $valor;
				}

				$this->model->__construct(null, $this->p_nome, $this->p_descricao, $this->p_preco);		
				$this->p_id = $this->model->inserir();
				
				if (is_numeric($this->p_id)){
					$_SESSION['message'] = "Produto cadastrado com sucesso";
				}
				
				header('Location: '. URL_APP .'?controller=produto&acao=editar&codigo='. $this->p_id);
				exit;  
			
			} catch (\Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		}
	}

	public function excluir() {

		try {

			$this->model->__construct($_GET['codigo']);
			
			if ($this->model->excluir()){
				$_SESSION['message'] = "Produto excluído com sucesso";
			}

			header('Location: '. URL_APP .'?controller=produto&acao=listar');
			exit;  
		
		} catch (\Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
		
		$this->template->define_vars(null);
	}
}