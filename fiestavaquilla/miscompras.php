<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs/lib/anime.min.js"></script>
    <link rel="stylesheet" href="css/miscompras.css">
</head>
<body>
    <?php require("header_session.php"); ?>
    <?php
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $user_id = $_SESSION['user_id'];

        require("config.php");

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "SELECT p.nombre, p.descripcion, dp.cantidad, dp.precio_unitario, dp.fecha_entrega_estimada
                FROM detalles_pedidos dp
                INNER JOIN productos p ON dp.producto_id = p.id
                INNER JOIN pedidos pe ON dp.pedido_id = pe.id
                WHERE pe.usuario_id = ?
                ORDER BY dp.fecha_entrega_estimada DESC";  // Ordenar por fecha de entrega estimada en orden descendente

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<div class='container'>";
                echo "<div class='row mt-5'>";
                $contador = 0;
                while ($row = $result->fetch_assoc()) {
                    $isExpired = strtotime($row["fecha_entrega_estimada"]) < time();
                    $card_style = $isExpired ? "background-color: lightgreen; color: white;" : "";
                    $envio_status = $isExpired ? "Entregado" : "En camino";
                    $card_id = "card-" . $contador;
                    
                    echo "<div class='col-md-6 mt-5'>";
                    echo "<div id='$card_id' class='card mb-3' style='$card_style'>";
                    echo "<div class='card-body'>";
                    echo "<h2 class='card-title'>" . $row["nombre"] . "</h2>";
                    echo "<p class='card-text'>" . $row["descripcion"] . "</p>";
                    echo "<p class='card-text'>Cantidad: " . $row["cantidad"] . "</p>";
                    echo "<p class='card-text'>Precio unitario: " . $row["precio_unitario"] . "</p>";
                    echo "<p class='card-text'>Fecha de entrega estimada: " . $row["fecha_entrega_estimada"] . "</p>";
                    echo "<p class='card-text'>Envío: " . $envio_status . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    if (!$isExpired) {
                        echo "<script>
                                anime({
                                    targets: '#$card_id',
                                    translateY: [0, -10],
                                    direction: 'alternate',
                                    loop: true,
                                    easing: 'easeInOutQuad',
                                    duration: 1000
                                });
                              </script>";
                    }
                    $contador++;
                }
                echo "</div>"; 
                echo "</div>"; 
            } else {
                echo "<div class='no-purchases'>No se encontraron compras para este usuario.</div>";
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

        $conn->close();
        ?>
        <div class="margen-footer"></div>
    <?php require("footer.php"); ?>
</body>
</html>
