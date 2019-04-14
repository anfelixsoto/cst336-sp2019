<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
     $sql = "SELECT id, about_me, username, picture_url FROM user ORDER BY id";
     
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
     $rand = rand(1,sizeof($records));
     echo json_encode($records[$rand]);
?>