<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
?>
<main>
    <div class="book-register">
        <h2>Register a New Book</h2>
        <form action="">
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
            <button type="submit">Register</button>
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