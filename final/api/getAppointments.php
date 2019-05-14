<?php
    
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
    
    $userId = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM appointment WHERE 1 ";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>