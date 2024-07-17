<?php
session_start();
include 'db_conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $evento_id = $_POST['evento_id'];

    $sql = "INSERT INTO registros (usuario_id, evento_id) VALUES ('$usuario_id', '$evento_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $evento_id = $_GET['id'];
    $sql = "SELECT * FROM eventos WHERE id='$evento_id'";
    $result = $conn->query($sql);
    $evento = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro a Evento</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro a Evento</h2>
        <h3><?php echo $evento['titulo']; ?></h3>
        <form method="POST" action="">
            <input type="hidden" name="evento_id" value="<?php echo $evento['id']; ?>">
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
