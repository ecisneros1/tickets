<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('crud_reporte.php');
require_once('../../models/Reporte.php');

$crud= new CrudReporte();
$reporte= new Reporte();

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['insertar'])) {
		//echo ($_POST['id_cliente']);
		$reporte->setCliente($_POST['cliente']);
		$reporte->setId_ticket($_POST['id_ticket']);
		$reporte->setContacto($_POST['contacto']);
		$reporte->setSolicitadopor($_POST['solicitadopor']);
		$reporte->setPartesdescripcion($_POST['partesdescripcion']);
		$reporte->setTareas($_POST['tareas']);
		$reporte->setTipo($_POST['tipo']);
		$reporte->setHorallegada($_POST['horallegada']);
		$reporte->setHorasalida($_POST['horasalida']);
		$reporte->setTiempotraslado($_POST['tiempotraslado']);
		$reporte->setFecha($_POST['fecha']);
		//$reporte->setServicio($_POST['servicio']);
		//$reporte->setPuntualidad($_POST['puntualidad']);
		//$reporte->setObservaciones($_POST['observaciones']);
		//$reporte->setConfirmacion($_POST['confirmacion']);
		//llama a la función insertar definida en el crud
		$myReporte=new Reporte();
		$myReporte=$crud->obtener($crud->insertar($reporte));
		echo json_encode($myReporte);


        $servername = "localhost";
		$username = "itthrcom_yoguin";
		$password = "Ittres20!0";
		$dbname = "itthrcom_it3";
		
                // Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$date = date('Y-m-d H:i:s');

		$sql = "UPDATE wp_js_ticket_tickets SET closed="+$date+" WHERE ticketid="+$myReporte->getId_ticket()+" )";

		$conn->query($sql);

		$conn->close();


		//header('Location: index.php');
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
	}elseif(isset($_POST['actualizar'])){
		$reporte->setId_reporte($_POST['id_reporte']);
		$reporte->setCliente($_POST['cliente']);
		$reporte->setId_ticket($_POST['id_ticket']);
		$reporte->setContacto($_POST['contacto']);
		$reporte->setSolicitadopor($_POST['solicitadoport']);
		$reporte->setPartesdescripcion($_POST['partesdescripcion']);
		$reporte->setTareas($_POST['tareas']);
		$reporte->setTipo($_POST['tipo']);
		$reporte->setHorallegada($_POST['horallegada']);
		$reporte->setHorasalida($_POST['horasalida']);
		$reporte->setTiempotraslado($_POST['tiempotraslado']);
		$reporte->setFecha($_POST['fecha']);
		$reporte->setServicio($_POST['servicio']);
		$reporte->setPuntualidad($_POST['puntualidad']);
		$reporte->setObservaciones($_POST['observaciones']);
		$reporte->setConfirmacion($_POST['confirmacion']);
		$crud->actualizar($reporte);
        //header('Location: index.php');
    }elseif(isset($_POST['mostrar'])){
        $listaReportes=$crud->mostrar();
        echo json_encode($listaReportes);
	// si la variable accion enviada por GET es == 'e' llama al crud y elimina un libro
	}elseif(isset($_POST['getid'])){
		echo json_encode($crud->obtener($_POST['id']));

	
	}elseif ($_GET['accion']=='e') {
		$crud->eliminar($_GET['id_reporte']);
		//header('Location: index.php');		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}elseif($_GET['accion']=='a'){
		//header('Location: actualizar.php');
	}
?>