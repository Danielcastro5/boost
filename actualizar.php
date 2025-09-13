<?php
session_start();
include("db.php");

$nombre   = $_POST["nombre"];
$email    = $_POST["email"];
$actual   = $_POST["actual"];
$nueva    = $_POST["nueva"];
$tarjeta  = $_POST["tarjeta"];
$expira   = $_POST["expira"];
$cvv      = $_POST["cvv"];

// Obtener usuario actual
$usuario = $_SESSION["usuario"];
$stmt = $conexion->prepare("SELECT password FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();

// Validar contraseña si se quiere cambiar
if (!empty($actual) && !empty($nueva)) {
  if ($actual === $datos["password"]) {
    $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE nombre = ?");
    $stmt->bind_param("ss", $nueva, $usuario);
    $stmt->execute();
  } else {
    echo "<div class='alert error'>Contraseña actual incorrecta.</div>";
    exit();
  }
}

// Actualizar nombre y correo
$stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE nombre = ?");
$stmt->bind_param("sss", $nombre, $email, $usuario);
$stmt->execute();

// Guardar tarjeta
$stmt = $conexion->prepare("UPDATE usuarios SET tarjeta = ?, expira = ?, cvv = ? WHERE nombre = ?");
$stmt->bind_param("ssss", $tarjeta, $expira, $cvv, $nombre);
$stmt->execute();

// Actualizar sesión
$_SESSION["usuario"] = $nombre;

// Confirmación visual y redirección
echo "<div class='alert success'>Cambios guardados correctamente. Redirigiendo...</div>";
echo "<script>setTimeout(() => window.location.href='bienvenida.php', 2000);</script>";
?>
