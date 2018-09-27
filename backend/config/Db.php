<?php

	class  Db{
		private static $conexion=NULL;
		private function __construct (){}

		public static function conectar(){
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			//self::$conexion= new PDO('mysql:host=localhost;dbname=itthrcom_it3','itthrcom_yoguin','Ittres20!0',$pdo_options);
			self::$conexion= new PDO('mysql:host=localhost;dbname=itthrcom_it3','root','',$pdo_options);
			return self::$conexion;
		}		
	} 

?>