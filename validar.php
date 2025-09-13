<?php
session_start();
include("db.php");

$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conexion->prepare("SELECT nombre, password FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
  $usuario = $resultado->fetch_assoc();
  if (password_verify($password, $usuario["password"])) {
    $_SESSION["usuario"] = $usuario["nombre"];
    header("Location: bienvenida.php");
    exit();
  } else {
    echo "<div class='alert error'>Contraseña incorrecta.</div>";
  }
} else {
  echo "<div class='alert error'>Correo no registrado.</div>";
}
?>
