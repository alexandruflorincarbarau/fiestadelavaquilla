<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Museo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/reserva.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url(css/img/historia-11.PNG);
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
            background-color: #f8f8f8; 
        }
    </style>
</head>
<body>
<?php include("header_session.php"); ?>
<div class="container">
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <div class="formulario">
        <h2 class="text-center tittle">Reservar visita al museo</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="reservaForm">
          <div class="form-group">
            <label for="fecha">Seleccione el día de la visita:</label>
            <?php
              $fecha_minima = date('Y-m-d', strtotime('+1 day'));
            ?>
            <input type="date" id="fecha" name="fecha" class="form-control" required min="<?php echo $fecha_minima; ?>">
          </div>
          <div class="text-center">
            <input type="submit" value="Realizar reserva" class="btn btn-light">
          </div>
          <input type="hidden" id="mensaje" name="mensaje" value="">
          <input type="hidden" id="tipoMensaje" name="tipoMensaje" value="">
        </form>
      </div>
    </div>
  </div>
</div>
  <?php
      if (!isset($_SESSION['user_id'])) {
          echo "<script>Swal.fire('Debes iniciar sesión para realizar una reserva.');</script>";
          exit;
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST["fecha"]) && !empty($_POST["fecha"])) {
              $servername = "localhost";
              $username = "root";
              $password = "contraseña";
              $dbname = "fiestavaquilla";

              mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

              $conn = new mysqli($servername, $username, $password, $dbname);

              $fecha_reserva = $_POST["fecha"];
              $usuario_id = $_SESSION['user_id'];

              $query = "SELECT * FROM reservas WHERE usuario_id = ? AND fecha_reserva = ?";
              $stmt = $conn->prepare($query);
              $stmt->bind_param("is", $usuario_id, $fecha_reserva);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                  $mensaje = "Ya tienes una reserva para este día.";
                  $tipoMensaje = "error";
              } else {
                  $stmt = $conn->prepare("INSERT INTO reservas (usuario_id, fecha_reserva) VALUES (?, ?)");
                  $stmt->bind_param("is", $usuario_id, $fecha_reserva);

                  if ($stmt->execute()) {
                      $mensaje = "¡Reserva realizada con éxito!";
                      $tipoMensaje = "success";
                  } else {
                      $mensaje = "Error al realizar la reserva: " . $stmt->error;
                      $tipoMensaje = "error";
                  }
              }

              $stmt->close();
              $conn->close();
          } else {
              $mensaje = "Por favor, seleccione una fecha para la reserva.";
              $tipoMensaje = "warning";
          }

          echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      text: '$mensaje',
                      icon: '$tipoMensaje'
                  });
              });
          </script>";
      }
  ?>
<?php include("footer.php"); ?>
</body>
</html>
