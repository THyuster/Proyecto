<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TelecomInventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idProducto = $_POST['idproducto'];
$nombre = $_POST['productName'];
$precio = $_POST['productPrice'];
$stockActual = $_POST['stockActual'];
$stockMinimo = $_POST['stockMinimo'];
$proveedorID = $_POST['proveedorID'];

$proveedorExistenteQuery = "SELECT * FROM Proveedores WHERE ProveedorID = $proveedorID";
$proveedorExistenteResult = $conn->query($proveedorExistenteQuery);

if ($proveedorExistenteResult->num_rows === 0) {
    echo "<script type='text/javascript'>alert('Proveedor no existente'); window.location.href = 'pagina_principal.php';</script>";
    exit();
}

$sql = "INSERT INTO Productos (ProductoID, Nombre, Precio, StockActual, StockMinimo, ProveedorID)
        VALUES ($idProducto, '$nombre', $precio, $stockActual, $stockMinimo, $proveedorID)";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Producto insertado correctamente'); window.location.href = 'pagina_principal.php';</script>";
} else {
    echo "Error al insertar el producto: " . $conn->error;
}

$conn->close();
?>
