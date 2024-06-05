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

        if (isset($_COOKIE['carrito'])) {
            $carrito = json_decode($_COOKIE['carrito'], true);
            unset($carrito[$id_producto]);
            setcookie('carrito', json_encode($carrito), time() + (86400 * 30), "/");
        }

        $id_usuario = $_SESSION['user_id'];
        $sql = "DELETE FROM carrito_usuarios WHERE id_usuario = $id_usuario AND id_producto = $id_producto";
        if ($conn->query($sql) === TRUE) {
            echo "Producto eliminado del carrito correctamente en la base de datos";
        } else {
            echo "Error al eliminar el producto del carrito en la base de datos: " . $conn->error;
        }

        $conn->close();

        header("Location: carrito.php");
        exit();
    }
?>
