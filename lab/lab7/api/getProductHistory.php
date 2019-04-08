<?php
    include '../connect.php';
    $conn = getDatabaseConnection("ottermart2");
    
    $productId = $_GET['productId'];
    $sql = "SELECT * FROM om_product WHERE productId = :pId";
    
    $np = array();
    $np[':pId'] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>