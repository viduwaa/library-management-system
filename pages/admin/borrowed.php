<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');

$error = null;
$html = null;

// Check if the search form has been submitted
if (isset($_POST['search-submit'])) {
    // Get the search details from the form
    $search_by = $_POST['search-by'];
    $search_value = $_POST['search'];

    // Check if the search is by book ID 
    if ($search_by == 'book-id') {
        // Check if the search value is a number
        if (is_numeric($search_value)) {
            // SQL query to get borrowed books by book ID
            $sqlBookID = "SELECT bb.* , b.name , u.username , u.mobile_no FROM borrowed_books bb
                            JOIN books b ON bb.book_id = b.books_id 
                            JOIN users u ON bb.user_id = u.user_id
                        WHERE bb.book_id = $search_value";

            // Execute the query
            $resultBookID = mysqli_query($conn, $sqlBookID);
            if ($resultBookID) {
                //check if there any result
                if (mysqli_num_rows($resultBookID) > 0) {
                    // Fetch and display the results
                    while ($row = mysqli_fetch_assoc($resultBookID)) {
                        $checkDue = $row['return_date'] == null ? '<button>Receive</button>' : $row['return_date'];
                        $html .= '<form action="borrowed.php" method="post">
                                    <tr>
                                        <td>' . $row['book_id'] . '</td>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $row['mobile_no'] . '</td>
                                        <td>' . $row['borrow_date'] . '</td>
                                        <td>' . $checkDue . '</td>
                                        <td>Yes</td>
                                    </tr>
                                  </form>';
                    }
                } else {
                    // Display a message if no results are found
                    $html .= '<tr><td colspan="7">No results found.</td></tr>';
                }
            } else {
                // Display an error if the query fails
                $error = '<h3 class="warning">Error executing query!</h3>';
            }
        } else {
            // Display an error if the book ID is not a number
            $error = '<h3 class="warning">Please enter a valid book ID!</h3>';
        }

    // Check if the search is by user mobile number
    } else if ($search_by == 'user-mobile') {
        // SQL query to get borrowed books by user mobile number
        $sqlBookID = "SELECT bb.*, b.name, u.username, u.mobile_no 
                      FROM borrowed_books bb
                      JOIN books b ON bb.book_id = b.books_id 
                      JOIN users u ON bb.user_id = u.user_id
                      WHERE u.mobile_no = '$search_value'";

        // Execute the query
        $resultBookID = mysqli_query($conn, $sqlBookID);
        if ($resultBookID) {
            // Check if there are any results
            if (mysqli_num_rows($resultBookID) > 0) {
                // Fetch and display the results
                while ($row = mysqli_fetch_assoc($resultBookID)) {
                    $checkDue = $row['return_date'] == null ? '<button>Receive</button>' : $row['return_date'];
                    $html .= '<form action="borrowed.php" method="post">
                                <tr>
                                    <td>' . $row['book_id'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['mobile_no'] . '</td>
                                    <td>' . $row['borrow_date'] . '</td>
                                    <td>' . $checkDue . '</td>
                                    <td>Yes</td>
                                </tr>
                              </form>';
                }
            } else {
                // Display a message if no results are found
                $html .= '<tr><td colspan="7">No results found.</td></tr>';
            }
        } else {
            // Display an error if the query fails
            $error = '<h3 class="warning">Error executing query!</h3>';
        }
    }// Check if the search is by username
    else if ($search_by == 'user') {
        // SQL query to get borrowed books by username
        $sqlBookID = "SELECT bb.*, b.name, u.username, u.mobile_no 
                      FROM borrowed_books bb
                      JOIN books b ON bb.book_id = b.books_id 
                      JOIN users u ON bb.user_id = u.user_id
                      WHERE u.username LIKE '%$search_value%'";

        // Execute the query
        $resultBookID = mysqli_query($conn, $sqlBookID);
        if ($resultBookID) {
            // Check if there are any results
            if (mysqli_num_rows($resultBookID) > 0) {
                // Fetch and display the results
                while ($row = mysqli_fetch_assoc($resultBookID)) {
                    $checkDue = $row['return_date'] == null ? '<button>Receive</button>' : $row['return_date'];
                    $html .= '<form action="borrowed.php" method="post">
                                <tr>
                                    <td>' . $row['book_id'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['mobile_no'] . '</td>
                                    <td>' . $row['borrow_date'] . '</td>
                                    <td>' . $checkDue . '</td>
                                    <td>Yes</td>
                                </tr>
                              </form>';
                }
            } else {
                // Display a message if no results are found
                $html .= '<tr><td colspan="7">No results found.</td></tr>';
            }
        } else {
            // Display an error if the query fails
            $error = '<h3 class="warning">Error executing query!</h3>';
        }
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
        <?php echo $error; ?>
    </div>

    <div class="borrowed">
        <h2>Borrowed Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Username</th>
                    <th>Mobile No.</th>
                    <th>Lend Date</th>
                    <th>Return Date</th>
                    <th>Is due</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $html; ?>
            </tbody>
        </table>
    </div>
</main>