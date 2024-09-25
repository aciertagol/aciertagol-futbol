<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Información</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Header con Logotipo y Navegación -->
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="images/logotipo.png" alt="Logotipo Fut6 Liga" class="h-12 mr-4">
                <h1 class="text-3xl font-bold">Fut6 Liga</h1>
            </div>

            <!-- Navegación -->
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="equipos.php" class="hover:underline">Equipos</a>
                <a href="jornadas.php" class="hover:underline">Jornadas</a>
                <a href="estadisticas.php" class="hover:underline">Estadísticas</a>
                <a href="informacion.php" class="hover:underline">Información</a>
                <a href="inscripción.php" class="hover:underline">Inscrpción</a>
            </nav>
        </div>
    </header>

    <!-- Sección de Información -->
    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold text-center mb-8">Información sobre la Fut6 Liga</h2>

        <!-- Descripción General -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-bold mb-4">Descripción General</h3>
            <p class="text-gray-700 mb-4">
                La **Fut6 Liga** es un torneo de fútbol 6 que reúne a los mejores equipos de la región en un emocionante
                campeonato. Nuestra liga está diseñada para fomentar la competitividad, el compañerismo y el amor por el
                deporte. Con un formato dinámico y apasionante, la Fut6 Liga es la oportunidad perfecta para que los
                equipos
                demuestren su talento.
            </p>
            <p class="text-gray-700">
                Cada temporada cuenta con múltiples jornadas, donde los equipos compiten entre sí, acumulando puntos
                para
                determinar al campeón. Además, los mejores jugadores son destacados por su rendimiento en cada jornada.
            </p>
        </div>

        <!-- Reglas del Torneo -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-bold mb-4">Reglas del Torneo</h3>
            <ul class="list-disc list-inside">
                <li class="text-gray-700 mb-2">
                    Cada equipo debe estar conformado por un mínimo de 6 jugadores y un máximo de 10 jugadores.
                </li>
                <li class="text-gray-700 mb-2">
                    Los partidos tienen una duración de 50 minutos, divididos en dos tiempos de 25 minutos cada uno.
                </li>
                <li class="text-gray-700 mb-2">
                    Cada equipo puede realizar hasta 3 cambios durante el partido.
                </li>
                <li class="text-gray-700 mb-2">
                    En caso de empate al final del tiempo reglamentario, se decidirá el partido mediante penales.
                </li>
                <li class="text-gray-700 mb-2">
                    Las tarjetas amarillas y rojas seguirán las reglas estándar del fútbol, con acumulación de
                    sanciones.
                </li>
            </ul>
        </div>

        <!-- Información sobre Inscripción -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-bold mb-4">Inscripción de Equipos</h3>
            <p class="text-gray-700 mb-4">
                La inscripción para participar en la Fut6 Liga está abierta para cualquier equipo que desee participar.
                Para
                inscribir a tu equipo, sigue los pasos que se indican a continuación:
            </p>
            <ol class="list-decimal list-inside mb-4">
                <li class="text-gray-700 mb-2">
                    Accede a la sección de inscripción en el menú principal.
                </li>
                <li class="text-gray-700 mb-2">
                    Completa el formulario de inscripción con los datos del equipo, incluyendo nombre, jugadores, y
                    capitán.
                </li>
                <li class="text-gray-700 mb-2">
                    Realiza el pago de la cuota de inscripción para asegurar tu lugar en el torneo.
                </li>
            </ol>
            <p class="text-gray-700">
                Para obtener más información sobre la inscripción, puedes visitar la página de <a
                    href="inscripcion_torneo.php" class="text-blue-600 hover:text-blue-800">Inscripción</a> o
                contactar con nosotros a través de nuestros canales de comunicación.
            </p>
        </div>

        <!-- Información de Contacto -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold mb-4">Contacto</h3>
            <p class="text-gray-700 mb-4">
                Si tienes alguna duda o consulta, no dudes en ponerte en contacto con el equipo organizador de la Fut6
                Liga.
            </p>
            <p class="text-gray-700"><strong>Teléfono:</strong> +34 123 456 789</p>
            <p class="text-gray-700"><strong>Email:</strong> contacto@fut6liga.com</p>
            <p class="text-gray-700"><strong>Redes Sociales:</strong></p>
            <ul class="list-none mt-2">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Facebook</a></li>
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Twitter</a></li>
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Instagram</a></li>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>