<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "telecominventario";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL con consulta preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE NombreUsuario = ? AND Contrasena = ?");
    $stmt->bind_param("ss", $username, $password);

    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se encontraron coincidencias
    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $username;
        $stmt->close(); // Cerramos la consulta preparada

        // Redirige a la página principal con un saludo
        header("Location: pagina_principal.php?saludo=Hola, $username!");
        exit();
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }

    // Cerrar la consulta preparada
    $stmt->close();

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="login-box">
        <img class="avatar" src="logop.jpg" alt="logo">
        <h1>login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- USERNAME INPUT -->
            <label for="username">usuario</label>
            <input type="text" name="username" placeholder="usuario"> 
            <!-- PASSWORD INPUT -->
            <label for="password">contraseña</label>
            <input type="password" name="password" placeholder="contraseña">

            <input type="submit" value="log in">
            <a href="#">Lost your Password?</a>
            <a href="#">Don't have An account?</a>
        </form>

        <?php
            if (isset($error_message)) {
                echo "<p class='error'>$error_message</p>";
            }
        ?>
    </div>
</body>
</html>


