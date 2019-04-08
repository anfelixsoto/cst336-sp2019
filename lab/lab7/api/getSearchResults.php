<?php

    include '../connect.php';
    $conn = getDatabaseConnection("ottermart2");
    $namedParameters = array();
    $sql = "SELECT * FROM om_product WHERE 1 ";
    
    if(!empty($_GET['category'])){
        $sql .= "AND catId = :categoryId";
        $namedParameters[":categoryId"] = $_GET['category'];
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>