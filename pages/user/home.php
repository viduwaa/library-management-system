<?php
include('../../includes/components/user-panel-head.php');
include('../../includes/functions/util_functions.php');

$html = null;


$defaultSQL = "SELECT * FROM books ORDER BY RAND() LIMIT 10";
$result = mysqli_query($conn, $defaultSQL);
if (mysqli_num_rows($result) > 0) {
    $html = renderCard($result);
}


if (isset($_POST['search'])) {
    $search_by = $_POST['search-by'];
    $search_value = $_POST['search-value'];

    if ($search_by == 'title') {
        $sql = "SELECT * FROM books WHERE name LIKE '%$search_value%' LIMIT 10";
    } else if ($search_by == 'author') {
        $sql = "SELECT * FROM books WHERE author LIKE '%$search_value%' LIMIT 10";
    } else if ($search_by == 'category') {
        $sql = "SELECT * FROM books WHERE genre LIKE '%$search_value%' LIMIT 10";
    }

    try {
        $result = mysqli_query($conn, $sql);
        $html = "";
        if (!$result || mysqli_num_rows($result) == 0) {
            $html = "<div class=\"search-results\">
                        <h4>No books found !</h4>
                    </div>";
        } else if ($result && mysqli_num_rows($result) > 0) {
            $html = renderCard($result);
        }
    } catch (Exception $e) {
        $html = "<div class=\"search-results\">
                    <h4>Something went wrong !</h4>
                </div>";
    }
}

?>

<main>
    <div>
        <h2>Search for books</h2>
        <form action="home.php" class="book-search" method="post">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="category">Category</option>
                </select>
            </label>
            <input type="text" name="search-value">
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <div class="result-wrapper">
        <h2>Search Results:</h2>
        <?php echo $html; ?>

       <!-- Result Card -->

        <!-- <div class="search-results">
            <div class="book">
                <div class="book-details">
                    <h4>Book ID - </h4>
                    <h4>Book Name - </h4>
                    <h4>Author- </h4>
                    <h4>Availability - </h4>
                </div>
                <img class="book-img" src="" alt="book img">
            </div>
        </div> -->

        <!--End of Result Card -->
    </div>

</main>
</div>

<script>
    document.title = "User Home";
</script>
</body>

</html>