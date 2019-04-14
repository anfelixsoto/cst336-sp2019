<?php
    $servername = "localhost";
    $username = "antoniofelix118";
    $password = "";
    $dbname = "ottermart";
    
    if($conn->connect_error){
        die("connection failed: "  . $conn->connect_error);
    }
    
    $productId = $_POST['productId'];
    echo $productId;
    $sql = "DELETE FROM `om_product` WHERE productId = :pId";
    
    if($conn->query($sql) === TRUE){
        echo "New record created successfully.";
    } else {
        echo "Error: " .$sql . "<br>" . $conn->error;
    }

    $conn->close()
?>