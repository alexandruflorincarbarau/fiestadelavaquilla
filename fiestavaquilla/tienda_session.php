<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/tienda_session.css">
    <style>
        body {
            background-image: url(css/img/historia-16.PNG);
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
            background-color: #f8f8f8; 
        }
        
    </style>
    <?php
        include 'config.php';
        $query = "SELECT * FROM productos";
        $result = mysqli_query($conn, $query);
        $productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        $contador = 0;
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
        $total_items = array_sum($carrito);
    ?>
</head>
<body>
<?php include("header_session.php");?>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($productos as $producto): ?>
                <?php 
                    $contador++;
                ?>
        <?php if ($contador == 1): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="css/img/tienda-1.PNG">
                <div class="card-title">
                    <h5 class="text-center"><?= htmlspecialchars($producto['nombre']) ?></h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
                <h5 class="text-right">
                    <span class="text-danger"><del>14.99&euro;</del></span>
                    <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($contador == 2): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
            <img src="css/img/tienda-2.PNG" >
                <div class="card-title">
                    <h5 class="text-center"><?= htmlspecialchars($producto['nombre']) ?></h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                    <?= htmlspecialchars($producto['descripcion']) ?>
                    <br>
                    ㅤ
                    <br>
                    ㅤ
                    <br>
                </p>
                <h5 class="text-right">
                    <span class="text-danger"><del>24.99&euro;</del></span>
                    <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($contador == 3): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="mt-5"></div>
                <div class="mt-1"></div>
                <img src="css/img/tienda-3.PNG">
                <div class="card-title mt-3">
                    <div class="mt-5"></div>
                    <h5 class="text-center"><?= htmlspecialchars($producto['nombre']) ?></h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                <br>
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
                <h5 class="text-right">
                    <span class="text-danger"><del>12.99&euro;</del></span>
                    <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <div class="row mt-5">
        <?php 
            $contador = 0;
            foreach ($productos as $producto):
                $contador++;
                if ($contador == 4):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="mt-3"></div>
                <img src="css/img/tienda-4.PNG">
                <div class="card-title">
                    <h5 class="text-center mt-5"><?= htmlspecialchars($producto['nombre']) ?></h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
                <h5 class="text-right">
                    <span class="text-danger"><del>9.99&euro;</del></span>
                    <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php 
            $contador = 0;
            foreach ($productos as $producto):
                $contador++;
                if ($contador == 5):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
            <div class="mt-5"></div>
            <div class="mt-5"></div>
            <div class="mt-5"></div>
            <img src="css/img/tienda-5.PNG" >
                <div class="card-title">
                    <div class="mt-5"></div>
                    <h5 class="text-center"><?= htmlspecialchars($producto['nombre']) ?></h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
                <h5 class="text-right">
                <span class="text-danger"><del>9.99&euro;</del></span>
                <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <div class="mt-4"></div>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php 
            $contador = 0;
            foreach ($productos as $producto):
                $contador++;
                if ($contador == 6):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="mt-5"></div>
                <div class="mt-5"></div>
                <div class="mt-5"></div>
                <div class="mt-1"></div>
                <img src="css/img/tienda-6.PNG" class="mt-5">
                <div class="mt-5"></div>
                <div class="mt-4"></div>
                <div class="card-title mt-5">
                    <h5 class="text-center">
                    <?= htmlspecialchars($producto['nombre']) ?>
                </h5>
                </div>
                <div class="card-body">
                <p class="card-text">
                <br>
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
                <h5 class="text-right">
                    <span class="text-danger"><del>49.99&euro;</del></span>
                    <span class="text-dark ml-2"><?= $producto['precio'] ?>&euro;</span>
                </h5><br>
                <form method="post" action="anadircarrito.php">
                    <div class="input-container">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1">
                        <button type="submit" class="btn-light btn btn-lg btn-block">Añadir al Carrito</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php include("footer.php");?>
</body>
</html>