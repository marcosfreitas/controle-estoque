<?php
namespace App\Mvc\Model;

/**
 * Inicia ou Destroi a conexão aberta.
 * -- A classe MysqliDb é um wrapper mysqli responsável pela construção e execução das queries mysql
 */
class Conexao extends \MysqliDb
{

	// será utilizada nas classes pai
	protected $__con;
	
	protected function conectar() {
		try {

			if (!empty(\MysqliDb::getInstance())) {
				return \MysqliDb::getInstance();
			}

			$db_config = Array (
				'host'     => 'localhost',
				'username' => 'root',
				'password' => '',
				'db'       => 'controle_estoque',
				'port'     => 3306,
				'prefix'   => '',
				'charset'  => 'latin1_general_ci'
			);
			return new \MysqliDb($db_config);		

		} catch (Exception $e) {
			throw new Exception("Não foi possível conectar-se ao banco de dados.", 1);
			
		}
	}

	protected function desconectar() {
		try {
			//mysqli_close(MysqliDb::getInstance());
			$this->__con = null;
		} catch(Exception $e) {
			//....
		}
	}
	
}