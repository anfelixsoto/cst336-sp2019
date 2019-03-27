<?php

    include '../connect.php';
    $conn = getDatabaseConnection("midterm_practice");
    $namedParameters = array();
    $sql = "SELECT * FROM mp_product WHERE 1 ";

    if(!empty($_GET['productId'])){
        $sql .= "AND productId = :productId";
        $namedParameters[":productId"] = $_GET['productId'];
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>