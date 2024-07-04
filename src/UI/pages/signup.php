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
  <script type="module" src="../javascript/signup.js"></script>
  <link rel="stylesheet" href="../css/signupcss.css">

    <section class="formulario-crearcuenta">
    <h1>Crear una nueva cuenta</h1>
    <form id="formulario-crear">
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" required><br><br>
      
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required><br><br>

      <label for="name" >Nombre:</label>
      <input type="text" id="name" name="name" required><br><br>

      <label for="tipo">Carro:</label>
      <input type="text" id="tipo" name="tipo" required><br><br>

      <label for="placa">Placa</label>
      <input type="text" id="placa" name="placa" required><br><br>

      
      <input type="submit"  value="Registrarse">
    </form>
    <a href="login.php">¡Ya tengo una cuenta!</a>
  </section>
</body>
</html>