<?php
    require_once('db_connect.php');
    session_start();

    if(!isset($_SESSION["user-mobile"])){
        header("Location: ../../");
    }
?>