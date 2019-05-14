<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
    
    $userId = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM appointment WHERE user_id = '$userId'";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>