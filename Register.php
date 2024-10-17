<?php
require('conexion.php'); // Incluir el archivo de conexión a la base de datos
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Obtener el nombre de usuario del formulario
    $email = $_POST['email']; // Obtener el email del formulario
    $password = $_POST['password']; // Obtener la contraseña del formulario
    // Encriptar la contraseña usando el algoritmo Bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Consulta para insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO Usuarios (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        header("Location: inicio.html"); // Redirigir al inicio si el registro fue exitoso
    } else {
        echo "Error: " . $stmt->error; // Mostrar un mensaje de error si la consulta falló
    } 
    $stmt->close(); // Cerrar la declaración preparada
}
$conn->close(); // Cerrar la conexión a la base de datos
?>
