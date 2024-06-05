<?php
    $servername = "localhost";
    $username = "root";
    $password = "contraseña";
    $dbname = "fiestavaquilla";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>
