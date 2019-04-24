<?php
    include '../connect.php';
    
    $conn = getDatabaseConnection("pixabay");
    
    $np[':image_id'] = $_POST['image_id'];
    
    $sql = "DELETE FROM images WHERE image_id = :image_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>