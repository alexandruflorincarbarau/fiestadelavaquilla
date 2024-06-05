<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "contraseña";
    $database = "fiestavaquilla";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        if (isset($_COOKIE['carrito'])) {
            $carrito = json_decode($_COOKIE['carrito'], true);
            $carrito[$id_producto] = $cantidad;
            setcookie('carrito', json_encode($carrito), time() + (86400 * 30), "/");
        }

        $id_usuario = $_SESSION['user_id'];
        $sql = "UPDATE carrito_usuarios SET cantidad = $cantidad WHERE id_usuario = $id_usuario AND id_producto = $id_producto";
        if ($conn->query($sql) === TRUE) {
            echo "Carrito actualizado correctamente en la base de datos";
        } else {
            echo "Error al actualizar el carrito en la base de datos: " . $conn->error;
        }

        $conn->close();

        header("Location: carrito.php");
        exit();
    }
?>
