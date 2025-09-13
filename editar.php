<?php
session_start();
include("db.php");

$mensaje = "";
$usuario = $_SESSION["usuario"] ?? null;

if (!$usuario) {
  header("Location: index.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre   = $_POST["nombre"];
  $email    = $_POST["email"];
  $actual   = $_POST["actual"];
  $nueva    = $_POST["nueva"];
  $tarjeta  = $_POST["tarjeta"];
  $expira   = $_POST["expira"];
  $cvv      = $_POST["cvv"];

  $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE nombre = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $datos = $resultado->fetch_assoc();

  if (!$datos || !isset($datos["password"])) {
    $mensaje = "<div class='alert error'>No se pudo verificar la contraseña actual.</div>";
  } else {
    if (!empty($actual) && !empty($nueva)) {
      if ($actual === $datos["password"]) {
        $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE nombre = ?");
        $stmt->bind_param("ss", $nueva, $usuario);
        $stmt->execute();
      } else {
        $mensaje = "<div class='alert error'>La contraseña actual no coincide. No se realizaron cambios.</div>";
      }
    }

    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE nombre = ?");
    $stmt->bind_param("sss", $nombre, $email, $usuario);
    $stmt->execute();

    $stmt = $conexion->prepare("UPDATE usuarios SET tarjeta = ?, expira = ?, cvv = ? WHERE nombre = ?");
    $stmt->bind_param("ssss", $tarjeta, $expira, $cvv, $nombre);
    $stmt->execute();

    $_SESSION["usuario"] = $nombre;
    if (empty($mensaje)) {
      $mensaje = "<div class='alert success'>Cambios guardados correctamente.</div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar perfil</title>
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
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
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

    .contenido {
      margin-top: 80px;
      padding: 40px;
      display: flex;
      justify-content: center;
    }

    .formulario {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 600px;
    }

    h2 {
      text-align: center;
      color: var(--boton);
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: var(--boton);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: var(--boton-hover);
    }

    .alert {
      max-width: 600px;
      margin: 20px auto;
      padding: 15px 25px;
      border-radius: 8px;
      font-size: 16px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      font-weight: 500;
    }

    .alert.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .alert.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
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
          <li><a href="editar.php">Editar datos</a></li>
         
        </ul>
      </li>
      <li><a href="cerrar.php"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
    </ul>
  </nav>
</header>

<div class="contenido">
  <div class="formulario">
    <h2><i class="fas fa-user-edit"></i> Editar perfil</h2>
    <?= $mensaje ?>
    <form method="POST">
      <label>Nombre completo</label>
       <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" required>

      <label>Correo electrónico</label>
      <input type="email" name="email" id="email" placeholder="Tu correo" required>

      <label>Contraseña actual</label>
      <input type="password" name="actual" id="actual" placeholder="Contraseña actual"required>

      <label>Nueva contraseña</label>
      <input type="password" name="nueva" id="nueva" placeholder="Nueva contraseña"required>

      <label>Número de tarjeta</label>
     <input type="text" name="tarjeta" id="tarjeta" placeholder="XXXX XXXX XXXX XXXX">

      <label>Fecha de expiración</label>
      <input type="text" name="expira" id="expira" placeholder="MM/AA">

      <label>CVV</label>
      <input type="text" name="cvv" placeholder="Ej: 123">

      <button type="submit"><i class="fas fa-save"></i> Guardar cambios</button>
    </form>
  </div>
</div>

<script>
  
  document.getElementById("expira").addEventListener("input", function(e) {
    let val = e.target.value.replace(/\D/g, "");
    if (val.length >= 2 && val.length <= 4) {
      e.target.value = val.slice(0, 2) + "/" + val.slice(2);
    } else {
      e.target.value = val;
    }
  });
</script>

</body>
</html>
