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
   <title>Tutorías Laborales</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --fondo: #F2F2F2;
      --barra: #030347ff;
      --submenu: #030347ff;
      --texto: #1f1f1f;
      --hover: #BEE3DB;
      --boton: #030347ff;
      --boton-hover: #030347ff;
    }
.boton-acceso {
  display: inline-block;
  background-color: #030347ff;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 16px;
  margin-top: 15px;
  transition: background 0.3s;
}

.boton-acceso:hover {
  background-color: #030347ff;
}

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--fondo);
      color: var(--texto);
    }

    header {
      background-color: var(--barra);
      color: white;
      padding: 3px 30px;
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
      top: 30px;
      left: 0;
      background-color: var(--submenu);
      border-radius: 5px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    nav ul ul li {
      width: 200px;
    }

    .contenido {
      margin-top: 60px;
      padding: 50px;
    }

    .grid-perfiles {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    .perfil {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      text-align: center;
      padding: 20px;
    }

    .perfil img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 8px;
    }

    .perfil h3 {
      margin: 15px 0 5px;
      color: var(--boton);
    }

    .perfil p {
      font-size: 14px;
      margin-bottom: 15px;
    }

    .perfil a {
      display: inline-block;
      background-color: var(--boton);
      color: white;
      padding: 8px 16px;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s;
    }

    .perfil a:hover {
      background-color: var(--boton-hover);
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><i class="fas fa-user-circle"></i> <?php echo $_SESSION["usuario"]; ?></div>
  <nav>
    <ul>
      <li><a href="bienvenida.php"><i class="fas fa-home"></i> Inicio</a></li>
      <li>
        <a href="#"><i class="fas fa-concierge-bell"></i> Servicios</a>
        <ul>
          <li><a href="psicologia.php"><i class="fas fa-brain"></i> Psicología y Terapias</a></li>
          <li><a href="finanzas.php"><i class="fa-solid fa-chart-simple"></i> Asesoria de Finanzas</a></li>
          <li><a href="educativas.php"><i class="fa-solid fa-book"></i> Tutorías Educativas</a></li>
          <li><a href="laborales.php"><i class="fa-solid fa-briefcase"></i> Tutorías Laborales</a></li>
        </ul>
      </li>
      <li>
        <a href="#"><i class="fas fa-user"></i> Perfil</a>
        <ul>
          <li><a href="editar.php"><i class="fa-solid fa-gears"></i> Editar datos</a></li>
        </ul>
      </li>
      <li><a href="cerrar.php"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
    </ul>
  </nav>
</header>

<div class="contenido">
  <h2>Asesores en Tutoría Laboral</h2>
  <div class="grid-perfiles">
    <div class="perfil">
      <img src="img/lf1.jpg" alt="Lic. Paula Restrepo">
      <h3>Lic. Paula Restrepo</h3>
      <p>Especialista en orientación vocacional y desarrollo de carrera profesional.</p>
      <a href="perfil.php?id=201">Ver perfil</a>
    </div>
    <div class="perfil">
      <img src="img/lm1.jpg" alt="Ing. Felipe Morales">
      <h3>Ing. Felipe Morales</h3>
      <p>Mentor en empleabilidad, entrevistas y hoja de vida para el sector tecnológico.</p>
      <a href="perfil.php?id=202">Ver perfil</a>
    </div>
    <div class="perfil">
      <img src="img/lf2.jpg" alt="Dra. Sandra Vélez">
      <h3>Dra. Sandra Vélez</h3>
      <p>Consultora en liderazgo, comunicación efectiva y habilidades blandas.</p>
      <a href="perfil.php?id=203">Ver perfil</a>
    </div>
    <div class="perfil">
      <img src="img/lm2.jpg" alt="Lic. Andrés Castaño">
      <div class="perfil">
      <h3>Lic. Andrés Castaño</h3>
      <p>Programador full-stack con experiencia en desarrollo web, bases de datos y asesoría técnica para transición laboral al sector tecnológico.</p>
      <a href="perfil.php?id=204">Ver perfil</a>
   </div>
  </div>
</div>

</body>
</html>
