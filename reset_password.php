<?php
require_once('./includes/functions/db_connect.php');
$response ='';
$error ='';


if(isset($_GET['token'])){
    $token = $_GET['token'];
    $current_time = date("U");
    $sql = "SELECT * FROM users WHERE reset_token = '$token' AND token_expires > $current_time";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)> 0){
        if(isset($_POST['pw-change'])){
            $new_pw = $_POST['password'];
            $resetSQL = "UPDATE users SET password ='$new_pw', reset_token = NULL, token_expires = NULL WHERE reset_token = '$token'";
            
            try {
                $resetResult = mysqli_query($conn,$resetSQL);
                $response = '<h3 class="sucess">Password changed successfully!</h3>
                            <h4 style="text-align:center">Please  <a href="./" style="display:inline-block">log back</a> in</h4>';
            } catch (\Throwable $th) {
                $error = "<span class=\"error\">Something went wrong </span>".$th;
            }
            


        }
    }else{
        $error = "<span class=\"error\">Link is expired. Please request a new password change. </span>";
    }


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/user-auth.css">
    <link rel="shortcut icon" href="./assets/icons/logo.webp" type="image/x-icon">
</head>


<body>
<?php if (isset($_GET['token'])) { ?>
<main>
    <div class="login-container">
        <h1>Reset Your Password</h1>
        <form action="reset_password.php?token=<?php echo $token; ?>" method="post">
            <fieldset>
                <legend>Please enter a new password</legend>
                <?php 
                if (!empty($response)) {
                    echo $response;
                } elseif (!empty($error)) {
                    echo $error;
                }else{
                    echo '<input type="password" name="password" placeholder="Enter your new password" required>
                    <button type="submit" name="pw-change">Reset</button>';
                }
                ?>    
            </fieldset>
        </form>
    </div>
</main>

<?php } else { ?>
    <main>
        <h1>404 Not Found</h1>
    </main>
<?php } ?>
</body>

</html>