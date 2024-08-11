<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
$htmlResponse = null;


if (isset($_POST["book-register"])) {
    $book_name = $_POST["b-name"];
    $book_author = $_POST["b-author"];
    $book_catergory = $_POST["b-catergory"];
    $book_quantity = $_POST["b-quantity"];


    if (isset($_FILES["b-image"]) && $_FILES["b-image"]["size"] > 0) {
        $bookimg_dir = "../../assets/book-images/";
        $book_image = $bookimg_dir . basename($_FILES["b-image"]["name"]);
        $image_type = strtolower(pathinfo($book_image, PATHINFO_EXTENSION));
        $book_image = $bookimg_dir . str_replace(' ', '', $book_name) . date("Ymd-His") . "." . $image_type;
        move_uploaded_file($_FILES["b-image"]["tmp_name"], $book_image);
    } else {
        $book_image = "../../assets/icons/empty-cover.webp";
    }

    $sql = "INSERT INTO books (name,author,genre,cover,quantity) VALUES ('$book_name','$book_author','$book_catergory','$book_image','$book_quantity')";

    try {
        if (mysqli_query($conn, $sql)) {
            $book_id = mysqli_insert_id($conn);
            $htmlResponse = "<div class=\"register-success\">
                                <h2>Book Lending Successfull <br> Please label book as <span style=\"color:var(--primary)\">Book ID :$book_id</span> </h2>
                                    <div class=\"lend-details\">
                                        <div>
                                            <h3>Book ID -<span class=\"response\">$book_id</span></h3>
                                            <h3>Book Name - <span class=\"response\">$book_name</span></h3>
                                            <h3>Book Author - <span class=\"response\">$book_author</span> </h3>
                                            <h3>Book Catergories - <span class=\"response\">$book_catergory</span> </h3>
                                        </div>
                                        <div>
                                            <img class=\"book-img\" src=\"$book_image\" alt=\"book img\">
                                        </div>
                                    </div>
                            </div>";
        } else {
            $response = "<span class=\"error\">Something went wrong !</span>";
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}


?>
<main>
    <div class="book-register">
        <h2>Register a New Book</h2>
        <form action="new-book.php" method="post" enctype="multipart/form-data">
            <div class="book-details">
                <label for="book-name">
                    Book Name
                    <input id="book-name" type="text" name="b-name" required>
                </label>
                <label for="book-author">
                    Book Author
                    <input id="book-author" type="text" name="b-author" required>
                </label>
                <label for="book-catergory">
                    Book Catergory
                    <input id="book-catergory" type="text" name="b-catergory" required>
                </label>
                <label for="book-quantity">
                    Book Quantity
                    <input id="book-quantity" type="text" name="b-quantity" required>
                </label>
                <label for="book-image">
                    Book Image
                    <input id="book-image" type="file" name="b-image">
                </label>
            </div>
            <div class="book-img">
                <img id="img-preview" src="../../assets/icons/empty-cover.webp" alt="">
            </div>
            <button type="submit" name="book-register">Register</button>
        </form>
    </div>
    <?php echo $htmlResponse; ?>
</main>
<script>
    document.getElementById('book-image').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const imgPreview = document.getElementById('img-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imgPreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            imgPreview.src = '../../assets/icons/empty-cover.webp'
        }

    })
</script>