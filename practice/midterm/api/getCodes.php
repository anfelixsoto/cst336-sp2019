<?php

    include '../connect.php';
    $conn = getDatabaseConnection("midterm_practice");
    $namedParameters = array();
    $sql = "SELECT * FROM mp_codes WHERE 1 ";

    if(!empty($_GET['promoCode'])){
        $sql .= "AND promoCode LIKE :promoCode";
        $namedParameters[":promoCode"] = "%" . $_GET['promoCode'] . "%";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>