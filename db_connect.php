<?php
    require_once "./config.php";
    $connection = new mysqli(IPADDRESS, USERNAME, PASSWORD, DBNAME, PORTNO);
    if($connection->error) {
        die("Connection Error : " . $connection->error);
    }