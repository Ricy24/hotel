<?php
// panel_reservas.php
include 'db.php';

// Consulta para obtener todas las reservas
$sql = "SELECT * FROM reservations";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Reservas</title>
    <link rel="stylesheet" href="styles.css"> <!-- Vinculamos el CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Google Fonts -->
</head>
<body>

<div class="container">
    <h1>Reservas del Hotel</h1>

    <?php if ($resultado->num_rows > 0): ?>
    <div class="card-grid">
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <div class="card">
            <h2>Reserva ID: <?php echo $fila['id']; ?></h2>
            <p><strong>Nombre:</strong> <?php echo $fila['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $fila['email']; ?></p>
            <p><strong>Celular:</strong> <?php echo $fila['celular']; ?></p>
            <p><strong>Tipo de Habitación:</strong> <?php echo $fila['room_type']; ?></p>
            <p><strong>Check-In:</strong> <?php echo $fila['check_in']; ?></p>
            <p><strong>Check-Out:</strong> <?php echo $fila['check_out']; ?></p>

            <div class="card-actions">
                <a href="editar_reserva.php?id=<?php echo $fila['id']; ?>">Editar</a>
                <a href="eliminar_reserva.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta reserva?');">Eliminar</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
        <p>No hay reservas registradas.</p>
    <?php endif; ?>
</div>

<footer>
    &copy; 2024 Hotel | Todos los derechos reservados.
</footer>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
