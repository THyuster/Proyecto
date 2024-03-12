<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="eliminar.css">
    <title>Eliminar Producto</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="pagina_principal.php"> Agregar producto</a></li>
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
        <h2>Eliminar Producto</h2>
        <form id="deleteProductForm" action="procesar_eliminacion.php" method="post">
            <label for="idproducto">ID Producto:</label>
            <input type="number" name="idproducto" required>
            <br>
            <button type="submit">Eliminar Producto</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>