<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
        .color-productos {
            color: #ff933a;
        }
        .color-icon--carrito{
            color: #ff933a;
        }
        .color-icon--carrito:hover{
            color: #000000;
        }
        .tittle-header{
            font-family: Arial, sans-serif;
            text-shadow: 2px 2px 10px #000000;
            -webkit-text-stroke: 1px #ff933a; 
            color: transparent; 
        }
  </style>
</head>
<body>
    <?php
        session_start();
        include 'config.php';
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
        $total_items = array_sum($carrito);
        $show_alert = false;
        if (isset($_COOKIE['session_started']) && $_COOKIE['session_started'] == '1') {
        $show_alert = true;
        setcookie('session_started', '0', time() + (86400 * 30), "/");
        }
    ?>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand tittle-header" href="index_session.php#home">Fiesta de la Vaquilla</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index_session.php#historia">Historia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index_session.php#personajes">Personajes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cronograma_session.php">Cronograma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="canciones_session.php">Canciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fresnedillas_session.php">Fresnedillas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="museo_session.php">Museo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tienda_session.php">Tienda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reserva.php">Reserva Museo</a>
            </li>
            <li class="nav-item"><a href="carrito.php" class="nav-link a">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart4 color-icon--carrito" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
                <span id="cart-count" class="color-productos"><?= $total_items ?></span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle color-icon  d-sm-block me-1" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    <span><?php echo $_SESSION['user_name']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="miscompras.php">Mis compras</a>
                    <a class="dropdown-item" href="misreservas.php">Mis reservas</a>
                    <a class="dropdown-item" href="mismensajes.php">Mis mensajes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                    <a class="dropdown-item" href="delete_acount.php">Eliminar cuenta</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>
