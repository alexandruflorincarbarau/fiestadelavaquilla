<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/fresnedillas.css">
    <style>
        .btn-light {
            box-shadow: 0 0 15px #ED642B !important;
        }

        .btn-light:hover {
            background-color: #ff8c00 !important;
            border-color: #ff8c00 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <?php include("header.php");?>
    <?php include("boton.php") ?>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7633.65106181048!2d-4.174135551783322!3d40.486439585713484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd41a6a299f1c777%3A0xf641d8a4a00c27d7!2s28214%20Fresnedillas%20de%20la%20Oliva%2C%20Madrid!5e1!3m2!1ses!2ses!4v1716401029765!5m2!1ses!2ses"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mapa">
    </iframe>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mt-4 titulo-estilizado ">Fresnedillas de la Oliva</h2>
            </div>
        </div>
    </div><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <img src="css/img/escudo-pueblo.png" class="escudo">
            </div>
        </div>
    </div><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center p">
                    Fresnedillas de la Oliva es una localidad y municipio de España, en la provincia y comunidad autónoma de Madrid.
                    Tiene una superficie de 28,2 km² con una población de 1392 habitantes y una densidad de 49,36 hab/km².
                    <br>
                    <a target="_blank" href="http://es.wikipedia.org/wiki/Fresnedillas_de_la_Oliva" class="a">Pulse aquí para más Info</a>
                </p>
            </div>
        </div>
    </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.querySelector(".titulo-estilizado").classList.add("visible");
            }, 300);
            });
        </script>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="formulario">
                    <h2 class="text-center p">Déjanos tu mensaje</h2>
                </div>
                <p class="text-center p">Para enviar un mensaje, debes iniciar sesión previamente.</p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("miFormulario").addEventListener("submit", function() {
            document.getElementById("nombre").value = ""; 
            document.getElementById("apellido").value = ""; 
            document.getElementById("mensaje").value = "";
        });
    </script>
    <?php include("footer.php")?>
</body>
</html>