<?php
// eliminar_reserva.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para eliminar la reserva
    $sql = "DELETE FROM reservations WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Reserva eliminada correctamente.";
        header("Location: panel_reservas.php");
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}
?>
