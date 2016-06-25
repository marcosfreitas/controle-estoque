<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: text/html; charset=ISO-8859-1');

ini_set('display_errors', 1);
error_reporting(E_ALL);

/* Sessions */
//if (session_status() !== PHP_SESSION_ACTIVE && session_status() !== 2) {}
/* Define o limitador de cache para 'private' */
session_cache_limiter('private');

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(30);

/* Inicia a sessão */
session_name("mf-estoque");
session_start();

/**
 * Momento inicial da execução do script
 */
define('BEGIN', microtime(true));

/**
 * Barras de acordo com o S.O.
 */
const DS = DIRECTORY_SEPARATOR;

/**
 * Endereços da aplicação
 */
define('URL_APP', "http://".$_SERVER['SERVER_NAME']."/projects/controle-estoque/app/");

/**
 * Raiz física da aplicação
 */
const ROOT = __DIR__.DS; // Constante nova no PHP 5.3 (equivale a dirname(__FILE__) no <= 5.2)
const PATH_MVC = __DIR__.DS.'src'.DS.'App'.DS.'Mvc'.DS; // Constante nova no PHP 5.3 (equivale a dirname(__FILE__) no <= 5.2)
const PATH_APP = __DIR__.DS.'src'.DS.'App'.DS; 


?>
