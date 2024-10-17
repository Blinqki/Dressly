<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Permite que la página pueda verse desde dispositivos móviles -->
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/dac5a0f402.js" crossorigin="anonymous"></script>
    <!-- Nombre de la página -->
    <title>Dressly</title>
    <link rel="icon" href="./Imagenes/Dicon.ico">
</head>

<body class="body">
    <section class="container">
        <div class="sidebar">
            <!-- Botón para ocultar la barra lateral -->
            <div class="side-hide">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <br><img src="./Imagenes/text-.png" width="130" alt="Logo">
            <ul>
                <!-- Opción de inicio de sesión si el usuario no está autenticado -->
                <?php if (!isset($_SESSION['username'])) { ?><li><a href="inicio.html">Inicio de Sesion</a></li> <?php } else {?>
                    <!-- Opción de inicio de sesión si el usuario no está autenticado -->
                <li><a href="crear_oufit_view.php">Diseña tu oufit</a></li>
                <li><a href="subetusprendas.html">Sube tus prendas</a></li>
                <li><a href="inventario_view.php">Tu Closet</a></li>
                <?php } ?>
                <!-- Enlace que se abrirá en una nueva pestaña -->
                <li><a href="contacto.html" target="_blank" >Contactanos</a></li>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                <?php if (isset($_SESSION['username'])) { ?>
                <li><a href="#"><?php echo $_SESSION['username'];   ?></a></li>
                <li><a href="logout.php">Salir </a></li> <?php } ?>
            </ul>
        </div>  
        <div class="content">
            <br> <button></button> 
            <br> <h2> "Dressly" </h2>
            <p>"Reinventa tu estilo, haz que cada prenda cuente." <br> 
            - Atrevete a cambiar.☆</p> 
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
  // Muestra SideBar
  $('button').on('click', function() {
    $(".container").toggleClass('show');
  })
  // Oculta SideBar
  $('.side-hide').on('click', function() {
    $(".container").toggleClass('show');
  });
</script>

    <?php
        include ("send.php");
    ?>
    <script>
        function myFunction() {
            window.location.href="http//localhost/Dressly/"
        }
    </script>
</body>
</html>