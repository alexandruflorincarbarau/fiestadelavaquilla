<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="path_to_your_css_file.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/misreservas.css">
    <?php 
    ?>
    <style>
        body {
          background-image: url(css/img/historia-11.PNG);
          background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
            background-color: #f8f8f8; 
        }
        .btn-light {
            box-shadow: 0 0 25px #000000 !important;
            border-radius: 20px;
            border: none;
        }

        .btn-light:hover {
            background-color: #ff8c00 !important;
            border-color: #ff8c00 !important;
            color: #ffffff !important;
            box-shadow: 0 0 25px #000000 !important;
        }
        .reservation-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .reservation-item span {
            margin-right: 5vw; 
        }
        
        @media (max-width: 768px) {
            .reservation-item {
                flex-direction: column;
                text-align: left;
            }
            .cancel-button {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include("header_session.php");?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="formulario">
                    <h2 class="text-center tittle">Mis reservas</h2>
                    <?php
                            if (!isset($_SESSION['user_id'])) {
                                echo "Debes iniciar sesión para ver tus reservas.";
                                exit;
                            }

                            $servername = "localhost";
                            $username = "root";
                            $password = "contraseña";
                            $dbname = "fiestavaquilla";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Error de conexión: " . $conn->connect_error);
                            }

                            $usuario_id = $_SESSION['user_id'];

                            $query = "SELECT id, fecha_reserva FROM reservas WHERE usuario_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $usuario_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                echo "<ul class='centered-list'>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li class='reservation-item'>";
                                    echo "<span><b>Fecha de reserva: " . $row["fecha_reserva"] . "</b></span>";
                                    echo "<form class='inline-form' action='cancelar_reserva.php' method='POST' onsubmit='confirmarCancelacion(event)'>";
                                    echo "<input type='hidden' name='reserva_id' value='" . $row["id"] . "'>";
                                    echo "<button type='submit' class='btn-light cancel-button'>Cancelar Reserva</button>";
                                    echo "</form>";
                                    echo "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<div class='centered-span-container'>
                                        <span class='centered-span'><b>No tienes reservas</b></span>
                                      </div>";
                            }

                            $stmt->close();
                            $conn->close();
                        ?>
                    <div class="mt-5">
                        <p>
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmarCancelacion(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Una vez cancelada la reserva, no habrá vuelta atrás",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);
                    fetch('cancelar_reserva.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire(
                                'Cancelada',
                                data.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al cancelar la reserva.',
                            'error'
                        );
                    });
                }
            });
        }
    </script>
    <?php include("footer.php");?>
</body>
</html>