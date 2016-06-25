<?php

namespace App\Mvc\Controller;

class Controller {
	protected $model;
    protected $controller;
    protected $acao;
    protected $template;
 
    function __construct($model, $controller, $acao) {
         
        $this->controller = $controller;
        $this->acao = $acao;
 
 		// iniciando o model
 		// ex.: \App\Mvc\Model\Cliente
 		$model = '\\App\\Mvc\\Model\\'.ucfirst($model);
 		$this->model = new $model;

        #$this->template = new \App\Mvc\View\Template($controller,$acao);
 
    }
 
    function define_vars($array_vars = array()) {
        $this->template->define_vars($array_vars);
    }
 
    function __destruct() {
         //$this->template->render();
    }
}