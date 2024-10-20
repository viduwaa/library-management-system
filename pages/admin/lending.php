<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');

$response = null;

if (isset($_POST['lend'])) {
    $book_id = $_POST['b-id'];
    $user_mobile = $_POST['user-mobile'];

    // Fetch book Details
    $sqlBook = "SELECT * FROM books WHERE books_id = '$book_id'";
    $bookResult = mysqli_query($conn, $sqlBook);
    if (mysqli_num_rows($bookResult) > 0) {
        $row = mysqli_fetch_assoc($bookResult);
        $book_name = $row['name'];
        $book_img = $row['cover'];
        $book_quantity = $row['quantity'];
    }


    // Fetch user Details
    $sqluserID = "SELECT * FROM users WHERE mobile_no = '$user_mobile'";
    $userResult = mysqli_query($conn, $sqluserID);
    if (mysqli_num_rows($userResult) > 0) {
        $row = mysqli_fetch_assoc($userResult);
        $user_name = $row['username'];
        $user_id = $row['user_id'];
    }

    //check for valid inputs
    if (!$bookResult || mysqli_num_rows($bookResult) == 0) {
        $response = "<div class=\"error\">Book not found or valid</div>";
    } elseif (!$userResult || mysqli_num_rows($userResult) == 0) {
        $response = "<div class=\"error\">User not found or valid</div>";
    } else {
        // Check if the book is already borrowed by the user
        $sqlCheck = "SELECT * FROM borrowed_books WHERE book_id = $book_id AND user_id = $user_id AND return_date IS NULL";
        $result = mysqli_query($conn, $sqlCheck);

        if (mysqli_num_rows($result) > 0) {
            $response = "<div class=\"error\">Book already borrowed by this user</div>";
        } else {
            // Insert the new record into borrowed_books table
            $lend_date = date("Y-m-d");
            $due_date = date("Y-m-d ", strtotime("+14 days", strtotime($lend_date)));
            $sqlInsert = "INSERT INTO borrowed_books (book_id, user_id, borrow_date, return_date, due_date) VALUES ($book_id, $user_id , '$lend_date', null,'$due_date')";

            //show the success message
            if (mysqli_query($conn, $sqlInsert)) {
                //reduce the quantity from books
                $sqlUpdate = "UPDATE books SET quantity = quantity - 1 WHERE books_id = $book_id";
                mysqli_query($conn, $sqlUpdate);

                //display the response
                $response = "<div class=\"lend-success\">
                            <h2>Book Lending Successfull</h2>
                            <div class=\"lend-details\">
                                <div>
                                    <h3>Book ID - <span class=\"response\">$book_id</span> </h3>
                                    <h3>Book Name - <span class=\"response\">$book_name</span> </h3>
                                    <h3>Borrower Name - <span class=\"response\">$user_name</span></h3>
                                    <h3>Borrower Mobile No - <span class=\"response\">$user_mobile</span></h3>
                                    <h3>Lend Date - <span class=\"response\">$lend_date</span> &emsp; Due Date - <span class=\"response\">$due_date</span> </h3>
                                </div>
                                <div>
                                    <img class=\"book-img\" src=\"$book_img\" alt=\"book img\">
                                </div>
                            </div>
                        </div>";
            } else {
                echo mysqli_error($conn);
            }
        }
    }
}

?>


<!-- ---------------- -->
<!-- FRONT END PART -->
<!-- ---------------- -->

<main>
    <div class="book-lending">
        <h2>Lend a Book</h2>
        <form action="lending.php" method="post">
            <div class="book-details">
                <label for="book-id">
                    Book ID
                    <input id="book-id" type="text" name="b-id" required>
                </label>
                <label for="user-mobile">
                    User Mobile No.
                    <input id="user-mobile" type="text" name="user-mobile" required>
                </label>
                <button type="submit" name="lend">Lend the Book</button>
            </div>
        </form>
    </div>

    <?php echo $response; ?>

    <!-- LEND Successful MESSAGE CARD -->
     
    <!-- <div class=\"lend-success\">
        <h2>Book Lending Successfull</h2>
        <div class=\"lend-details\">
            <div>
                <h3>Book ID - <span class=\"response\">$book_id</span> </h3>
                <h3>Book Name - <span class=\"response\">$book_name</span> </h3>
                <h3>Borrower Name - <span class=\"response\">$user_name</span></h3>
                <h3>Borrower Mobile No - <span class=\"response\">$user_mobile</span></h3>
                <h3>Lend Date - <span class=\"response\">$lend_date</span> &emsp; Due Date - <span class=\"response\">$due_date</span> </h3>
            </div>
            <div>
                <img class=\"book-img\" src=\"$book_img\" alt=\"book img\">
            </div>
        </div>
    </div> -->
</main>
<script>
    document.title = "Book Lending";
</script>