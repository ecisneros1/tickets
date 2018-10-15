<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once(__DIR__.'/libs/phpmailer/email.php');
require_once(__DIR__.'/../crud_login.php');

	class UseEmail{
		function checkPost($data){
			if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
				//echo $data;
				return $_POST[''.$data.''];
			}else{
				return 'empty';
			}
		}	
	
		function useClass(){
			$email= new Email();
			$login=new CrudLogin();
			if(isset($_POST['token'])){
				$t=$login->getToken($this->checkPost('token'));
				if(!empty($t)){
					if (isset($_POST['mail'])) {
						$email->sendEmail($_POST['email'], $_POST['id_reporte'], $_POST['nombre'], $_POST['id'], $_POST['fecha'], $_POST['publictoken']);
					}
				}
			}
		}
	}
?>