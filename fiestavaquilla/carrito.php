<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G5MW3h/8/fFxgZMEf4w5BxIM+JQyPxh6UyJv" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="css/carrito.css">
    <style>
        body {
          background-image: url(css/img/historia-17.PNG);
          background-position: center;
          background-repeat: repeat-y;
          background-size: cover;
          background-color: #f8f8f8; 
        }
        .custom-table {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 8px;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-light {
            color: black;
            background-color: white;
            border-color: white;
        }
        .input-actualizado {
            color: black;
        }
        .margin-precio {
            margin-right: 10px;
        }
    </style>
    <?php
        include 'config.php'; 
    
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
        $total_items = array_sum($carrito);
    
        if (empty($carrito)) {
        }
    
        $productos_ids = array_keys($carrito);
    
        if (!empty($productos_ids)) {
            $ids = implode(",", array_map('intval', $productos_ids));
            $query = "SELECT * FROM productos WHERE id IN ($ids)";
            $result = mysqli_query($conn, $query);
            $productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $productos = [];
        }
    
        $total_general = 0;
    
        mysqli_close($conn);
    ?>
</head>
<body>
    <?php include("header_session.php");?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div id="error-message" class="alert alert-danger" style="display: none;">Error: No hay productos en el carrito para finalizar la compra.</div>
                <div class="table-responsive custom-table">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Unidad</th>
                                <th scope="col">Total</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <?php
                                $total_producto = $producto['precio'] * $carrito[$producto['id']];
                                $total_general += $total_producto;
                                ?>
                                <tr>
                                    <td class="text-light"><?= htmlspecialchars($producto['nombre']) ?></td>
                                    <td class="text-light"><?= $carrito[$producto['id']] ?></td>
                                    <td class="text-light"><?= $producto['precio'] ?>&euro;</td>
                                    <td class="text-light"><?= $total_producto ?>&euro;</td>
                                    <td class="text-light">
                                        <div class="d-flex align-items-center">
                                            <form method="post" action="eliminarcarrito.php" class="me-2">
                                                <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <form method="post" action="actualizarcarrito.php" class="d-flex align-items-center">
                                                <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                                                <input class="input-actualizado form-control form-control-sm me-2" type="number" name="cantidad" value="<?= $carrito[$producto['id']] ?>" min="1" style="width: 60px;">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-right mb-3 margin-precio">
                        <h4>Total: <?= $total_general ?> €</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="tienda_session.php" class="btn btn-light mx-2 mb-2">Seguir Comprando</a>
                    <a href="checkout.php" class="btn btn-light mx-2 mb-2" onclick="return finalizarCompra()">Finalizar Compra</a>
                </div>
            </div>
            <div class="mb-5"></div>
            <div class="mb-5"></div>
            <div class="mb-5"></div>
            <div class="mb-5"></div>
            <div class="mb-5"></div>
            <div class="mb-5"></div>
        </div>
    </div>
    <script>
        function finalizarCompra() {
            <?php if (empty($productos)): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No hay productos en el carrito para finalizar la compra.'
                });
                return false;
            <?php else: ?>
                window.location.href = 'checkout.php';
            <?php endif; ?>
        }
    </script>
    <?php include("footer.php")?>
</body>
</html>
