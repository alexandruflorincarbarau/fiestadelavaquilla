<?php
    $cookie_accepted = isset($_COOKIE['cookie_accepted']) && $_COOKIE['cookie_accepted'] == 'yes';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/index.css">
    <style>
        #cookie-banner {
            display: none;
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #000000;
            color: white;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.8);
            z-index: 1000px;
        }
        #cookie-banner.show {
            display: flex;
        }
        #cookie-banner button {
            background-color: #ffffff;
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
            flex: 1 1 45%;
            max-width: 150px;
            box-shadow: 0 0 11px #ffffff;
            border: none;
        }
        #cookie-banner button:hover {
            box-shadow: 0 0 15px greenyellow;
            background-color: green;
            color: white
        }
        #cookie-banner button.cancel {
            background-color: #ffffff;
        }
        #cookie-banner button.cancel:hover {
            box-shadow: 0 0 15px violet;
            background-color: red;
            color: white
        }
        .swal2-container {
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <?php include("header_session.php") ?>
    <?php include("boton.php") ?>
    <div id="cookie-banner" class="<?php echo $cookie_accepted ? '' : 'show'; ?>">
        <div>Esta página usa cookies para mejorar tu experiencia. ¿Aceptas el uso de cookies?</div>
        <div>
            <button id="cancel-cookies" class="cancel mt-2">Cancelar</button>
            <button id="accept-cookies">Aceptar</button>
        </div>
    </div>
    <script>
        document.getElementById('accept-cookies').addEventListener('click', function() {
            document.cookie = "cookie_accepted=yes; path=/; max-age=" + 60*60*24*30;
            document.getElementById('cookie-banner').style.display = 'none';
        });

        document.getElementById('cancel-cookies').addEventListener('click', function() {
            document.getElementById('cookie-banner').style.display = 'none';
        });
        window.onload = function() {
            if (document.cookie.indexOf('cookie_accepted=yes') === -1) {
                document.getElementById('cookie-banner').classList.add('show');
            }
        };
    </script>
    <?php
    if (!isset($_SESSION['messageShown'])) {
        $userName = $_SESSION['user_name']; 
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userName = <?php echo json_encode($userName); ?>;
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `¡Bienvenido, ${userName}!`,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                customClass: {
                    container: 'my-swal'
                },
                didOpen: () => {
                    const swalContainer = Swal.getPopup();
                    swalContainer.addEventListener('click', () => {
                        Swal.close();
                    });
                }
            });
        });
        <?php $_SESSION['messageShown'] = true; ?>
    </script>
    <?php
        }
    ?>
    <section class="hero-section" id="home">
        <div class="hero-section-slider">
            <h2 class="h2">Fiesta de la Vaquilla en honor a San Sebastián</h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mt-4 tittle" id="historia">HISTORIA</h2>
                <p>La Fiesta de «La Vaquilla» en honor a San Sebastián, de Fresnedillas de la Oliva (Madrid) es una celebración invernal que tiene lugar en este pueblo de la sierra madrileña.
                    Se considera que se trata de una manifestación importante de las fratrías y otros ritos de paso ancestrales de raíz celta, y forma parte del patrimonio inmaterial de la Comunidad de Madrid, 
                    por lo que el 19 de enero de 2013 se incoó el expediente para la declaración de bien de interés cultural, en la categoría de Hecho Cultural. La bibliografía científica especializada señala 
                    que Fresnedillas de la Oliva es uno de los núcleos rurales del centro y norte de la Península Ibérica que han albergado o albergan prácticas en las que los varones se agrupan anualmente con 
                    atuendo ex-profeso en torno a una celebración litúrgica o a una ceremonia propia de invierno. En este caso se trata de una fiesta de escarnio característica del período invernal, «mascarada» 
                    o «caretada», de origen pagano pero cristianizada por la Iglesia católica mediante la vinculación a un determinado santo, en este caso, San Sebastián. Se celebra en su honor el 20 de enero.
                    <br><br>
                    Su inicios y antecedentes son difíciles de determinar, dada la carencia de documentación histórica existente. Se menciona por tradición oral-no contrastado documentalmente-, ya convertida en leyenda popular, 
                    que Felipe II viajó desde El Escorial a Fresnedillas para presenciar la celebración de dicha fiesta. De carácter etnológico, se puede decir que esta fiesta es un «rito de paso«, donde los niños se convierten 
                    en mozos, pues a partir de los catorce años ya pueden participar en la fiesta. También es un «rito de iniciación«, una llamada a la fertilidad dado que con los cencerros se pretende despertar al sol y llamar 
                    la atención de los espectadores, principalmente de las mozas.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2 mt-3">
                    <h2 class="tittle-indice">ÍNDICE:</h2>
                    <ol>
                        <li><a href="https://es.wikipedia.org/wiki/Fiesta_de_La_Vaquilla_%28Fresnedillas_de_la_Oliva%29#Los_personajes" target="_blank" >Los personajes</a></li>
                        <li><a href="https://es.wikipedia.org/wiki/Fiesta_de_La_Vaquilla_%28Fresnedillas_de_la_Oliva%29#Desarrollo_del_ritual" target="_blank" >Desarrollo del ritual</a></li>
                        <li><a href="https://es.wikipedia.org/wiki/Fiesta_de_La_Vaquilla_%28Fresnedillas_de_la_Oliva%29#Desarrollo_.C3.ADntegro" target="_blank" >Desarrollo íntegro</a></li>
                        <li ><a href="https://es.wikipedia.org/wiki/Fiesta_de_La_Vaquilla_%28Fresnedillas_de_la_Oliva%29#Enlaces_externos" target="_blank" >Enlaces externos</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
     <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 mt-3">
        <h2 class="text-center tittle-personajes">Los personajes</h2>
        <p>
            La Vaquilla es el personaje principal y el que da nombre a la fiesta. La representa un joven que porta sobre los hombros a la Vaquilla, representación tosca y esquemática de una vaca realizada 
            a partir de un armazón de madera en forma de horquilla con cuernos y rabo bobino. Se adorna la estructura con una escarapela y cintas de raso multicolor.
            <br><br>
            El Alcalde y el Alguacil representan simbólicamente estos cargos y constituyen la autoridad. Visten traje y llevan unos característicos sombreros de gran vistosidad con cintas multicolores, 
            también en el bolsillo. El Alcalde portará un cetro de mando y el Alguacil una banda cruzada de derecha a izquierda. Conocidos también como “los de las cintas” o actualmente, como “los de los sombreros».
            <br><br>
            El Escribano y la Hilandera (o Guarrona popularmente conocida) son los personajes grotescos de la celebración. Forman matrimonio, aunque ambos son hombres, y sus atuendos son extravagantes y 
            destartalados, para dar un aire cómico. El escribano será el encargado de rendir cuentas y portará un gran lápiz.
            <br><br>
            Los Judíos o Motilones representan al pueblo. Son un grupo de jóvenes solteros cuyo número oscila cada año y se encargan de evitar que la vaca se escape. Su indumentaria da un gran colorido a la fiesta. 
            Visten monos floreados, llevan una honda, pañuelo al cuello, gorro militar y grandes cencerros a la espalda, llamados zumbas colocándose una almohadilla de protección envuelta en tela de costal 
            para amortiguar su peso.
            <img src="css/img/historia-1.PNG" class="d-block w-100 shadow-lg mt-5 img-style">
        </p>
        </p>
      </div>
      <div class="col-lg-6 mt-3">
        <h2 class="text-center tittle-personajes">Desarrollo del ritual</h2>
        <p>
            La fiesta se desarrolla durante varios días. Los prolegómenos comienzan el 7 de enero, cuando los niños menores de catorce años se disfrazan de los mismos personajes y salen todas las tardes tocando 
            los cencerros por las calles y cruces del pueblo pidiendo «la voluntad» a los forasteros y hacen pequeñas hogueras. Su día grande es el día 18 de enero tradicionalmente (hoy en día el último sábado antes del 
            20) cuando su vaquilla «muere».
            <br><br>
            La parte más relevante del rito corresponde a los mozos solteros, el día 20 en la medianoche con la preparación de la fiesta y por la mañana con la celebración propiamente dicha, coincidiendo con la 
            festividad de San Sebastián.
            <br><br>
            A medianoche se reúnen los Judíos en la plaza con sus zumbas y comienzan a dar vueltas alrededor de la misma con el atronador sonido de sus instrumentos. Sobre la una de la madrugada traen el carro y lo 
            instalan en la plaza del pueblo, lugar donde se celebrará la fiesta, acompañados por la gente del pueblo. Al amanecer salen a correr el aguardiente, y asaltan a los vecinos para que les paguen este licor. 
            A las nueve de la mañana se tocan las Ave Marías, señal que indica que todos los vecinos pueden andar libremente por las calles. Se suelta la Vaquilla por primera vez, y acompañada por los Judíos, emprende 
            las carreras.
            <br><br>
            Después de desayunar, la vaca y los Judíos van a buscar al Alcalde y al Alguacil y al propio Alcalde del municipio, dirigiéndose en comitiva a la iglesia. Tras una carrera de la vaca y los Judíos alrededor
            de la iglesia entran en la misma desprovistos del armazón y de los cencerros en señal de respeto. A las doce de mediodía se celebra la misa. Acabada la misa, los Judíos se colocan nuevamente las zumbas. 
            Mientras tanto, se pone en marcha la procesión. El Alcalde y el Alguacil acompañan a la imagen de San Sebastián llevada por los anderos. La procesión transcurre por las calles del pueblo, mientras la vaca 
            dirige y marca el paso de los Judíos, que salen y entran de la procesión corriendo rápidamente hacia la imagen y lanzando «vivas» al santo. La procesión continúa hasta la iglesia donde concluye la 
            celebración religiosa.
            <br><br>
            A continuación, todos los participantes van a la plaza, sucediéndose las carreras y las persecuciones vertiginosas. Cada cornada es festejada por los Judíos. A las catorce horas guardan las zumbas y el 
            armazón de la Vaquilla y marchan emparejados a comer. A las dieciséis horas se colocan nuevamente las zumbas y el armazón, continuando las acometidas de la Vaquilla. Mientras tanto el Escribano y 
            la Hilandera piden cuentas a los forasteros asistentes por los daños que ha causado la Vaquilla.
            <br><br>
            Por la tarde, los Judíos dan vueltas en círculo haciendo sonar sus cencerros y se sucederán las acometidas de la Vaquilla. Tras diferentes idas y venidas, el Alguacil ata con una larga cuerda a la 
            Vaquilla, y con un disparo de escopeta al aire se la espanta, la Vaquilla se deshace de la cuerda y cruza toda la plaza con los Judíos detrás. En este momento, desde el carro, una persona del pueblo recita 
            poesías y anécdotas en tono jocoso y divertido alusivo a los habitantes del lugar. Al terminar, el Alguacil vuelve a atar a la Vaquilla y continúan las persecuciones. Al caer la tarde, con un nuevo tiro de
            escopeta al aire se mata a la Vaquilla, que cae al suelo. Una vez despojada de su armazón, el mozo que lo portaba junto con los Judíos, van a la carrera a beber la sangre de la Vaquilla (vino tinto) que
            han colocado el Escribano y la Hilandera en un barreño bajo el carro.
            <br><br>
            Así se da fin a la jornada principal de la fiesta. El ritual se repite el día siguiente, protagonizado por los hombres casados, en un tono más informal y humorístico. Concluye con una cena realizada por 
            este colectivo. El sábado siguiente (antiguamente el 22 de Enero) se celebra otra cena para los solteros o Judíos. Los participantes, acompañados por una rondalla, recorren casa por casa, ofreciendo sangre 
            de la Vaquilla (un vaso de vino) a cambio de la voluntad (ahora dinero, antes víveres). La cena es parte del ritual, y a ella asisten las autoridades del municipio. Con esta cena finaliza la fiesta hasta el 
            año siguiente.
            <br><br>
            Aunque se conservan restos de fiestas de origen similar en otras localidades de la sierra madrileña, ninguna ha llegado hasta nuestros días completa y sin adulteraciones como la de Fresnedillas de la Oliva.
        </p>
        <div class="text-center">
            <img src="css/img/historia-5.PNG" style="border: 1px solid black; width: 30%;" onclick="agrandarImagen(this)"/>
            <img src="css/img/historia-6.PNG" style="border: 1px solid black; width: 30%;" onclick="agrandarImagen(this)"/>
            <img src="css/img/historia-7.PNG" style="border: 1px solid black; width: 30%;" onclick="agrandarImagen(this)"/>
        </div>
        <script>
            function agrandarImagen(imagen) {
                if (imagen.classList.contains('agrandada')) {
                        imagen.classList.remove('agrandada');
                        imagen.onclick = function() {
                            agrandarImagen(imagen);
                        }
                } else {
                    imagen.classList.add('agrandada');
                    imagen.onclick = function() {
                    imagen.classList.remove('agrandada');
                    imagen.onclick = function() {
                        agrandarImagen(imagen);
                        }
                    }
                }
            }
        </script>
      </div>
    </div>
  </div>
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mt-4 tittle-personajes">Desarrollo íntegro</h2>
                <p>
                    El Alguacil y su familia son los que preparan a San Sebastián, le ponen en andas y con el ramo de olivo adornado, además de limpiar y decorar con centros de flores la iglesia.
                    <br><br>
                    El día 20 a las 00:00 h se empieza a tocar y salen los judíos junto con los cinco de la fiesta (con pañuelos cruzados pero sin vestir). Se va tocando por todo el pueblo y parando en los 
                    bares donde se pagan las costumbres, que son: la botella de coñac, la botella de anís y una caja de bollos. Los encargados de pagar dichas costumbres serán los judíos que entren nuevos. 
                    A continuación se va por el carro para llevarle a la plaza a la carrera y seguir tocando.
                    <br><br>
                    Por la mañana a primera hora (7:00h) se corre el aguardiente; que consiste en ponerse un cinto con cascabeles o cencerros pequeños y correr a por la gente (vaqueros) para que paguen el 
                    aguardiente hasta las 9:00 aproximadamente. Se tocan las Aves Marías (las campanas), los judíos se ponen los cencerros y se suelta a la Vaca hacia las 9:30- 10:00. Se dan tres vueltas a 
                    la farola y se va a la carrera hacia las “Praderas Matías”. Se arranca de nuevo y se pasa por la plaza a la carrera, subiendo por la Placetuela y por la calle de la Amargura hasta las Escuelas 
                    viejas, donde se para a fumar un cigarro. Seguidamente se baja andando por la Placetuela y desde allí se lanza otra carrera para cruzar la plaza hacia las Praderas Matías. De aquí se va a la 
                    plaza y se dan las tres , para cerrar a la Vaca, estando el Alcalde, el Alguacil, la Hilandera y el Escribano todavía sin vestir, y se va a desayunar.
                    <br><br>
                    Ya vestidos, la Hilandera y el Escribano, se saca de nuevo a la Vaca sobre las 11:00h dando de nuevo tres vueltas a la farola y yendo a las Praderas Matías a la carrera. Se vuelve para buscar 
                    al Alguacil y al Alcalde, por este orden a sus casas y posteriormente al alcalde del pueblo.
                    <br><br>
                    Se sube por la carretera hasta la puerta de la iglesia, donde el Alcalde y el Alguacil entran por delante junto con el alcalde municipal mientras que la Vaca, la Hilandera, el Escribano y los 
                    judíos entran a la carrera por detrás del templo y se quitan los cencerros.
                    <br><br>
                    Para repartir las moneda hay que pedir permiso al Alcalde diciendo: “¿Da usted su permiso?” contestando el Alcalde: “Usted lo tiene”. El primero que coge la moneda es el Alguacil seguido de los 
                    judíos más novatos. El gorro del Escribano será de color negro y la Hilandera no podrá ir pintada a la misa.
                    <br><br>
                    En la iglesia, el Alcalde se situará a la derecha y el Alguacil a la izquierda de la doble fila formada por los judíos. En la misma fila que el Alcalde y en penúltima posición se colocará el 
                    Escribano y en la del Alguacil la Hilandera dejando el último lugar a la Vaca. Mientras tanto, los judíos deberán ir tapados con mantas como símbolo de respeto. Durante la misa, ninguno hablará 
                    y se permanecerá de pie. En la ofrenda el primero será el Alcalde, seguido del Alguacil y judíos. Esta ofrenda se realiza echando la moneda con la boca en el cesto, besando la estola del cura y 
                    volviendo de espaldas a la fila sin dejar de encarar al Santo. Cuando se acaba la misa, los judíos se cuelgan los cencerros y salen por detrás de la iglesia. Se saca al Santo y el Alcalde y el 
                    Alguacil se sitúan a la derecha y a la izquierda respectivamente, mientras que en el centro se situará el sacerdote.
                    <br><br>
                    Empieza la procesión, y se baja corriendo, desde el cruce de Robledo hasta el Ayuntamiento viejo (Hogar del jubilado) y se sube a la iglesia y una vez llegado al Santo, rodilla en tierra, grita 
                    la Vaca: “¡¡Viva san Sebastián!!” contestando el resto “¡¡Viva!!”. Se sigue la procesión mientras la Vaca va y viene al Santo entre los judíos y una vez llegado San Sebastián a la Clínica, se 
                    sale a la carrera alrededor de las escuelas. Entrando por la derecha y saliendo por la izquierda.
                    Continúa la procesión hasta la placetuela y cuando el Santo va a entrar a ella, se baja corriendo a la plaza, dando la vuelta a la farola y subiendo de nuevo hasta el Santo. Se llega a la plaza 
                    y cuando el Santo se baja de los hombros, se irá andando hacia la carretera y se sube corriendo hacia el Santo para que la Vaca arrodillada, junto a los judíos, diga de nuevo: 
                    “¡¡Viva San Sebastián!!”
                    <br><br>
                    Continúa la procesión por la carretera hasta la puerta del patio de la iglesia, donde se emprende una nueva carrera por detrás de la misma llegando de nuevo al Santo donde se gritará otra vez
                    “Viva San Sebastián” (de nuevo en rodillas). Se levantan y saldrán por detrás de la iglesia dándose por concluida la procesión. (Durante todo este tiempo, la Hilandera y el Escribano, harán las
                     mismas carreras y mismo recorrido que la Vaca y los judíos). Mientras que todos estos descansan refrescándose en el exterior de la iglesia, el Alcalde y el Alguacil acompañarán 
                     (en este momento éstos adelantarán la imagen conservando las posiciones, derecha e izquierda respectivamente) al Santo al interior de la misma para despedir a San Sebastián con los 
                     cánticos de las mujeres:
                    <br><br>
                    ….San Sebastián con gran fervor Muéstranos el fiel consuelo…
                    <br><br>
                    Una vez todos los personajes principales de la fiesta, sacerdote y alcalde municipal estén listos se baja a la plaza. Cuando se entra en ella, se dan las tres en la parte de arriba 
                    (antigua casa del cura o ahora discoteca), colocándose Alcalde a la derecha y Alguacil a la izquierda del sentido de la carrera hacia las Praderas Matías. En este punto el Alguacil da el pito 
                    (cigarro) a la Vaca, picándola y yendo hacia la carrera a la parte baja de la plaza (donde estará situado el carro) para dar de nuevo las tres. A partir de este momento de abrirá la 
                    veda para que la Vaca inicie las persecuciones tras las autoridades de la fiesta.
                    <br><br>
                    Alrededor de la 14:00h se procede al cierre de la Vaca, dirigiéndose hacia el final de la parte baja de la plaza (Ayuntamiento) donde se darán de nuevo las tres y se entrará en el corral. 
                    En éste se dejarán los cencerros de los judíos y el armazón de la Vaca para irse a comer (se irá a almorzar por parejas; Alcalde y Alguacil, Escribano e Hilandera, los judíos dos a dos y 
                    la Vaca sola, salvo que un judío hubiese quedado impar).
                    <br><br>
                    A las 16:00h se reanuda sacando a la Vaca del corral con el proceder habitual: tres vueltas a la farola y la carrera a las Praderas Matías. Desde aquí se inicia una nueva carrera hasta la 
                    puerta de las Escuelas cruzando la plaza. En este punto es el momento del pito del Alcalde a la Vaca, se baja corriendo a la plaza, se dan las tres en su parte alta, para volver corriendo 
                    a las Praderas Matías. Se vuelve a la plaza, se dan las tres y s inician las carreras tras el Alcalde y el Alguacil.
                    <br><br>
                    Se hace el primer descanso yendo a la carretera. Después de ése la Vaca se escapa del grupo y sorprende por el callejón de espaldas al Alcalde y Alguacil. Más tarde se va a la Praderas 
                    Matías a atar a la Vaca por parte del Alguacil. Se entra a la plaza con la Vaca atada, se dan las tres y se amarra a la Vaca preferiblemente al carro.
                    <br><br>
                    Cuando la Vaca está atada, el Alcalde y Alguacil ya no tendrán barreras (protección de ser multados refugiándose en la antigua casa del cura/discoteca o en el corral/Ayuntamiento). 
                    Ni el Alcalde ni el Alguacil podrán subir al carro mientras que el acceso a la barbacana quedará prohibido para los principales personajes de la fiesta.
                    <br><br>
                    A continuación se sube a La Placetuela para espantarla, con el primer tiro, la Vaca tira la cuerda y sale corriendo hacia las Praderas Matías. Se va al carro a recitar las anécdotas 
                    de los jarandos y jarandas en verso sobre las 17:30h.
                    <br><br>
                    Se vuelve a ir a las Praderas Matías donde se atará a la Vaca por segunda vez, posteriormente se entra a la plaza esta vez sin dar las tres y amarrándola de nuevo a la farola, 
                    carro o cualquier palo disponible. Se sube de nuevo a La Placetuela con la Vaca asida andando. Por último mientras se baja corriendo a la plaza se escuchará un segundo tiro que 
                    matará esta vez a la Vaca (tirándose el cordel y armazón) tras lo que todos se meterán bajo el carro para beber la sangre de la Vaca (vino que habrá sido preparado previamente por 
                    el Escribano y Guarrona).
                    <br><br>
                    Desde este momento y hasta el día de pedir, sábado posterior a la fiesta de los casados, se habrá de llevar pañuelo al cuello y honda atravesada de derecha a izquierda. Vaca, 
                    Hilandera y Escribano deberán llevar el pañuelo atravesado al cuerpo del mismo modo que la honda judía.
                    <br><br>
                    Durante el día de pedir el acceso a las viviendas vendrá dado por el siguiente orden: Alcalde, Alguacil, judíos y La Vaca como último en entrar. El Alcalde acarreará con “la talega” 
                    para las donaciones de los vecinos. Además los judíos novatos se encargarán de transportar el vino y suministrar en todo momento los cigarros a la Vaca.
                    <br><br>
                    La cena será presidida por el Alcalde y el Alguacil poniendo cotos (mendrugos de pan) que prohibirán el comer y/o el beber para la buena organización del convite, el Alguacil sólo lo 
                    hará bajo permiso del Alcalde. La Vaca no podrá sentarse ni tendrá derecho a plato ni comida salvo solidaridad de los judíos. Su cometido será servir el vino al resto de participantes 
                    de la fiesta.
                    <br><br>
                    Todo aquel incumplimiento, tanto en horario, como en modo y/o forma, de lo anterior será considerado multa.
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-3">
                <h2 class="tittle-indice">Enlaces externos</h2>
                <p>
                    - Este artículo es una obra derivada de la disposición relativa al proceso de declaración o incoación de un Bien de Interés Cultural publicada en el BOCM N.º 166 el 15 de julio de 2013 (texto),
                    que está libre de restricciones conocidas en virtud del derecho de autor de conformidad con lo dispuesto en el<br>
                    <a href="https://es.wikipedia.org/wiki/Wikipedia:Recursos_libres/Art%C3%ADculo_13_de_la_Ley_de_Propiedad_Intelectual_espa%C3%B1ola" target="_blank" class="a">artículo 13 de la Ley de Propiedad Intelectual española.</a>
                    <br>
                    - Actualización del proceso de declaración o incoación del Bien de Interés Cultural publicado en el BOCM N.º 273 el 17 de noviembre de 2015 <a target="_blank" href="https://www.bocm.es/boletin/CM_Orden_BOCM/2015/11/17/BOCM-20151117-24.PDF" class="a"> (texto)</a>
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12 mt-3">
            <h1 class="titulo-llamativo text-center tittle" id="personajes">PERSONAJES</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mt-2 mb-5">
            <div class="card card-personajes">
                <h2 class="card-title text-center mt-3 tittle-personajes">La Vaquilla</h2>
                <img src="css/img/vaquilla.JPG" class="mt-3 img-fluid rounded mx-auto d-block card-img" alt="La Vaquilla" style="max-width: 80%; margin: 0 auto;">
                <div class="card-body">
                    <p class="card-text text-center">
                        La Vaca o la Vaquilla es el personaje principal y el que da nombre a la fiesta. La representa un joven que porta sobre los hombros a la Vaquilla, 
                        representación tosca y esquemática de una vaca realizada a partir de un armazón de madera en forma de horquilla con cuernos y rabo bobino. 
                        Se adorna la estructura con una escarapela y cintas de raso multicolor.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mt-5 mb-5">
            <div class="card card-personajes">
                <h2 class="card-title text-center mt-3 tittle-personajes">Alcalde y Alguacil</h2>
                <img src="css/img/alcalde-alguacil.JPG" class="mt-3 img-fluid rounded mx-auto d-block card-img" alt="Alcalde y Alguacil" style="max-width: 80%; margin: 0 auto;">
                <div class="card-body">
                    <p class="card-text mb-2 text-center">
                        El Alcalde y el Alguacil representan simbólicamente estos cargos y constituyen la autoridad. Visten traje y llevan unos característicos sombreros de gran vistosidad con cintas multicolores, 
                        también en el bolsillo. El Alcalde portará un cetro de mando y el Alguacil una banda cruzada de derecha a izquierda. Conocidos también como “los de las cintas” o “los de los sombreros".
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mt-5 mb-5">
            <div class="card card-personajes--2">
                <h2 class="card-title text-center mt-3 tittle-personajes">Escribano e Hilandera</h2>
                <img src="css/img/guarrona-escribano.JPG" class="mt-3 img-fluid rounded mx-auto d-block card-img--2" alt="Escribano e Hilandera" style="max-width: 80%; margin: 0 auto;">
                <div class="card-body">
                    <p class="card-text mb-2 text-center">
                        El Escribano y la Hilandera (o Guarrona popularmente conocida) son los personajes grotescos de la celebración. Forman matrimonio, aunque ambos son hombres, y sus atuendos 
                        son extravagantes y destartalados, para dar un aire cómico. El escribano será el encargado de rendir cuentas, apuntar "las multas" y portará un gran lápiz.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mt-2 mb-5">
            <div class="card card-personajes--2">
                <h2 class="card-title text-center mt-3 tittle-personajes">Judíos o Motilones</h2>
                <img src="css/img/judios.jpg" class="mt-3 img-fluid rounded mx-auto d-block card-img--2" alt="Judíos o Motilones" style="max-width: 80%; margin: 0 auto;">
                <div class="card-body">
                    <p class="card-text text-center">
                        Los Judíos o Motilones representan a la plebe. Son un grupo de jóvenes solteros que se encargan de acompañar a La Vaca. 
                        Su indumentaria da un gran colorido a la fiesta al vestir monos y pañuelos floreados; también llevan una honda, un gorro militar y grandes cencerros a la espalda, 
                        colocándose un "costal" de protección para amortiguar su peso.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>