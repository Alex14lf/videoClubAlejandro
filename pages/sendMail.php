<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (!isset($_SESSION["user"]) || !isset($_SESSION["password"])) {
    header("Location:../index.php");
    exit();
} else {
    if (isset($_POST["asunto"]) && !empty(($_POST["asunto"])) && isset($_POST["mensaje"]) && !empty($_POST["mensaje"])) {

        $asunto = $_POST["asunto"];
        $mensaje = $_POST["mensaje"];
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'devalex14lf@gmail.com'; //AÑADE TU CORREO
        $mail->Password = 'qjxogmeplweiuuuy'; //AÑADE LA CONTRASEÑA
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('devalex14lf@gmail.com');//AÑADE TU CORREO
        $mail->addAddress('devalex14lf@gmail.com');//AÑADE EL CORREO DONDE QUIERES ENVIARLO
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->send();
        
        header("Location: users.php?mail=send");
    }
}
?>