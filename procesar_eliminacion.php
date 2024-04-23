<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "telecominventario";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }
    $productID = $_POST['idproducto'];
    $checkSql = "SELECT * FROM productos WHERE ProductoID = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $productID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $checkStmt->close();

        $sql = "DELETE FROM productos WHERE ProductoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productID);

        if ($stmt->execute()) {
            echo "<script>alert('Producto eliminado con éxito'); location.href='eliminar_producto.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el producto: " . $stmt->error . "'); location.href='eliminar_producto.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Producto no existente'); location.href='eliminar_producto.php';</script>";
    }
    
    $conn->close();
?>
