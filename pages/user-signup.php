<?php
require_once('../includes/functions/db_connect.php');
$response = null;
$error = null;

if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobileno = $_POST["mobile"];
    $password = $_POST["password"];

 
        $sqlInsert = "INSERT INTO users (username,email,mobile_no,password) VALUES ('$username','$email','$mobileno','$password')";
        $sqlCheck = "SELECT * FROM users WHERE email='$email' OR mobile_no='$mobileno'";
    
        try {
            $result = mysqli_query($conn, $sqlCheck);
            if (mysqli_num_rows($result) > 0) {
                $error = "<span class=\"error\">User already exists</span>";
            }elseif(!is_numeric($mobileno)){
                $error = "<span class=\"error\">Phone number must be numeric</span>";
            } else {
                $result = mysqli_query($conn, $sqlInsert);
                if ($result) {
                    $response = "<span class=\"sucess\">User created successfully</span>";
                }
            }
        } catch (Exception $e) {
            $error = "<span class=\"error\">Something went wrong</span>" . $e;
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

<body>
    <main class="signup">
        <div class="topic-container">
            <h1>Welcome to Library</h1>
        </div>

        <div class="login-container">
            <h1>User Sign Up</h1>
            <form action="user-signup.php" method="post">
                <fieldset>
                    <legend></legend>
                    <input type="text" name="username" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <input type="text" name="mobile" placeholder="Enter your mobile no" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <?php echo $response, $error; ?>
                    <button type="submit" name="signup">Sign Up</button>
                    <p>Already have an account ? <a href="../">Login</a></p>
                </fieldset>
            </form>
        </div>

    </main>