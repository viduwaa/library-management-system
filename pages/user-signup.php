<?php
    require_once('../includes/functions/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/user-auth.css">
</head>
<body>
<main class="signup">
    <div class="topic-container">
        <h1>Welcome to Library</h1>
    </div>

    <div class="login-container">
        <h1>User Sign Up</h1>
        <form action="user-login.php" method="post">
            <fieldset>
                <legend></legend>
                <input type="text"  name="username" placeholder="Enter your name" required>
                <input type="email"  name="email" placeholder="Enter your email" required>
                <input type="text"  name="mobile" placeholder="Enter your mobile no" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
                <p>Already have an account ? <a href="../">Login</a></p>
            </fieldset>
        </form>
    </div>

</main>