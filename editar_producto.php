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
    $sql = "SELECT ProductoID, Nombre, Precio, StockActual, StockMinimo FROM productos WHERE ProductoID = ?";
    $stmt = $conn->prepare($sql);
    
    // Vincular parámetros
    $stmt->bind_param("i", $productoID);

    // Ejecutar consulta
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <head>
        <style>
        body {
            background-color: #f2f2f2; /* Cambia el color de fondo a un gris más claro */
            color: #333; /* Cambia el color del texto a un tono más oscuro */
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            color: #fff;
            box-shadow: 0 0 20px 0 #00000040;
            max-width: 500px;
        }

        form label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            margin-bottom: 20px;
            box-sizing: border-box;
            color: #323232;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            text-align: center;
            width: 100%;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

        </head>
         
        <form action="actualizar_producto.php" method="post">
            <label for="ProductoID">ID del Producto:</label><br>
            <input type="text" id="ProductoID" name="ProductoID" value="<?php echo $row['ProductoID']; ?>" readonly>
            <label for="Nombre">Nombre:</label><br>
            <input type="text" id="Nombre" name="Nombre" value="<?php echo $row['Nombre']; ?>"><br>

            <label for="Precio">Precio:</label><br>
            <input type="text" id="Precio" name="Precio" value="<?php echo $row['Precio']; ?>"><br>

            <label for="StockActual">Stock Actual:</label><br>
            <input type="text" id="StockActual" name="StockActual" value="<?php echo $row['StockActual']; ?>"><br>

            <label for="StockMinimo">Stock Mínimo:</label><br>
            <input type="text" id="StockMinimo" name="StockMinimo" value="<?php echo $row['StockMinimo']; ?>"><br>

            <input type="submit" value="Actualizar">
        </form>
        <?php
    } else {
        echo "No se encontró ningún producto con ese ID";
    }
} else {
    echo "Error: No se proporcionó un ID de producto";
}

// Cerrar conexiones
if (isset($stmt)) {
    $stmt->close();
}

$conn->close();
?>
