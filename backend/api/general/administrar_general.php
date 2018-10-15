<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Expose-Headers: X-Suggested-Filename");
require_once(__DIR__.'/crud_general.php');
require_once(__DIR__.'/../../models/Reporte.php');
require_once(__DIR__.'/../pdf/pdf.php');
require_once(__DIR__.'/../crud_login.php');

class General{
	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			return $_POST[''.$data.''];
		}else{
			return 'empty1';
		}
	}
	function checkGet($data){
		if(isset($_GET[''.$data.'']) && !empty($_GET[''.$data.''])){
			return $_GET[''.$data.''];
		}else{
			return '0';
		}
	}


	function useClass(){
		$crud= new CrudGeneral();
		$reporte= new Reporte();
		$pdf=new PDF();
		$login=new CrudLogin();
		if(isset($_POST['token'])){
			$t=$login->getToken($this->checkPost('token'));
			if(!empty($t)){
				if(isset($_POST['pdf'])){
					//$id=checkPost('id_reporte');
					$fechainicio=$this->checkPost('fechainicio');
					$fechafinal=$this->checkPost('fechafinal');
					$obj=$crud->mostrar($fechainicio, $fechafinal);
					if($obj!=null){
						echo $pdf->createPdf($obj, 0);
					}else{
						echo $pdf->createEmpty();
					}
				}elseif(isset($_POST['pdfClientes'])){
					//$id=checkPost('id_reporte');
					$fechainicio=$this->checkPost('fechainicio');
					$fechafinal=$this->checkPost('fechafinal');
					$objs=$crud->mostrarEmpresas($fechainicio, $fechafinal);
					//echo json_encode($objs);
					if($objs!=null){
						echo $pdf->createPdf($objs, 1); 
					}else{
						echo $pdf->createEmpty();
					}
				}elseif(isset($_POST['pdfCliente'])){
					$cli=$this->checkPost('cliente');
					$fechainicio=$this->checkPost('fechainicio');
					$fechafinal=$this->checkPost('fechafinal');
					//echo $cli.'   '.$fechainicio.$fechafinal;
					$obj=$crud->mostrarEmpresa($cli, $fechainicio, $fechafinal);
					//echo json_encode($obj);
					if($obj!=null){
						echo $pdf->createPdf($obj, 2);
					} else{
						echo $pdf->createEmpty();
					}
				}
			}else{
				echo 'error T';
			}
		}
	}
}
?>