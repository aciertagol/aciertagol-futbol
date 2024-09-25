<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Consulta para obtener estadísticas de equipos
$queryEquipos = $pdo->query('SELECT nombre, partidos_jugados, goles_favor, goles_contra, victorias FROM equipos');
$equipos = $queryEquipos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener estadísticas de jugadores
$queryJugadores = $pdo->query('SELECT nombre, equipo, goles, asistencias, tarjetas_amarillas, tarjetas_rojas FROM jugadores');
$jugadores = $queryJugadores->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los máximos goleadores
$queryGoleadores = $pdo->query('SELECT nombre, equipo, goles FROM jugadores ORDER BY goles DESC LIMIT 5');
$goleadores = $queryGoleadores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Estadísticas</title>
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

    <!-- Sección de Estadísticas -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Estadísticas</h2>
        <p>Consulta las estadísticas de los equipos, jugadores y goleadores.</p>

        <!-- Estadísticas de Equipos -->
        <div class="mt-6">
            <h3 class="text-xl font-bold mb-4">Estadísticas de Equipos</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($equipos as $equipo): ?>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <h4 class="text-lg font-bold mb-2"><?= htmlspecialchars($equipo['nombre']); ?></h4>
                    <p>Partidos jugados: <?= htmlspecialchars($equipo['partidos_jugados']); ?></p>
                    <p>Goles a favor: <?= htmlspecialchars($equipo['goles_favor']); ?></p>
                    <p>Goles en contra: <?= htmlspecialchars($equipo['goles_contra']); ?></p>
                    <p>Victorias: <?= htmlspecialchars($equipo['victorias']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Estadísticas de Jugadores -->
        <div class="mt-12">
            <h3 class="text-xl font-bold mb-4">Estadísticas de Jugadores</h3>
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Equipo</th>
                            <th class="px-4 py-2">Goles</th>
                            <th class="px-4 py-2">Asistencias</th>
                            <th class="px-4 py-2">Tarjetas Amarillas</th>
                            <th class="px-4 py-2">Tarjetas Rojas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jugadores as $jugador): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['nombre']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['equipo']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['goles']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['asistencias']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['tarjetas_amarillas']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($jugador['tarjetas_rojas']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Máximos Goleadores -->
        <div class="mt-12">
            <h3 class="text-xl font-bold mb-4">Máximos Goleadores</h3>
            <ul class="bg-white p-6 rounded-lg shadow-md">
                <?php foreach ($goleadores as $goleador): ?>
                <li class="mb-2">
                    <span class="font-bold"><?= htmlspecialchars($goleador['nombre']); ?></span>
                    (<?= htmlspecialchars($goleador['equipo']); ?>) - <?= htmlspecialchars($goleador['goles']); ?> goles
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>