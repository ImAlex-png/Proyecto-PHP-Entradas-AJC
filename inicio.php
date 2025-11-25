<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styleInicio.css">
    <title>Inicio</title>
</head>

<body>

    <?php
    session_start();
    // mostrar error de mensaje de error
    if (isset($_SESSION["mensaje"])) {
        $mensaje = $_SESSION["mensaje"];
        echo $mensaje;
        // elimina el mensaje despues de mostrarlo
        unset($_SESSION["mensaje"]);
    }
    ?>
    <h1>¡BIENVENIDO!</h1>
    <form action="validacion.php" method="post">

        Nombre usuario: <input type="text" name="usuario" />
        <br></br>

        Contraseña: <input type="password" name="contraseña" />

        <br></br>

        Email: <input type="text" name="email" />

        <br></br>

        <select name="cine" id="cine">
            <option value="arcos">Los Arcos</option>
            <option value="alcores">Los Alcores</option>
            <option value="nervion">Nervion</option>
        </select>

        <br><br>

        <input type="submit" name="submit" value="Enviar" />

    </form>



</body>

</html>