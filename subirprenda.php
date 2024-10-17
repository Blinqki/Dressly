<?php
session_start();
require('conexion.php');
// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $talla = $_POST['talla'];
    $username = $_SESSION['username']; // Obtener el username de la sesión

    // Manejar la subida de la imagen
    $targetDir = "Prendas_Subidas/";
    $targetFile = $targetDir . basename($_FILES["fileInput"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si la imagen es real
    $check = getimagesize($_FILES["fileInput"]["tmp_name"]);
    if ($check === false) {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar tamaño del archivo (5MB máximo)
    if ($_FILES["fileInput"]["size"] > 5000000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de imagen
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk está en 0 debido a un error
    if ($uploadOk === 0) {
        echo "Lo siento, tu archivo no fue subido.";
    } else {
        // Intentar subir el archivo
        if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFile)) {
            // Preparar la inserción en la base de datos
            $stmt = $conn->prepare("INSERT INTO prendas (nombre, categoria, descripcion, color, talla, imagen_url, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $nombre, $categoria, $descripcion, $color, $talla, $targetFile, $username);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                header("Location: exito.html");  
            } else {
                echo "Error al insertar en la base de datos: " . $stmt->error;
            }
            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
