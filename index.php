<?php
require_once './includes/functions/db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library</title>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <?php
    if (isset($_SESSION['user'])) {
        echo '<h1>Welcome ' . $_SESSION['user']['first_name'] . '</h1>';
        echo '<a href="pages/logout.php">Logout</a>';
    } else {
        include './includes/user-login.php';
    }
    ?>
</body>
</html>