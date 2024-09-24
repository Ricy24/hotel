<?php
// editar_reserva.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos de la reserva
    $sql = "SELECT * FROM reservations WHERE id = $id";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $tipo_habitacion = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Actualizar la reserva
    $sql = "UPDATE reservations SET 
            name = '$nombre', 
            email = '$email', 
            celular = '$celular', 
            room_type = '$tipo_habitacion', 
            check_in = '$check_in', 
            check_out = '$check_out' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva actualizada correctamente.";
        header("Location: panel_reservas.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
</head>
<body>

<h1>Editar Reserva</h1>

<form method="POST" action="editar_reserva.php">
    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
    Nombre: <input type="text" name="name" value="<?php echo $fila['name']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $fila['email']; ?>"><br>
    Celular: <input type="text" name="celular" value="<?php echo $fila['celular']; ?>"><br>
    Tipo de Habitación: <input type="text" name="room_type" value="<?php echo $fila['room_type']; ?>"><br>
    Check-In: <input type="date" name="check_in" value="<?php echo $fila['check_in']; ?>"><br>
    Check-Out: <input type="date" name="check_out" value="<?php echo $fila['check_out']; ?>"><br>
    <input type="submit" value="Actualizar Reserva">
</form>

</body>
</html>
