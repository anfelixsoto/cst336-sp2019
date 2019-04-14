<?php
     include '../connect.php';
    
    $conn=getDatabaseConnection("ottermart");
    
    $sql="SELECT productId, productName, productDescription, productImage, price FROM om_product ORDER BY productId ";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>