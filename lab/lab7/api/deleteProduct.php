<?php
    include '../connect.php';
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();
    $namedParameters[':productId'] = $_POST['productId'];
    
    $sql = "DELETE FROM om_product WHERE productId = :productId";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>