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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si 'ProductoID' está definido en $_POST
    $productoID = isset($_POST['ProductoID']) ? $_POST['ProductoID'] : null;
    
    // Verificar si 'ProductoID' es diferente de null antes de procesar
    if ($productoID !== null) {
        $nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : null;
        $precio = isset($_POST['Precio']) ? $_POST['Precio'] : null;
        $stockActual = isset($_POST['StockActual']) ? $_POST['StockActual'] : null;
        $stockMinimo = isset($_POST['StockMinimo']) ? $_POST['StockMinimo'] : null;

        // Consulta preparada para evitar inyección de SQL
        $sql = "UPDATE productos SET Nombre = ?, Precio = ?, StockActual = ?, StockMinimo = ? WHERE ProductoID = ?";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("siiii", $nombre, $precio, $stockActual, $stockMinimo, $productoID);

        // Ejecutar consulta
        if ($stmt->execute()) {
            // Cerrar conexiones
            $stmt->close();

            // Redirigir a la página de "Ver Productos" con un mensaje
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

// Cerrar conexiones
$conn->close();
?>
