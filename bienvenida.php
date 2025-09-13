<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --fondo: #F2F2F2;
      --barra: #030347ff;
      --submenu: #030347ff;
      --texto: #1f1f1f;
      --hover: #F2F2F2;
      --boton: #030347ff;
      --boton-hover: #030347ff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--fondo);
      color: var(--texto);
    }

    header {
      background-color: var(--barra);
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 60px;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .logo {
      font-size: 20px;
      font-weight: bold;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    nav ul li {
      position: relative;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      padding: 8px;
      display: block;
      transition: background 0.3s;
    }

    nav a:hover {
      background-color: var(--hover);
      color: var(--texto);
      border-radius: 5px;
    }

    nav ul li:hover > ul {
      display: block;
    }

    nav ul ul {
      display: none;
      position: absolute;
      top: 35px;
      left: 0;
      background-color: var(--submenu);
      border-radius: 5px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    nav ul ul li {
      width: 200px;
    }

    .pantalla-imagen {
      background-image: url('img/imagen-bienvenida.JPG');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .pantalla-imagen::after {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.4);
      z-index: 1;
    }

    .contenido-superpuesto {
      position: relative;
      z-index: 2;
      color: white;
      text-align: center;
      padding: 20px;
    }

    .contenido-superpuesto h1 {
      font-size: 48px;
      margin-bottom: 10px;
    }

    .contenido-superpuesto p {
      font-size: 20px;
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><i class="fas fa-user-circle"></i> Bienvenido, <?php echo $_SESSION["usuario"]; ?></div>
  <nav>
    <ul>
      <li><a href="bienvenida.php"><i class="fas fa-home"></i> Inicio</a></li>
      <li>
        <a href="#"><i class="fas fa-concierge-bell"></i> Servicios</a>
        <ul>
          <li><a href="psicologia.php"><i class="fas fa-brain"></i> Psicología y Terapias</a></li>
           <li><a href="finanzas.php"><i class="fa-solid fa-chart-simple"></i> Asesoria de finanzas</a></li>
          <li><a href="educativas.php"><i class="fa-solid fa-book"></i> Tutorías educativas</a></li>
          <li><a href="laborales.php"><i class="fa-solid fa-briefcase"></i> Tutorías Laborales</a></li>
        </ul>
      </li>
      <li>
        <a href="#"><i class="fas fa-user"></i> Perfil</a>
        <ul>
          <li><a href="editar.php"><i class="fa-solid fa-gears"></i>Editar datos</a></li>
        </ul>
      </li>
      <li><a href="cerrar.php"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
    </ul>
  </nav>
</header>

<div class="pantalla-imagen">
  <div class="contenido-superpuesto">
    <div class="formulario">

  </a>
</div>

    <h1>Bienvenido a BOOST</h1>
    <p>Trabajando para mejorar tu vida</p>
  </div>
</div>

</body>
</html>
