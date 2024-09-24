<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php'; // Incluye la conexión a la base de datos
require '../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Función para calcular el costo por día según el tipo de habitación
function calcularCostoPorDia($tipo_habitacion) {
    switch ($tipo_habitacion) {
        case "simple":
            return 60000;
        case "doble":
            return 100000;
        case "suite":
            return 500000;
        default:
            return 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $room_type = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $num_personas = $_POST['num_personas'];

    // Escapar los datos para prevenir inyecciones SQL
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $celular = $conn->real_escape_string($celular);
    $room_type = $conn->real_escape_string($room_type);
    $check_in = $conn->real_escape_string($check_in);
    $check_out = $conn->real_escape_string($check_out);

    // Generar el número de reserva
    $sql = "INSERT INTO reservations (name, email, celular, room_type, check_in, check_out) VALUES ('$name', '$email', '$celular', '$room_type', '$check_in', '$check_out')";

    if ($conn->query($sql) === TRUE) {
        $reservation_id = $conn->insert_id;

        // Crear el contenido del archivo .ics
        $ics_content = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Resort la Isla Encantada//Reservas//ES
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@Resortlaislaencantada.com
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:" . date('Ymd\THis\Z', strtotime($check_in)) . "
DTEND:" . date('Ymd\THis\Z', strtotime($check_out)) . "
SUMMARY:Reserva en Resort la Isla Encantada
DESCRIPTION:Detalles de la reserva\nNombre: $name\n Email: $email\nCelular: $celular\nTipo de habitación: $room_type\nNúmero de reserva: $reservation_id
END:VEVENT
END:VCALENDAR";

        // Enviar correo de notificación
        $mail = new PHPMailer(true);

        try {
            // Configuración de SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'Resortlaislaencantada@outlook.com';
            $mail->Password = 'Resort1234';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinatarios
            $mail->setFrom('Resortlaislaencantada@outlook.com', 'Resort la Isla Encantada');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Reserva Confirmada';

            // Cálculos del costo de la reserva
            $costo_por_dia = calcularCostoPorDia($room_type);
            $num_dias = ceil((strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24));
            $costo_total_habitacion = $costo_por_dia * $num_dias;
            $costo_por_persona = 30000;
            $costo_total_personas = $costo_por_persona * $num_personas * $num_dias;
            $total_reserva = $costo_total_habitacion + $costo_total_personas;

            // Contenido del correo
            $message = "
            <p>Hola $name,</p>
            <p>Tu reserva ha sido confirmada para el Resort la Isla Encantada.</p>
            <p><strong>Detalles de la reserva:</strong></p>
            <ul>
                <li>Nombre: $name</li>
                <li>Email: $email</li>
                <li>Celular: $celular</li>
                <li>Tipo de habitación: $room_type</li>
                <li>Fecha de entrada: $check_in</li>
                <li>Fecha de salida: $check_out</li>
                <li>Número de reserva: $reservation_id</li>
            </ul>
            <p>Detalles de la Reserva</p>
            <p>Costo por día de la habitación: $costo_por_dia COP</p>
            <p>Costo total de la habitación ($num_dias días): $costo_total_habitacion COP</p>
            <p>Costo por persona adicional ($num_personas personas x $num_dias días): $costo_total_personas COP</p>
            <p>Total de la Reserva: $total_reserva COP</p>
            <p>Para finalizar tu reserva, por favor realiza el pago utilizando el siguiente código QR:</p>
            <p>Una vez finalizado el pago, nuestros asesores se pondrán en contacto contigo para confirmar los detalles de tu reserva.</p>
            <p>¡Gracias por elegirnos!</p>
            ";

            // Obtener la ruta del archivo de imagen
            $attachmentPath = dirname(__FILE__) . '/../images/PagoQRNequi.jpg';

            // Verificar si el archivo existe antes de adjuntarlo
            if (file_exists($attachmentPath)) {
                $mail->addAttachment($attachmentPath, 'PagoQRNequi.jpg');
            } else {
                echo "El archivo de imagen no se encuentra en la ruta especificada.";
            }

            $mail->Body = $message;
            $mail->AltBody = 'Tu cliente de correo no admite HTML';

            // Adjuntar el archivo .ics al cuerpo del correo electrónico
            $mail->addStringAttachment($ics_content, 'reserva.ics', 'base64', 'text/calendar');

            $mail->send();

            // Mostrar notificación y redirigir después de 3 segundos
            echo "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Reserva Exitosa</title>
                <style>
                    body {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                        font-family: Arial, sans-serif;
                        background-color: #f8f9fa;
                    }
                    .container {
                        text-align: center;
                        padding: 20px;
                        border: 1px solid #ced4da;
                        border-radius: 8px;
                        background-color: #ffffff;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .container h1 {
                        color: #28a745;
                    }
                    .container p {
                        font-size: 18px;
                        margin: 10px 0;
                    }
                    .container button {
                        padding: 10px 20px;
                        font-size: 16px;
                        color: #ffffff;
                        background-color: #007bff;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>¡Muchas gracias!</h1>
                    <p>Tu reserva ha sido realizada exitosamente.</p>
                    <p>Un correo de confirmación ha sido enviado a tu dirección de correo electrónico.</p>
                    <button onclick=\"window.location.href='../index.html'\">Volver al inicio</button>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '../index.html';
                    }, 3000);
                </script>
            </body>
            </html>
            ";
            exit();
        } catch (Exception $e) {
            echo "Error al enviar el correo: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error al registrar la reserva: " . $conn->error;
    }
}
?>
