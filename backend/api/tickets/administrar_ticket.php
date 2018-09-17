<?php
//incluye la clase Libro y CrudLibro
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
require_once('crud_ticket.php');
require_once('../../models/Ticket.php');

$crud= new CrudTicket();
$ticket= new Ticket();

    if(isset($_POST['mostrar'])){
        $listaTickets=$crud->mostrar();
        echo json_encode($listaTickets);
    }else if(isset($_POST['obtener'])){
        $ticket=$crud->obtener($_POST['id_ticket']);
        echo json_encode($ticket);
    }
?>