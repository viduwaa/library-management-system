<?php
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