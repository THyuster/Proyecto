<?php
// Conexión a la base de datos (reemplazar con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$tipo_movimiento = $_POST["tipo_movimiento"];
$producto_id = $_POST["producto_id"];
$nombre_tra = $_POST['nombre_trabajador'];
$cc_traba = $_POST['cc_trabajador'];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$motivo = $_POST["motivo"];
$cantidad = $_POST["cantidad"];

// Obtener la cantidad actual del producto
$cantidad_actual_query = "SELECT StockActual FROM productos WHERE ProductoID = $producto_id";
$result_cantidad_actual = $conn->query($cantidad_actual_query);

if ($result_cantidad_actual->num_rows > 0) {
    $row = $result_cantidad_actual->fetch_assoc();
    $cantidad_actual = $row["StockActual"];
    
    // Verificar si hay suficiente cantidad
    if ($tipo_movimiento == "salida" && $cantidad > $cantidad_actual) {
        $mensaje = "No hay suficiente cantidad disponible para este producto.";
    } else {
        // Insertar movimiento en la tabla movimientos
        $insert_movimiento_query = "INSERT INTO movimientos (TipoMovimiento, ProductoID, Nombre_trabajador, cc_trabajador, Fecha, Hora, Cantidad, Motivo) VALUES ('$tipo_movimiento', '$producto_id', '$nombre_tra', '$cc_traba', '$fecha', '$hora', '$cantidad', '$motivo')";
        $conn->query($insert_movimiento_query);

        // Actualizar la cantidad en la tabla productos
        if ($tipo_movimiento == "entrada") {
            $update_cantidad_query = "UPDATE productos SET StockActual = StockActual + $cantidad WHERE ProductoID = $producto_id";
        } elseif ($tipo_movimiento == "salida") {
            $update_cantidad_query = "UPDATE productos SET StockActual = StockActual - $cantidad WHERE ProductoID = $producto_id";
        }

        $conn->query($update_cantidad_query);
    }
} else {
    $mensaje = "Producto no encontrado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimiento Registrado</title>
    <script>
        // Script de JavaScript para mostrar un mensaje y redirigir
        window.onload = function() {
            var mensaje = "<?php echo isset($mensaje) ? $mensaje : ''; ?>";
            if (mensaje) {
                alert(mensaje);
            }
            window.location.href = "movimientos.php"; 
        };
    </script>
</head>
<body>
    <div id="mensaje">
        <?php
            if (isset($mensaje)) {
                echo $mensaje;
            }
        ?>
    </div>
</body>
</html>
