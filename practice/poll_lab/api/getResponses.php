<?php
    include '../connect.php';
    $conn = getDatabaseConnection("poll");
    
    $sql = "SELECT option1, option2, option3, option4, option5 FROM poll_response";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records); 
?>