<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Flotante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        #btnFlotante {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 50px;
            height: 50px;
            background-color: rgba(237, 100, 43, 0.85);
            padding-bottom: 2vh;
            color: white;
            font-size: 24px;
            border: none;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s, transform 0.3s;
            z-index: 1000;
            box-shadow: 0 0 11px rgba(0, 0, 0, 0.8) !important;
        }
        #btnFlotante:hover {
            background-color: rgba(237, 100, 43);
        }
    </style>
</head>
<body>
    <button id="btnFlotante">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chevron-double-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z"/>
            <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
        </svg>
    </button>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btnFlotante = document.getElementById("btnFlotante");

            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            btnFlotante.addEventListener("click", function(event) {
                event.stopPropagation();
                scrollToTop();
            });
        });
    </script>
</body>
</html>
