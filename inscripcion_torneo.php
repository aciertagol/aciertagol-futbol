<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_equipo = $_POST['nombre_equipo'];
    $email_capitan = $_POST['email_capitan'];
    $telefono = $_POST['telefono'];
    $jugadores = $_POST['jugadores'];

    // Insertar el equipo en la base de datos
    $stmt = $pdo->prepare('INSERT INTO equipos (nombre, email_capitan, telefono, jugadores) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre_equipo, $email_capitan, $telefono, $jugadores]);

    // Confirmación de registro exitoso
    $mensaje = 'Equipo inscrito correctamente.';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Inscripción</title>
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
                <a href="inscripción.php" class="hover:underline">Inscripción</a>
            </nav>
        </div>
    </header>

    <!-- Sección de Inscripción -->
    <section class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold text-center mb-8">Inscripción de Equipos</h2>

        <!-- Mensaje de Confirmación -->
        <?php if (isset($mensaje)): ?>
        <p class="text-green-600 text-center mb-4"><?= htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <form action="inscripcion_torneo.php" method="POST">
                <!-- Nombre del equipo -->
                <div class="mb-4">
                    <label for="nombre_equipo" class="block text-gray-700 font-bold mb-2">Nombre del Equipo</label>
                    <input type="text" name="nombre_equipo" id="nombre_equipo" class="w-full p-2 border rounded"
                        required>
                </div>

                <!-- Email del Capitán -->
                <div class="mb-4">
                    <label for="email_capitan" class="block text-gray-700 font-bold mb-2">Correo del Capitán</label>
                    <input type="email" name="email_capitan" id="email_capitan" class="w-full p-2 border rounded"
                        required>
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono de Contacto</label>
                    <input type="text" name="telefono" id="telefono" class="w-full p-2 border rounded" required>
                </div>

                <!-- Lista de Jugadores -->
                <div class="mb-4">
                    <label for="jugadores" class="block text-gray-700 font-bold mb-2">Lista de Jugadores</label>
                    <textarea name="jugadores" id="jugadores" class="w-full p-2 border rounded" rows="4"
                        placeholder="Escribe los nombres de los jugadores separados por comas..." required></textarea>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Inscribir Equipo</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center mt-12">
        <p>&copy; 2024 Fut6 Liga. Todos los derechos reservados.</p>
    </footer>
</body>

</html>