<?php
session_start();
include 'db_conexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'organizador') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $lugar = $_POST['lugar'];
    $capacidad = $_POST['capacidad'];
    $organizador_id = $_SESSION['user_id'];

    $sql = "INSERT INTO eventos (titulo, descripcion, fecha, hora, lugar, capacidad, organizador_id) 
            VALUES ('$titulo', '$descripcion', '$fecha', '$hora', '$lugar', '$capacidad', '$organizador_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Evento creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Crear Evento</h2>
        <form method="POST" action="">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="date" name="fecha" required>
            <input type="time" name="hora" required>
            <input type="text" name="lugar" placeholder="Lugar" required>
            <input type="number" name="capacidad" placeholder="Capacidad Máxima" required>
            <button type="submit">Crear Evento</button>
        </form>
    </div>
</body>
</html>
