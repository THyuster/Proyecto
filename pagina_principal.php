
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Gestión de Inventario</title>
    <style>
        .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        min-width: 160px;
        z-index: 1;
        }

        .dropdown:hover .dropdown-content {
        display: block;
        }
    </style>
</head>
<body>

    
    <nav>
        <ul>
            <li><a href="pagina_principal.php">Agregar Producto</a></li>
            <li><a href="agregar_proveedor.html">Agregar Proveedor</a></li>
            <li><a href="ver_productos.php">Ver Productos</a></li>
            <li><a href="ver_proveedor.php">Ver Proveedores</a></li>
            <li><a href="eliminar_producto.php">Eliminar Producto</a></li>
            <li><a href="estadisticas.php">Estadisticas </a></li>
            <li><a href="movimientos.php">Movimientos</a></li>
            <li><a href="inicio_de_sesion.html">Cerrar Sesion</a></li>
        </ul>
    </nav>
    

    <div class="container">
        <!-- Formulario para agregar productos -->
        <div class="add-product-form">
            <h2>Agregar Nuevo Producto</h2>
            <form id="addProductForm" action="procesar_insercion.php" method="post">
                <label for="idproducto">ID Producto:</label>
                <input type="number" name="idproducto" required>
                <br>
                <label for="productName">Nombre del Producto:</label>
                <input type="text" id="productName" name="productName" required>
                <br>
                <label for="productPrice">Precio:</label>
                <input type="number" id="productPrice" name="productPrice" step="0.01" required>
                <br>
                <label for="stockActual">cantidad:</label>
                <input type="number" id="stockActual" name="stockActual" required>
                <br>
                <label for="stockMinimo">Stock Minimo:</label>
                <input type="number" id="stockMinimo" name="stockMinimo" required>
                <br>
                <label for="proveedorID">Proveedor ID:</label>
                <input type="number" id="proveedorID" name="proveedorID" required>
                <br>
                <button type="submit">Agregar Producto</button>
            </form>
            <br>
            <br>
            <br>
        </div>

        
    </div>

    <footer>
        <p>&copy; 2023 Gestión de Inventario</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
