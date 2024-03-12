<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "telecominventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$idProveedor = trim($_POST["ProveedorID"]);
$nombreProveedor = trim($_POST["NombreProveedor"]);
$telefono = trim($_POST["telefono"]);

$sql = "INSERT INTO proveedores (ProveedorID, NombreProveedor, telefono) 
        VALUES ('$idProveedor', '$nombreProveedor', '$telefono')";

if ($conn->query($sql) === TRUE) {
  echo "<script type='text/javascript'>alert('Proveedor añadido correctamente');</script>";
  echo "<script type='text/javascript'>window.location.href = 'agregar_proveedor.html';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>