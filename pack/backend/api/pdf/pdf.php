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

    public function createPdf($obj){
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
}

?>