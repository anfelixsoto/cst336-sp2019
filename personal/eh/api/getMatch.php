<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
    $sql = "SELECT user_id, match_user_id, answer_timestamp, answer_type_id, picture_url, username FROM `match` NATURAL JOIN user";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>