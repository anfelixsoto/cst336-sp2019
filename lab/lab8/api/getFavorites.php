<?php
    include '../connect.php';
    
    $conn = getDatabaseConnection("pixabay");
    
    $sql="SELECT image_id, image_url, favorite FROM images ORDER BY image_id";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>