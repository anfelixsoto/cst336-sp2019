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
    $np[':date'] = $_POST['date'];
    $np[':startTime'] = $_POST['startTime'];
    $np[':endTime'] = $_POST['endTime'];
    
    $sql = "INSERT INTO appointment (user_id,start_time,end_time,date) values (:user_id,:startTime,:endTime,:date)";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
?>