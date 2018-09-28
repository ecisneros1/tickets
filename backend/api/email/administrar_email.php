<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('./libs/phpmailer/email.php');
require_once('../crud_login.php');

$email= new Email();
$login=new CrudLogin();


	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			//echo $data;
			return $_POST[''.$data.''];
		}else{
			return 'empty';
		}
	}


	if(isset($_POST['token'])){
		$t=$login->getToken(checkPost('token'));
		if(!empty($t)){
			if (isset($_POST['mail'])) {
				$email->sendEmail($_POST['email'], $_POST['id_reporte'], $_POST['nombre'], $_POST['id'], $_POST['fecha'], $_POST['publictoken']);
			}
		}
	}
?>