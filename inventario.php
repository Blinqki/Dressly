<?php
// Aumentar el límite de memoria
ini_set('memory_limit', '1G');

// Iniciar sesión
//session_start();
require('conexion.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    die("Debes iniciar sesión para ver tu inventario.");
}

$username = $_SESSION['username'];

// Consulta para obtener todas las prendas del usuario
$sql = "SELECT * FROM prendas WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$prendas = [];
while ($row = $result->fetch_assoc()) {
    $prendas[] = $row; // Almacenar todas las prendas en un array
}

// Verificar si se ha solicitado eliminar una prenda
if (isset($_POST['eliminar'])) {
    $prenda_id = $_POST['prenda_id'];
    // Eliminar la prenda de la base de datos
    $sql = "DELETE FROM prendas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prenda_id);
    $stmt->execute();
    $stmt->close();
    // Refrescar la página para actualizar el inventario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Cerrar la conexión
$conn->close();
?>

