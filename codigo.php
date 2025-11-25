<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styleCodigo.css">
    <title>QR y Enlaces</title>
</head>

<body>
    <?php

    session_start();

    //Importamos libreria
    include('lib/phpqrcode/qrlib.php');

    //Recuperamos de la session el usuario y el cine
    $usuario = $_SESSION['usuario'];
    $cine = $_COOKIE['cine'];
    $asiento = $_GET['asiento'];

    $_SESSION['asiento'] = $asiento;

    // echo 'El usuario es: ' . $usuario . '<br>';
    // echo 'El cine es: ' . $cine . '<br>';
    // echo 'El asiento es: ' . $asiento . '<br>';
    
    //Url a la que nos lleva el Qr
    $url = 'http:http://localhost/proyecto/entrada.php?nombre=' . $usuario . '&asiento=' . $asiento . '&cine=' . $cine;

    //Guardar QR como archivo temporal
    $qrFile = 'codigo.png';

    //Generar QR
    QRcode::png($url, $qrFile);


    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>El QR</title>
    </head>

    <body>
        <h2>Tu entrada a golpe de QR:</h2>
        <img src="<?php echo $qrFile; ?>" alt="Código QR">

        <p><a href="codigoPdf.php">Descargar en PDF</a></p>
        <br><br>

        <p><a href="codigoCorreo.php">Enviar por correo electronico</a></p>
    </body>

    </html>
</body>

</html>