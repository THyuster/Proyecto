<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="movimientos.css">
    <title>Registro de Entrada/Salida de Productos</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="pagina_principal.php">Agregar productos</a></li>
            <li><a href="agregar_proveedor.html">Agregar provedor </a></li>
            <li><a href="ver_productos.php">Ver Productos</a></li>
            <li><a href="ver_proveedor.php">Ver Proveedores</a></li>
            <li><a href="eliminar_producto.php">Eliminar Producto</a></li>
            <li><a href="estadisticas.php">Estadisticas </a></li>
            <li><a href="movimientos.php">Movimientos</a></li>
            <li><a href="inicio_de_sesion.html">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <h2>Registro de Entrada/Salida de Productos</h2>
    <div class="container">
        <form action="procesar_formulario.php" method="post" id="addProductFrom">
            <label for="tipo_movimiento">Tipo de Movimiento:</label>
            <select name="tipo_movimiento" required>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>

            <label for="producto_id">Producto:</label>
            <select name="producto_id" required>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "telecominventario";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $productos_query = "SELECT ProductoID, Nombre FROM productos";
                $productos_result = $conn->query($productos_query);

                while ($row = $productos_result->fetch_assoc()) {
                    echo "<option value='" . $row['ProductoID'] . "'>" . $row['ProductoID'] . " - " . $row['Nombre'] . "</option>";
                }

                $conn->close();
                ?>
            </select>
            <label for="nombre_tra">Nombre del Trabajador</label>
            <input type="text" name="nombre_trabajador" required>

            <label for="cedula">Numero de Cedula</label>
            <input type="number" name="cc_trabajador" required>
            
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="text" name="hora" placeholder="HH:mm:ss" required>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" required>

            <label for="motivo">Motivo:</label>
            <textarea name="motivo" rows="4" cols="50" required></textarea><br>

            <input type="submit" value="Registrar Movimiento">
        </form>
    </div>
    <hr>
    <h3>Movimientos Registrados</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "telecominventario";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $movimientos_query = "SELECT movimientos.*, productos.Nombre AS NombreProducto FROM movimientos 
                      JOIN productos ON movimientos.ProductoID = productos.ProductoID";
    $movimientos_result = $conn->query($movimientos_query);

    if ($movimientos_result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Tipo de Movimiento</th><th>Producto ID</th><th>Nombre del Producto</th><th>Nombre Trabajador</th><th>C.C TRABAJADOR</th><th>Fecha</th><th>Hora</th><th>Cantidad</th><th>Motivo</th></tr>";
        while ($row = $movimientos_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['MovimientoID'] . "</td>";
            echo "<td>" . $row['TipoMovimiento'] . "</td>";
            echo "<td>" . $row['ProductoID'] . "</td>";
            echo "<td>" . $row['NombreProducto'] ."</td>";
            echo "<td>" . $row['Nombre_trabajador'] ."</td>";
            echo "<td>" . $row['cc_trabajador'] ."</td>";
            echo "<td>" . $row['Fecha'] . "</td>";
            echo "<td>" . $row['Hora'] . "</td>";
            echo "<td>" . $row['Cantidad'] . "</td>";
            echo "<td>" . $row['Motivo'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No hay movimientos registrados.";
    }

    $conn->close();
    ?>
</body>
</html>
