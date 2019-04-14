<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
     $sql = "SELECT id, about_me, username, picture_url FROM user ORDER BY id";
     
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
     echo json_encode($records);
?>