<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
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
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h2 class="text-xl font-bold md:text-2xl">Plataforma de Eventos</h2>
            <nav class="hidden md:block"> <!-- Oculta en dispositivos móviles -->
                <ul class="flex space-x-4">
                    <li><a href="#inicio" class="hover:text-gray-400">Inicio</a></li>
                    <li><a href="#acerca" class="hover:text-gray-400">Acerca de</a></li>
                    <li><a href="#contacto" class="hover:text-gray-400">Contacto</a></li>
                    <li class="relative dropdown">
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="#" class="hover:text-gray-400"><i class="fas fa-user-circle text-xl mr-2"></i><?php echo $_SESSION['user_name']; ?></a>
                    <ul id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg z-20">
                    <?php if ($_SESSION['user_role'] === 'organizador'): ?>
                   <li><a href="crear_evento.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-plus-circle mr-2"></i>Crear Evento</a></li>
                   <?php else: ?>
                   <li><a href="ver_eventos.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-calendar-alt mr-2"></i>Ver Eventos Disponibles</a></li>
                   <?php endif; ?>
                   <li><a href="perfil.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-user-edit mr-2"></i>Editar Perfil</a></li>
                  <li><a href="logout.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión</a></li>
                   </ul>
                   <?php else: ?>
                   <a href="#" class="hover:text-gray-400"><i class="fas fa-user-circle text-xl mr-2"></i>Perfil</a>
                   <ul id="dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg z-20">
                   <li><a href="registro.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-user-plus mr-2"></i>Registrarse</a></li>
                     <li><a href="login.php" class="block px-4 py-2 hover:bg-gray-200 text-center"><i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión</a></li>
                     </ul>
                     <?php endif; ?>

                    </li>
                </ul>
            </nav>
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
        
        <!-- para mostrar opciones según el rol -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['user_role'] === 'organizador'): ?>
                <li><a href="crear_evento.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-plus-circle mr-2"></i>Crear Evento</a></li>
            <?php else: ?>
                <li><a href="ver_eventos.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-calendar-alt mr-2"></i>Ver Eventos Disponibles</a></li>
            <?php endif; ?>
            <li><a href="logout.php" class="block px-4 py-2 hover:bg-gray-200"><i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión</a></li>
        <?php else: ?>
            <li><a href="registro.html" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-user-circle mr-2"></i>Registrarse</a></li>
            <li><a href="login.html" class="block px-4 py-2 hover:bg-gray-200"><i class="fa fa-sign-in-alt mr-2"></i>Iniciar Sesión</a></li>
        <?php endif; ?>
    </ul>
</nav>

        </div>
    </header>

    <style>
        /* Estilos adicionales para asegurar que el menú desplegable se muestre correctamente */
        .dropdown-menu {
            z-index: 20; /* Asegura que el menú desplegable tenga una capa superior */
        }
    </style>

    <!-- Sección de Bienvenida -->
    <section id="inicio" class="relative bg-cover bg-center" style="background-image: url('images/inicio-bienvenida.jpg'); height: calc(100vh + 200px); width: 100%; background-size: cover; background-repeat: no-repeat; padding: 180px 0;">
        <h1 class="text-7xl font-bold text-center mb-4">Bienvenido a nuestra plataforma de eventos</h1>
        <p class="text-3xl text-gray-700 font-bold leading-relaxed text-center">
            En nuestra plataforma, podrás descubrir y participar en una amplia variedad de eventos emocionantes. Desde conferencias educativas hasta conciertos en vivo y talleres creativos, tenemos algo para todos los intereses y pasiones. Únete a nuestra comunidad y explora eventos únicos organizados por expertos en sus campos, donde también podrás organizarlos tú mismo.
        </p>

        <div class="container mx-auto mt-8 px-4">
            <div class="flex justify-center space-x-4 ">
                <div class="relative w-1/3 p-4 rounded-lg shadow-md overflow-hidden" style="height: 400px;">
                    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url(images/video-conferencias.jpg);"></div>
                    <div class="absolute inset-0 bg-gray-800 opacity-90"></div>
                    <div class="relative z-10">
                        <h2 class="text-xl font-bold mb-2 text-center text-white">Conferencia Virtual</h2>
                        <p class="text-gray-200 text-center">Únete a nuestra conferencia virtual sobre tecnología emergente. Aprende de expertos y conecta con profesionales de todo el mundo.</p>
                        <p class="text-gray-200 text-center mt-2 font-bold">Fecha: 20 de Julio, 2024</p>
                        <p class="text-gray-200 text-center font-bold">Hora: 10:00 AM</p>
                        <p class="text-gray-200 text-center font-bold">Lugar: Zoom</p>
                        <p class="text-gray-200 text-center font-bold">Capacidad: 100 personas</p>
                        <div class="flex justify-center mt-4">
                            <button id="btnAsistir1" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Asistir</button>
                        </div>
                    </div>
                </div>

                <div class="relative w-1/3 p-4 rounded-lg shadow-md overflow-hidden" style="height: 400px;">
                    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url(images/concierto.gif);"></div>
                    <div class="absolute inset-0 bg-gray-800 opacity-90"></div>
                    <div class="relative z-10">
                        <h2 class="text-xl font-bold mb-2 text-center text-white">Concierto en Vivo</h2>
                        <p class="text-gray-200 text-center">Disfruta de un concierto en vivo con tus artistas favoritos. Baila, canta y vive una experiencia musical inolvidable.</p>
                        <p class="text-gray-200 text-center mt-2 font-bold">Fecha: 25 de Julio, 2024</p>
                        <p class="text-gray-200 text-center font-bold">Hora: 8:00 PM</p>
                        <p class="text-gray-200 text-center font-bold">Lugar: Teatro Principal</p>
                        <p class="text-gray-200 text-center font-bold">Capacidad: 500 personas</p>
                        <div class="flex justify-center mt-4">
                            <button id="btnAsistir2" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Asistir</button>
                        </div>
                    </div>
                </div>

                <div class="relative w-1/3 p-4 rounded-lg shadow-md overflow-hidden" style="height: 400px;">
                    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url(images/Taller-de-Fotografía.jpg);"></div>
                    <div class="absolute inset-0 bg-gray-800 opacity-90"></div>
                    <div class="relative z-10">
                        <h2 class="text-xl font-bold mb-2 text-center text-white">Taller de Fotografía</h2>
                        <p class="text-gray-200 text-center">Explora tu creatividad en nuestro taller de fotografía. Aprende técnicas avanzadas y mejora tus habilidades fotográficas.</p>
                        <p class="text-gray-200 text-center mt-2 font-bold">Fecha: 30 de Julio, 2024</p>
                        <p class="text-gray-200 text-center font-bold">Hora: 2:00 PM</p>
                        <p class="text-gray-200 text-center font-bold">Lugar: Centro Cultural</p>
                        <p class="text-gray-200 text-center font-bold">Capacidad: 50 personas</p>
                        <div class="flex justify-center mt-4">
                            <button id="btnAsistir3" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Asistir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Acerca de -->
    <section id="acerca" class="relative bg-cover bg-center opacity-90" style="background-image: url('images/about-us3.jpg'); height: 100%; width: 100%; padding: 180px 0;">
        <h1 class="text-6xl font-bold text-center mb-4 pt-6">Acerca de nosotros</h1>
        <p class="text-gray-700 font-bold leading-relaxed px-4 text-4xl text-center">
            Esta plataforma de eventos está diseñada para proporcionar una experiencia única a nuestros usuarios, permitiendo la organización y gestión eficiente de eventos.
        </p>
    </section>

    <!-- Sección Contacto -->
    <section id="contacto" class="form_wrap bg-gray-100 p-8" style="padding: 230px 0;">
        <section class="contact_info relative bg-cover bg-center" style="background-image: url('images/fondo.jpg');">
            <div class="absolute inset-0 bg-blue-500 opacity-80 text-white rounded-lg shadow-lg p-6 flex flex-col justify-center items-center">
                <div class="flex items-center mb-4">
                    <span class="fa fa-user-circle text-4xl"></span>
                    <h2 class="ml-4 text-2xl font-bold text-center">INFORMACION<br>DE CONTACTO</h2>
                </div>
                <div class="info_items text-center">
                    <p><span class="fa fa-envelope"></span> info.contact@gmail.com</p>
                    <p><span class="fa fa-mobile"></span> +591 60000233</p>
                </div>
            </div>
        </section>

        <form action="" class="form_contact bg-white rounded-lg shadow-lg p-6 mt-4">
            <h2 class="text-2xl font-bold mb-4">Envía un mensaje</h2>
            <div class="user_info grid grid-cols-1 md:grid-cols-2 gap-4">
                <label for="names" class="block">
                    Nombres *
                    <input type="text" id="names" class="form-input mt-1 block w-full">
                </label>
                <label for="phone" class="block">
                    Teléfono / Celular
                    <input type="text" id="phone" class="form-input mt-1 block w-full">
                </label>
                <label for="email" class="block">
                    Correo electrónico *
                    <input type="text" id="email" class="form-input mt-1 block w-full">
                </label>
                <label for="mensaje" class="block col-span-2">
                    Mensaje *
                    <textarea id="mensaje" class="form-textarea mt-1 block w-full"></textarea>
                </label>
            </div>

            <input type="button" value="Enviar Mensaje" id="btnSend" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg cursor-pointer">
        </form>
    </section>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 flex justify-center">
            <p>&copy; 2024 Tu Página Web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Enlazar el archivo JavaScript -->
    <script src="scripts/scripts.js"></script>

</body>
</html>
