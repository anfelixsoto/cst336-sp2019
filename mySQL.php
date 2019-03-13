<?php

// Prepare the connection and connect
$host = "p2d0untihotgr5f6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	";
$port = 3306;
$dbname = "gt9gz6l4m90i51re";
$username = "tb5mdtpzu7iffen4";
$password = "mb2sta6yvrh2qjcw";

$connParts = parse_url($url);

$host = $connParts['host'];
$dbname = ltrim($connParts['path'],'/');
$username = $connParts['user'];
$password = $connParts['pass'];

$dbConn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);

$connUrl = getenv('JAWSDB_MARIA_URL');
//$connUrl = "mysql://j4dca6gxki2p2a7s:puwg05o53pi5g1r0@p2d0untihotgr5f6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/hllilhmqaqrauk1m";
$hasConnUrl = !empty($connUrl);

$connParts = null;
if ($hasConnUrl) {
    $connParts = parse_url($connUrl);
}

//var_dump($hasConnUrl);
$host = $hasConnUrl ? $connParts['host'] : getenv('IP');
$dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'crime_tips';
$username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
$password = $hasConnUrl ? $connParts['pass'] : '';

return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

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