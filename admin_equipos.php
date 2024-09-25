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

// Si se está agregando un nuevo equipo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $numero_jugadores = $_POST['numero_jugadores'];
    $telefono = $_POST['telefono'];

    // Insertar el nuevo equipo en la base de datos
    $stmt = $pdo->prepare('INSERT INTO equipos (nombre, numero_jugadores, telefono) VALUES (?, ?, ?)');
    $stmt->execute([$nombre, $numero_jugadores, $telefono]);

    // Redirigir de vuelta a la gestión de equipos
    header('Location: admin_equipos.php');
    exit();
}

// Obtener todos los equipos
$equipos = $pdo->query('SELECT * FROM equipos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Gestión de Equipos</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_dashboard.php" class="hover:underline">Volver al Panel</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Equipos Registrados</h2>

        <!-- Tabla de Equipos -->
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Jugadores</th>
                    <th class="py-3 px-6 text-left">Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipos as $equipo): ?>
                <tr class="border-b">
                    <td class="py-3 px-6"><?= htmlspecialchars($equipo['nombre']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($equipo['numero_jugadores']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($equipo['telefono']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para agregar un nuevo equipo -->
        <h3 class="text-2xl font-bold mt-12 mb-4">Agregar Nuevo Equipo</h3>
        <form action="admin_equipos.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold">Nombre del Equipo:</label>
                <input type="text" name="nombre" id="nombre" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="numero_jugadores" class="block text-gray-700 font-bold">Número de Jugadores:</label>
                <input type="number" name="numero_jugadores" id="numero_jugadores" class="w-full p-2 border rounded"
                    required>
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700 font-bold">Teléfono de Contacto:</label>
                <input type="text" name="telefono" id="telefono" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Equipo</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>