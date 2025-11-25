<?php

session_start();

$personas = [
    [
        "nombre" => "Antonio",
        "password" => "erchulo"
    ],
    [
        "nombre" => "Noelia",
        "password" => "lguapa"
    ],
    [
        "nombre" => "Pepe",
        "password" => "elpsao"
    ],

    [
        "nombre" => "Sofia",
        "password" => "lalista"
    ]
];


// Comprobamos que este los campoa
if (isset($_POST['usuario']) && isset($_POST['contraseña']) && isset($_POST['email']) && isset($_POST['cine'])) {

    if (!empty($_POST['usuario']) && !empty($_POST['contraseña']) && !empty($_POST['email'])) {

        //Pillamos todas las variables del formulario y las pasamos por el htmlspecialcharacters ( primer saneamiento )
        $nombre = htmlspecialchars($_POST['usuario']);
        $contraseña = htmlspecialchars($_POST['contraseña']);
        $correo = htmlspecialchars($_POST['email']);
        $cine = htmlspecialchars($_POST['cine']);

        //Boolean para ver si se ha encontrado o no
        $encontrado = false;

        //Recorremos el array de arrays 
        foreach ($personas as $persona) {
            //Comprobamos si en esa lista el nombre y password coincide con el que le metemos por formulario
            if ($persona['nombre'] == $nombre && $persona['password'] == $contraseña) {
                $encontrado = true;
                break;
            }
        }

        //Si coincide, metemos en la session el usuario y contraseña y saneamos el correo 
        if ($encontrado) {

            //Asignamos el usuario y la contraseña ya saneada a la session para que se puedo propagar y lo enviamos a asientos.php
            $_SESSION['usuario'] = $nombre;

            $_SESSION['contraseña'] = $contraseña;

            //Creamos la cookie con el cine seleccionado
            setcookie('cine', $cine, time() + 3600 * 24);

            header('Location:asientos.php');

        } else {
            //Si no coincide, mandamos mensaje de error y redirigimos a la pagina de inicio
            $_SESSION["mensaje"] = '<h4 style="color:red;">El usuario o contraseña no es correcto</h4>';

            header('Location:inicio.php');
            exit();
        }

        //Hacemos el try catch para validar correo
        try {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['email'] = $correo;
            } else {
                throw new Exception("El formato del correo electrónico no es válido.");
            }
        } catch (Exception $e) {
            // Guardamos el mensaje en la sesión para mostrarlo en inicio.php
            $_SESSION["mensaje"] = $e->getMessage();

            // Volvemos a inicio.php
            header("Location: inicio.php");
            exit;
        }
    } else {
        $_SESSION["mensaje"] = '<h4 style="color:red;">Los datos no pueden ser vacios.</h4>';


        header('Location:inicio.php');
        exit();
    }
}
