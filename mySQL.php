<?php

// Prepare the connection and connect
$host = "jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$port = 3306;
$dbname = "kgej2abje0hvtla6";
$username = "tb5mdtpzu7iffen4";
$password = "pkyzi3vwrp3psysr";

$dbConn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);

// Setup to exception on errors (will go to php_errors.log)
$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Compose the SQL statement
$sql = " SELECT * FROM table_name WHERE id = :id ";

// Prepare the statement
$stmt = $dbConn -> prepare ($sql);

// Execute the statement, passing in array of parameters
$stmt -> execute (  array ( ':id' => '1')  );

// Process the results if there are any
if ($stmt->rowCount() > 0) {
  while ($row = $stmt -> fetch())  {
      echo  $row['field1_name'] . ", " . $row['field2_name'];
  }
}
else {
  echo "No data found";
}

?>