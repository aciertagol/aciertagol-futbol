<?php
session_start(); // Inicia la sesión

// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Obtener los filtros (si existen)
$equipo = $_GET['equipo'] ?? '';
$fecha = $_GET['fecha'] ?? '';

// Consulta para filtrar jornadas según equipo y/o fecha
$query = $pdo->prepare('SELECT * FROM jornadas WHERE (equipo_a LIKE ? OR equipo_b LIKE ?) AND (fecha >= ? OR ? = "") ORDER BY fecha');
$query->execute(["%$equipo%", "%$equipo%", $fecha, $fecha]);
$jornadas = $query->fetchAll(PDO::FETCH_ASSOC);

// Comprobar si el usuario es administrador
$isAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Jornadas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="images/logotipo.png" alt="Logotipo Fut6 Liga" class="h-12 mr-4">
                <h1 class="text-3xl font-bold">Fut6 Liga</h1>
            </div>
            <nav class="space-x-4">
                <a href="index.php" class="hover:underline">Inicio</a>
                <a href="equipos.php" class="hover:underline">Equipos</a>
                <a href="jornadas.php" class="hover:underline">Jornadas</a>
                <a href="estadisticas.php" class="hover:underline">Estadísticas</a>
                <a href="informacion.php" class="hover:underline">Información</a>
                <a href="inscripción.php" class="hover:underline">Inscripción</a>
            </nav>
        </div>
    </header>

    <!-- Sección de Filtros -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Filtrar Jornadas</h2>
        <form action="jornadas.php" method="GET" class="mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/3">
                    <label for="equipo" class="block text-gray-700 font-bold">Buscar por equipo:</label>
                    <input type="text" name="equipo" id="equipo" value="<?= htmlspecialchars($equipo); ?>"
                        placeholder="Nombre del equipo" class="p-2 border rounded w-full">
                </div>
                <div class="w-full md:w-1/3">
                    <label for="fecha" class="block text-gray-700 font-bold">Filtrar por fecha:</label>
                    <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($fecha); ?>"
                        class="p-2 border rounded w-full">
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white p-2 rounded mt-4">Filtrar</button>
        </form>

        <!-- Código para agregar y eliminar equipos (solo para admin) -->
        <?php if ($isAdmin): ?>
        <div class="mt-6">
            <h2 class="text-2xl font-bold">Administración de Equipos</h2>
            <form action="agregar_equipo.php" method="POST">
                <input type="text" name="nombre_equipo" placeholder="Nombre del equipo" required
                    class="p-2 border rounded">
                <button type="submit" class="bg-green-600 text-white p-2 rounded">Agregar Equipo</button>
            </form>
            <form action="eliminar_equipo.php" method="POST" class="mt-4">
                <input type="text" name="nombre_equipo" placeholder="Nombre del equipo a eliminar" required
                    class="p-2 border rounded">
                <button type="submit" class="bg-red-600 text-white p-2 rounded">Eliminar Equipo</button>
            </form>
        </div>
        <?php endif; ?>
    </section>

    <!-- Sección de Jornadas -->
    <section class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Jornadas</h2>
        <p>Consulta el calendario de las próximas jornadas y resultados anteriores.</p>

        <!-- Lista de Jornadas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <?php if (count($jornadas) > 0): ?>
            <?php foreach ($jornadas as $jornada): ?>
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-xl font-bold mb-2">Jornada <?= htmlspecialchars($jornada['numero']); ?></h3>
                <p class="text-gray-700">Fecha: <?= htmlspecialchars(date('d M Y', strtotime($jornada['fecha']))); ?>
                </p>
                <p class="text-gray-700"><?= htmlspecialchars($jornada['equipo_a']); ?> vs
                    <?= htmlspecialchars($jornada['equipo_b']); ?></p>
                <?php if ($jornada['resultado']): ?>
                <p class="text-green-600">Resultado: <?= htmlspecialchars($jornada['resultado']); ?></p>
                <?php else: ?>
                <p class="text-red-600">Pendiente</p>
                <?php endif; ?>
                <a href="detalle_jornada.php?id=<?= $jornada['id']; ?>"
                    class="text-blue-600 hover:text-blue-800 mt-4 block">Ver más detalles</a>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-red-600">No se encontraron jornadas con los filtros seleccionados.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>