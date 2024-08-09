<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/user-auth.css">
</head>
<main>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="admin-login.php" method="post">
            <fieldset>
                <legend>Please login into continue</legend>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </fieldset>
        </form>
    </div>

    <div class="topic-container">
        <h1>Welcome to Library</h1>
    </div>
</main>