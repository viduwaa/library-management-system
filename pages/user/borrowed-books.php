<?php
include('../../includes/components/user-panel-head.php');

$html = null;
$sql = "SELECT bb.*, b.name, b.author , b.cover FROM borrowed_books bb JOIN books b ON bb.book_id = b.books_id WHERE user_id = " . $_SESSION['user-id']. " ORDER BY bb.return_date ASC";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($book = mysqli_fetch_assoc($result)) {
        if($book['return_date'] == null){
            $book['return_date'] = "Not Returned";
            $returedClass = "";
            $returnedMsg = "<h4 style='color:red'>Not Returned</h4>";
            $date = "<h4>Due Date - <span class=\"response\">" . $book['due_date'] . "</span></h4>";
        }else{
            $book['return_date'] = $book['return_date'];
            $returedClass = "returned";
            $returnedMsg = "<h4 style='color:green'>Returned</h4>";
            $date = "<h4>Returned Date - <span class=\"response\">" . $book['return_date'] . "</span></h4>";
        }
        $html .= "<div class=\"search-results $returedClass\">
                        <div class=\"book\">
                            <div class=\"book-details\">
                                <h4>Book ID - <span class=\"response\">" . $book['book_id'] . "</span></h4>
                                <h4>Book Name - <span class=\"response\">" . $book['name'] . "</span></h4>
                                <h4>Author - <span class=\"response\">" . $book['author'] . "</span></h4>
                                <h4>Borrowed Date - <span class=\"response\">" . $book['borrow_date'] . "</span></h4>
                                $date
                                $returnedMsg
                            </div>
                            <div class=\"book-img\">
                                <img src=" . $book['cover'] . " alt=\"book img\">
                            </div>                              
                        </div>
                </div>";
    }
}else{
    $html = "<div class=\"no-books\">
                <h4>No books borrowed yet!</h4>
            </div>";
}


?>

<main>
    <div class="result-wrapper">
        <h2>My Borrowed Books:</h2>
        <?php echo $html; ?>
    </div>
</main>

<script>
    document.title = "User Borrowed Books";
</script>