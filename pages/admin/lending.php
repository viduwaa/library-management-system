<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
?>
<main>
    <div class="book-lending">
        <h2>Lend a Book</h2>
        <form action="">
            <div class="book-details">
                <label for="book-id">
                    Book ID 
                    <input id="book-id" type="text" name="b-id">
                </label>
                <label for="user-mobile">
                    User Mobile No.
                    <input id="user-mobile" type="text" name="user-mobile">
                </label>
                <button type="submit">Lend the Book</button>
            </div>
        </form>
    </div>

    <div class="lend-success">
        <h2>Book Lending Successfull</h2>
        <div class="lend-details">
            <div>
                <h3>Book ID - </h3>
                <h3>Book Name - </h3>
                <h3>Borrower Name - </h3>
                <h3>Borrower Mobile No - </h3>
                <h3>Lend Date - </h3>
                <h3>Due Date - </h3>
            </div>
            <div>
                <img class="book-img" src="" alt="book img">
            </div>
        </div>
    </div>
</main>