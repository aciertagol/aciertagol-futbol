<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Redirigir al inicio si no tiene acceso
    header('Location: login.php');
    exit();
}

// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Obtener estadísticas básicas de la liga
$equipos_query = $pdo->query('SELECT COUNT(*) as total_equipos FROM equipos');
$jornadas_query = $pdo->query('SELECT COUNT(*) as total_jornadas FROM jornadas');
$jugadores_query = $pdo->query('SELECT COUNT(*) as total_jugadores FROM jugadores');

$total_equipos = $equipos_query->fetch()['total_equipos'];
$total_jornadas = $jornadas_query->fetch()['total_jornadas'];
$total_jugadores = $jugadores_query->fetch()['total_jugadores'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Panel de Administración</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_equipos.php" class="hover:underline">Gestión de Equipos</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Bienvenido, <?= htmlspecialchars($_SESSION['username']); ?>.</h2>
        <p class="mb-8">Aquí puedes gestionar los equipos, jornadas y jugadores de la Fut6 Liga.</p>

        <!-- Sección de estadísticas básicas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-bold mb-2">Total de Equipos</h3>
                <p class="text-3xl text-blue-600"><?= $total_equipos; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-bold mb-2">Total de Jornadas</h3>
                <p class="text-3xl text-blue-600"><?= $total_jornadas; ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-bold mb-2">Total de Jugadores</h3>
                <p class="text-3xl text-blue-600"><?= $total_jugadores; ?></p>
            </div>
        </div>

        <!-- Opciones de gestión -->
        <h3 class="text-2xl font-bold mb-4">Gestión de la Liga</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="admin_equipos.php"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow block text-center">
                <h3 class="text-xl font-bold mb-2">Gestión de Equipos</h3>
                <p>Ver, agregar o editar equipos.</p>
            </a>
            <a href="admin_jornadas.php"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow block text-center">
                <h3 class="text-xl font-bold mb-2">Gestión de Jornadas</h3>
                <p>Ver o agregar nuevas jornadas.</p>
            </a>
            <a href="admin_jugadores.php"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow block text-center">
                <h3 class="text-xl font-bold mb-2">Gestión de Jugadores</h3>
                <p>Ver, agregar o editar jugadores.</p>
            </a>
            <a href="admin_usuarios.php"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow block text-center">
                <h3 class="text-xl font-bold mb-2">Gestión de Usuarios</h3>
                <p>Administrar cuentas de usuarios.</p>
            </a>
            <a href="admin_patrocinadores.php"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow block text-center">
                <h3 class="text-xl font-bold mb-2">Gestión de Patrocinadores</h3>
                <p>Ver, agregar o editar patrocinadores.</p>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>