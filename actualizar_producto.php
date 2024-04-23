<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productoID = filter_input(INPUT_POST, 'ProductoID', FILTER_VALIDATE_INT);

    if ($productoID !== null && $productoID !== false) {
        $nombre = filter_input(INPUT_POST, 'Nombre', FILTER_SANITIZE_STRING);
        $precio = filter_input(INPUT_POST, 'Precio', FILTER_VALIDATE_FLOAT);
        $stockActual = filter_input(INPUT_POST, 'StockActual', FILTER_VALIDATE_INT);
        $stockMinimo = filter_input(INPUT_POST, 'StockMinimo', FILTER_VALIDATE_INT);

        $sql = "UPDATE productos SET Nombre = ?, Precio = ?, StockActual = ?, StockMinimo = ? WHERE ProductoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdiii", $nombre, $precio, $stockActual, $stockMinimo, $productoID);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ver_productos.php?mensaje=Editado correctamente");
            exit();
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }
    } else {
        echo "Error: No se proporcionó el ID del producto";
    }
} else {
    echo "Error: El formulario no se envió correctamente";
}

$conn->close();