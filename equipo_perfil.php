<?php
// Obtener los detalles del equipo por ID
$equipo_id = $_GET['id'];
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');
$query = $pdo->prepare('SELECT * FROM equipos WHERE id = ?');
$query->execute([$equipo_id]);
$equipo = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Equipo - <?= htmlspecialchars($equipo['nombre']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Header con Logotipo y Navegación -->
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="images/logotipo.png" alt="Logotipo Fut6 Liga" class="h-12 mr-4">
                <h1 class="text-3xl font-bold">Perfil de Equipo</h1>
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

    <!-- Perfil de Equipo -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($equipo['nombre']); ?></h2>
        <img src="images/equipos/<?= htmlspecialchars($equipo['imagen']); ?>"
            alt="Escudo del equipo <?= htmlspecialchars($equipo['nombre']); ?>" class="h-32 mb-4">
        <p>Entrenador: <?= htmlspecialchars($equipo['entrenador']); ?></p>
        <p>Número de jugadores: <?= htmlspecialchars($equipo['numero_jugadores']); ?></p>
        <p>Descripción del equipo: <?= htmlspecialchars($equipo['descripcion']); ?></p>

        <!-- Mostrar estadísticas del equipo -->
        <h3 class="text-xl font-bold mt-4">Estadísticas</h3>
        <p>Goles anotados: <?= htmlspecialchars($equipo['goles_anotados']); ?></p>
        <p>Goles recibidos: <?= htmlspecialchars($equipo['goles_recibidos']); ?></p>
        <p>Partidos ganados: <?= htmlspecialchars($equipo['partidos_ganados']); ?></p>
        <p>Partidos empatados: <?= htmlspecialchars($equipo['partidos_empatados']); ?></p>
        <p>Partidos perdidos: <?= htmlspecialchars($equipo['partidos_perdidos']); ?></p>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>