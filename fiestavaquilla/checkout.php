<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AbxlCyKkthvLSNTahiNEtiTSHxsMlm8e2EIt91MsBLdwhS9kgPDLJw4wSYfRwsnTXJ0-rUQvSVWsx7_Q&currency=EUR"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        $servername = "localhost"; 
        $username = "root"; 
        $password = "contraseña"; 
        $dbname = "fiestavaquilla"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : [];
        $total_items = array_sum($carrito);

        if (empty($carrito)) {
            echo "El carrito está vacío.";
            $productos = [];
        } else {
            $productos_ids = array_keys($carrito);
            if (!empty($productos_ids)) {
                $ids = implode(",", array_map('intval', $productos_ids));
                $query = "SELECT * FROM productos WHERE id IN ($ids)";
                $result = mysqli_query($conn, $query);
                $productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                $productos = [];
            }
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
                <div class="table-responsive custom-table">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre Producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Unidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($productos)) { ?>
                                <tr>
                                    <td colspan="4" class="text-center text-light h5">El carrito está vacío.</td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($productos as $producto): ?>
                                    <?php
                                    $total_producto = $producto['precio'] * $carrito[$producto['id']];
                                    $total_general += $total_producto;
                                    ?>
                                    <tr>
                                        <td class="text-light h5"><?= htmlspecialchars($producto['nombre']) ?></td>
                                        <td class="text-light h5"><?= $carrito[$producto['id']] ?></td>
                                        <td class="text-light h5"><?= htmlspecialchars($producto['precio']) ?>&euro;</td>
                                        <td class="text-light h5"><?= number_format($total_producto, 2) ?>&euro;</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-right mb-3 margin-precio text-light">
                        <h4>Total: <?= number_format($total_general, 2) ?> €</h4>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-5 mb-5">
                        <div class="col-lg-6 mt-3"></div>
                        <div class="col-lg-6 ">
                            <div id="paypal-button-container"></div>
                            <script>
                                paypal.Buttons({
                                    style: {
                                        color: 'gold',
                                        shape: 'pill',
                                        label: 'pay'
                                    },
                                    createOrder: function(data, actions) {
                                        return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                    value: '<?= number_format($total_general, 2, '.', '') ?>'
                                                }
                                            }]
                                        });
                                    },
                                    onApprove: function(data, actions) {
                                        return actions.order.capture().then(function(details) {
                                            fetch('complete_purchase.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify({ orderID: data.orderID })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '¡Compra completada!',
                                                        text: 'Compra completada con éxito'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            window.location.href = 'tienda_session.php';
                                                        }
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: '¡Error!',
                                                        text: 'Error al completar la compra: ' + data.message
                                                    });
                                                }
                                            });
                                        });
                                    },
                                    onCancel: function(data) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: '¡Pago cancelado!',
                                            text: 'Pago cancelado'
                                        });
                                    }
                                }).render('#paypal-button-container');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="mb-5"></div>
            <div class="mb-5"></div> 
        </div>
    </div>
    <?php include("footer.php")?>
</body>
</html>
