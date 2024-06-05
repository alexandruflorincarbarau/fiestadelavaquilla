<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <h2>Registrarse</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="registro">
                <div class="inputBx">
                    <input type="text" placeholder="Introduzca su nombre"  aria-label="nombre" id="nombre" name="nombre" required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="text" placeholder="Introduzca su apellido"  aria-label="nombre" id="apellido" name="apellido" required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="email" placeholder="Correo electrónico"  aria-label="nombre" id="email" name="email"required>
                </div>
                <br>
                <div class="inputBx">
                    <input type="password" placeholder="Contraseña" aria-label="nombre" minlength="8" id="pass" name="pass" required>
                </div>
                <br>
                <button class="btn btn-light--terminos btn-sm inputBx" data-bs-toggle="modal" data-bs-target="#modal-1">Términos y condiciones</button><br>
                                    <div class="modal fade" id="modal-1" tabindex="-1" aria-hidden="true" aria-labelledby="label-modal-1">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <h5 class="modal-title">Términos y condiciones</h5>
                                                        <button class="btn-close" data-bs-dismiss="modal" aria-label="cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-start">
                                                            <b>1. Aceptación de los Términos</b>
                                                            <br>
                                                            Al registrarse en nuestra página informativa, usted acepta cumplir y estar sujeto a los siguientes términos y condiciones. Si no está de acuerdo con alguno de estos términos, por favor, no se registre ni utilice nuestros servicios.
                                                            <br><br>
                                                            <b>2. Registro de Usuario</b>
                                                            <br>
                                                            Para acceder a ciertos contenidos y servicios de nuestra página, se requiere que los usuarios completen el formulario de registro proporcionando información precisa, actual y completa. El usuario es responsable de mantener la confidencialidad de su cuenta y contraseña, así como de todas las actividades que ocurran bajo su cuenta.
                                                            <br><br>
                                                            <b>3. Uso de la Información</b>
                                                            <br>
                                                            La información proporcionada por los usuarios durante el registro será utilizada para mejorar nuestros servicios y ofrecer contenido personalizado. Nos comprometemos a no compartir esta información con terceros sin el consentimiento del usuario, excepto cuando sea necesario para cumplir con la ley o en respuesta a un proceso legal válido.
                                                            <br><br>
                                                            <b>4. Obligaciones del Usuario</b>
                                                            <br>
                                                            Al registrarse y utilizar nuestros servicios, usted se compromete a:
                                                            <br><br>
                                                            ㅤㅤㅤㅤ<b>·</b> Proveer información veraz, exacta, actual y completa
                                                            <br>
                                                            ㅤㅤㅤㅤ durante el registro y a mantener dicha información
                                                            <br>
                                                            ㅤㅤㅤㅤ actualizada.
                                                            <br>
                                                            ㅤㅤㅤㅤ<b>·</b> No utilizar la página con fines ilegales o no autorizados.
                                                            <br>
                                                            ㅤㅤㅤㅤ<b>·</b> No compartir su cuenta con terceros.
                                                            <br>
                                                            ㅤㅤㅤㅤ<b>·</b> Informar inmediatamente sobre cualquier uso no
                                                            <br>
                                                            ㅤㅤㅤㅤ autorizado de su cuenta.
                                                            <br><br>
                                                            <b>5. Propiedad Intelectual</b>
                                                            <br>
                                                            Todos los contenidos, marcas, logos, dibujos, documentación, programas informáticos, o cualquier otro elemento susceptible de protección por la legislación de propiedad intelectual o industrial, que sean accesibles en nuestra página, corresponden exclusivamente a nuestra empresa o a sus legítimos titulares y quedan expresamente reservados todos los derechos sobre los mismos.
                                                            <br><br>
                                                            <b>6. Protección de Datos</b>
                                                            <br>
                                                            Nos comprometemos a proteger la privacidad de los usuarios y a tratar sus datos personales de conformidad con la legislación vigente en materia de protección de datos personales. Para más detalles, consulte nuestra Política de Privacidad.
                                                            <br><br>
                                                            <b>7. Modificaciones de los Términos</b>
                                                            <br>
                                                            Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones serán efectivas a partir del momento de su publicación en nuestra página. Se recomienda revisar regularmente estos términos para estar al tanto de cualquier cambio.
                                                            <br><br>
                                                            <b>8. Limitación de Responsabilidad</b>
                                                            <br>
                                                            No seremos responsables de ningún daño directo, indirecto, incidental, especial o consecuente que resulte del uso o la imposibilidad de uso de nuestros servicios. Esto incluye, pero no se limita a, daños por pérdida de beneficios, uso, datos u otras pérdidas intangibles.
                                                            <br><br>
                                                            <b>9. Terminación</b>
                                                            <br>
                                                            Nos reservamos el derecho de terminar su cuenta y acceso a nuestros servicios, sin previo aviso, en caso de incumplimiento de estos términos y condiciones o de cualquier otro comportamiento que consideremos inapropiado.
                                                            <br><br>
                                                            <b>10. Ley Aplicable</b>
                                                            <br>
                                                            Estos términos y condiciones se regirán e interpretarán de acuerdo con las leyes del país en el que está establecida nuestra empresa, sin dar efecto a ningún principio de conflictos de leyes. Cualquier disputa que surja en relación con estos términos será sometida a la jurisdicción exclusiva de los tribunales de dicho país.
                                                            <br>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Cancelar</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Aceptar</button>
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const btnAceptar = document.querySelector('.modal-footer .btn-secondary');
                                                                const checkbox = document.getElementById('checkbox');

                                                                btnAceptar.addEventListener('click', function() {
                                                                    checkbox.checked = true;
                                                                });
                                                            });
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const btnAceptar = document.querySelector('.modal-footer .btn-light');
                                                                const checkbox = document.getElementById('checkbox');

                                                                btnAceptar.addEventListener('click', function() {
                                                                    checkbox.checked = false;
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox" required>
                                        <label for="checkbox" class="form-check-label text-light">Acepto los términos y condiciones</label>   
                                    </div><br>
                <div class="inputBx">
                    <input type="submit" value="Registrarse">
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
        $nombre = "";
        $apellido = "";
        $email = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $nombre = htmlspecialchars(trim($_POST["nombre"]));
            $apellido = htmlspecialchars(trim($_POST["apellido"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $contrasena = htmlspecialchars(trim($_POST["pass"]));
            
            
            $conexion = new mysqli("127.0.0.1", "root", "contraseña", "fiestavaquilla");

            if ($conexion->connect_errno) {
                die("Fallo al conectar a MySQL: " . $conexion->connect_error);
            } else {
                
                $verificar_email_query = "SELECT id FROM usuarios WHERE correo = '$email'";
                $verificar_email_result = $conexion->query($verificar_email_query);

                if ($verificar_email_result->num_rows == 0) {

                    $insertar_usuario_query = "INSERT INTO usuarios (nombre, apellido, correo , contrasena) VALUES ('$nombre', '$apellido','$email', MD5('$contrasena'))";
                    
                    if ($conexion->query($insertar_usuario_query)) {
                        $_SESSION['user_name'] = $nombre;
                        $_SESSION['apellido'] = $apellido;
                        $_SESSION['email'] = $email;

                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Usuario registrado correctamente!',
                                text: 'Gracias por unirte a la familia de la Fiesta de la vaquilla de Fresnedillas de la Oliva, ahora podrás disfrutar de la reserva para visitar nuestro museo y de la tienda exclusiva',
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
                                window.location.href = 'login.php';
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al registrar el usuario',
                                text: '" . $conexion->error . "',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                position: 'top-end',
                                toast: true
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'El correo electrónico ya está registrado en la base de datos',
                            timer: 2000,
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
