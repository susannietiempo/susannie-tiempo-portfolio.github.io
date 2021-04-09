<?php

include 'includes/session.php';
include 'includes/function.php';

$_SESSION = array();

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();
redirect_to('login.php?logout=1');
?>