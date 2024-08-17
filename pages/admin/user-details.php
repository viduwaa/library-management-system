<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');

$error = null;
$response = null;
$htmlUser = null;
$htmlBooks = null;

if (isset($_POST['open-details']) || isset($_POST['direct-search'])) {
    if (isset($_POST['open-details'])) {
        $user_id = $_POST['user-id'];
        $sqlUser = "SELECT * FROM users WHERE user_id = '$user_id'";
    } else {
        $searchBy = $_POST['search-by'];
        $search = $_POST['search'];
        $sqlUser = "SELECT * FROM users WHERE $searchBy = '$search'";
    }

    $result = mysqli_query($conn, $sqlUser);
    if (mysqli_num_rows($result) == 0) {
        $response = '<h3 class="error">User not found</h3>';
    } else {
        $userRow = mysqli_fetch_assoc($result);
        $htmlUser = '<div>
                    <form action="user-details.php" method="post">
                        <label for="u-id"> User ID - 
                            <input type="text" id="u-id" value="' . $userRow['user_id'] . '" disabled>
                            <input type="hidden" name="u-id" value="' . $userRow['user_id'] . '">
                        </label>
                        <label for="u-name"> Username - 
                            <input class="edit" type="text" name="u-name" value="' . $userRow['username'] . '" disabled>
                        </label>
                        <label for="u-email"> User Email - 
                            <input class="edit" type="text" name="u-email" value="' . $userRow['email'] . '" disabled>
                        </label>
                        <label for="u-mobile"> User Mobile No - 
                            <input class="edit" type="text" name="u-mobile" value="' . $userRow['mobile_no'] . '" disabled>
                        </label>
                        <div>
                            <button id="edit">Edit</button>
                            <button type="submit" name="update">Update</button>
                            <button type="submit" name="remove">Remove</button>
                        </div>   
                    </form>
                </div>';

        $sqlBorrowed = "SELECT bb.*, b.books_id, b.name, b.cover FROM borrowed_books bb JOIN books b ON bb.book_id = b.books_id WHERE user_id = " . $userRow['user_id'] . " ORDER BY bb.borrow_date DESC";

        $resultBorrowed = mysqli_query($conn, $sqlBorrowed);
        if (mysqli_num_rows($resultBorrowed) > 0) {
            while ($rowBorrowed = mysqli_fetch_assoc($resultBorrowed)) {
    
                if($rowBorrowed['return_date'] == null){
                    $rowBorrowed['return_date'] = "Not Returned";
                    $returedClass = "";
                }else{
                    $rowBorrowed['return_date'] = $rowBorrowed['return_date'];
                    $returedClass = "returned";
                }

                $htmlBooks .= '<div class="book-details '. $returedClass.'">
                                        <div>
                                            <h3>Book ID - <span class="response">' . $rowBorrowed['books_id'] . '</span></h3>
                                            <h3>Book Title - <span class="response"> ' . $rowBorrowed['name'] . '</span></h3>
                                            <h3>Borrowed Date - <span class="response"> ' . $rowBorrowed['borrow_date'] . '</span></h3>
                                            <h3>Returned - <span class="response"> ' . $rowBorrowed['return_date'] . '</span></h3>
                                        </div>
                                        <div>
                                            <img src="' . $rowBorrowed['cover'] . '" alt="">
                                        </div>
                                        
                                    </div>';
            }
        } else {
            $htmlBooks = '<div class="warning">No books borrowed by this user</div>';
        }
    }
}

if (isset($_POST['update'])) {
    $user_id = $_POST['u-id'];
    $username = $_POST['u-name'];
    $email = $_POST['u-email'];
    $mobile = $_POST['u-mobile'];

    $sqlUpdate = "UPDATE users SET username = '$username', email = '$email', mobile_no = '$mobile' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sqlUpdate)) {
        $response = '<h3 class="sucess">User details updated successfully</h3>';
    } else {
        $error = mysqli_error($conn);
    }
}

?>
<main>
    <div>
        <h2>Search for User Directly</h2>
        <form action="" class="book-search" method="post">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="mobile_no">Mobile No.</option>
                    <option value="email">Email</option>
                </select>
            </label>
            <input type="text" name="search" required>
            <button type="submit" name="direct-search">Search</button>
        </form>
    </div>

    <div>
        <h2>Search Results</h2>
        <div class="user-details">
            <?php echo $htmlUser;
            if (isset($htmlBooks)) {
                echo '<div class="user-books">
                            <h2>User Borrowed Books</h2>'
                    . $htmlBooks .
                    '</div>';
            } else if (isset($response)) {
                echo $response;
            }
            ?>

        </div>
    </div>
</main>
<script>
    document.title = "User Details & Update";

    document.getElementById('edit').addEventListener('click', (e) => {
        e.preventDefault();
        const inputs = document.querySelectorAll('.edit');
        inputs.forEach(input => {
            input.disabled = false;
        })
    })

</script>