<?php
require_once('./includes/functions/db_connect.php');
require_once('./includes/functions/mail_config.php');

$error = '';
$response = '';


//URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$fullUrl = $protocol . '://' . $host;


if (isset($_POST['pw-reset'])) {
    $userInput = $_POST['email'];

    $SQLcheckUser = "SELECT * FROM users WHERE email = '$userInput'";

    try {
        $SQLcheckUserResult = mysqli_query($conn, $SQLcheckUser);
        if (mysqli_num_rows($SQLcheckUserResult) > 0) {
            //get username
            $checkDetails = mysqli_fetch_assoc($SQLcheckUserResult);
            $username = $checkDetails['username'];
            //User found, generating token
            $token = bin2hex(random_bytes(32));
            $expiry = date("U") + 1800;

            //store token in user table
            $updateUserTokenSQL = "UPDATE users SET reset_token = '$token', token_expires = '$expiry' WHERE email = '$userInput'";
            mysqli_query($conn, $updateUserTokenSQL);

            //send email or phone
            $resetLink = $fullUrl . "/library-system/reset_password.php?token=" . $token;
            $response = sendVerificationEmail($userInput, $username, $resetLink);

            //
        } else {
            $error = "<span class=\"error\">Invalid Email or Doesn't exit on our system</span>";
        }
    } catch (\Throwable $th) {
        $error = "Something went wrong" . $th;
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

<main>
    <div class="login-container forgot-pw">
        <img src="./assets/icons/logo.webp" alt="logo">
        <h1>Password Reset</h1>
        <form action="forgot-password.php" method="post">
            <fieldset>
                <legend>Please enter the email to continue</legend>
                <input type="email" name="email" placeholder="Enter your email" required>
                <?php if (!empty($response)) {
                    echo $response;
                } elseif (!empty($error)) {
                    echo $error;
                }

                ?>
                <button type="submit" name="pw-reset">Reset</button>
                <p>Back to<a href="./">Login</a></p>
            </fieldset>
        </form>
    </div>
</main>