<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
    $sql = "SELECT u.id, u.username, m.answer_type_id FROM  `user` u LEFT JOIN  `match` m ON u.id = m.match_user_id WHERE m.user_id =1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>