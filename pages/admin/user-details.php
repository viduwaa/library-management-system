<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');
?>
<main>
    <div>
        <h2>Search for User</h2>
        <form action="" class="book-search">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="username">Username</option>
                    <option value="mobile">Mobile No.</option>
                    <option value="email">Email</option>
                </select>
            </label>
            <input type="text" name="search">
            <button type="submit">Search</button>
        </form>
    </div>

    <div>
        <h2>Search Results</h2>
        <div class="user-details">
            <div>
                <form action="">
                    <label for="u-id"> User ID - 
                        <input type="text" id="u-id" disabled>
                    </label>
                    <label for="u-name"> Username - 
                        <input class="edit" type="text" id="u-name" disabled>
                    </label>
                    <label for="u-email"> User Email - 
                        <input class="edit" type="text" id="u-email" disabled>
                    </label>
                    <label for="u-mobile"> User Mobile No - 
                        <input class="edit" type="text" id="u-mobile" disabled>
                    </label>
                    <div>
                        <button id="edit">Edit</button>
                        <button type="submit" name="update">Update</button>
                        <button type="submit" name="remove">Remove</button>
                    </div>   
                </form>
            </div>
            <div class="user-books">
                <h2>User Borrowed Books</h2>
                <div class="book-details">
                    <h3>Book ID -</h3>
                    <h3>Book Title -</h3>
                    <h3>Borrowed Date -</h3>
                    <h3>Due Date -</h3>
                    <h3>Returned - </h3>
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