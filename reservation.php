<?php
session_start(); 


if (!isset($_SESSION['usuario'])) {

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - Resort la isla encantada</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Reservas</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="gallery.html">Galería</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="reservation.php">Reservas</a></li>
                <li><a href="contact.html">Contacto</a></li>
                <li><a href="login.php">Login</a></li>    
            </ul>
        </nav>
    </header>
    <main>
        <h2>Reserva tu habitación</h2>
        <form action="php/reserve.php" method="post">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="celular">Número de Celular:</label>
            <input type="tel" id="celular" name="celular" pattern="[0-9]{10}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="room_type">Planes de estadía:</label>
            <select id="room_type" name="room_type" onchange="calcularCostoTotal()">
                <option value="simple">Export Plus</option>
                <option value="doble">Platinum Plus</option>
                <option value="suite">Gold Plus</option>
            </select>

            <label for="check_in">Fecha de Entrada:</label>
            <input type="date" id="check_in" name="check_in" onchange="calcularCostoTotal()" required>

            <label for="check_out">Fecha de Salida:</label>
            <input type="date" id="check_out" name="check_out" onchange="calcularCostoTotal()" required>

            <label for="num_personas">Número de Personas:</label>
            <input type="number" id="num_personas" name="num_personas" min="1" value="1" onchange="calcularCostoTotal()" required>

            <input type="submit" value="Reservar">
        </form>

        <div id="detalleReserva"></div> <!-- Área de detalles de la reserva -->
    </main>
    <br><br><br><br><br>
    <footer>
        <p>&copy; Resort la isla encantada</p>
    </footer>

    <script>
        function calcularCostoTotal() {
            const tipoHabitacion = document.getElementById("room_type").value;
            let costoPorDia = 0;

            switch (tipoHabitacion) {
                case "simple":
                    costoPorDia = 60000; // Costo por día para habitación simple
                    break;
                case "doble":
                    costoPorDia = 100000; // Costo por día para habitación doble
                  
                    break;
                case "suite":
                    costoPorDia = 500000; // Costo por día para suite
                    break;
                default:
                    costoPorDia = 0; // Valor por defecto si no se selecciona ninguna opción válida
            }

            const checkIn = new Date(document.getElementById("check_in").value);
            const checkOut = new Date(document.getElementById("check_out").value);
            const numPersonas = parseInt(document.getElementById("num_personas").value);

            const numDias = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const costoTotalHabitacion = costoPorDia * numDias;

            const costoPorPersona = 30000; // 
            const costoTotalPersonas = costoPorPersona * numPersonas * numDias;

            const totalReserva = costoTotalHabitacion + costoTotalPersonas;

            const detalleReserva = `
                <h3>Detalles de la Reserva</h3>
                <p>Costo por día de la habitación: $${costoPorDia.toFixed(2)} COP</p>
                <p>Costo total de la habitación (${numDias} días): $${costoTotalHabitacion.toFixed(2)} COP</p>
                <p>Costo por persona adicional (${numPersonas} personas x ${numDias} días): $${costoTotalPersonas.toFixed(2)} COP</p>
                <h2>Total de la Reserva: $${totalReserva.toFixed(2)} COP</h2>
            `;

            document.getElementById("detalleReserva").innerHTML = detalleReserva;
        }
    </script>

</body>
</html>
