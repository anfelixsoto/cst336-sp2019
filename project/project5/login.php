<?php
  include 'connect.php';
  session_start();

  // Get Data from DB
  $conn = getDatabaseConnection("project5");
  $namedParameters = array();
  
  $namedParameters[":email"] = $_GET['email'];
  
  $sql = "SELECT * FROM Carousel " .
         "WHERE email_address = :email ";
  
$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$record = $stmt->fetch();

 if ($_GET["email"] == $record["email_address"]){
   $isAuthenticated = true;
 }else{
   $isAuthenticated = false;
 }
    
  if ($isAuthenticated) {
    $_SESSION["email"] = $record["email"];
  }
  
  // Allow any client to access
  header("Access-Control-Allow-Origin: *");
  // Let the client know the format of the data being returned
  header("Content-Type: application/json");

  // Sending back down as JSON
  echo json_encode(array("isAuthenticated" => $isAuthenticated));
?>
