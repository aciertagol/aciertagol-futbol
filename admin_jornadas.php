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

// Si se está agregando una nueva jornada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $equipo_a_id = $_POST['equipo_a_id'];
    $equipo_b_id = $_POST['equipo_b_id'];
    $resultado = $_POST['resultado'];
    $resumen = $_POST['resumen'];

    // Insertar la nueva jornada en la base de datos
    $stmt = $pdo->prepare('INSERT INTO jornadas (numero, fecha, equipo_a_id, equipo_b_id, resultado, resumen) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$numero, $fecha, $equipo_a_id, $equipo_b_id, $resultado, $resumen]);

    // Redirigir de vuelta a la gestión de jornadas
    header('Location: admin_jornadas.php');
    exit();
}

// Eliminar jornada
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM jornadas WHERE id = ?');
    $stmt->execute([$id]);

    // Redirigir de vuelta a la gestión de jornadas
    header('Location: admin_jornadas.php');
    exit();
}

// Obtener todas las jornadas
$jornadas = $pdo->query('SELECT * FROM jornadas')->fetchAll(PDO::FETCH_ASSOC);

// Obtener todos los equipos para los selectores
$equipos = $pdo->query('SELECT id, nombre FROM equipos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Jornadas - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Gestión de Jornadas</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_dashboard.php" class="hover:underline">Volver al Panel</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Jornadas Programadas</h2>

        <!-- Tabla de Jornadas -->
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Número de Jornada</th>
                    <th class="py-3 px-6 text-left">Fecha</th>
                    <th class="py-3 px-6 text-left">Equipo A</th>
                    <th class="py-3 px-6 text-left">Equipo B</th>
                    <th class="py-3 px-6 text-left">Resultado</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($jornadas as $jornada): ?>
                <tr class="border-b">
                    <td class="py-3 px-6"><?= htmlspecialchars($jornada['numero']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jornada['fecha']); ?></td>
                    <td class="py-3 px-6">
                        <?php
                        $equipo_a = $pdo->prepare('SELECT nombre FROM equipos WHERE id = ?');
                        $equipo_a->execute([$jornada['equipo_a_id']]);
                        echo htmlspecialchars($equipo_a->fetchColumn());
                        ?>
                    </td>
                    <td class="py-3 px-6">
                        <?php
                        $equipo_b = $pdo->prepare('SELECT nombre FROM equipos WHERE id = ?');
                        $equipo_b->execute([$jornada['equipo_b_id']]);
                        echo htmlspecialchars($equipo_b->fetchColumn());
                        ?>
                    </td>
                    <td class="py-3 px-6"><?= htmlspecialchars($jornada['resultado']); ?></td>
                    <td class="py-3 px-6">
                        <a href="admin_jornadas.php?delete=<?= $jornada['id']; ?>" class="text-red-600 hover:underline"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta jornada?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para agregar una nueva jornada -->
        <h3 class="text-2xl font-bold mt-12 mb-4">Agregar Nueva Jornada</h3>
        <form action="admin_jornadas.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="numero" class="block text-gray-700 font-bold">Número de Jornada:</label>
                <input type="number" name="numero" id="numero" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="fecha" class="block text-gray-700 font-bold">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="equipo_a_id" class="block text-gray-700 font-bold">Equipo A:</label>
                <select name="equipo_a_id" id="equipo_a_id" class="w-full p-2 border rounded" required>
                    <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= $equipo['id']; ?>"><?= htmlspecialchars($equipo['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="equipo_b_id" class="block text-gray-700 font-bold">Equipo B:</label>
                <select name="equipo_b_id" id="equipo_b_id" class="w-full p-2 border rounded" required>
                    <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= $equipo['id']; ?>"><?= htmlspecialchars($equipo['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="resultado" class="block text-gray-700 font-bold">Resultado:</label>
                <input type="text" name="resultado" id="resultado" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Jornada</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>