<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2; // Cambia a 0 en producción
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bvmpjp@gmail.com'; 
        $mail->Password = 'tucontraseña'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('bvmpjp@gmail.com', 'Consulta Web'); 
        $mail->addReplyTo($_POST["correo"], $_POST["nombre"]);
        $mail->addAddress("bvmpjp@gmail.com"); 
        $mail->Subject = "Consulta de " . $_POST["nombre"];
        $mail->Body = "Nombre: " . $_POST["nombre"] . "\nCorreo Electrónico: " . $_POST["correo"] . "\n\nConsulta:\n" . $_POST["comentario"];

        $mail->send();
        header("Location: confirmacion.html");
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}