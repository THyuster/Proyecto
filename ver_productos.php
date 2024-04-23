<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="eliminar.css">
    <title>Ver Productos</title>
    <style>
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
        th, td {
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
    <div class="container">
        <h2>Lista de Productos</h2>
        <form id="searchForm">
            <input type="text" id="searchInput" placeholder="Buscar producto...">
            <button type="submit">Buscar</button>
        </form> 
        <div id="productList">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "telecominventario";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT ProductoID, Nombre, Precio, StockActual, StockMinimo, ProveedorID FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Stock Mínimo</th></tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ProductoID"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Precio"]. "</td><td>";

                    if ($row["StockActual"] <= $row["StockMinimo"]) {
                        echo "<span class='alert-icon' onclick='showAlert(\"" . $row["Nombre"] . "\")'>!</span> ";
                    }

                    echo $row["StockActual"] . "</td><td>" . $row["StockMinimo"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 resultados";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        function showAlert(productName) {
            alert('¡Alerta! La cantidad de ' + productName + ' está igual o por debajo del stock mínimo.');
        }
    </script>
</body>
</html>
