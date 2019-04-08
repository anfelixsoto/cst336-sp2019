<?php
//Used to check the letter the user inputed in the form, and if the letter is in the word
//Should return an array of booleans as the api
    include '../dbConnection.php';

    $wid1 = intval($_GET['wordId']);
    
    $sql = "select * from words where word_id = $wid1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch();
    
    echo $record;

?>