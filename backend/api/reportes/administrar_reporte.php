<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Expose-Headers: X-Suggested-Filename");
require_once('crud_reporte.php');
require_once('../../models/Reporte.php');
require_once('../pdf/pdf.php');
require_once('../crud_login.php');


$crud= new CrudReporte();
$reporte= new Reporte();
$pdf=new PDF();
$login=new CrudLogin();

	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			return $_POST[''.$data.''];
		}else{
			return 'empty';
		}
	}
	function checkGet($data){
		if(isset($_GET[''.$data.'']) && !empty($_GET[''.$data.''])){
			return $_GET[''.$data.''];
		}else{
			return '0';
		}
	}


	if(isset($_POST['token'])){
		$t=$login->getToken(checkPost('token'));
		if(!empty($t)){
			if (isset($_POST['insertar'])) {
				$reporte->setCliente(checkPost('cliente'));
				$reporte->setId_ticket(checkPost('id_ticket'));
				$reporte->setContacto(checkPost('contacto'));
				$reporte->setSolicitadopor(checkPost('solicitadopor'));
				$reporte->setPartesdescripcion(checkPost('partesdescripcion'));
				$reporte->setTareas(checkPost('tareas'));
				$reporte->setTipo(checkPost('tipo'));
				$reporte->setHorallegada(checkPost('horallegada'));
				$reporte->setHorasalida(checkPost('horasalida'));
				$reporte->setTiempotraslado(checkPost('tiempotraslado'));
				$reporte->setFecha(checkPost('fecha'));
				$myReporte=new Reporte();
				$myReporte=$crud->obtener($crud->insertar($reporte));
				echo json_encode($myReporte);
			}elseif(isset($_POST['actualizar'])){
				$reporte->setId_reporte=checkPost('id_reporte');
				$reporte->setCliente=checkPost('cliente');
				$reporte->setId_ticket=checkPost('id_ticket');
				$reporte->setContacto=checkPost('contacto');
				$reporte->setSolicitadopor=checkPost('solicitadopor');
				$reporte->setPartesdescripcion=checkPost('partesdescripcion');
				$reporte->setTareas=checkPost('tareas');
				$reporte->setTipo=checkPost('tipo');
				$reporte->setHorallegada=checkPost('horallegada');
				$reporte->setHorasalida=checkPost('horasalida');
				$reporte->setTiempotraslado=checkPost('tiempotraslado');
				$reporte->setFecha=checkPost('fecha');
				$reporte->setServicio=checkPost('servicio');
				$reporte->setPuntualidad=checkPost('puntualidad');
				$reporte->setObservaciones=checkPost('observaciones');
				$reporte->setConfirmacion=checkPost('confirmacion');
				$crud->actualizar($reporte);
			}elseif(isset($_POST['mostrar'])){
				$listaReportes=$crud->mostrar();
				echo json_encode($listaReportes);
			}elseif(isset($_POST['pdf'])){
				$id=checkPost('id_reporte');
				$obj=$crud->obtener($id);
				//echo json_encode($obj);
				echo $pdf->createPdf($obj); 
			}elseif(isset($_POST['getid'])){
				echo json_encode($crud->obtener($_POST['id']));
			}
		}else{
			echo 'error T';
		}
	}
?>