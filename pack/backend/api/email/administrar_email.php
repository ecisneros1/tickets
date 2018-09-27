<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('./libs/phpmailer/email.php');

$email= new Email();
//$reporte= new Reporte();

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['mail'])) {
		//echo json_encode($email->sendEmail($_POST['email'], $_POST['id_reporte'], $_POST['nombre'], $_POST['id'], $_POST['fecha']));
		$email->sendEmail($_POST['email'], $_POST['id_reporte'], $_POST['nombre'], $_POST['id'], $_POST['fecha']);
	}

	//$email->pruebahtml();
?>