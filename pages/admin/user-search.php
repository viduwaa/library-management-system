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

    <div class="user-table">
        <h2>Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Mobile No.</th>
                    <th>Email</th>
                    <th>Borrowed Books</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Username</td>
                    <td>Mobile No.</td>
                    <td>Email</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>Mobile No.</td>
                    <td>Email</td>
                    <td>2</td>
                </tr>
        </table>
    </div>
</main>

