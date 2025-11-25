<?php
//Iniciamos session para pillar la info de las otras paginas
session_start();

// Incluimos la libreria como hemos hecho en el del codigo QR
include 'lib/fpdf186/fpdf.php';

// Recuperamos de la session el usuario, el cine y el asiento
$usuario = $_SESSION['usuario'];
$cine = $_COOKIE['cine'];
$asiento = $_SESSION['asiento'];

// echo 'El usuario es: ' . $usuario . '<br>';
// echo 'El cine es: ' . $cine . '<br>';
// echo 'El asiento es: ' . $asiento . '<br>';

//Creamos un fpdf
$pdf = new FPDF();

//Añadimos una pagina
$pdf->AddPage();

//Especificamos la letra, el estilo y el tamaño
$pdf->SetFont('Arial', '', 12);


// Título
$pdf->Cell(0, 10, 'La entrada:', 0, 1);

// Texto de usuario
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Usuario: ' . $usuario, 0, 1);
$pdf->Cell(0, 10, 'Cine: ' . $cine, 0, 1);
$pdf->Cell(0, 10, 'Asiento: ' . $asiento, 0, 1);

// Espacio antes de la imagen
$pdf->Ln(10);

// Posicionamos la imagen debajo del texto usando GetY()
$y = $pdf->GetY();
$pdf->Image('codigo.png', 80, $y, 40, 40, 'PNG');

$pdf->Output();


