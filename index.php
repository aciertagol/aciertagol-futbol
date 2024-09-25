<?php
session_start(); // Inicia la sesión

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Header con Logotipo y Navegación -->
    <header class="bg-blue-600 text-white p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logotipo -->
            <div class="flex items-center">
                <img src="images/logotipo.png" alt="Logotipo Fut6 Liga" class="h-12 mr-4">
                <h1 class="text-3xl font-bold hover:text-blue-300 transition duration-300">Fut6 Liga</h1>
            </div>

            <!-- Navegación -->
            <nav class="space-x-4 hidden md:flex">
                <a href="index.php" class="hover:text-blue-300 transition duration-300">Inicio</a>
                <a href="equipos.php" class="hover:text-blue-300 transition duration-300">Equipos</a>
                <a href="jornadas.php" class="hover:text-blue-300 transition duration-300">Jornadas</a>
                <a href="estadisticas.php" class="hover:text-blue-300 transition duration-300">Estadísticas</a>
                <a href="informacion.php" class="hover:text-blue-300 transition duration-300">Información</a>
                <a href="inscripcion_torneo.php" class="hover:text-blue-300 transition duration-300">Inscripción</a>
                <!-- Enlace corregido -->

                <!-- Mostrar "Iniciar Sesión" o "Cerrar Sesión" basado en la autenticación -->
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="hover:text-blue-300 transition duration-300">Cerrar Sesión</a>
                <?php else: ?>
                <a href="login.php" class="hover:text-blue-300 transition duration-300">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>

            <!-- Menú móvil -->
            <button id="menuToggle" class="md:hidden text-2xl focus:outline-none">&#9776;</button>
        </div>
    </header>

    <!-- Menú móvil desplegable -->
    <div id="mobileMenu" class="bg-blue-600 text-white md:hidden p-4 hidden">
        <a href="index.php" class="block py-2 hover:text-blue-300">Inicio</a>
        <a href="equipos.php" class="block py-2 hover:text-blue-300">Equipos</a>
        <a href="jornadas.php" class="block py-2 hover:text-blue-300">Jornadas</a>
        <a href="estadisticas.php" class="block py-2 hover:text-blue-300">Estadísticas</a>
        <a href="informacion.php" class="block py-2 hover:text-blue-300">Información</a>
        <a href="inscripcion_torneo.php" class="block py-2 hover:text-blue-300">Inscripción</a>
        <!-- Enlace corregido -->

        <!-- Mostrar "Iniciar Sesión" o "Cerrar Sesión" en el menú móvil -->
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="block py-2 hover:text-blue-300">Cerrar Sesión</a>
        <?php else: ?>
        <a href="login.php" class="block py-2 hover:text-blue-300">Iniciar Sesión</a>
        <?php endif; ?>
    </div>

    <!-- Sección de Hero con Carrusel y Noticias Destacadas -->
    <section id="inicio" class="relative h-screen bg-cover bg-center"
        style="background-image: url('images/hero_futbol.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative container mx-auto h-full flex flex-col justify-center text-white text-center">
            <h2 class="text-4xl font-bold mb-4">¡Bienvenidos a la Fut6 Liga!</h2>
            <p class="text-lg mb-8">La liga donde el fútbol 6 hace historia.</p>
            <a href="informacion.php"
                class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-400 transition duration-300">Descubre más</a>
        </div>
    </section>

    <!-- Sección de Videos Destacados -->
    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-4 text-center">Videos Destacados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-4 shadow-md">
                <iframe class="w-full h-56" src="https://www.youtube.com/embed/VIDEO_ID1" frameborder="0"
                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <h3 class="mt-4 text-xl font-bold">Resumen del Partido A vs B</h3>
            </div>
            <div class="bg-white p-4 shadow-md">
                <iframe class="w-full h-56" src="https://www.youtube.com/embed/VIDEO_ID2" frameborder="0"
                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <h3 class="mt-4 text-xl font-bold">Goles más Destacados</h3>
            </div>
            <div class="bg-white p-4 shadow-md">
                <iframe class="w-full h-56" src="https://www.youtube.com/embed/VIDEO_ID3" frameborder="0"
                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <h3 class="mt-4 text-xl font-bold">Entrevista al Goleador del Torneo</h3>
            </div>
        </div>
    </section>

    <!-- Sección de Próximos Partidos -->
    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-4 text-center">Próximos Partidos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Tarjetas dinámicas de partidos -->
            <div
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105">
                <h3 class="text-xl font-bold mb-2">Equipo A vs Equipo B</h3>
                <p class="text-gray-700">Fecha: 21 de septiembre 2024</p>
                <p class="text-gray-700">Hora: 18:00</p>
                <a href="#" class="text-blue-600 hover:text-blue-800">Ver más detalles</a>
            </div>

            <div
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105">
                <h3 class="text-xl font-bold mb-2">Equipo C vs Equipo D</h3>
                <p class="text-gray-700">Fecha: 22 de septiembre 2024</p>
                <p class="text-gray-700">Hora: 16:00</p>
                <a href="#" class="text-blue-600 hover:text-blue-800">Ver más detalles</a>
            </div>

            <div
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 transform hover:scale-105">
                <h3 class="text-xl font-bold mb-2">Equipo E vs Equipo F</h3>
                <p class="text-gray-700">Fecha: 23 de septiembre 2024</p>
                <p class="text-gray-700">Hora: 20:00</p>
                <a href="#" class="text-blue-600 hover:text-blue-800">Ver más detalles</a>
            </div>
        </div>
    </section>

    <!-- Sección de Patrocinadores -->
    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-4 text-center">Nuestros Patrocinadores</h2>
        <div class="overflow-hidden">
            <div class="flex animate-slide">
                <!-- Logos de los patrocinadores -->
                <div class="flex-shrink-0 mx-4">
                    <img src="images/patrocinador1.png" alt="Patrocinador 1" class="h-24">
                </div>
                <div class="flex-shrink-0 mx-4">
                    <img src="images/patrocinador2.png" alt="Patrocinador 2" class="h-24">
                </div>
                <div class="flex-shrink-0 mx-4">
                    <img src="images/patrocinador3.png" alt="Patrocinador 3" class="h-24">
                </div>
                <div class="flex-shrink-0 mx-4">
                    <img src="images/patrocinador4.png" alt="Patrocinador 4" class="h-24">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>

    <script>
    // Lógica del menú móvil
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    </script>
</body>

</html>