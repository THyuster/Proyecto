<?php
// Establecer conexión con la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TelecomInventario";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario
$idProducto = $_POST['idproducto'];
$nombre = $_POST['productName'];
$precio = $_POST['productPrice'];
$stockActual = $_POST['stockActual'];
$stockMinimo = $_POST['stockMinimo'];
$proveedorID = $_POST['proveedorID'];

// Consulta para verificar la existencia del proveedor
$proveedorExistenteQuery = "SELECT * FROM Proveedores WHERE ProveedorID = $proveedorID";
$proveedorExistenteResult = $conn->query($proveedorExistenteQuery);

// Verificar si el proveedor existe
if ($proveedorExistenteResult->num_rows === 0) {
    // El proveedor no existe, mostrar mensaje y salir del script
    echo "<script type='text/javascript'>alert('Proveedor no existente'); window.location.href = 'pagina_principal.php';</script>";
    exit();
}

// Consulta de inserción
$sql = "INSERT INTO Productos (ProductoID, Nombre, Precio, StockActual, StockMinimo, ProveedorID)
        VALUES ($idProducto, '$nombre', $precio, $stockActual, $stockMinimo, $proveedorID)";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Producto insertado correctamente'); window.location.href = 'pagina_principal.php';</script>";
} else {
    echo "Error al insertar el producto: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
