<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql1 = "SELECT ProductoID, Nombre, Precio, StockActual FROM productos ORDER BY Precio DESC LIMIT 5";
$sql2 = "SELECT ProductoID, Nombre, Precio, StockActual FROM productos ORDER BY StockActual DESC LIMIT 5";
$sql3 = "SELECT ProductoID, Nombre, Precio, StockActual FROM productos ORDER BY StockActual ASC LIMIT 5";
$sql4 = "SELECT COUNT(*) as TotalProductos, SUM(Precio * StockActual) as SumaTotal FROM productos";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);

function mostrarTabla($result, $titulo) {
    if ($result->num_rows > 0) {
        echo "<h2>$titulo</h2>";
        echo "<table><tr><th>ProductoID</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ProductoID']}</td><td>{$row['Nombre']}</td><td>{$row['Precio']}</td><td>{$row['StockActual']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados para $titulo.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estadísticas de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    mostrarTabla($result1, "Productos con el precio más alto");
    mostrarTabla($result2, "Productos con mayor cantidad");
    mostrarTabla($result3, "Productos con menor cantidad");

    if ($result4->num_rows > 0) {
        echo "<h2>Total de Productos y Suma Total de Precios</h2>";
        echo "<table><tr><th>Total de Productos</th><th>Suma Total de Precios</th></tr>";

        $row = $result4->fetch_assoc();
        $totalProductos = $row["TotalProductos"];
        $sumaTotal = $row["SumaTotal"];

        echo "<tr><td>$totalProductos</td><td>$sumaTotal</td></tr></table>";
    } else {
        echo "<p>Error en la consulta: {$conn->error}</p>";
    }
    $conn->close();
    ?>
</body>
</html>