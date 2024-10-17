<?php 
session_start();
session_destroy(); 
header("Location: index.php");
// Cerrar la conexión al login

