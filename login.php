<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo '<p class="text-red-500">Credenziali non valide</p>';
        die;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $res = $stmt->get_result();

    if ($res->num_rows == 0) {
        echo '<p class="text-red-500">Credenziali non valide</p>';
        die;
    }

    $user = $res->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        echo '<p class="text-red-500">Credenziali non valide</p>';
        die;
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">

<div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-center text-blue-600 mb-6">Accedi al tuo account</h2>

    <!-- Form di login -->
    <form method="post">
        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="password" class="block text-lg font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
            Accedi
        </button>

        <div class="text-center">
            <a href="register.php" class="text-blue-600 hover:underline">Non hai un account? Registrati</a>
        </div>
    </form>
</div>

</body>
</html>
