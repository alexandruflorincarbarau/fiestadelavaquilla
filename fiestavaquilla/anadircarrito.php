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
        $cantidad = $_POST['cantidad'] ?? 1;

        if (!isset($_COOKIE['carrito'])) {
            $carrito = [];
        } else {
            $carrito = json_decode($_COOKIE['carrito'], true);
        }

        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto] += $cantidad;
        } else {
            $carrito[$id_producto] = $cantidad;
        }

        setcookie('carrito', json_encode($carrito), time() + (86400 * 30), "/");

        $id_usuario = $_SESSION['user_id'];

        $sql_check = "SELECT cantidad FROM carrito_usuarios WHERE id_usuario = ? AND id_producto = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $id_usuario, $id_producto);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nueva_cantidad = $row['cantidad'] + $cantidad;
            $sql_update = "UPDATE carrito_usuarios SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("iii", $nueva_cantidad, $id_usuario, $id_producto);
            if ($stmt_update->execute()) {
                echo "Cantidad del producto actualizada correctamente";
            } else {
                echo "Error al actualizar la cantidad del producto en el carrito: " . $conn->error;
            }
        } else {
            $sql_insert = "INSERT INTO carrito_usuarios (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("iii", $id_usuario, $id_producto, $cantidad);
            if ($stmt_insert->execute()) {
                echo "Producto añadido al carrito y a la base de datos correctamente";
            } else {
                echo "Error al añadir el producto al carrito y a la base de datos: " . $conn->error;
            }
        }

        $stmt_check->close();
        $conn->close();

        header("Location: tienda_session.php");
        exit();
    }
?>
