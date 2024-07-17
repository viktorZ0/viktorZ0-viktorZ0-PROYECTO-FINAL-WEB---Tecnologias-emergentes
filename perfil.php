<?php
session_start();
require_once 'db_conexion.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$rol = $_SESSION['rol'];


try {

    $pdo = new PDO($dsn, $username, $password, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener los eventos creados por el usuario (si es organizador)
    $eventos = [];
    if ($rol === 'organizador') {
        $sql = "SELECT * FROM eventos WHERE organizador_id = :organizador_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':organizador_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Gestión de Eventos</h1>
        <nav class="md:hidden"> <!-- Visible solo en dispositivos móviles -->
            <button id="mobile-menu-toggle" class="text-gray-400 hover:text-gray-300 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <ul id="mobile-menu" class="hidden md:flex md:flex-col md:space-y-2 bg-white text-gray-800 rounded-lg shadow-lg absolute right-0 mt-2 z-20">
                <li><a href="#inicio" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-home mr-2"></i>Inicio</a></li>
                <li><a href="#acerca" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-info-circle mr-2"></i>Acerca de</a></li>
                <li><a href="#contacto" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-envelope mr-2"></i>Contacto</a></li>
                <li><a href="registro.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-user-circle mr-2"></i>Registrarse</a></li>
                <li><a href="login.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-sign-in-alt mr-2"></i>Iniciar Sesión</a></li>
            </ul>
        </nav>
        <ul class="hidden md:flex space-x-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="relative dropdown">
                    <a href="#" class="hover:text-gray-400"><i class="fas fa-user-circle text-xl mr-2"></i><?php echo $_SESSION['user_name']; ?></a>
                    <ul id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg z-20">
                        <?php if ($_SESSION['rol'] === 'organizador'): ?>
                            <li><a href="crear_evento.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-plus-circle mr-2"></i>Crear Evento</a></li>
                        <?php else: ?>
                            <li><a href="ver_eventos.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-calendar-alt mr-2"></i>Ver Eventos Disponibles</a></li>
                        <?php endif; ?>
                        <li><a href="perfil.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-user-edit mr-2"></i>Editar Perfil</a></li>
                        <li><a href="logout.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <li><a href="registro.php" class="hover:text-gray-400"><i class="fas fa-user-plus text-xl mr-2"></i>Registrarse</a></li>
                <li><a href="login.php" class="hover:text-gray-400"><i class="fas fa-sign-in-alt text-xl mr-2"></i>Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </header>

    <main class="p-4">
        <h2 class="text-2xl font-bold mb-4">Perfil de Usuario</h2>
        <div class="mb-4">
            <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['nombre_usuario']); ?></p>
            <p><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <?php if ($user['foto_perfil']): ?>
                <p><strong>Foto de Perfil:</strong></p>
                <img src="<?php echo htmlspecialchars($user['foto_perfil']); ?>" alt="Foto de Perfil" class="w-32 h-32 object-cover rounded-full">
            <?php endif; ?>
        </div>

        <?php if ($rol === 'organizador'): ?>
            <h3 class="text-xl font-bold mb-4">Eventos Creados</h3>
            <?php if (count($eventos) > 0): ?>
                <ul>
                    <?php foreach ($eventos as $evento): ?>
                        <li><?php echo htmlspecialchars($evento['titulo']); ?> - <?php echo htmlspecialchars($evento['fecha']); ?> - <?php echo htmlspecialchars($evento['lugar']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No has creado ningún evento.</p>
            <?php endif; ?>
        <?php endif; ?>

        <button id="edit-profile-btn" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Editar Perfil</button>

        <div id="edit-profile-form" class="hidden mt-4">
            <form action="editar_perfil.php" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nombre_usuario" class="block text-gray-700">Nombre de Usuario:</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>">
                </div>
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700">Nombre Completo:</label>
                    <input type="text" name="nombre" id="nombre" class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['nombre']); ?>">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="mb-4">
                    <label for="contraseña" class="block text-gray-700">Contraseña:</label>
                    <input type="password" name="contraseña" id="contraseña" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="foto_perfil" class="block text-gray-700">Foto de Perfil:</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('edit-profile-btn').addEventListener('click', function() {
            document.getElementById('edit-profile-form').classList.toggle('hidden');
        });
    </script>
</body>
</html>
