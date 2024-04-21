<?php
include "conexion_be.php";
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

function enviarCorreo($correo, $asunto, $cuerpo , $codigo = null, $enlace = null) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = 'soporte@clinicamontalban.com';
    $mail->Password = 'soportemontalban';
    $mail->Host = "authsmtp.securemail.pro";
    $mail->Port = 465;
    $mail->setFrom('soporte@clinicamontalban.com');
    $mail->Subject = $asunto;

    if ($codigo !== null) {

        ob_start();

        include '../correoCode.php';

        $cuerpo = ob_get_clean();


        $body = str_replace('$code', $codigo, $cuerpo);

        $mail->addAddress($correo);


        $mail->Body = $body;
        

    } else if($enlace !== null) {
        
        ob_start();

        include '../correoLink.php';
        
        $cuerpo = ob_get_clean();

        $body = str_replace('$enlace',$enlace, $cuerpo);

        $mail->addAddress($correo);

        $mail->Body =$body;

    } else{

      
        $correo2 ='soporte@clinicamontalban.com';

        $mail->addAddress($correo2);

        $mail->Body = $cuerpo;  

        
    }

    return $mail->send();
}

?>
