<?php
session_start(); // Iniciar una sesión
include('inventario.php'); // Incluir el archivo inventario.php para obtener las prendas
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Especifica la codificación de caracteres UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Hacer la página responsiva -->
    <title>Inventario</title> <!-- Título de la página -->
    <link rel="stylesheet" href="InvPrendas.css"> <!-- Enlace a la hoja de estilos CSS externa -->
</head>
<body>
    <div class="container">
        <!-- Botón para regresar a index.php -->
        <div class="top-left">
            <a href="index.php"><button>Inicio</button></a> <!-- Botón para volver al inicio -->
        </div>
        <h1 class="tituloo">Tu Inventario de Prendas</h1> <!-- Título del inventario -->
        <div class="grid">
            <?php if (!empty($prendas)): ?> <!-- Verificar si hay prendas en el inventario -->
                <?php foreach ($prendas as $prenda): ?> <!-- Iterar sobre cada prenda en el inventario -->
                    <div class="prenda">
                        <img src="<?php echo htmlspecialchars($prenda['imagen_url']); ?>" alt="<?php echo htmlspecialchars($prenda['nombre']); ?>"> <!-- Mostrar la imagen de la prenda -->
                        <h2 class="tiitulo"><?php echo htmlspecialchars($prenda['nombre']); ?></h2> <!-- Mostrar el nombre de la prenda -->
                        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($prenda['categoria']); ?></p> <!-- Mostrar la categoría de la prenda -->
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($prenda['descripcion']); ?></p> <!-- Mostrar la descripción de la prenda -->
                        <p><strong>Color:</strong> <?php echo htmlspecialchars($prenda['color']); ?></p> <!-- Mostrar el color de la prenda -->
                        <p><strong>Talla:</strong> <?php echo htmlspecialchars($prenda['talla']); ?></p> <!-- Mostrar la talla de la prenda -->
                        <!-- Botón para eliminar la prenda -->
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!-- Formulario para enviar la solicitud de eliminación -->
                            <input type="hidden" name="prenda_id" value="<?php echo $prenda['id']; ?>"> <!-- Campo oculto con el ID de la prenda -->
                            <button type="submit" name="eliminar">Borrar</button> <!-- Botón para enviar la solicitud de eliminación -->
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tienes prendas en tu inventario.</p> <!-- Mensaje si no hay prendas en el inventario -->
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

