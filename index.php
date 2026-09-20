<?php

$pageTitle = "Home";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="hero">
        <div class="hero-text">
            <h1>Welcome to UserApp</h1>
            <p>Manage your users easily and efficiently.</p>
            <a href="user.php" class="view-users-btn">View Users -></a>
        </div>

        <div class="hero-image">
            <img src="assets/images/3user.png" alt="UserApp">
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <div class="icon-circle bluee">
                <img src="assets/images/users-round.svg" alt="Users">
            </div>
            <h2>View Users</h2>
            <p>See and manage all users</p>
        </div>

        <div class="card">
            <div class="icon-circle green">
                <img src="assets/images/add-user.svg" alt="Add User">
            </div>
            <h2>Add User</h2>
            <p>Create a new user quickly</p>
        </div>

        <div class="card">
            <div class="icon-circle yellow">
                <img src="assets/images/analysis.svg" alt="Chart">
            </div>
            <h2>Stay Organized</h2>
            <p>Keep your user data in one place</p>
        </div>
    </div>

    <div class="footer-text">
        <p>Simple Efficient User Management</p>
    </div>
</body>

</html>