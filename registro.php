<?php
include("db.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre   = $_POST["nombre"];
  $email    = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $mensaje = "<div class='alert error'>Este correo ya está registrado.</div>";
  } else {
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password);
    $stmt->execute();
    $mensaje = "<div class='alert success'>¡Registro exitoso! Puedes iniciar sesión ahora.</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .fondo-registro {
      background-image: url('img/imglogin.JPG'); /* Cambia por tu imagen */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .fondo-registro::after {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1;
    }

    .formulario-registro {
      position: relative;
      z-index: 2;
      background: #f2f2f2;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .formulario-registro h2 {
      margin-bottom: 35px;
      color: #030347ff;
    }

    input {
      width: 80%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: #030347ff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      width: 85%;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2f438f;
    }

    .alert.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .alert.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .formulario-registro a {
      display: block;
      margin-top: 10px;
      color: #384fa4;
      text-decoration: none;
    }

    .formulario-registro a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="fondo-registro">
  <div class="formulario-registro">
    <h2><i class="fas fa-user-plus"></i> Crear cuenta</h2>
    <?= $mensaje ?>
    <form method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Registrarse</button>
    </form>
    <a href="index.php">¿Ya tienes cuenta? Inicia sesión</a>
  </div>
</div>

</body>
</html>
