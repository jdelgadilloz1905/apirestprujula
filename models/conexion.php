<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=prujuladb",
						"root",
						"",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

//		$link = new PDO("mysql:host=localhost;dbname=ashbel18_trop_db",
//			"ashbel18_trop",
//			"Password01.",
//			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
//		);

		return $link;

	}

}