<?php  
    session_start();
    require_once('../includes/functions/db_connect.php');
    $error = "";

    if(isset($_POST["login"])){
        $adminName = $_POST["a-username"];
        $password = $_POST["password"];
        
        $sql = "SELECT * FROM admin WHERE admin_name = '$adminName' AND admin_password = '$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION["admin"] = $adminName;
            header("Location: ./admin/new-book.php");
        } else {
            $error = "Invalid username or password";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/user-auth.css">
    <link rel="shortcut icon" href="../assets/icons/logo.webp" type="image/x-icon">
</head>
<main>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="admin-login.php" method="post">
            <fieldset>
                <legend>Please login into continue</legend>
                <input type="text" id="username" name="a-username" placeholder="Enter admin username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <p class="error"><?php echo $error; ?></p>
                <button type="submit" name="login">Login</button>
            </fieldset>
        </form>
    </div>

    <div class="topic-container">
        <h1>Welcome to Library</h1>
        <h3><a href="../">User Login</a></h3>
    </div>
</main>