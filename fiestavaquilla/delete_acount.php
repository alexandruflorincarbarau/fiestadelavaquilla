<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="css/delete_acount.css">
</head>
<body>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <h2>Eliminar cuenta de manera irreversible</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="inputBx">
                    <input type="email" placeholder="Correo electrónico"  aria-label="nombre" id="email" name="email" required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="password" placeholder="Contraseña" aria-label="nombre" minlength="8" id="pass" name="pass" required>
                </div>
                <br>
                <div class="inputBx">
                <label for="checkbox" class="form-check-label text-light text-center">Para eliminar su cuenta de forma irreversible, marque la casilla.<br>
                                                                                        Una vez eliminada su cuenta, sus datos se borrarán permanentemente.</label>
                    <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox" required>
                </div><br>
                <div class="inputBx">
                    <input type="submit" value="Eliminar cuenta">
                </div><br>
                <div class="links">
                    <a href="#"></a>
                    <a href="#" onclick="history.back()">Volver atrás</a>
                    <a href="#"></a>
                </div>
            </form>
        </div>
    </div>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = htmlspecialchars(trim($_POST["email"]));
            $contrasena = htmlspecialchars(trim($_POST["pass"]));
            
            $conexion = new mysqli("127.0.0.1", "root", "contraseña", "fiestavaquilla");

            if ($conexion->connect_errno) {
                die("Fallo al conectar a MySQL: " . $conexion->connect_error);
            } else {
                $verificar_usuario_query = "SELECT id FROM usuarios WHERE correo = '$email' AND contrasena = MD5('$contrasena')";
                $verificar_usuario_result = $conexion->query($verificar_usuario_query);

                if ($verificar_usuario_result->num_rows == 1) {
                    $eliminar_usuario_query = "DELETE FROM usuarios WHERE correo = '$email' AND contrasena = MD5('$contrasena')";
                    
                    if ($conexion->query($eliminar_usuario_query)) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario eliminado correctamente',
                                text: 'Su cuenta ha sido eliminada con éxito.',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                toast: true,
                                didOpen: () => {
                                    const swalContainer = Swal.getPopup();
                                    swalContainer.addEventListener('click', () => {
                                        Swal.close();
                                    });
                                }
                            }).then(function() {
                                setTimeout(function(){
                                    window.location.href = 'index.php';
                                }, 750);
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al eliminar el usuario',
                                text: '" . $conexion->error . "',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                toast: true,
                                didOpen: () => {
                                    const swalContainer = Swal.getPopup();
                                    swalContainer.addEventListener('click', () => {
                                        Swal.close();
                                    });
                                }
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Correo electrónico o contraseña incorrectos',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            toast: true,
                            didOpen: () => {
                                const swalContainer = Swal.getPopup();
                                swalContainer.addEventListener('click', () => {
                                    Swal.close();
                                });
                            }
                        });
                    </script>";
                }
                $conexion->close();
            }
        }
    ?>
</body>
</html>
