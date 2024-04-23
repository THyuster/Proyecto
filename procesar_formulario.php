<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$tipo_movimiento = $_POST["tipo_movimiento"];
$producto_id = $_POST["producto_id"];
$nombre_tra = $_POST['nombre_trabajador'];
$cc_traba = $_POST['cc_trabajador'];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$motivo = $_POST["motivo"];
$cantidad = $_POST["cantidad"];

$cantidad_actual_query = "SELECT StockActual FROM productos WHERE ProductoID = $producto_id";
$result_cantidad_actual = $conn->query($cantidad_actual_query);

if ($result_cantidad_actual->num_rows > 0) {
    $row = $result_cantidad_actual->fetch_assoc();
    $cantidad_actual = $row["StockActual"];
    
    if ($tipo_movimiento == "salida" && $cantidad > $cantidad_actual) {
        $mensaje = "No hay suficiente cantidad disponible para este producto.";
    } else {
        $insert_movimiento_query = "INSERT INTO movimientos (TipoMovimiento, ProductoID, Nombre_trabajador, cc_trabajador, Fecha, Hora, Cantidad, Motivo) VALUES ('$tipo_movimiento', '$producto_id', '$nombre_tra', '$cc_traba', '$fecha', '$hora', '$cantidad', '$motivo')";
        $conn->query($insert_movimiento_query);

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
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimiento Registrado</title>
    <script>
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
