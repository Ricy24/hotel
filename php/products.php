<?php
include '../db/connect.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='product'>
                <img src='" . $row['image'] . "' alt='" . $row['name'] . "'>
                <h2>" . $row['name'] . "</h2>
                <p>" . $row['description'] . "</p>
                <p>$" . $row['price'] . "</p>
                <button onclick='addToCart(" . $row['id'] . ")'>Agregar al carrito</button>
              </div>";
    }
} else {
    echo "No hay productos disponibles.";
}

$conn->close();
?>
