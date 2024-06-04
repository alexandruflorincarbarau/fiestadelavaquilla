<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/mismensajes.css">
    <style>
        .texto-blanco{
            color: #ffffff;
        }
        body {
            background-color: #000000 !important;
        }
        .card {
            box-shadow: 0 5px 10px 0 #ffffff;
            transition: 0.3s;
            border-radius: 5px;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 #ffffff;
        }
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
    <?php include("header_session.php");?>
    <div class="container mt-5">
        <h2 class="text-center tittle margen-header">Mis Mensajes</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php
                    require("config.php");

                    if (!isset($_SESSION['user_id'])) {
                        echo "<p>Debes iniciar sesión para ver tus mensajes.</p>";
                        exit;
                    }

                    $usuario_id = $_SESSION['user_id'];

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    $successMessage = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_message'])) {
                        $mensaje_id = $_POST['mensaje_id'];
                        $delete_stmt = $conn->prepare("DELETE FROM mensaje WHERE id = ? AND usuario_id = ?");
                        $delete_stmt->bind_param("ii", $mensaje_id, $usuario_id);
                        if ($delete_stmt->execute()) {
                            $successMessage = "Mensaje borrado con éxito.";
                        }
                        $delete_stmt->close();
                    }

                    $stmt = $conn->prepare("SELECT id, nombre, apellido, mensaje, fecha FROM mensaje WHERE usuario_id = ?");
                    $stmt->bind_param("i", $usuario_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    ?>
                    <!--para que el bloque de eliminación aparezca antes que las reservas es decir en el tope de la pantala-->
                    <?php if (!empty($successMessage)) { ?>
                        <div class="container mt-3">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div id="success-alert" class="alert alert-success" role="alert">
                                        <?php echo $successMessage; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-alert').style.display = 'none';
                            }, 1000);
                        </script>
                    <?php } ?>
                    <?php

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card mb-3 mt-3'>";
                            echo "<div class='card-body'>";
                            echo "<div class='d-flex justify-content-between align-items-center'>";
                            echo "<div>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($row['nombre']) . " " . htmlspecialchars($row['apellido']) . "</h5>";
                            echo "<p class='card-text'>" . htmlspecialchars($row['mensaje']) . "</p>";
                            echo "<p class='card-text'><small class='text-muted'>" . htmlspecialchars($row['fecha']) . "</small></p>";
                            echo "</div>";
                            echo "<div>";
                            echo "<form id='delete-form-" . $row['id'] . "' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                            echo "<input type='hidden' name='mensaje_id' value='" . $row['id'] . "'>";
                            echo "<button type='button' onclick='confirmDelete(" . $row['id'] . ")' class='btn btn-light btn-sm'>Borrar</button>";
                            echo "<input type='hidden' name='delete_message' value='1'>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p class='mt-3 texto-blanco'>No has enviado ningún mensaje todavía.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                ?>
            </div>
            <div class="row margen-footer">

            </div>
        </div>
    </div>
    <?php include("footer.php");?>
    <script>
        function confirmDelete(messageId) {
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar este mensaje?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + messageId).submit();
                }
            });
        }
    </script>
</body>
</html>
