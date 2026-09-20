<?php

require_once 'config/database.php';

$stmt = $pdo->query("SELECT id, name, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main class="users-container">

        <div class="users-header">

            <div class="title">
                <h1>Users List</h1>
                <p>View and manage all users.</p>
            </div>

            <div class="search-box">
                <input type="search" id="searchUser" placeholder="Search by name...">
            </div>

        </div>

        <table class="users-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($users as $user): ?>

                    <tr class="user-row">

                        <td><?= htmlspecialchars($user['id']) ?></td>

                        <td class="user-name">
                            <?= htmlspecialchars($user['name']) ?>
                        </td>

                        <td><?= htmlspecialchars($user['email']) ?></td>

                        <td><?= htmlspecialchars($user['role']) ?></td>

                        <td class="actions">

                            <a href="edit-user.php?id=<?= $user['id'] ?>" class="edit-btn">
                                <img src="assets/images/edit.svg" alt="Edit icon">
                            </a>

                            <form action="delete-user.php" method="POST">

                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <button type="submit" class="delete-btn">
                                    <img src="assets/images/delete.svg" alt="Delete icon">
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </main>

    <script src="assets/js/users.js"></script>

</body>

</html>