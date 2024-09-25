<?php
$servername = "localhost"; 
$username = "root";   
$password = "";
$dbname = "hotel_db"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar credenciales
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM Administrador WHERE usuario = ? AND clave = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login exitoso
        session_start(); // Inicia la sesión
        $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
        header("Location: panel_reservas.php"); // Redirige al panel de reservas
        exit(); // Asegúrate de salir después de redirigir
    } else {
        // Login fallido
        echo "Usuario o contraseña incorrectos.";
    }
}
?>

<form method="post" action="">
    Usuario: <input type="text" name="usuario"><br>
    Clave: <input type="password" name="clave"><br>
    <input type="submit" value="Iniciar sesión">
</form>
