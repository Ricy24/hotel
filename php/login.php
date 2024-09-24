<?php
include 'db.php'; // Asegúrate de que la conexión a la base de datos esté correctamente configurada

session_start(); // Iniciar sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validación básica
    if (empty($email) || empty($password)) {
        die("Ambos campos son requeridos.");
    }

    // Escapar datos para evitar inyecciones SQL
    $email = $conn->real_escape_string($email);

    // Verificar si el usuario existe en la tabla `register` usando el correo electrónico
    $query = "SELECT * FROM register WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Usuario encontrado, ahora verificar la contraseña
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Almacenar la información del usuario en la sesión
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];

            // Redirigir a la página de inicio (index.html)
            header("Location: ../index.html");
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "El correo electrónico no está registrado.";
    }
}
?>
