<?php
include 'db.php';
require '../vendor/autoload.php'; // Usar el autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Validación básica
    if (empty($name) || empty($email) || empty($message)) {
        die("Todos los campos son requeridos.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("La dirección de correo electrónico proporcionada no es válida.");
    }
     // Escapar los datos para prevenir inyecciones SQL
     $name = $conn->real_escape_string($name);
     $email = $conn->real_escape_string($email);
     $message = $conn->real_escape_string($message);
 
     // Generar el número de reserva
     $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Office365
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Resortlaislaencantada@outlook.com'; // Tu dirección de correo
        $mail->Password = 'Resort1234'; // Tu contraseña de correo o contraseña de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Habilitar la depuración SMTP para depuración avanzada
        $mail->SMTPDebug = 0;

        // Destinatario y contenido del correo
        $mail->setFrom('Resortlaislaencantada@outlook.com', 'Resort la Isla Encantada');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Mensaje de contacto de $name";
        $mail->Body = "Nombre: $name<br>Email: $email<br>Mensaje:<br>$message";

        // Enviar el correo
        $mail->send();
        echo "Mensaje enviado. Nos pondremos en contacto contigo pronto.";
    } catch (Exception $e) {
        echo "Error al enviar el mensaje. Detalles del error: {$mail->ErrorInfo}";
    }
}
?>
