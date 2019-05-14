<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("Reservation");
   
    $user_id = $_SESSION['user_id'];
    $id = $_POST['id'];
    
    $sql = "SELECT id FROM `appointment` WHERE id = '$id' AND user_id = '$user_id' ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch();
    
    if($_POST['id'] == $record['id']){
        $delete = true;
    }else {
        $delete = false;
    }
  
    $sql = "DELETE FROM  `appointment` WHERE id =  '$id' AND user_id =  '$user_id'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo json_encode(array("delete" => $delete));
?>