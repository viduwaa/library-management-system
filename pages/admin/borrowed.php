<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
include('../../includes/functions/util_functions.php');

$error = null;
$html = null;
$sucess = null;


//default page load data
$sql = "SELECT bb.*, b.name, u.username, u.mobile_no 
        FROM borrowed_books bb
        JOIN books b ON bb.book_id = b.books_id 
        JOIN users u ON bb.user_id = u.user_id
        ORDER BY (bb.due_date = CURDATE()) DESC, bb.due_date ASC;";


$result = mysqli_query($conn,$sql);
$html = processResults($result);
                  


// Check if the search form has been submitted
if (isset($_POST['search-submit'])) {
    // Get the search details from the form
    $search_by = $_POST['search-by'];
    $search_value = $_POST['search'];

    // Build the SQL query based on the search type
    switch ($search_by) {
        case 'book-id':
            if (is_numeric($search_value)) {
                $sql = "SELECT bb.*, b.name, u.username, u.mobile_no 
                        FROM borrowed_books bb
                        JOIN books b ON bb.book_id = b.books_id 
                        JOIN users u ON bb.user_id = u.user_id
                        WHERE bb.book_id = $search_value ORDER BY bb.borrow_date DESC";
            } else {
                $error = '<h3 class="warning">Please enter a valid book ID!</h3>';
            }
            break;
        
        case 'user-mobile':
            $sql = "SELECT bb.*, b.name, u.username, u.mobile_no 
                    FROM borrowed_books bb
                    JOIN books b ON bb.book_id = b.books_id 
                    JOIN users u ON bb.user_id = u.user_id
                    WHERE u.mobile_no = '$search_value' ORDER BY bb.borrow_date DESC";
            break;

        case 'user':
            $sql = "SELECT bb.*, b.name, u.username, u.mobile_no 
                    FROM borrowed_books bb
                    JOIN books b ON bb.book_id = b.books_id 
                    JOIN users u ON bb.user_id = u.user_id
                    WHERE u.username LIKE '%$search_value%' ORDER BY bb.borrow_date DESC";
            break;

        default:
            $error = '<h3 class="warning">Invalid search criteria!</h3>';
            break;
    }

    // Execute the query if no errors
    if (!$error && isset($sql)) {
        $resultBookID = mysqli_query($conn, $sql);
        if ($resultBookID) {
            $html = processResults($resultBookID);
        } else {
            $error = '<h3 class="warning">Error executing query!</h3>';
        }
    }
}


// Check if the book has been received
if(isset($_POST['recieved'])){
    // Get the book ID and user ID from the form
    $book_id = $_POST['b-id'];
    $user_id = $_POST['u-id'];

    // Update the borrowed_books table to set the return date
    $sqlRecieve = "UPDATE borrowed_books SET return_date = NOW() WHERE book_id = $book_id AND user_id = $user_id AND return_date IS NULL";
    $result = mysqli_query($conn, $sqlRecieve);

    // Update the books table to increase the quantity
    $sqlQuantity = "UPDATE books SET quantity = quantity + 1 WHERE books_id = $book_id";
    $resultQuantity = mysqli_query($conn, $sqlQuantity);

    // Query to get the details of the received book
    $sqlRecieved = "SELECT bb.*, b.name, u.username, u.mobile_no 
                    FROM borrowed_books bb
                    JOIN books b ON bb.book_id = b.books_id 
                    JOIN users u ON bb.user_id = u.user_id
                    WHERE bb.book_id = $book_id AND bb.user_id = $user_id";

    $resultRecieved = mysqli_query($conn, $sqlRecieved);

    // Check if all queries were successful
    if($result && $resultQuantity && $resultRecieved){
        $sucess = '<h3 class="sucess">Book received successfully!</h3>';
        $html = processResults($resultRecieved);
    } else {
        $error = '<h3 class="warning">Error receiving book!</h3>';
    }
}



?>
<main>
    <div>
        <h2>Search for Borrowed books</h2>
        <form action="borrowed.php" class="book-search" method="post">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="book-id">Book ID</option>
                    <option value="user">Username</option>
                    <option value="user-mobile" selected>Mobile No.</option>
                </select>
            </label>
            <input type="text" name="search" required>
            <button type="submit" name="search-submit">Search</button>
        </form>
        <?php echo $error,$sucess; ?>
    </div>

    <div class="borrowed">
        <h2>Borrowed Books</h2>
        <table>
            <thead>
                <tr>
                    <th id="book_id">Book ID</th>
                    <th id="book_name">Book Name</th>
                    <th id="book_borrower">Username</th>
                    <th id="book_borrowerNo">Mobile No.</th>
                    <th id="book_lendDate">Lend Date</th>
                    <th id="book_due">Due Date</th>
                    <th id="book_return">Return Date</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $html; ?>

               <!--  TALBE ROW RESPONSE  -->

                <!-- <form action="borrowed.php" method="post">
                        <tr>
                            <td>' . $row['book_id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['mobile_no'] . '</td>
                            <td>' . $row['borrow_date'] . '</td>
                            <td '.$showColor.' >' . $row['due_date'] . '</td>
                            <td> 
                                <input type="hidden" name="b-id" value="' . $row['book_id'] . '">
                                <input type="hidden" name="u-id" value="' . $row['user_id'] . '">' . $checkDue . '
                            </td>
                        </tr>
                      </form> -->

                <!-- ------------------ -->
            </tbody>
        </table>
    </div>
</main>
<script>
    document.title = "Book Recieving and Borrowed Books";
</script>