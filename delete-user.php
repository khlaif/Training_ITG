<?php

require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");

    $stmt->execute([
        ':id' => $id
    ]);
}

header("Location: users.php");
exit;