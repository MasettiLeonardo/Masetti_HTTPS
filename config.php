<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_NAME'],
    (int) $_ENV['DB_PORT']
);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
