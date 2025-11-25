<?php

session_start();

// echo '<h1>Funciona el QR </h1>';\

// Recogemos los datos de la URL
$usuario = $_GET['usuario'];
$asiento = $_GET['asiento'];
$cine = $_GET['cine'];

$valido = false;

// Matriz de entradas válidas (igual que tu ejemplo de $personas)
$entradas = [
    [
        "usuario" => "Antonio",
        "asiento" => 1,
        "cine" => "arcos"
    ],
    [
        "usuario" => "Noelia",
        "asiento" => 2,
        "cine" => "alcores"
    ],
    [
        "usuario" => "Pepe",
        "asiento" => 3,
        "cine" => "arcos"
    ],
    [
        "usuario" => "Sofia",
        "asiento" => 4,
        "cine" => "nervion"
    ]
];

foreach ($entradas as $entrada) {
    if ($entrada['usuario'] === $usuario && $entrada['asiento'] === $asiento && $entrada['cine'] === $cine) {
        $valido = true;
    }
}

if ($valido) {
    $_SESSION["mensaje"] = 'La entrada no es correcta';
    header('Location:inicio.php');
    exit;
} else {
    echo "<h1>Entrada válida</h1>";
    echo "<p>Usuario: $usuario</p>";
    echo "<p>Asiento: $asiento</p>";
    echo "<p>Cine: $cine</p>";
}

