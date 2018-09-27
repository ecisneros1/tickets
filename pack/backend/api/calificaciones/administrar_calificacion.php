<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('crud_calificacion.php');
require_once('../../models/Calificacion.php');

$crud= new CrudCalificacion();
$calificacion= new Calificacion();

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['insertar'])) {
		//echo ($_POST['id_cliente']);
		//$calificacion->setId_calificacion($_POST['id_calificacion']);
		$calificacion->setId_reporte($_POST['id_reporte']);
		$calificacion->setServicio($_POST['servicio']);
		$calificacion->setPuntualidad($_POST['puntualidad']);
		$calificacion->setObservaciones($_POST['observaciones']);
		$calificacion=$crud->obtener($crud->insertar($calificacion));
		//header("Location: http://it3.com.ec");
		//echo json_encode($calificacion);
		//Redirect('https://mail.google.com/mail/u/0/#inbox', false);
		//exit();
		echo 'GRACIAS POR SU OPINION. YA PUEDE CERRAR ESTA PESTANIA';
		//header('Location: index.php');
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
	}elseif(isset($_POST['mostrar'])){
        $listaCalificaciones=$crud->mostrar();
        echo json_encode($listaCalificaciones);
	// si la variable accion enviada por GET es == 'e' llama al crud y elimina un libro
	}elseif(isset($_POST['getid'])){
		echo json_encode($crud->obtener($_POST['id']));
	}
?>