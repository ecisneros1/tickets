<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once('crud_ticket.php');
require_once('../../models/Ticket.php');
require_once('../crud_login.php');

$crud= new CrudTicket();
$ticket= new Ticket();
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
		if(!empty($t) && $t!=null){
			if(isset($_POST['mostrar'])){
				$listaTickets=$crud->mostrar();
				echo json_encode($listaTickets);
			}else if(isset($_POST['obtener'])){
				$ticket=$crud->obtener($_POST['id_ticket']);
				echo json_encode($ticket);
			}elseif(isset($_POST['close'])){
				$id=checkPost('id_ticket');
				$date = date('Y-m-d H:i:s');
				$crud->closeTicket($id, $date);
				$listaTickets=$crud->mostrar();
				echo json_encode($listaTickets);
			}
		}else{
			echo 'error';
		}
	}
?>