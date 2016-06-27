<?php

namespace App\Mvc\Controller;

/**
 * Controller dos pedido
 * -- 
 */
class Pedido extends Controller {

	private $pe_id;
	private $fk_cliente;
	private $fk_produto;
	private $pp_quantidade;
	
	public function __contruct() {
		parent::__contruct();
	}

	// métodos para definirem as variáveis
	public function listar() {

		try {

			$pedidos = $this->model->todos_pedidos();
			// adiciona dados do cliente vinculado ao pedido ao array de pedidos
			foreach ($pedidos as $chave => $valor) {
				$c = new \App\Mvc\Model\Cliente();
				$cliente = $c->obter_dados($valor['fk_cliente']);
				foreach ($cliente as $i => $v) {
					$pedidos[$chave][$i] = $v;
				}
			}
		
		} catch (\Exception $e){
			$_SESSION['message'] = $e->getMessage();
		}

		// cria variaveis de acordo com as variaveis retornadas
		$this->template->define_vars($pedidos);
		// a renderização acontece no destruct
	}

	public function editar() {

		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				$this->pe_id = $_POST['pe_id'];
				$this->fk_cliente = $_POST['c_id'];
				$this->fk_produto = $_POST['produtos'];

				$this->model->__construct($this->pe_id, $this->fk_cliente, $this->fk_produto);		
				$this->pe_id = $this->model->atualizar();
								
				if ($this->model->atualizar()){
					$_SESSION['message'] = "Produto atualizado com sucesso";
				} else {
					$_SESSION['message'] = "Não foi possível atualizar os dados do produto";
				}
				
				#header('Location: '. URL_APP .'?controller=pedido&acao=editar&codigo='. $this->pe_id);
				#exit;  
			
			} catch (\Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		}

		try {

				$c = new \App\Mvc\Model\Cliente();
				$p = new \App\Mvc\Model\Produto();
				$pedido = $this->model->obter_dados($_GET['codigo']);

				// recuperando informações dos produtos do pedido explodindo a string de IDs
				// adiciona como um grupo de arrays dentro do array $pedido
				$array_produtos = explode(",", $pedido['fk_produto']);
				foreach ($array_produtos as $chave => $valor) {
					$pedido['produtos'][] = $p->obter_dados($valor); 
				}

				$clientes = $c->todos_clientes();
				$produtos = $p->todos_produtos();

				if(empty($clientes)) {
					$clientes = [];
				}
				if(empty($produtos)) {
					$produtos = [];
				}


				$dados['pedido']   = $pedido;
				$dados['clientes'] = $clientes;
				$dados['produtos'] = $produtos;
			$this->template->define_vars($dados);

		} catch (\Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
	}

	public function adicionar() {

		if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST)) {

			try {

				$this->fk_cliente = $_POST['c_id'];
				$this->fk_produto = $_POST['produtos'];

				$this->model->__construct(null, $this->fk_cliente, $this->fk_produto);		
				$this->pe_id = $this->model->inserir();
				
				if (is_numeric($this->pe_id)){
					$_SESSION['message'] = "Pedido cadastrado com sucesso";
				}
				
				header('Location: '. URL_APP .'?controller=pedido&acao=editar&codigo='. $this->pe_id);
				exit;  
			
			} catch (\Exception $e) {
				$_SESSION['message'] = $e->getMessage();
			}

		} else {

			try {

				$c = new \App\Mvc\Model\Cliente();
				$p = new \App\Mvc\Model\Produto();
				$clientes = $c->todos_clientes();
				$produtos = $p->todos_produtos();

				if(empty($clientes)) {
					$clientes = [];
				}
				if(empty($produtos)) {
					$produtos = [];
				}

				$dados['clientes'] = $clientes;
				$dados['produtos'] = $produtos;
				$this->template->define_vars($dados);

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

			header('Location: '. URL_APP .'?controller=pedido&acao=listar');
			exit;  
		
		} catch (\Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
		
		$this->template->define_vars(null);
	}
}