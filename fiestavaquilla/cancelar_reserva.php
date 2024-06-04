<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Debes iniciar sesión para cancelar la reserva.']);
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "contraseña";
    $dbname = "fiestavaquilla";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Error de conexión: ' . $conn->connect_error]);
        exit;
    }

    $reserva_id = $_POST['reserva_id'];
    $usuario_id = $_SESSION['user_id'];

    $query = "DELETE FROM reservas WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $reserva_id, $usuario_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Reserva cancelada con éxito.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al cancelar la reserva.']);
    }

    $stmt->close();
    $conn->close();
?>
