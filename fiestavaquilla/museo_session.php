<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/museo.css">
    <style>
        .carousel-item {
            padding: 40px;
            background-color: #000000; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
      
        }

        .carousel-caption {
            color: #fff; 
            text-align: center;
            max-width: 80%; 
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #fff; 
        }

        .carousel-control-prev,
        .carousel-control-next {
            color: #fff; 
        }
    </style>
</head>
<body>
    <?php include("header_session.php");?>
    <?php include("boton.php") ?>
    <div class="wrapper">
        <div class="news-item hero-item">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mt-4 tittle">Museo de la Vaquilla de Fresnedillas de la Oliva</h2>
            </div>
        </div>
    </div>
    <div class="container-centrado mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!4v1716400912027!6m8!1m7!1sZpRsH-g5pe5Ft_p_HqQebw!2m2!1d40.48274861850573!2d-4.173760862223843!3f58.065751581632824!4f-18.49058575443948!5f0.7820865974627469" 
            width="900" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                    <div id="infoCarousel" class="carousel slide" data-ride="carousel">
                    <div id="infoCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="carousel-caption">
                                <h5>Historia de la Fiesta de la Vaquilla</h5>
                                <p>Presentar la historia, tradición y elementos característicos de la Fiesta de la Vaquilla.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Orígenes de la Fiesta</h5>
                                <p>Explicación de los orígenes de la fiesta, su evolución y su importancia en la comunidad.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Evolución de la Celebración</h5>
                                <p>Cómo ha cambiado la celebración desde sus inicios hasta la actualidad.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Figura Central de la Fiesta</h5>
                                <p>Descripción de la figura central de la fiesta, su simbolismo y significado.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Trajes Tradicionales</h5>
                                <p>Detalle de los trajes tradicionales usados durante la fiesta, incluyendo los materiales y colores típicos.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Músicas y Danzas</h5>
                                <p>Explicación de las músicas y danzas tradicionales asociadas con la celebración.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Recorrido del Desfile</h5>
                                <p>Descripción del recorrido del desfile, su estructura y participantes.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Actividades para Familias</h5>
                                <p>Actividades específicas dirigidas a los más pequeños y a las familias.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Bebidas Tradicionales</h5>
                                <p>Mención de las bebidas que se sirven y su importancia cultural.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Participación de la Comunidad</h5>
                                <p>Cómo participa la comunidad local en la organización y celebración de la fiesta.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Talleres y Actividades Educativas</h5>
                                <p>Talleres, charlas y actividades educativas ofrecidas por el museo.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h5>Sesión de Preguntas y Respuestas</h5>
                                <p>Abrir el micrófono a preguntas del público y responder a sus inquietudes.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#infoCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#infoCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center h3">
                Este museo de la Fiesta de la Vaquilla de Fresnedillas de la Oliva está abierto al público todos los días en horario de <b class="horario">12:00-14:00.</b> 
                </h3>
            </div>
        </div>
    </div>
    <div class="wrapper-2">
        <div class="news-item standard-item">
        </div>
        <div class="news-item standard-item">
        </div>
        <div class="news-item standard-item">
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>