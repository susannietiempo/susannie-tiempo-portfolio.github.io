<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'PASSWORD';
    $dbName = 'susannie_tiempo_portfolio';

    $dbLink = new mysqli($server, $username, $password, $dbName);

    if ($dbLink->connect_errno) {
        printf("Unable to connect to database: %s", $dbLink->connect_error);
        exit();
    }
?>

