<?php
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
    
    $np = array();
    $appointment_id = $_POST['appointment_id'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    $sql = "SELECT `appointment_id` FROM `booked` WHERE `appointment_id` = '$appointment_id'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    if($records['appointment_id']){
        $isBooked = false;
    }else {
        // $sql = "INSERT INTO `booked`(`appointment_id`, `email`, `name`) VALUES ('$appointment_id','$email','$name')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $isBooked = true;
    }
    
    if($isBooked){
        $sql = "SELECT date, start_time , end_time, id FROM `appointment` WHERE id = '$appointment_id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt -> fetch(PDO::FETCH_ASSOC);
        echo json_encode($record);
    }else{
       header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode(array("isBooked" => $isBooked)); 
    }
    
?>