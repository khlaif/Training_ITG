<?php

require_once 'config/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, role, password)
            VALUES (:name, :email, :role, :password)
        ");

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':role' => $role,
            ':password' => $hashedPassword
        ]);

        header("Location: users.php");
        exit;
    } else {
        $message = "Please fill in all fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main class="users-container">

        <div class="users-header">

            <div class="title">
                <h1>Add New User</h1>
                <p>Fill in the details to create a new user</p>
            </div>

            <div class="icon-add">
                <img src="assets/images/add-user-blue.svg" alt="Add User">
            </div>

        </div>

        <div class="form-container">

            <?php if ($message): ?>
                <p><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form method="POST">

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter full name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email address" required>

                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>

                <div class="form-buttons">
                    <button type="submit" class="add-btn">
                        Add User
                    </button>

                    <button type="reset" class="cancel-btn">
                        Cancel
                    </button>
                </div>

            </form>

        </div>

    </main>

</body>

</html>