<?php
session_start();

if (!isset($_SESSION['log_success'])) {
    header("Location: http://localhost/views/connection.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="dashboard_parent_container">
        <h1>Welcome to your dashboard</h1>
        <p><?php echo isset($_SESSION['first_name']) && isset($_SESSION['last_name']) ? $_SESSION['first_name'] . " " . $_SESSION['last_name'] : 'Guest'; ?></p>
        <p><?php echo isset($_SESSION['e_mail']) ? "Your email: " . $_SESSION['e_mail'] : 'Email not set'; ?></p>
        <form action="../api/logout.php" method="post">
           <button type="submit" name="logout" class="logout_btn">Logout</button>
	</form>

    </div>
</body>
</html>