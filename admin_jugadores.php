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

// Si se está agregando un nuevo jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $posicion = $_POST['posicion'];
    $equipo_id = $_POST['equipo_id'];
    $goles = $_POST['goles'] ?? 0;
    $asistencias = $_POST['asistencias'] ?? 0;
    $tarjetas_amarillas = $_POST['tarjetas_amarillas'] ?? 0;
    $tarjetas_rojas = $_POST['tarjetas_rojas'] ?? 0;

    // Insertar el nuevo jugador en la base de datos
    $stmt = $pdo->prepare('INSERT INTO jugadores (nombre, posicion, equipo_id, goles, asistencias, tarjetas_amarillas, tarjetas_rojas) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nombre, $posicion, $equipo_id, $goles, $asistencias, $tarjetas_amarillas, $tarjetas_rojas]);

    // Redirigir de vuelta a la gestión de jugadores
    header('Location: admin_jugadores.php');
    exit();
}

// Eliminar jugador
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM jugadores WHERE id = ?');
    $stmt->execute([$id]);

    // Redirigir de vuelta a la gestión de jugadores
    header('Location: admin_jugadores.php');
    exit();
}

// Obtener todos los jugadores
$jugadores = $pdo->query('SELECT * FROM jugadores')->fetchAll(PDO::FETCH_ASSOC);

// Obtener todos los equipos para el selector de equipo
$equipos = $pdo->query('SELECT id, nombre FROM equipos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Jugadores - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Gestión de Jugadores</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_dashboard.php" class="hover:underline">Volver al Panel</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Jugadores Registrados</h2>

        <!-- Tabla de Jugadores -->
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Posición</th>
                    <th class="py-3 px-6 text-left">Equipo</th>
                    <th class="py-3 px-6 text-left">Goles</th>
                    <th class="py-3 px-6 text-left">Asistencias</th>
                    <th class="py-3 px-6 text-left">Tarjetas Amarillas</th>
                    <th class="py-3 px-6 text-left">Tarjetas Rojas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $jugador): ?>
                <tr class="border-b">
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['nombre']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['posicion']); ?></td>
                    <td class="py-3 px-6">
                        <?php
                        $equipo = $pdo->prepare('SELECT nombre FROM equipos WHERE id = ?');
                        $equipo->execute([$jugador['equipo_id']]);
                        echo htmlspecialchars($equipo->fetchColumn());
                        ?>
                    </td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['goles']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['asistencias']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['tarjetas_amarillas']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jugador['tarjetas_rojas']); ?></td>
                    <td class="py-3 px-6">
                        <a href="admin_jugadores.php?delete=<?= $jugador['id']; ?>" class="text-red-600 hover:underline"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este jugador?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para agregar un nuevo jugador -->
        <h3 class="text-2xl font-bold mt-12 mb-4">Agregar Nuevo Jugador</h3>
        <form action="admin_jugadores.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold">Nombre del Jugador:</label>
                <input type="text" name="nombre" id="nombre" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="posicion" class="block text-gray-700 font-bold">Posición:</label>
                <input type="text" name="posicion" id="posicion" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="equipo_id" class="block text-gray-700 font-bold">Equipo:</label>
                <select name="equipo_id" id="equipo_id" class="w-full p-2 border rounded" required>
                    <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= $equipo['id']; ?>"><?= htmlspecialchars($equipo['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="goles" class="block text-gray-700 font-bold">Goles:</label>
                <input type="number" name="goles" id="goles" class="w-full p-2 border rounded" value="0">
            </div>
            <div class="mb-4">
                <label for="asistencias" class="block text-gray-700 font-bold">Asistencias:</label>
                <input type="number" name="asistencias" id="asistencias" class="w-full p-2 border rounded" value="0">
            </div>
            <div class="mb-4">
                <label for="tarjetas_amarillas" class="block text-gray-700 font-bold">Tarjetas Amarillas:</label>
                <input type="number" name="tarjetas_amarillas" id="tarjetas_amarillas" class="w-full p-2 border rounded"
                    value="0">
            </div>
            <div class="mb-4">
                <label for="tarjetas_rojas" class="block text-gray-700 font-bold">Tarjetas Rojas:</label>
                <input type="number" name="tarjetas_rojas" id="tarjetas_rojas" class="w-full p-2 border rounded"
                    value="0">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Jugador</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>