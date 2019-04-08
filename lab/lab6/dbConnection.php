<?php

function getDatabaseConnection($dnmae = 'ottermart'){
    
    $host = "localhost";
    $username = "root";
    $password= "";
    
    if(strpos($_SERVER['HTTP_HOST'],'herokuapp') != false){
        $url = parse_url('JAWSDB_MARIA_URL');
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];

    }
    
    $host = $hasConnUrl ? $connParts['host']: getenv('IP');
    $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'ottermart';
    $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
    $password = $hasConnUrl ? $connParts['pass'] : '';
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
 
}
?>