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

// Si se está agregando un nuevo patrocinador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $logo = $_FILES['logo']['name'];

    // Subir el logo al servidor
    $target_dir = "uploads/patrocinadores/";
    $target_file = $target_dir . basename($logo);
    move_uploaded_file($_FILES['logo']['tmp_name'], $target_file);

    // Insertar el nuevo patrocinador en la base de datos
    $stmt = $pdo->prepare('INSERT INTO patrocinadores (nombre, logo) VALUES (?, ?)');
    $stmt->execute([$nombre, $logo]);

    // Redirigir de vuelta a la gestión de patrocinadores
    header('Location: admin_patrocinadores.php');
    exit();
}

// Eliminar patrocinador
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Obtener el nombre del archivo de logo para eliminarlo
    $stmt = $pdo->prepare('SELECT logo FROM patrocinadores WHERE id = ?');
    $stmt->execute([$id]);
    $logo = $stmt->fetchColumn();

    // Eliminar el archivo de logo
    if ($logo) {
        unlink("uploads/patrocinadores/" . $logo);
    }

    // Eliminar el patrocinador de la base de datos
    $stmt = $pdo->prepare('DELETE FROM patrocinadores WHERE id = ?');
    $stmt->execute([$id]);

    // Redirigir de vuelta a la gestión de patrocinadores
    header('Location: admin_patrocinadores.php');
    exit();
}

// Obtener todos los patrocinadores
$patrocinadores = $pdo->query('SELECT * FROM patrocinadores')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Patrocinadores - Fut6 Liga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold">Gestión de Patrocinadores</h1>
            </div>

            <nav class="space-x-4">
                <a href="admin_dashboard.php" class="hover:underline">Volver al Panel</a>
                <a href="logout.php" class="hover:underline">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold mb-6">Patrocinadores Registrados</h2>

        <!-- Tabla de Patrocinadores -->
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Logo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patrocinadores as $patrocinador): ?>
                <tr class="border-b">
                    <td class="py-3 px-6"><?= htmlspecialchars($patrocinador['nombre']); ?></td>
                    <td class="py-3 px-6">
                        <img src="uploads/patrocinadores/<?= htmlspecialchars($patrocinador['logo']); ?>" alt="Logo"
                            class="h-12">
                    </td>
                    <td class="py-3 px-6">
                        <a href="admin_patrocinadores.php?delete=<?= $patrocinador['id']; ?>"
                            class="text-red-600 hover:underline"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este patrocinador?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulario para agregar un nuevo patrocinador -->
        <h3 class="text-2xl font-bold mt-12 mb-4">Agregar Nuevo Patrocinador</h3>
        <form action="admin_patrocinadores.php" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold">Nombre del Patrocinador:</label>
                <input type="text" name="nombre" id="nombre" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="logo" class="block text-gray-700 font-bold">Logo del Patrocinador:</label>
                <input type="file" name="logo" id="logo" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar Patrocinador</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>