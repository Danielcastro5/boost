<?php
session_start();
include("db.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $conexion->prepare("SELECT nombre, password FROM usuarios WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if ($password === $usuario["password"]) {
      $_SESSION["usuario"] = $usuario["nombre"];
      header("Location: bienvenida.php");
      exit();
    } else {
      $mensaje = "<div class='alert error'>Contraseña incorrecta.</div>";
    }
  } else {
    $mensaje = "<div class='alert error'>Correo no registrado.</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .fondo-login {
      background-image: url('img/imglogin.JPG');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .fondo-login::after {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1;
    }

    .formulario-login {
      position: relative;
      z-index: 2;
      background: #f2f2f2;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .formulario-login h2 {
      margin-bottom: 35px;
      color: #030347ff;
    }

    input {
      width: 80%;
      padding: 8px;
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
      background-color: #030347ff;
    }

    .alert.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .formulario-login a {
      display: block;
      margin-top: 10px;
      color: #030347ff;
      text-decoration: none;
    }

    .formulario-login a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="fondo-login">
  <div class="formulario-login">
    <h2><i class="fas fa-sign-in-alt"></i> Iniciar sesión</h2>
    <?= $mensaje ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>
    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
  </div>
</div>

</body>
</html>
