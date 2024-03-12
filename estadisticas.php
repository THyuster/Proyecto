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

// Consulta para obtener los 5 productos con el precio más alto
$sql1 = "SELECT * FROM productos ORDER BY Precio DESC LIMIT 5";
$result1 = $conn->query($sql1);

// Consulta para obtener los 5 productos con mayor cantidad
$sql2 = "SELECT * FROM productos ORDER BY StockActual DESC LIMIT 5";
$result2 = $conn->query($sql2);

// Consulta para obtener los 5 productos con menor cantidad
$sql3 = "SELECT * FROM productos ORDER BY StockActual ASC LIMIT 5";
$result3 = $conn->query($sql3);

// Consulta para obtener la totalidad de productos y la suma total de precios
$sql4 = "SELECT COUNT(*) as TotalProductos, SUM(Precio * StockActual) as SumaTotal FROM productos";
$result4 = $conn->query($sql4);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f8f8f8;
            line-height: 1.6;
        }

        h2{
            position: relative;
            display: flex;
            justify-content: center;
            font-size: 35px;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 15px 0;
        }

        nav ul {
            padding: 0;
            list-style: none;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            color: #666;
            text-shadow: 1px 1px 0px #fff;
            background: #eaebec;
            margin: 20px 0;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #fff;
            padding: 10px 20px;
            text-align: center;
        }

        th {
            background-color: #556270;
            color: white;
            text-transform: uppercase;
        }

        tr {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #dbdadc;
        }

        .alert-icon {
            cursor: pointer;
            color: red;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="pagina_principal.php">Agregar productos</a></li>
            <li><a href="agregar_proveedor.html">Agregar proveedor</a></li>
            <li><a href="ver_productos.php">Ver Productos</a></li>
            <li><a href="ver_proveedor.php">Ver Proveedores</a></li>
            <li><a href="eliminar_producto.php">Eliminar Producto</a></li>
            <li><a href="estadisticas.php">Estadisticas </a></li>
            <li><a href="movimientos.php">Movimientos</a></li>
            <li><a href="inicio_de_sesion.html">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <?php
    // Mostrar resultados de la primera consulta
    if ($result1->num_rows > 0) {
        echo "<h2>Productos con el precio más alto</h2>";
        echo "<table>";
        echo "<tr><th>ProductoID</th><th>Nombre</th><th>Precio</th><th>StockActual</th></tr>";
        while ($row = $result1->fetch_assoc()) {
            echo "<tr><td>{$row['ProductoID']}</td><td>{$row['Nombre']}</td><td>{$row['Precio']}</td><td>{$row['StockActual']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la primera consulta.";
    }

    // Mostrar resultados de la segunda consulta
    if ($result2->num_rows > 0) {
        echo "<h2>Productos con mayor cantidad</h2>";
        echo "<table>";
        echo "<tr><th>ProductoID</th><th>Nombre</th><th>Precio</th><th>StockActual</th></tr>";
        while ($row = $result2->fetch_assoc()) {
            echo "<tr><td>{$row['ProductoID']}</td><td>{$row['Nombre']}</td><td>{$row['Precio']}</td><td>{$row['StockActual']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la segunda consulta.";
    }

    // Mostrar resultados de la tercera consulta
    if ($result3->num_rows > 0) {
        echo "<h2>Productos con menor cantidad</h2>";
        echo "<table>";
        echo "<tr><th>ProductoID</th><th>Nombre</th><th>Precio</th><th>StockActual</th></tr>";
        while ($row = $result3->fetch_assoc()) {
            echo "<tr><td>{$row['ProductoID']}</td><td>{$row['Nombre']}</td><td>{$row['Precio']}</td><td>{$row['StockActual']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la tercera consulta.";
    }

    // Mostrar resultados de la cuarta consulta
    if ($result4->num_rows > 0) {
        echo "<h2>Total de Productos y Suma Total de Precios</h2>";
        echo "<table>";
        echo "<tr><th>Total de Productos</th><th>Suma Total de Precios</th></tr>";

        $row = $result4->fetch_assoc();
        $totalProductos = $row["TotalProductos"];
        $sumaTotal = $row["SumaTotal"];

        echo "<tr><td>{$totalProductos}</td><td>{$sumaTotal}</td></tr>";
        echo "</table>";
    } else {
        echo "<p>Error en la consulta: {$conn->error}</p>";
    }

    // Cerrar conexión
    $conn->close();
    ?>

</body>

</html>

