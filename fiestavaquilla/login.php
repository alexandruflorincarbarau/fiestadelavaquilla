<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/login.css">
    <style>
        .swal2-toast {
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <h2>Iniciar Sesión</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="login">
                <div class="inputBx">
                    <input type="email" placeholder="Correo electrónico" aria-label="nombre" id="email" name="email" required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="password" placeholder="Contraseña" aria-label="nombre" minlength="8" id="pass" name="pass" required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="submit" value="Acceder">
                </div>
                <br>
                <div class="links">
                    <a href="#" onclick="history.back()">Volver atrás</a>
                    <a href="registro.php">Registrarse</a>
                </div>
            </form>
        </div>
    </div>
    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $contrasena = htmlspecialchars(trim($_POST["pass"]));
            $email = htmlspecialchars(trim($_POST["email"]));


            $conexion = new mysqli("127.0.0.1", "root", "contraseña", "fiestavaquilla");


            if ($conexion->connect_errno) { 
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error',
                                text: 'Fallo al conectar a MySQL: " . $conexion->connect_error . "',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    const swalContainer = Swal.getPopup();
                                    swalContainer.addEventListener('click', () => {
                                        Swal.close();
                                    });
                                }
                            });
                        });
                      </script>";
                exit;
            }

            $stmt = $conexion->prepare("SELECT id, nombre, apellido, correo, contrasena FROM usuarios WHERE contrasena = md5(?) AND correo = ?");
            $stmt->bind_param("ss", $contrasena, $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();


                if ($result->num_rows > 0) { 
                    $fila = $result->fetch_assoc();

                    $_SESSION['user_id'] = $fila['id'];
                    $_SESSION['user_name'] = $fila['nombre'];
                    setcookie('session_started', '1', time() + (86400 * 30), "/"); 

                    header('Location: index_session.php');
                    exit();
                } else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Credenciales incorrectas',
                                    text: 'Por favor, verifica tu correo electrónico y contraseña.',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        const swalContainer = Swal.getPopup();
                                        swalContainer.addEventListener('click', () => {
                                            Swal.close();
                                        });
                                    }
                                });
                            });
                          </script>";
                }
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error en la consulta',
                                text: 'Error en la consulta: " . $stmt->error . "',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    const swalContainer = Swal.getPopup();
                                    swalContainer.addEventListener('click', () => {
                                        Swal.close();
                                    });
                                }
                            });
                        });
                      </script>";
            }

            $stmt->close();
            $conexion->close();
        }
    ?>
    <script>
        function onSubmit(token) {
            document.getElementById("login").submit();
        }
    </script>
</body>
</html>
