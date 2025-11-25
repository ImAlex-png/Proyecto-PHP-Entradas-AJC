<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styleAsientos.css">
    <title>Asientos</title>
</head>

<body>
    <?php
    //Iniciamos session para pillar las cositas
    session_start();


    echo '<h1>Elige tus asientos:</h1>';
    ?>

    <table border="1">
        <tr>
            <th colspan="2"><b>Asientos</b></th>
        </tr>
        <tr>
            <td><a href="codigo.php?asiento=1">1</a></td>
            <td><a href="codigo.php?asiento=2">2</a></td>
        </tr>
        <tr>
            <td><a href="codigo.php?asiento=3">3</a></td>
            <td><a href="codigo.php?asiento=4">4</a></td>
        </tr>
    </table>
</body>

</html>