<?php
// db_conexion.php

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "gestion_eventos";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);
/*
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
else {
    echo "Conexión exitosa";
}
?>
*/