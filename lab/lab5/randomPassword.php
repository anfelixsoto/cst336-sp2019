<?php

function rand_string( $length ) {

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*";
return substr(str_shuffle($chars),0,$length);

}

$password = array();
$password["generatedPassword"] = rand_string(20);
echo json_encode($password);

?>