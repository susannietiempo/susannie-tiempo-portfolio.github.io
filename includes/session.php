<?php session_start();

function confirm_logged_in(){
    if (!isset($SESSION['username'])) {
        redirect_to('login.php');
    }

}


?>