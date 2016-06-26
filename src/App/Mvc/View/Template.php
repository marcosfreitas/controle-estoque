<?php

namespace App\Mvc\View;

class Template {
	protected $vars = array();
	protected $controller;
	protected $acao;

	public function __construct($controller, $acao){
		$this->controller = $controller;
		$this->acao = $acao;
	}

	// definindo variáveis para serem utilizadas nos templates
	public function define_vars($vars) {
		$this->vars = $vars;
	}

	public function render() {

		include (PATH_MVC . 'View' . DS . 'topo.php');

		if (!empty($this->controller) || !empty($this->acao)) {

			if (file_exists(PATH_MVC . 'View' . DS . ucfirst($this->controller) . DS . $this->acao .'.php')) {
				include (PATH_MVC . 'View' . DS . ucfirst($this->controller) . DS . $this->acao . '.php');
			} else {
				include (PATH_MVC . 'View' . DS . 'inicio.php');
			}       
		} else {
			include (PATH_MVC . 'View' . DS . 'inicio.php');
		}

		include (PATH_MVC . 'View' . DS . 'rodape.php');
	}

}