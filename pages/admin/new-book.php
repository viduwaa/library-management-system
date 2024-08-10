<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');


if (isset($_POST["book-register"])) {
    $book_name = $_POST["b-name"];
    $book_author = $_POST["b-author"];
    $book_catergory = $_POST["b-catergory"];
    $book_quantity = $_POST["b-quantity"];

    $bookimg_dir = "../../assets/book-images/";
    $book_image = $bookimg_dir . basename($_FILES["b-image"]["name"]);
    $image_type = strtolower(pathinfo($book_image, PATHINFO_EXTENSION));
    $book_image = $bookimg_dir . $book_name .date("Ymd-His"). "." . $image_type;

    // Check if the file is an image
    /* $image_check = getimagesize($_FILES["b-image"]["tmp_name"]);
    if ($image_check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["b-image"]["tmp_name"], $book_image)) {
            echo "The file has been uploaded successfully.";
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "The uploaded file is not a valid image.";
    } */
}


?>
<main>
    <div class="book-register">
        <h2>Register a New Book</h2>
        <form action="new-book.php" method="post" enctype="multipart/form-data">
            <div class="book-details">
                <label for="book-name">
                    Book Name 
                    <input id="book-name" type="text" name="b-name">
                </label>
                <label for="book-author">
                    Book Author 
                    <input id="book-author" type="text" name="b-author">
                </label>
                <label for="book-catergory">
                    Book Catergory 
                    <input id="book-catergory" type="text" name="b-catergory">
                </label>
                <label for="book-quantity">
                    Book Quantity 
                    <input id="book-quantity" type="text" name="b-quantity">
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
</main>
<script>
    document.getElementById('book-image').addEventListener('change',(e)=>{
        const file = e.target.files[0];
        const imgPreview = document.getElementById('img-preview');

        if(file){
            const reader = new FileReader();
            reader.onload = (e)=>{
                imgPreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }else{
            imgPreview.src = '../../assets/icons/empty-cover.webp'
        }

    })
</script>