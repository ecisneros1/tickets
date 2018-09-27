<?php

use PHPMailer\PHPMailer\PHPMailer;
//use phpmailer\phpmailer\src\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
//require ('../../calificaciones/administrar_calificacion.php');
require_once('../../config/Proxy.php');


class Email{

    public function sendEmail($email, $id_reporte, $nombre, $id, $fecha, $token){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP

            $mail->Host = 'mail.it3.com.ec';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'soporte@it3.com.ec';                 // SMTP username
            $mail->Password = 'd\S}i=ca&9K4X';                           // SMTP password
            //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 26;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('soporte@it3.com.ec', 'Soporte');
            $mail->addAddress($email, 'Cliente');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('http://localhost/tickets/backend/api/reportes/administrar_reporte.php?pdf=1&id_reporte=1');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Calificacion de servicio por soporte IT3';
            $proxy=new Proxy();
            //echo ('proxy: '.$proxy->getProxy());
            $homepage = file_get_contents($proxy->getProxy().'email/libs/phpmailer/formato.html');
            $variables=array();
            $variables['nombre']=$nombre;
            $variables['id']=$id;
            $variables['fecha']=$fecha;
            $variables['id_reporte']=$id_reporte;
            $variables['id_repo']=$id_reporte;
            $variables['token']=$token;
            foreach($variables as $key=>$value){
                $homepage=str_replace('{{ '.$key.' }}',$value,$homepage);
            }
            $mail->Body    = $homepage;
            //$mail->Body    ='hola';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
?>



