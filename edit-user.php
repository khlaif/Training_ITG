<?php

require_once 'config/database.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT id, name, email, role
    FROM users
    WHERE id = :id
");

$stmt->execute([
    ':id' => $id
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: users.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("
        UPDATE users
        SET name = :name,
            email = :email,
            role = :role
        WHERE id = :id
    ");

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
    ]);

    header("Location: users.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main class="users-container">

        <div class="users-header">

            <div class="title">
                <h1>Edit User</h1>
                <p>Update user information</p>
            </div>

        </div>

        <div class="form-container">

            <form method="POST">

                <label for="name">Full Name</label>

                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

                <label for="email">Email</label>

                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                <label for="role">Role</label>

                <select id="role" name="role">

                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>
                        User
                    </option>

                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>
                        Admin
                    </option>

                    <option value="manager" <?= $user['role'] === 'manager' ? 'selected' : '' ?>>
                        Manager
                    </option>

                </select>

                <div class="form-buttons">

                    <button type="submit" class="add-btn">
                        Update User
                    </button>

                    <a href="users.php" class="cancel-btn">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </main>

</body>

</html>