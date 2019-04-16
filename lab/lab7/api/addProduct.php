<?php
    
    include '../connect.php';
    $conn = getDatabaseConnection("ottermart");
    
    $namedParameters = array();
    $namedParameters[':productId'] = $_POST['productId'];
    $namedParameters[':productName'] = $_POST['productName'];
    $namedParameters[':productDescription'] = $_POST['productDescription'];
    $namedParameters[':productImage'] = $_POST['productImage'];
    $namedParameters[':price'] = $_POST['price'];
    $namedParameters[':catId'] = $_POST['catId'];
    
    $sql = "INSERT INTO om_product (productId, productName, productDescription, productImage, price, catId)
    VALUES (:productId,:productName, :productDescription, :productImage, :price, :catId)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>