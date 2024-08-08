
<link rel="stylesheet" href="./styles/user-auth.css">
<main>
    <div class="login-container">
        <h1>User Login</h1>
        <form action="user-login.php" method="post">
            <fieldset>
                <legend>Please login into continue</legend>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p>Don't have an account ? <a href="./pages/user-signup.php">Sign up</a></p>
            </fieldset>
        </form>
    </div>

    <div class="topic-container">
        <h1>Welcome to Library</h1>
    </div>
</main>