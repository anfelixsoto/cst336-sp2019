<?php
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
    
    $np = array();
    $np[':id'] = $_GET['id'];
    
    $sql = "SELECT id, date, start_time, end_time FROM appointment WHERE id = :id";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>