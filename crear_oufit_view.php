<?php
session_start();
include('inventario.php'); // Incluir el inventario

// Mezclar y filtrar prendas para que no se repitan en el outfit
if (!isset($_SESSION['outfit'])) {
    shuffle($prendas);
    $prendas_unicas = array_unique($prendas, SORT_REGULAR);
    $_SESSION['outfit'] = $prendas_unicas;
}

// Mantener una prenda seleccionada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keep'])) {
    $keep_index = $_POST['keep'];
    $prendas_unicas = array_filter($_SESSION['outfit'], function($key) use ($keep_index) {
        return $key != $keep_index;
    }, ARRAY_FILTER_USE_KEY);
    shuffle($prendas_unicas);
    $prendas_unicas = array_unique($prendas_unicas, SORT_REGULAR);
    $_SESSION['outfit'] = array_merge(array($_SESSION['outfit'][$keep_index]), $prendas_unicas);
}

// Regenerar outfits al presionar el botón
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regenerar'])) {
    shuffle($prendas);
    $prendas_unicas = array_unique($prendas, SORT_REGULAR);
    $_SESSION['outfit'] = $prendas_unicas;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Outfit</title>
    <link rel="stylesheet" href="tu_estilo.css">
</head>
<body>
    <div class="container">
        <!-- Botón para regresar a index.php -->
        <div class="top-right">
            <a href="index.php"><button>Volver al Inicio</button></a>
        </div>

        <div class="outfit-section">
            <!-- Generar los outfits -->
            <div class="outfit">
                <?php
                if (!empty($_SESSION['outfit'])) {
                    $prendas_unicas = $_SESSION['outfit'];
                    // Asegurarse de que hay suficientes prendas únicas para el outfit
                    if (count($prendas_unicas) >= 3) {
                        // Cuadro superior
                        $prenda = array_shift($prendas_unicas);
                        echo '<div class="cuadro cuadro-top">';
                        echo '<img src="' . htmlspecialchars($prenda['imagen_url']) . '" alt="' . htmlspecialchars($prenda['nombre']) . '">';
                        echo '<h2>' . htmlspecialchars($prenda['nombre']) . '</h2>';
                        echo '</div>';

                        // Cuadros inferiores
                        echo '<div class="cuadro-bottom">';
                        for ($i = 1; $i <= 2; $i++) {
                            $prenda = array_shift($prendas_unicas);
                            echo '<div class="cuadro">';
                            echo '<img src="' . htmlspecialchars($prenda['imagen_url']) . '" alt="' . htmlspecialchars($prenda['nombre']) . '">';
                            echo '<h2>' . htmlspecialchars($prenda['nombre']) . '</h2>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No tienes suficientes prendas únicas en tu inventario para crear un outfit completo.</p>';
                    }
                } else {
                    echo '<p>No tienes prendas en tu inventario.</p>';
                }
                ?>
            </div>

            <!-- Botón para regenerar outfit -->
            <div class="regenerar">
                <form method="post">
                    <button type="submit" name="regenerar">Regenerar</button>
                </form>
                <p>
                1. Da al botón de regenerar para cambiar las prendas.
                <br>2. Las prendas pueden repetirse, solo dale al botón para cambiarlas.
                <br>3. ¡Disfruta!
                </p>
            </div>
        </div>
    </div>
</body>
</html>
