<?php

//Iniciamos session
session_start();

//Importamos las clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Cargamos el autoload de Composer
require 'vendor/autoload.php';

//Creamos variable de PHPMailer
$mail = new PHPMailer(true);

//Recuperamos los datos de la entrada de la session
$usuario = $_SESSION['usuario'];
$cine = $_COOKIE['cine'];
$asiento = $_SESSION['asiento'];
$email = $_SESSION['email'];

// echo "Usuario: $usuario<br>";
// echo "Asiento: $asiento<br>";
// echo "Email: $email<br>";
// echo "Cine: $cine<br>";

//Intentamos enviar el correo
try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'alejc2006@gmail.com';
    $mail->Password = 'edld uqgb wtvq hxmh';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('alejc2006@gmail.com', 'Alejandro');
    $mail->addAddress($email, 'Destinatario');

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Informacion de la entrada';
    $mail->Body = "
        <h1>Hola!</h1>
        <p>Aquí te envío la informacion de la entrada:</p>
        <p><b>Usuario:</b> $usuario</p>
        <p><b>Asiento:</b> $asiento</p>
        <p><b>Cine:</b> $cine</p>";

    $mail->addAttachment('codigo.png');


    $mail->send();
    echo 'Mensaje enviado correctamente.';

    header('Location:entrada.php?usuario=' . $usuario . '&asiento=' . $asiento . '&cine=' . $cine);
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
