<?php
    include('../../includes/functions/check_user.php');   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/user-panel.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.webp" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <img src="../../assets/icons/logo.webp" alt="logo" alt="logo">
                <div class="sidebar-links">
                    <h2>Welcome <?php echo $_SESSION["user-name"] ?>!</h2>
                    <ul>
                        <li><a href="./home.php">Book Search</a></li>
                        <li><a href="./borrowed-books.php">My Borrowed Books</a></li>                        
                        <li><a href="../../includes/functions/logout.php">Log Out</a></li>                        
                    </ul>
                </div>
            </nav>
        </header>

        <img id="show-sidebar" src="../../assets/icons/menu.png" alt="show sidebar">

        <header class="responsive-nav">
            <img id="close-sidebar" src="../../assets/icons/close.png" alt="">
            <nav>
                <img src="../../assets/icons/logo.webp" alt="logo">
                <div class="sidebar-links">
                    <h2>Welcome User !</h2>
                    <ul>
                        <li><a href="./home.php">Book Search</a></li>
                        <li><a href="./borrowed-books.php">My Borrowed Books</a></li>                        
                        <li><a href="../../includes/functions/logout.php">Log Out</a></li>                        
                    </ul>
                </div>
            </nav>
        </header>

        <script>
            const showSidebar = document.getElementById('show-sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const responsiveNav = document.querySelector('.responsive-nav');

            showSidebar.addEventListener('click', function() {
                responsiveNav.classList.add('show');
            });

            closeSidebar.addEventListener('click', function() {
                responsiveNav.classList.remove('show');
            });
        </script>