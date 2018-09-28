<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image(__DIR__.'/logoit3.jpg',10,6,30);
        // Arial bold 15
        $this->SetFont('Helvetica','B',20);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Reporte de Ticket IT3',2,0,'C');
        // Line break
        $this->Ln(40);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

    public function createPdf($obj, $type){
        switch ($type){
            case 0:{
                $this->general($obj);
                break;
            }
            case 1:{
                $this->clientes($obj);
                break;
            }
            case 2:{
                $this->cliente($obj);
                break;
            }
            case 3:{
                $this->reporte($obj);
                break;
            }
            default:{
                break;
            }

        }
    }

    public function createEmpty(){
        $this->vacio();
    }

    function clientes($objs){
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetX(30);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(0,10,'Fecha Inicio: '.$objs->fechainicio,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Fecha Final: '.$objs->fechafinal,0,1);


        foreach($objs->objs as $obj){
            $pdf->AddPage();
            $pdf->SetX(30);
            $pdf->SetFont('Helvetica','B',13);
            $pdf->Cell(0,10,'Cliente: '.$obj->cliente,0,1);
            $pdf->SetX(30);
            $pdf->Cell(0,10,'IDs de Reportes: '.$obj->ids,0,1);
            $pdf->SetX(30);
            $pdf->Cell(0,10,'Fechas de Reportes: '.$obj->fechas,0,1);
            $pdf->SetX(30);
            $pdf->Cell(0,10,'Tiempo total de servicio: '.$obj->time,0,1);
        }
        
        $pdf->Output();
    }

    function reporte($obj){
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();


        $pdf->SetX(30);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(0,10,'ID Reporte: '.$obj->id_reporte,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Cliente: '.$obj->cliente,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'ID Ticket: '.$obj->id_ticket,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Contacto: '.$obj->contacto,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Solicitado por: '.$obj->solicitadopor,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Partes / Descripcion: '.$obj->partesdescripcion,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Tareas: '.$obj->tareas,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Tipo: '.$obj->tipo,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Hora de llegada: '.$obj->horallegada,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Hora de salida: '.$obj->horasalida,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Tiempo de traslado: '.$obj->tiempotraslado,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Fecha: '.$obj->fecha,0,1);

        $pdf->Output();
    }

    function general($obj){
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetX(30);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(0,10,'Fecha Inicio: '.$obj->fechainicio,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Fecha Final: '.$obj->fechafinal,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Total de horas de servicio: '.$obj->time,0,1);

        $pdf->Output();
    }

    function cliente($obj){
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetX(30);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(0,10,'Cliente: '.$obj->cliente,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Fecha Inicio: '.$obj->fechainicio,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Fecha Final: '.$obj->fechafinal,0,1);
        $pdf->SetX(30);
        $pdf->Cell(0,10,'Total de horas de servicio: '.$obj->time,0,1);

        $pdf->Output();
    }

    function vacio(){
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetX(30);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(0,10,'Mensaje: '.'No existen datos que concuerden con la busqueda',0,1);
        $pdf->Output();
    }
}

?>