<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
?>
<main>
    <div>
        <h2>Search for books</h2>
        <form action="" class="book-search">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="title">Book ID</option>
                    <option value="author">Book Name</option>
                    <option value="category">Book Author</option>
                </select>
            </label>
            <input type="text" name="search">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="result-wrapper">
        <h2>Search Results:</h2>

        <div class="search-results">
            <div class="book">
                <div class="book-details">
                    <form action="">
                        <label for="b-id"> Book ID - 
                            <input type="text" id="b-id" disabled>
                        </label>
                        <label for="b-name"> Book Name - 
                            <input class="edit" type="text" id="b-name" disabled>
                        </label>
                        <label for="b-author"> Book Author - 
                            <input class="edit" type="text" id="b-author" disabled>
                        </label>
                        <label for="b-quantity"> Book Quantity - 
                            <input class="edit" type="text" id="b-quantity" disabled>
                        </label>
                        <div>
                            <button id="edit">Edit</button>
                            <button type="submit">Update</button>
                        </div>
                        
                    </form>
                    <img class="book-img" src="" alt="book img">
                </div>
            </div>
        </div>


    </div>    
</main>
<script>
    document.getElementById('edit').addEventListener('click',(e)=>{
        e.preventDefault();
        const inputs = document.querySelectorAll('.edit');
        inputs.forEach(input=>{
            input.disabled = false;
        })
    })
</script>