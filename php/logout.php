<?php
session_start(); // Iniciar la sesión
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión

header("Location: ../login.php"); // Redirigir al formulario de login
exit();
?>
