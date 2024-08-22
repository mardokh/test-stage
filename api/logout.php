<?php
session_start();


if (isset($_POST['logout'])) {

    // destroy sesssion and unset variables
    session_unset();
    session_destroy();

    // redirect to connection page
    header("Location: http://localhost/views/connection.html"); 
    exit(); 
}
?>