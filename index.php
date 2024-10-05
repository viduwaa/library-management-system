<?php
require_once('./includes/functions/db_connect.php');
session_start();
if(isset($_SESSION["user-mobile"])){
    header("Location: ./pages/user/home.php");
}
$error = null;

if (isset($_POST["user-login"])) {
    $mobileno = $_POST["mobile"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE mobile_no='$mobileno' AND password='$password'";

    try {
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
            $_SESSION["user-mobile"] = $mobileno;
            $_SESSION["user-id"] = $row["user_id"];
            $_SESSION["user-name"] = $row["username"];
            header("Location: ./pages/user/home.php");
        }else{
            $error = "<span class=\"error\">Invalid Mobile no or Password</span>";
        }    
    } catch (\Throwable $th) {
        $error = "Something went wrong".$th;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Library</title>
        <link rel="stylesheet" href="./styles/styles.css">
        <link rel="stylesheet" href="./styles/user-auth.css">
        <link rel="shortcut icon" href="./assets/icons/logo.webp" type="image/x-icon">
    </head>

    <body>
        <main>
            <div class="login-container">
                <h1>User Login</h1>
                <form action="index.php" method="post">
                    <fieldset>
                        <legend>Please login into continue</legend>
                        <input type="tel" name="mobile" placeholder="Enter your mobile no" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <?php echo $error; ?>
                        <button type="submit" name="user-login">Login</button>
                        <p>Don't have an account ? <a href="./pages/user-signup.php">Sign up</a></p>
                    </fieldset>
                </form>
            </div>

            <div class="topic-container">
                <h1>Welcome to Library</h1>
                <h3><a href="./pages/admin-login.php">Admin Login</a></h3>
            </div>
        </main>
    </body>

</html>