<?php
include('../../includes/components/admin-panel-head.php')
?>
<main>
    <div>
        <h2>Search for Borrowed books</h2>
        <form action="" class="book-search">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="title">Book ID</option>
                    <option value="user">Username</option>
                    <option value="user-mobile">Mobile No.</option>
                </select>
            </label>
            <input type="text" name="search">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="borrowed">
        <h2>Borrowed Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Username</th>
                    <th>Mobile No.</th>
                    <th>Lend Date</th>
                    <th>Return Date</th>
                    <th>Is due</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Book Name</td>
                    <td>Username</td>
                    <td>Mobile No.</td>
                    <td>12/12/2021</td>
                    <td>12/12/2021</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Book Name</td>
                    <td>Username</td>
                    <td>Mobile No.</td>
                    <td>12/12/2021</td>
                    <td><button>Recieve</button></td>
                    <td>No</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>