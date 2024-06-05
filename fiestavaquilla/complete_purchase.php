<?php
    session_start();
    require("config.php");

    header('Content-Type: application/json');

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para realizar la compra.']);
        exit;
    }

    $cliente_id = $_SESSION['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);
    $orderID = $data['orderID'] ?? '';

    if (empty($orderID)) {
        echo json_encode(['success' => false, 'message' => 'No se recibió el ID del pedido de PayPal.']);
        exit;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]));
    }

    try {
        // Iniciar la transacción
        $conn->begin_transaction();

        // Obtener los productos del carrito
        $query = "SELECT cu.id_producto, p.nombre, p.precio, cu.cantidad, p.stock
                FROM carrito_usuarios cu
                JOIN productos p ON cu.id_producto = p.id
                WHERE cu.id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $cliente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $carrito = $result->fetch_all(MYSQLI_ASSOC);

        if (empty($carrito)) {
            echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
            exit;
        }

        // Calcular el total del pedido
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        

        // Verificar el stock de los productos
        foreach ($carrito as $item) {
            if ($item['stock'] < $item['cantidad']) {
                throw new Exception("No hay suficiente stock para el producto: " . $item['nombre']);
            }
        }

        // Insertar el pedido
        $query = "INSERT INTO pedidos (usuario_id, fecha, estado) VALUES (?, NOW(), 'Pagado')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $cliente_id);
        $stmt->execute();
        $pedido_id = $stmt->insert_id;

        // Vaciar el carrito
        $query = "DELETE FROM carrito_usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $cliente_id);
        $stmt->execute();

        // Actualizar el stock de productos
        foreach ($carrito as $item) {
            $query = "UPDATE productos SET stock = stock - ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $item['cantidad'], $item['id_producto']);
            $stmt->execute();
        }

        // Insertar detalles del pedido
        $fecha_actual = date('Y-m-d H:i:s');

        foreach ($carrito as $item) {

            $fecha_entrega_estimada = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($fecha_actual)));
            
            $precio_unitario = $item['precio'] * $item['cantidad'];

            $query = "INSERT INTO detalles_pedidos (pedido_id, producto_id, cantidad, precio_unitario, fecha_entrega_estimada) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            
            $stmt->bind_param("iiids", $pedido_id, $item['id_producto'], $item['cantidad'], $precio_unitario, $fecha_entrega_estimada);
            $stmt->execute();
        }
        
        $conn->commit();

        // Borrar la cookie del carrito
        setcookie('carrito', '', time() - 3600, '/');

        echo json_encode(['success' => true, 'message' => 'Compra finalizada con éxito.', 'pedido_id' => $pedido_id]);
    } catch (Exception $e) {
        // Revertir la transacción si hay un error
        $conn->rollback();
        error_log('Error en el proceso de compra: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error en el proceso de compra: ' . $e->getMessage()]);
        exit;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
?>