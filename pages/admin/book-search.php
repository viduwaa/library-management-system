<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');

$row = null;
$response = null;

//BOOK SEARCH
if (isset($_POST['book-search'])) {
    $search_by = $_POST['search-by'];
    $search_value = $_POST['search'];


    if ($search_by == 'book-id' && !is_numeric($search_value)) {
        $response = "<h4 class=\"warning\">Book ID must be a number !</h4>";
    } else {
        if ($search_by == 'book-id') {
            $sql = "Select * FROM books WHERE books_id = $search_value";
        } else if ($search_by == 'name') {
            $sql = "Select * FROM books WHERE name LIKE '%$search_value%'";
        } else if ($search_by == 'author') {
            $sql = "Select * FROM books WHERE author LIKE '%$search_value%'";
        }

        try {
            $result = mysqli_query($conn, $sql);
            $row = "";
            if (!$result || mysqli_num_rows($result) == 0) {
                $row = "<div class=\"search-results\"> 
                            <h4>No books found !</h4>
                        </div>";
            } else if ($result && mysqli_num_rows($result) > 0) {
                while ($book = mysqli_fetch_assoc($result)) {
                    $row .= "<div class=\"search-results\">
                                <div class=\"book\">
                                    <div class=\"book-details\">
                                        <form action=\"book-search.php\" method=\"post\">
                                            <label for=\"b-id\"> Book ID - 
                                                <input type=\"text\" id=\"b-id\" value=\"".$book['books_id']."\" disabled>
                                            </label>
                                            <label for=\"b-id\" class=\"hidden-input\"> Book ID - 
                                                <input type=\"text\" id=\"b-id\" name=\"b-id\" value=\"".$book['books_id']."\">
                                            </label>
                                            <label for=\"b-name\"> Book Name - 
                                                <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-name\" name=\"b-name\" value=\"".$book['name']."\" disabled>
                                            </label>
                                            <label for=\"b-author\"> Book Author - 
                                                <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-author\" name=\"b-author\" value=\"".$book['author']."\" disabled>
                                            </label>
                                            <label for=\"b-catergory\"> Book Catergories - 
                                                <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-catergory\" name=\"b-catergory\" value=\"".$book['genre']."\" disabled>
                                            </label>
                                            <label for=\"b-quantity\"> Book Quantity - 
                                                <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-quantity\" name=\"b-quantity\" value=\"".$book['quantity']."\" disabled>
                                            </label>
                                            <div>
                                                <button id=\"edit-".$book['books_id']."\">Edit</button>
                                                <button type=\"submit\" class=\"hidden-input\" id=\"update-".$book['books_id']."\" name=\"book-update\">Update</button>
                                            </div>
                                        </form>
                                        <div class=\"book-img\"><img src=\"".$book['cover']."\" alt=\"book img\"></div>
                                    </div>
                                </div>
                            </div> 
                            <script>
                                document.getElementById('edit-".$book['books_id']."').addEventListener('click', (e) => {
                                    e.preventDefault();
                                    const inputs = document.querySelectorAll('.edit-".$book['books_id']."');
                                    inputs.forEach(input => {
                                        input.disabled = false;
                                        document.getElementById('update-".$book['books_id']."').style.display = 'inline';
                                    })
                                })
                            </script>";
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}


//BOOK UPDATE
if (isset($_POST['book-update'])) {
    $book_id = $_POST['b-id'];
    $book_name = $_POST['b-name'];
    $book_author = $_POST['b-author'];
    $book_genre = $_POST['b-catergory'];
    $book_quantity = $_POST['b-quantity'];

    $sql = "UPDATE books SET name = '$book_name' , author = '$book_author' , genre = '$book_genre' , quantity = $book_quantity  WHERE  books_id = $book_id";

    try {
        $result = mysqli_query($conn,$sql);
        if($result){
            $response = "<h4 class=\"update-success\">Book Updated Successfully !</h4>";
        }else{
            $response = "<h4 class=\"error\">Something went wrong !</h4>";
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}

?>

<main>
    <div>
        <h2>Search for books</h2>
        <form action="book-search.php" class="book-search" method="post">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="book-id">Book ID</option>
                    <option value="name" selected>Book Name</option>
                    <option value="author">Book Author</option>
                </select>
            </label>
            <input type="text" name="search" required>
            <button type="submit" name="book-search">Search</button>
        </form>
        <?php echo $response ?>
    </div>

    <div class="result-wrapper">
        <h2>Search Results:</h2>
        <?php
        echo $row;
        ?>
    </div>
</main>
<script>
    document.title = "Book Search";
</script>