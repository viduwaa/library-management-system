<?php
include('../../includes/components/user-panel-head.php');
include('../../includes/functions/check_user.php');
?>

<main>
    <div>
        <h2>Search for books</h2>
        <form action="" class="book-search">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="category">Category</option>
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
                    <h4>Book ID - </h4>
                    <h4>Book Name - </h4>
                    <h4>Author- </h4>
                    <h4>Availability - </h4>
                </div>
                <img class="book-img" src="" alt="book img">
            </div>
        </div>
    </div>

</main>
</div>
</body>

</html>