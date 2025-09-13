<?php
$conexion = new mysqli("localhost", "root", "basquet123", "sistema_seguro");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}
?>