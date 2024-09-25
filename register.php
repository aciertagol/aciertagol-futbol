<?php
session_start();

// Conexión a la base de datos
$pdo = new PDO('mysql:host=localhost;dbname=fut6_liga', 'root', '');

// Manejar el envío del formulario de registro
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        // Verificar si el nombre de usuario o correo ya existen
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error = 'El nombre de usuario o el correo electrónico ya están registrados.';
        } else {
            // Insertar el nuevo usuario
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (username, email, password, rol) VALUES (?, ?, ?, ?)');
            $stmt->execute([$username, $email, $hashed_password, 'user']);

            $success = 'Cuenta creada exitosamente. Ahora puedes iniciar sesión.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fut6 Liga - Registro</title>
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

            <h2 class="text-4xl font-bold text-green-600 text-center mb-8">Regístrate</h2>

            <!-- Mostrar mensaje de error o éxito -->
            <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <?php if ($success): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                <?= htmlspecialchars($success); ?>
            </div>
            <?php endif; ?>

            <!-- Formulario de Registro -->
            <form action="register.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold">Usuario:</label>
                    <input type="text" name="username" id="username"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nombre de usuario" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold">Correo electrónico:</label>
                    <input type="email" name="email" id="email"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Correo electrónico" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold">Contraseña:</label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contraseña" required>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700 font-bold">Confirmar Contraseña:</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                        class="w-full p-3 border border-green-300 rounded shadow-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Confirmar contraseña" required>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded shadow-lg hover:bg-green-700 transition duration-300 ease-in-out btn-efecto">Crear
                    Cuenta</button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">¿Ya tienes una cuenta? <a href="login.php"
                        class="text-green-600 hover:underline">Inicia sesión aquí</a>.</p>
            </div>
        </div>
    </div>

</body>

</html>