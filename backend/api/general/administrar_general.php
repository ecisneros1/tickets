<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Expose-Headers: X-Suggested-Filename");
require_once('crud_general.php');
require_once('../../models/Reporte.php');
require_once('../pdf/pdf.php');
require_once('../crud_login.php');


$crud= new CrudGeneral();
$reporte= new Reporte();
$pdf=new PDF();
$login=new CrudLogin();

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


	if(isset($_POST['token'])){
		$t=$login->getToken(checkPost('token'));
		if(!empty($t)){
			if(isset($_POST['pdf'])){
                //$id=checkPost('id_reporte');
                $fechainicio=checkPost('fechainicio');
                $fechafinal=checkPost('fechafinal');
				$obj=$crud->mostrar($fechainicio, $fechafinal);
				if($obj!=null){
					echo $pdf->createPdf($obj, 0);
				}else{
					echo $pdf->createEmpty();
				}
			}elseif(isset($_POST['pdfClientes'])){
                //$id=checkPost('id_reporte');
                $fechainicio=checkPost('fechainicio');
                $fechafinal=checkPost('fechafinal');
                $objs=$crud->mostrarEmpresas($fechainicio, $fechafinal);
				//echo json_encode($objs);
				if($objs!=null){
					echo $pdf->createPdf($objs, 1); 
				}else{
					echo $pdf->createEmpty();
				}
            }elseif(isset($_POST['pdfCliente'])){
                $cli=checkPost('cliente');
                $fechainicio=checkPost('fechainicio');
				$fechafinal=checkPost('fechafinal');
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
?>