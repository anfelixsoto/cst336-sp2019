<?php
    $host = "127.0.0.1";
    $dbname = "just_bits";
    $username = "antoniofelix118";
    $password = "";

    // Get Data from DB
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
?>