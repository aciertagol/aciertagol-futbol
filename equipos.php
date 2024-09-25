<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Obtener la búsqueda del usuario si existe
$search = $_GET['search'] ?? '';

// Modificar la consulta de equipos para incluir búsqueda
$query = $pdo->prepare('SELECT * FROM equipos WHERE nombre LIKE ?');
$query->execute(["%$search%"]);
$equipos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Equipos</title>
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
                <a href="inscripcion.php" class="hover:underline">Inscripción</a>
                <a href="informacion.php" class="hover:underline">Información</a> <!-- Enlace de información añadido -->
            </nav>
        </div>
    </header>

    <!-- Sección de Búsqueda -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Buscar Equipos</h2>
        <form action="equipos.php" method="GET" class="mb-6">
            <input type="text" name="search" placeholder="Buscar equipo..." value="<?= htmlspecialchars($search); ?>"
                class="p-2 border rounded w-full md:w-1/3">
            <button type="submit" class="bg-blue-600 text-white p-2 rounded ml-2">Buscar</button>
        </form>
    </section>

    <!-- Sección de Equipos -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Lista de Equipos</h2>
        <p>Aquí puedes ver la lista de equipos que participan en nuestra liga.</p>

        <!-- Lista de equipos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <?php if (count($equipos) > 0): ?>
            <?php foreach ($equipos as $equipo): ?>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                <img src="images/equipos/<?= htmlspecialchars($equipo['imagen']); ?>"
                    alt="Escudo del equipo <?= htmlspecialchars($equipo['nombre']); ?>" class="h-24 mx-auto mb-4">
                <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($equipo['nombre']); ?></h3>
                <p class="text-gray-700">Entrenador: <?= htmlspecialchars($equipo['entrenador']); ?></p>
                <p class="text-gray-700">Jugadores: <?= htmlspecialchars($equipo['numero_jugadores']); ?></p>
                <a href="equipo_perfil.php?id=<?= $equipo['id']; ?>"
                    class="text-blue-600 hover:text-blue-800 mt-4 block">Ver perfil completo</a>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-red-600">No se encontraron equipos con ese nombre.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>