<?php
include('../../includes/components/admin-panel-head.php');
include('../../includes/functions/check_admin.php');

$error = null;
$html = null;

if (isset($_POST['search-submit'])) {
    $search_by = $_POST['search-by'];
    $search_value = $_POST['search'];

    switch ($search_by) {
        case 'username':
            $sqlUser = "SELECT * FROM users WHERE username LIKE '%$search_value%'";
            break;
        case 'mobile':
            $sqlUser = "SELECT * FROM users WHERE mobile_no LIKE '%$search_value%'";
            break;
        case 'email':
            $sqlUser = "SELECT * FROM users WHERE email LIKE '%$search_value%'";
            break;
        default:
            $error = '<h3 class="warning">Please enter a valid search type!</h3>';
            break;
    }

    $result = mysqli_query($conn, $sqlUser);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $sqlborrowed = "SELECT user_id FROM borrowed_books WHERE user_id = {$row['user_id']}";
            $resultBorrowed = mysqli_query($conn, $sqlborrowed);

            $html .= '<form action="user-details.php" method="post">
                        <input type="hidden" name="user-id" value="'.$row['user_id'].'">
                        <tr>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['mobile_no'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . mysqli_num_rows($resultBorrowed) . '</td>
                            <td><button type="submit" name="open-details">Details</button></td>
                        </tr>
                    </form>';
        }
    }else{
        $html = "<tr><td colspan=\"5\">No results found.</td></tr>";
    }
}

?>
<main>
    <div>
        <h2>Search for User</h2>
        <form action="user-search.php" class="book-search" method="post">
            <label for="search-by">
                Search by:
                <select name="search-by" id="search-by">
                    <option value="username">Username</option>
                    <option value="mobile">Mobile No.</option>
                    <option value="email">Email</option>
                </select>
            </label>
            <input type="text" name="search" required>
            <button type="submit" name="search-submit">Search</button>
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($html) {
                    echo $html;
                } else {
                    for ($i = 0; $i < 5; $i++){
                        echo "<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>";
                    }
                } ?>
        </table>
    </div>
</main>
<script>
    document.title = "User Search";
</script>