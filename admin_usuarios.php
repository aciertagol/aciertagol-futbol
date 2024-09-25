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

// Si se está agregando un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    // Insertar el nuevo usuario en la base de datos
    $stmt = $pdo->prepare('INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)');
    $stmt->execute([$username, $password, $rol]);

    // Redirigir de vuelta a la gestión de usuarios
    header('Location: admin_usuarios.php');
    exit();
}

// Eliminar usuario
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
    $stmt->execute([$id]);

    // Redirigir de vuelta a la gestión de usuarios
    header('Location: admin_usuarios.php');
    exit();
}

// Obtener todos los usuarios
$usuarios = $pdo->query('SELECT * FROM usuarios')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Gestión de Usuarios</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_dashboard.php" class="hover:underline">Volver al Panel</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Usuarios Registrados</h2>

        <!-- Tabla de Usuarios -->
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Username</th>
                    <th class="py-3 px-6 text-left">Rol</th>
                    <th class="py-3 px-6 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr class="border-b">
                    <td class="py-3 px-6"><?= htmlspecialchars($usuario['username']); ?></td>
                    <td class="py-3 px-6"><?= htmlspecialchars($usuario['rol']); ?></td>
                    <td class="py-3 px-6">
                        <a href="admin_usuarios.php?delete=<?= $usuario['id']; ?>" class="text-red-600 hover:underline"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para agregar un nuevo usuario -->
        <h3 class="text-2xl font-bold mt-12 mb-4">Agregar Nuevo Usuario</h3>
        <form action="admin_usuarios.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold">Nombre de Usuario:</label>
                <input type="text" name="username" id="username" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold">Contraseña:</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-gray-700 font-bold">Rol:</label>
                <select name="rol" id="rol" class="w-full p-2 border rounded" required>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Usuario</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>