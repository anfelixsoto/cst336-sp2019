<?php
    include '../connect.php';
    
    $conn = getDatabaseConnection("pixabay");
    
    $sql = "SELECT image_id FROM images WHERE 1 ";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
    
?>