<?php

require_once 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($email) || empty($password)) {
        echo '<p class="text-red-500">Credenziali non valide</p>';
        die;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="text-red-500">Email non valida</p>';
        die;
    }
    if (strlen($password) < 8) {
        echo '<p class="text-red-500">La password deve contenere almeno 8 caratteri</p>';
        die;
    }

    // Controllo se l'utente esiste già
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo '<p class="text-red-500">Utente già registrato</p>';
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        echo '<p class="text-red-500">Errore nella registrazione</p>';
    }

    exit;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">

<div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-center text-blue-600 mb-6">Registrati</h2>

    <!-- Form di registrazione -->
    <form method="post">
        <div class="mb-4">
            <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" class="w-full px-4 py-2 border
             border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

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
            Registrati
        </button>

        <div class="text-center">
            <a href="login.php" class="text-blue-600 hover:underline">Hai già un account? Accedi</a>
        </div>
    </form>
</div>

</body>
</html>
