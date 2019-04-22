<?php

    include '../connect.php';
    $conn = getDatabaseConnection("poll");
    // print_r ($_POST);
    $np = array();
    $np[':pollId'] = $_POST['pollId'];
    $np[':option'] = $_POST['option'];
    
    $sql = "UPDATE `poll_response` SET ".$np[":option"] ."  = :option WHERE pollId = :pollId ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    //$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT option1, option2, option3, option4, option5 FROM poll_response";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($records);
?>