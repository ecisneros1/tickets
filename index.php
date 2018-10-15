<?php
require_once(__DIR__.'/backend/api/login.php');
require_once(__DIR__.'/backend/api/calificaciones/administrar_calificacion.php');
require_once(__DIR__.'/backend/api/email/administrar_email.php');
require_once(__DIR__.'/backend/api/general/administrar_general.php');
require_once(__DIR__.'/backend/api/reportes/administrar_reporte.php');
require_once(__DIR__.'/backend/api/tickets/administrar_ticket.php');

if(isset($_POST['loginGen'])){
    $object=new Login();
    $object->useClass();
}elseif(isset($_POST['calificacion'])){
    $object=new UseCalificacion();
    $object->useClass();
}elseif(isset($_POST['email'])){
    $object=new UseEmail();
    $object->useClass();
}elseif(isset($_POST['general'])){
    $object=new General();
    $object->useClass();
}elseif(isset($_POST['reporte'])){
    $object=new UseReporte();
    $object->useClass();
}elseif(isset($_POST['ticket'])){
    $object=new UseTicket();
    $object->useClass();
}



?>