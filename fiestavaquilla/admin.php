<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <title></title>
    <style>
        .btn-light {
            box-shadow: 0 0 11px rgba(0, 0, 0, 0.8) !important;
        }

        .btn-light:hover {
            background-color: #ff8c00 !important;
            border-color: #ff8c00 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <h1 class="tittle">Fiesta de la Vaquilla de Fresnedillas de la Oliva</h1>
    <div class="btn-container">
        <button class="btn btn-light mr-2" onclick="showSection('usuarios')">Usuarios</button>
        <button class="btn btn-light mr-2" onclick="showSection('compras')">Compras</button>
        <button class="btn btn-light mr-2" onclick="showSection('reservas')">Reservas</button>
        <button class="btn btn-light mr-2" onclick="showSection('mensajes')">Mensajes</button>
        <a class="btn btn-light" href="logout.php">Cerrar sesión</a>
    </div>

    <?php
    require("config.php");

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    echo "<div id='compras' class='content-container' style='display:none;'>
            <div class='table-responsive'>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Nombre Usuario</th>
                        <th>Correo Usuario</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>";

    $sql = "SELECT p.id, p.fecha, p.estado, u.nombre, u.correo, pr.nombre AS producto, dp.cantidad, dp.precio_unitario, pr.stock 
            FROM pedidos p
            JOIN detalles_pedidos dp ON p.id = dp.pedido_id
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN productos pr ON dp.producto_id = pr.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["fecha"] . "</td>
                    <td>" . $row["estado"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["correo"] . "</td>
                    <td>" . $row["producto"] . "</td>
                    <td>" . $row["cantidad"] . "</td>
                    <td>" . $row["precio_unitario"] . "</td>
                    <td>" . $row["stock"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No se encontraron compras</td></tr>";
    }

    echo "</tbody>
        </table>
        </div>
        </div>";
    echo "<div id='reservas' class='content-container' style='display:none;'>
            <div class='table-responsive'>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Usuario</th>
                        <th>Correo Usuario</th>
                        <th>Fecha Reserva</th>
                        <th>Hora Reserva</th>
                    </tr>
                </thead>
                <tbody>";

    $sql = "SELECT r.id, u.nombre, u.correo, r.fecha_reserva, r.hora_reserva 
            FROM reservas r
            JOIN usuarios u ON r.usuario_id = u.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["correo"] . "</td>
                    <td>" . $row["fecha_reserva"] . "</td>
                    <td>" . $row["hora_reserva"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron reservas</td></tr>";
    }

    echo "</tbody>
        </table>
        </div>
        </div>";
    echo "<div id='usuarios' class='content-container' style='display:none;'>
            <div class='table-responsive'>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>";

    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["apellido"] . "</td>
                    <td>" . $row["correo"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No se encontraron usuarios</td></tr>";
    }

    echo "</tbody>
        </table>
        </div>
        </div>";

    echo "<div id='mensajes' class='content-container' style='display:none;'>
            <div class='table-responsive'>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>";

    $sql = "SELECT * FROM mensaje";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["apellido"] . "</td>
                    <td>" . $row["mensaje"] . "</td>
                    <td>" . $row["fecha"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron mensajes</td></tr>";
    }

    echo "</tbody>
        </table>
        </div>
        </div>";

    $conn->close();
    ?>

    <script>
        function showSection(section) {
            document.getElementById('compras').style.display = 'none';
            document.getElementById('reservas').style.display = 'none';
            document.getElementById('usuarios').style.display = 'none';
            document.getElementById('mensajes').style.display = 'none';
            document.getElementById(section).style.display = 'block';
        }
    </script>
</body>
</html>