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

	public function define_vars($vars = array()) {
		extract($this->vars);
	}

	public function render() {

		include (PATH_MVC . 'View' . DS . 'topo.php');

		if (file_exists(PATH_MVC . 'View' . DS . $this->controller . DS . $this->acao '.php')) {
			include (PATH_MVC . 'View' . DS . $this->controller . DS . $this->acao . '.php');
		} else {
			include (PATH_MVC . 'View' . DS . 'inicio.php');
		}       

		include (PATH_MVC . 'View' . DS . 'rodape.php');
	}

}