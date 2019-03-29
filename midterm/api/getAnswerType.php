<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
    $sql = "SELECT id, name, is_positive, is_negative FROM answer_type_id ORDER BY is_negative";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>

