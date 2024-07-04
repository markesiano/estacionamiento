<?php
session_start();

// Comprobamos si ya hay una variable llamada "cliente" en la sesión
if(isset($_SESSION['cliente'])){
    // Si ya existe, redirigimos a la página principal
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script type="module" src="../javascript/firebaseConnector.js"></script>
    <script type="module" src="../javascript/login.js"></script>
    <link rel="stylesheet" href="../css/signupcss.css">
    <section class="formulario-iniciosesion">
        <h1>¡Bienvenido de nuevo!</h1>
        <form method="post" id="formulario-sesion">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" id="btn-login" value="Iniciar sesión">
        </form>
        <a href="signup.php">Crear una nueva cuenta</a>
    </section>
</body>
</html>