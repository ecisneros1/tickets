<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once(__DIR__.'/crud_calificacion.php');
require_once(__DIR__.'/../../models/Calificacion.php');
require_once(__DIR__.'/../crud_login.php');

class UseCalificacion{
	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			return $_POST[''.$data.''];
		}else{
			return 'empty';
		}
	}


	function useClass(){
		$crud= new CrudCalificacion();
		$calificacion= new Calificacion();
		$login=new CrudLogin();
		if(isset($_POST['token'])){
			$t=$login->getToken($this->checkPost('token'));
			echo $t;
			if(!empty($t)){
				if(isset($_POST['getid'])){
					echo json_encode($crud->obtener($this->checkPost('id')));
				}elseif(isset($_POST['mostrar'])){
					$listaCalificaciones=$crud->mostrar();
					echo json_encode($listaCalificaciones);
				}
			}
		}elseif(isset($_POST['publictoken'])){
			$t=$login->getToken($this->checkPost('publictoken'));
			if(!empty($t)){
				if (isset($_POST['insertar'])) {
					$calificacion->setId_reporte($this->checkPost('id_reporte'));
					$calificacion->setServicio($this->checkPost('servicio'));
					$calificacion->setPuntualidad($this->checkPost('puntualidad'));
					$calificacion->setObservaciones($this->checkPost('observaciones'));
					$calificacion=$crud->obtener($crud->insertar($calificacion));
					echo 'GRACIAS POR SU OPINION. YA PUEDE CERRAR ESTA PESTANIA';
				}
			}
		}
	}
}


	
?>