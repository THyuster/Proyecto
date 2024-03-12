<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="eliminar.css">
    <title>Ver Proveedores</title>
    <style>
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
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="pagina_principal.php">Agregar productos</a></li>
            <li><a href="agregar_proveedor.html">Agregar provedor </a></li>
            <li><a href="ver_productos.php">Ver Productos</a></li>
            <li><a href="eliminar_producto.php">Eliminar Producto</a></li>
            <li><a href="estadisticas.php">Estadisticas </a></li>
            <li><a href="movimientos.php">Movimientos</a></li>
            <li><a href="inicio_de_sesion.html">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Lista de Proveedores</h2>

        <!-- Aquí se mostrará la lista de productos -->
        <div id="productList">
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

            $sql = "SELECT ProveedorID, NombreProveedor, telefono, ProveedorID FROM proveedores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              echo "<table><tr><th>ID</th><th>Nombre</th><th>telefono</th></tr>";
              // Mostrar datos de cada fila
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ProveedorID"]. "</td><td>" . $row["NombreProveedor"]. "</td><td>" . $row["telefono"]. "</td></tr>";
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
</body>
</html>
