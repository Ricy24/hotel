<?php
include 'db.php'; // Asegúrate de que la conexión esté bien configurada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Validación básica
    if (empty($name) || empty($email) || empty($usuario) || empty($password)) {
        die("Todos los campos son requeridos.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("La dirección de correo no es válida.");
    }

    // Escapar los datos
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $usuario = $conn->real_escape_string($usuario);
    $passwordHashed = password_hash($conn->real_escape_string($password), PASSWORD_DEFAULT);

    // Comprobar si el usuario o el email ya existen
    $sqlCheck = "SELECT * FROM register WHERE email = '$email' OR usuario = '$usuario'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck->num_rows > 0) {
        die("El correo o el usuario ya están registrados.");
    }

    // Insertar el registro
    $sql = "INSERT INTO register (name, email, usuario, password) VALUES ('$name', '$email', '$usuario', '$passwordHashed')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php"); // Redirige a la página de login
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
