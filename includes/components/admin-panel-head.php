<?php
    require_once('../../includes/functions/db_connect.php');

    $sqlBooksCount = "SELECT SUM(quantity) as book_count FROM books";
    $sqlUsersCount = "SELECT COUNT(user_id) as user_count FROM users";
    
    // Execute the queries
    $resultBooks = mysqli_query($conn, $sqlBooksCount);
    $resultUsers = mysqli_query($conn, $sqlUsersCount);
    
    // Fetch the counts
    $bookCount = mysqli_fetch_assoc($resultBooks)['book_count'];
    $userCount = mysqli_fetch_assoc($resultUsers)['user_count'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/admin-panel.css">
    <link rel="shortcut icon" href="../../assets/icons/logo.webp" type="image/x-icon">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <img src="../../assets/icons/logo.webp" alt="logo">
                <div class="sidebar-links">
                    <h2>Welcome Admin !</h2>
                    <ul>
                        <li><p>Book Management</p>
                            <a href="./new-book.php">Add a New Book</a>
                            <a href="./book-search.php">Book Search & Update</a>
                            <a href="./lending.php">Book Lending</a>
                            <a href="./borrowed.php">Borrowed Books & Recieving</a>
                        </li>
                        <li><p>User Management</p>
                            <a href="./user-search.php">User Search</a>
                            <a href="./user-details.php">User Details & Update</a>
                        </li>
                        <li><a href="../../includes/functions/logout.php">Log Out</a></li>
                    </ul>
                </div>
            </nav>
            <div class="library-details">
                <h3>Total Books:<?php echo $bookCount ?> </h3>
                <h3>Total Users:<?php echo $userCount ?> </h3>
            </div>
        </header>

        <img id="show-sidebar" src="../../assets/icons/menu.png" alt="show sidebar">

        <header class="responsive-nav">
            <img id="close-sidebar" src="../../assets/icons/close.png" alt="">
            <nav>
                <img src="../../assets/icons/logo.webp" alt="logo">
                <div class="sidebar-links">
                    <h2>Welcome Admin !</h2>
                    <ul>
                        <li><p>Book Management</p>
                            <a href="./new-book.php">Add a New Book</a>
                            <a href="./book-search.php">Book Search & Update</a>
                            <a href="./lending.php">Book Lending</a>
                            <a href="./borrowed.php">Borrowed Books & Recieving</a>
                        </li>
                        <li><p>User Management</p>
                            <a href="./user-search.php">User Search</a>
                            <a href="./user-details.php">User Details & Update</a>
                        </li>
                        <li><a href="../../includes/functions/logout.php">Log Out</a></li>
                    </ul>
                </div>
            </nav>
            <div class="library-details">
                <h3>Total Books:<?php echo $bookCount ?> </h3>
                <h3>Total Users:<?php echo $userCount ?> </h3>
            </div>
        </header>

        <script>
            const showSidebar = document.getElementById('show-sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const responsiveNav = document.querySelector('.responsive-nav');

            showSidebar.addEventListener('click', () => {
                responsiveNav.classList.add('show');
            });

            closeSidebar.addEventListener('click', () => {
                responsiveNav.classList.remove('show');
            });
        </script>
