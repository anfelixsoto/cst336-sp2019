<?php
    include '../connect.php';
    $conn = getDatabaseConnection("pixabay");
    
    $np = array();
    $np[':search_name'] = $_POST['search_name'];
    $np[':image_id'] = $_POST['image_id'];
    $np[':image_url'] = $_POST['image_url'];
    
    $sql = "INSERT INTO images (search_name,image_id,image_url,favorite)
    VALUES (:search_name,:image_id,:image_url,'1')";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>