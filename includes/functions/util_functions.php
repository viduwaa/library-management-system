<?php

//USER PANEL BOOK CARD
function renderCard($result){
    $html = '';
    while ($book = mysqli_fetch_assoc($result)) {
        $avaialability = $book['quantity'] > 0 ? '<span class="sucess response">Available</span>' : '<span class="error">Not Available</span>';

        $html .= "<div class=\"search-results\">
                    <div class=\"book\">
                        <div class=\"book-details\">
                            <h4>Book ID - <span class=\"response\">" . $book['books_id'] . "</span></h4>
                            <h4>Book Name - <span class=\"response\">" . $book['name'] . "</span></h4>
                            <h4>Author - <span class=\"response\">" . $book['author'] . "</span></h4>
                            <h4>Genres - <span class=\"response\">" . $book['genre'] . "</span></h4>
                            <h4>Availability - " . $avaialability . "</h4>
                        </div>
                        <div class=\"book-img\">
                            <img src=" . $book['cover'] . " alt=\"book img\">
                        </div>                              
                    </div>
                </div>";
    }

    return $html;
}

//ADMIN PANEL BOOK CARD /W EDIT
function renderEditBooksCards($result){
    $html = '';
    while ($book = mysqli_fetch_assoc($result)) {
        $html .= "<div class=\"search-results\">
                    <div class=\"book\">
                        <div class=\"book-details\">
                            <form action=\"book-search.php\" method=\"post\">
                                <label for=\"b-id\"> Book ID - 
                                    <input type=\"text\" id=\"b-id\" value=\"".$book['books_id']."\" disabled>
                                </label>
                                <label for=\"b-id\" class=\"hidden-input\"> Book ID - 
                                    <input type=\"text\" id=\"b-id\" name=\"b-id\" value=\"".$book['books_id']."\">
                                </label>
                                <label for=\"b-name\"> Book Name - 
                                    <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-name\" name=\"b-name\" value=\"".htmlspecialchars($book['name'])."\" disabled>
                                </label>
                                <label for=\"b-author\"> Book Author - 
                                    <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-author\" name=\"b-author\" value=\"".htmlspecialchars($book['author'])."\" disabled>
                                </label>
                                <label for=\"b-catergory\"> Book Catergories - 
                                    <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-catergory\" name=\"b-catergory\" value=\"".htmlspecialchars($book['genre'])."\" disabled>
                                </label>
                                <label for=\"b-quantity\"> Book Quantity - 
                                    <input class=\"edit-".$book['books_id']."\" type=\"text\" id=\"b-quantity\" name=\"b-quantity\" value=\"".htmlspecialchars($book['quantity'])."\" disabled>
                                </label>
                                <div>
                                    <button id=\"edit-".$book['books_id']."\">Edit</button>
                                    <button type=\"submit\" class=\"hidden-input\" id=\"update-".$book['books_id']."\" name=\"book-update\">Update</button>
                                </div>
                            </form>
                            <div class=\"book-img\"><img src=\"".$book['cover']."\" alt=\"book img\"></div>
                        </div>
                    </div>
                </div> 
                <script>
                    document.getElementById('edit-".$book['books_id']."').addEventListener('click', (e) => {
                        e.preventDefault();
                        const inputs = document.querySelectorAll('.edit-".$book['books_id']."');
                        inputs.forEach(input => {
                            input.disabled = false;
                            document.getElementById('update-".$book['books_id']."').style.display = 'inline';
                        })
                    })
                </script>";             
    }
    

    return $html;
}

//ADMIN BORROWED BOOKS TABLE RENDER
function processResults($resultBookID) {
    date_default_timezone_set('Asia/Colombo');  
    $html = '';
    
    if (mysqli_num_rows($resultBookID) > 0) {
        while ($row = mysqli_fetch_assoc($resultBookID)) {
            $showColor = '';
            $checkDue = $row['return_date'] == null ? '<button type="submit" name="recieved">Receive</button>' : $row['return_date'];
            
            if($row['due_date'] === date("Y-m-d") && $row['return_date'] == null){
                $showColor = 'style="color:red"';
            }
            $html .= '<form action="borrowed.php" method="post">
                        <tr>
                            <td>' . $row['book_id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['mobile_no'] . '</td>
                            <td>' . $row['borrow_date'] . '</td>
                            <td '.$showColor.' >' . $row['due_date'] . '</td>
                            <td> 
                                <input type="hidden" name="b-id" value="' . $row['book_id'] . '">
                                <input type="hidden" name="u-id" value="' . $row['user_id'] . '">' . $checkDue . '
                            </td>
                        </tr>
                      </form>';
        }
    } else {
        $html .= '<tr><td colspan="7">No results found.</td></tr>';
    }
    return $html;
}