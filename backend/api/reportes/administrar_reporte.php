<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Expose-Headers: X-Suggested-Filename");
require_once(__DIR__.'/crud_reporte.php');
require_once(__DIR__.'/../../models/Reporte.php');
require_once(__DIR__.'/../pdf/pdf.php');
require_once(__DIR__.'/../crud_login.php');


class UseReporte{

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

	function rand_string( $length ) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";  
        $size = strlen( $chars );
        $str='';
        for( $i = 0; $i < $length; $i++ ) {
            $str= $str.$chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
	}
	
	function useClass(){
		$crud= new CrudReporte();
		$reporte= new Reporte();
		$pdf=new PDF();
		$login=new CrudLogin();
		if(isset($_POST['token'])){
			$t=$login->getToken($this->checkPost('token'));
			if(!empty($t)){
				if (isset($_POST['insertar'])) {
					$reporte->setCliente($this->checkPost('cliente'));
					$reporte->setId_ticket($this->checkPost('id_ticket'));
					$reporte->setContacto($this->checkPost('contacto'));
					$reporte->setSolicitadopor($this->checkPost('solicitadopor'));
					$reporte->setPartesdescripcion($this->checkPost('partesdescripcion'));
					$reporte->setTareas($this->checkPost('tareas'));
					$reporte->setTipo($this->checkPost('tipo'));
					$reporte->setHorallegada($this->checkPost('horallegada'));
					$reporte->setHorasalida($this->checkPost('horasalida'));
					$reporte->setTiempotraslado($this->checkPost('tiempotraslado'));
					$reporte->setFecha($this->checkPost('fecha'));
					$reporte->setPublictoken($this->rand_string(48));
					$myReporte=new Reporte();
					$myReporte=$crud->obtener($crud->insertar($reporte));
					echo json_encode($myReporte);
				}elseif(isset($_POST['actualizar'])){
					$reporte->setId_reporte($this->checkPost('id_reporte'));
					$reporte->setCliente($this->checkPost('cliente'));
					$reporte->setId_ticket($this->checkPost('id_ticket'));
					$reporte->setContacto($this->checkPost('contacto'));
					$reporte->setSolicitadopor($this->checkPost('solicitadopor'));
					$reporte->setPartesdescripcion($this->checkPost('partesdescripcion'));
					$reporte->setTareas($this->checkPost('tareas'));
					$reporte->setTipo($this->checkPost('tipo'));
					$reporte->setHorallegada($this->checkPost('horallegada'));
					$reporte->setHorasalida($this->checkPost('horasalida'));
					$reporte->setTiempotraslado($this->checkPost('tiempotraslado'));
					$reporte->setFecha($this->checkPost('fecha'));
					$reporte->setPublictoken($this->checkPost('publictoken'));
					$crud->actualizar($reporte);
				}elseif(isset($_POST['mostrar'])){
					$listaReportes=$crud->mostrar();
					echo json_encode($listaReportes);
				}elseif(isset($_POST['pdf'])){
					$id=$this->checkPost('id_reporte');
					$obj=$crud->obtener($id);
					//echo json_encode($obj);
					echo $pdf->createPdf($obj, 3); 
				}elseif(isset($_POST['getid'])){
					echo json_encode($crud->obtener($_POST['id']));
				}
			}
		}elseif(isset($_POST['publictokenrep'])){
			$t=$login->getPublicTokenRep($this->checkPost('publictokenrep'));
			if(!empty($t)){
				if(isset($_POST['get'])){
					$id=$this->checkPost('id_reporte');
					$obj=$crud->obtener($id);
					//echo json_encode($obj);
					echo $pdf->createPdf($obj, 3); 
				}
			}
		}
	}
}
?>