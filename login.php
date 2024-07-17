<?php
include 'db_conexion.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT id, nombre_usuario, nombre, email, contraseña, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['contraseña'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre_usuario'];
            $_SESSION['user_fullname'] = $user['nombre'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['rol'];

            header("Location: index.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Correo electrónico no registrado.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.active {
            display: block;
        }
        section {
            padding: 60px 0;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col items-center h-screen">
    <!-- Header con Menú Desplegable -->
    <header class="bg-gray-800 text-white w-full p-4 relative z-10">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <h2 class="text-xl font-bold">Plataforma de Eventos</h2>
            <nav class="hidden md:block">
                <ul class="flex space-x-4">
                    <li><a href="index.php#inicio" class="hover:text-gray-400">Inicio</a></li>
                    <li><a href="index.php#acerca" class="hover:text-gray-400">Acerca de</a></li>
                    <li><a href="index.php#contacto" class="hover:text-gray-400">Contacto</a></li>
                    <li class="relative dropdown">
                        <a href="#" class="hover:text-gray-400"><i class="fas fa-user-circle text-xl mr-2"></i>Perfil</a>
                        <ul id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg z-20">
                            <li><a href="registro.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-user-plus mr-2"></i>Registrarse</a></li>
                            <li><a href="login.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav class="md:hidden">
                <button id="mobile-menu-toggle" class="text-gray-400 hover:text-gray-300 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <ul id="mobile-menu" class="hidden md:flex md:flex-col md:space-y-2 bg-white text-gray-800 rounded-lg shadow-lg absolute right-0 mt-2 z-20">
                    <li><a href="index.html#inicio" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-home mr-2"></i>Inicio</a></li>
                    <li><a href="index.html#acerca" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-info-circle mr-2"></i>Acerca de</a></li>
                    <li><a href="index.html#contacto" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-envelope mr-2"></i>Contacto</a></li>
                    <li><a href="registro.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-user-circle mr-2"></i>Registrarse</a></li>
                    <li><a href="login.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-sign-in-alt mr-2"></i>Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="flex items-center justify-center h-screen -mt-16" style="background-image: url('images/inicio-bienvenida.jpg'); width: 100%; background-size: cover; background-repeat: no-repeat; height: 100%; width: 100%; padding: 230px 0;">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-4">
                <input type="email" name="email" placeholder="Correo electrónico" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                <input type="password" name="password" placeholder="Contraseña" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                <?php if (isset($error)): ?>
                    <div class="text-red-600"><?php echo $error; ?></div>
                <?php endif; ?>
                <select name="role" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="" disabled selected>Seleccione su rol</option>
                    <option value="organizador">Organizador</option>
                    <option value="asistente">Asistente</option>
                </select>
                <div class="flex justify-center">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Iniciar Sesión</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <button onclick="window.location.href='registro.php'" class="text-sm text-blue-500 hover:text-blue-600 focus:outline-none">¿No tienes una cuenta? Regístrate</button>
            </div>
        </div>
    </div>

    <!-- Enlazar el archivo JavaScript -->
    <script src="scripts/scripts.js"></script>
</body>
</html>
