<?php
include("db.php");

$nombre   = $_POST["nombre"];
$email    = $_POST["email"];
$password = $_POST["password"];



$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  echo "<div class='success-message'>Este correo ya está registrado. <a href='index.php'>Inicia sesión</a></div>";
  exit();
}

$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $password);
$stmt->execute();

echo "<div class='success-message'>¡Registro exitoso! Redirigiendo al login...</div>";
echo "<script>setTimeout(() => window.location.href='index.php', 2000);</script>";
?>
