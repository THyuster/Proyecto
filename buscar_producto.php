<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['productoID'])) {
    $productoID = $_GET['productoID'];

    // Consulta preparada para evitar inyección de SQL
    $sql = "SELECT ProductoID, Nombre, Precio, StockActual, StockMinimo, ProveedorID FROM productos WHERE ProductoID = ?";
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("i", $productoID);

    // Ejecutar consulta
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();
} else {
    $sql = "SELECT ProductoID, Nombre, Precio, StockActual, StockMinimo, ProveedorID FROM productos";
    $result = $conn->query($sql);
}

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Stock Mínimo</th><th>Editar</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["ProductoID"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Precio"]. "</td><td>";

            // Mostrar cantidad y stock mínimo y agregar símbolo de exclamación si la cantidad es menor o igual al stock mínimo
            if ($row["StockActual"] <= $row["StockMinimo"]) {
                echo "<span class='alert-icon'>!</span> ";
            }

            echo $row["StockActual"] . "</td><td>" . $row["StockMinimo"] . "</td>";
            echo "<td><a href='editar_producto.php?productoID=" . $row["ProductoID"] . "'>Editar</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontró ningún producto con ese ID";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}

// Cerrar conexiones
if (isset($stmt)) {
    $stmt->close();
}

$conn->close();
?>
