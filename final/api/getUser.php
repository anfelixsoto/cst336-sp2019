<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
    
    $np = array();
    $np[':user_id'] = $_SESSION['user_id'];
    
    $sql = "SELECT name,email FROM user where user_id = :user_id";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>