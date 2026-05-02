<?php

session_start();

if (!isset($_SESSION["cuenta"])) {
    $_SESSION["cuenta"] = "";
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Mi Bar</title>

        <link rel="stylesheet" href="./PagPrincipal/CSS/1-all-css.css">
        <link rel="stylesheet" href="./PagPrincipal/CSS/2-horario-css.css">
        <link rel="stylesheet" href="./PagPrincipal/CSS/3-ubicacion-css.css">
        <link rel="stylesheet" href="./PagPrincipal/CSS/4-menu-css.css">
        <link rel="stylesheet" href="./PagPrincipal/CSS/6-footer-css.css">
        <link rel="stylesheet" href="./PagPrincipal/CSS/7-bootstrap.min.css">

    </head>

    <body>

        <header>
            <div class="contenedor">
                <p class="logo"><a href="#hero"><b>Mi Bar</b></a></p>
                <span class="ver-menu">Ver Menu</span>
                <nav class="nav">
                    <ul>
                        <li><a href="#horarios-local">              <b>Horarios </b></a></li>  
                        <li><a href="#ubicacion-local">             <b>Ubicacion</b></a></li>  
                        <li><a href="#menu-local">                  <b>Carta    </b></a></li>  
                        <li><a href="#footer">                      <b>+ Info   </b></a></li>
                        <li><a href="./Login/registrarvista.php">   <b>Login</b></a></li>  
                    </ul>
                </nav>
            </div>
        </header>   

        <section id="hero">
            <h1><b>Mi Bar <br> Tu Bar <br> Nuestro Bar!</b></h1>
        </section>

        <section id="horarios-local"> 
            <h1>Nuestros Horarios!</h1>
            <img src="./Imagenes/horarios.jpg" id="horario">
        </section>

        <section id="ubicacion-local">
            <h1>Donde nos podes Encontrar?</h1>
                <div class="locales row justify-content-around">

                    <div class="col-lg-3">
                        <div class="picture1"></div>
                        <h3>MiBar Aristides</h3>
                        <p>
                            Ubicado en Calle Aristides, <br>
                            una de las mas conocidasde la zona.
                        </p>
                        <button class="boton-mapa">
                            <a href="https://www.google.com/maps/place/Zitto/@-32.8924424,-68.853413,18z/data=!4m5!3m4!1s0x967e0906671ed731:0xf50153b8c289742f!8m2!3d-32.8922585!4d-68.8540801">Ver Mapa</a>  
                        </button>
                    </div>

                    <div class="col-lg-3">
                        <div class="picture2"></div>
                        <h3>Entre que calles?</h3>
                        <p>
                            Se encuentra entre calle Olascoaga(hacia el Norte) <br>
                            y calle Cnel Rodriguez(hacia el Norte) 
                        </p>
                    </div>

                    <div class="col-lg-3">
                        <div class="picture3"></div>
                        <h3>Frente del Local</h3>
                        <p>
                            El local cuenta con espacios tanto adentro como afuera, <br>
                            donde predominan sus colores llamativos. <br>
                            Muy buen ambiente para cualquier edad, con amigos o familia.
                        </p>
                    </div>

                </div>
        </section>

        <section id="menu-local">
            <h1>Nuestro Menu</h1>
            <div class="menu row justify-content-around">

                <div class="col-lg-3">
                    <div class="img-mañana"></div>
                    <h3>Menu Mañana</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Rerum nobis quia, architecto illum perspiciatis saepe aliquid 
                        omnis repellendus tempore doloribus soluta fuga doloremque 
                        recusandae dicta placeat asperiores nesciunt veritatis eligendi?
                    </p>
                    <button class="menu-mañana">
                        <a href="./Menu-Mañana/Menu Mañana.php">Ver Menu</a>
                    </button>
                </div>

                <div class="col-lg-3">
                    <div class="img-tarde"></div>
                    <h3>Menu Tarde</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Rerum nobis quia, architecto illum perspiciatis saepe aliquid 
                        omnis repellendus tempore doloribus soluta fuga doloremque 
                        recusandae dicta placeat asperiores nesciunt veritatis eligendi?
                    </p>
                    <button class="menu-tarde">
                        <a href="./Menu-Tarde/MenuTarde.php">Ver Menu</a>
                    </button>
                </div>

            </div>
        </section>
        
        <footer id="footer">
            <div class="locales row justify-content-around">

                <div class="col-lg-3">
                    <br>
                    <h4>CONTACTO</h4> 
                    <p>25 de Mayo, Mendoza, Argentina <br> +54 261 632 5700 <br> ignaciomello20029@gmail.com</p> <br><br>
                    <h4>HORARIOS DE ATENCION</h4>
                    <p>Lunes y Viernes de 12.30 a 16.30y de 18.30 a 23.30.</p>
                </div>

                <div class="col-lg-3">
                    <br>
                    <h4>REDES SOCIALES</h4> <br>
                    <div class="icon-1"><img src="./Imagenes/icon-facebook.png"></div> <br>
                    <div class="icon-2"><img src="./Imagenes/icon-instagram.png"></div> <br>
                    <div class="icon-3"><img src="./Imagenes/icon-twitter.png"></div>
                </div>

                <div class="col-lg-3">
                    <br>
                    <h4>COMENTARIOS</h4>
                    <form enctype="text/plain" action="mailto:ignaciomello20029@gmail.com" method="post">
                        <label for="nombre">NOMBRE:</label> <br>
                        <input type="text" name="Nombre" placeholder="nombre..." size="30"> <br>
                        <label for="e-mail">E-MAIL:</label> <br>
                        <input type="e-mail" name="E-mail" placeholder="email..." size="30"> <br>
                        <label for="sugerencia">SUGERENCIA:</label> <br>
                        <input type="text" name="Sugerencia" placeholder="contame..." size="30"> <br><br>
                        <label for="sexo">Sexo:</label> 
                        <input type="radio" name="sexo" value="hombre">
                        <label>Hombre</label>
                        <input type="radio" name="sexo" value="mujer">
                        <label>Mujer</label>
                        <br><br>
                        <p>
                            <input type="submit" value="Enviar">
                            <input type="reset" value="Reset">
                        </p>
                    </form>
                </div>

            </div>
        </footer>
    </body>
</html> 