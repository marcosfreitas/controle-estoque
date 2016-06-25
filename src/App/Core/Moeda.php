<?php
namespace App\Core;

class Moeda {
	/**
	 * Converte o valor para decimal
	 * @param string $valor
	 */
	public static function formata_decimal($valor){

	    $decimal = (!empty($valor) ? $valor : 0.00);

	    # first remove points, so change commas to points
	    $decimal = preg_replace("#[^0-9.,]#", "", $decimal);
	    $decimal = str_replace(".", "", $decimal);
	    $decimal = str_replace(",", ".", $decimal);

	    //$decimal = floatval($decimal);

	    $__aux = explode('.',$decimal);
	    $decimal = intval($decimal).'.'.substr(end($__aux),0,2);

	    return $decimal;
	}

	# @param $price Format to Brazilian currency
	public static function formata_moeda_br($valor){

		#setlocale(LC_MONETARY, array("pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese", "Portuguese_Brazil.1252"));
		$decimal = (!empty($valor) ? $valor : 0.00);

	    # first remove points, so change commas to points
	    $decimal = preg_replace("#[^0-9.,]#", "", $decimal);
	    $decimal = floatval($decimal);

	   	return "R$ " . number_format($decimal, 2, ',', '.');
	}
}