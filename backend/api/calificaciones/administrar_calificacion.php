<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('crud_calificacion.php');
require_once('../../models/Calificacion.php');
require_once('../crud_login.php');

$crud= new CrudCalificacion();
$calificacion= new Calificacion();
$login=new CrudLogin();



	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			return $_POST[''.$data.''];
		}else{
			return 'empty';
		}
	}


	if(isset($_POST['token'])){
		$t=$login->getToken(checkPost('token'));
		echo $t;
		if(!empty($t)){
			if(isset($_POST['getid'])){
				echo json_encode($crud->obtener(checkPost('id')));
			}elseif(isset($_POST['mostrar'])){
				$listaCalificaciones=$crud->mostrar();
				echo json_encode($listaCalificaciones);
			}
		}
	}elseif(isset($_POST['publictoken'])){
		$t=$login->getToken(checkPost('publictoken'));
		if(!empty($t)){
			if (isset($_POST['insertar'])) {
				$calificacion->setId_reporte(checkPost('id_reporte'));
				$calificacion->setServicio(checkPost('servicio'));
				$calificacion->setPuntualidad(checkPost('puntualidad'));
				$calificacion->setObservaciones(checkPost('observaciones'));
				$calificacion=$crud->obtener($crud->insertar($calificacion));
				echo 'GRACIAS POR SU OPINION. YA PUEDE CERRAR ESTA PESTANIA';
			}
		}
	}


	
?>