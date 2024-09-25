<?php
session_start();

// Verificar si el usuario ya está logueado y redirigirlo si es así
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Manejar el envío del formulario
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar al usuario en la base de datos
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña
    if ($user && password_verify($password, $user['password'])) {
        // Guardar la sesión del usuario
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['username'] = $user['username'];
        
        // Redirigir al index en lugar del panel de administración
        header('Location: index.php');
        exit();
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        background: linear-gradient(135deg, #34d399, #10b981, #059669);
        background-size: 400% 400%;
        animation: gradientBG 12s ease infinite;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .btn-efecto:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
    }
    </style>
</head>

<body class="bg-gradient-to-r from-green-600 via-green-400 to-green-200">

    <!-- Contenedor Principal Centrado -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white shadow-2xl rounded-lg overflow-hidden w-full max-w-md p-8">

            <!-- Agregar el logotipo de la marca -->
            <div class="flex justify-center mb-6">
                <img src="images/tu_logotipo.png" alt="Tu Marca" class="h-16">
            </div>

            <h2 class="text-4xl font-bold text-green-600 text-center mb-8">Iniciar Sesión</h2>

            <!-- Mostrar mensaje de error -->
            <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <!-- Formulario de Inicio de Sesión -->
            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold">Usuario:</label>
                    <input type="text" name="username" id="username"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nombre de usuario" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold">Contraseña:</label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contraseña" required>
                </div>

                <!-- Mostrar Contraseña -->
                <div class="mb-4">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword" class="text-gray-700">Mostrar Contraseña</label>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded shadow-lg hover:bg-green-700 transition duration-300 ease-in-out btn-efecto">Iniciar
                    Sesión</button>
            </form>

            <!-- Enlace para ir a la página principal (index.php) -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">¿No tienes una cuenta? <a href="register.php"
                        class="text-green-600 hover:underline">Regístrate aquí</a>.</p>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600">¿Volver a la página principal? <a href="index.php"
                        class="text-green-600 hover:underline">Ir al Inicio</a>.</p>
            </div>

        </div>
    </div>

    <script>
    // Función para mostrar/ocultar la contraseña
    function togglePassword() {
        var passwordField = document.getElementById('password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text'; // Mostrar contraseña
        } else {
            passwordField.type = 'password'; // Ocultar contraseña
        }
    }
    </script>

</body>

</html>