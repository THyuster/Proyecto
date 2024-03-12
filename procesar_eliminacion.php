<?php
    // Configuración de la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "telecominventario";

    // Crear una nueva conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Obtener el ID del producto del formulario
    $productID = $_POST['idproducto'];

    // Primero, verifica si el producto existe
    $checkSql = "SELECT * FROM productos WHERE ProductoID = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $productID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // El producto existe, procede a eliminarlo
        $checkStmt->close();

        // Crear la consulta SQL
        $sql = "DELETE FROM productos WHERE ProductoID = ?";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bind_param("i", $productID);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "<script>alert('Producto eliminado con éxito'); location.href='eliminar_producto.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el producto: " . $stmt->error . "'); location.href='eliminar_producto.php';</script>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // El producto no existe
        echo "<script>alert('Producto no existente'); location.href='eliminar_producto.php';</script>";
    }

    // Cerrar la conexión
    $conn->close();
?>
