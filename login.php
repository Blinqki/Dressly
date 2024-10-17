<?php
session_start();

require('conexion.php');
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario
    $stmt = $conn->prepare("SELECT password FROM Usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    // Verificar si existe el usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirigir a la página de inicio después de iniciar sesión
            exit();
        } else {
            header("Location: incorrect.html");
        }
    } else {
        header("Location: incorrect.html");
    }

    $stmt->close();
}
$conn->close();
?>
