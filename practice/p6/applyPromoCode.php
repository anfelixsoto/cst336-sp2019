header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization");

<?php
$discount = array();
$discount["discountCode"] = "getfifty";
$discount["discount"] = .5;

$discountsArray = array();
array_push($discountsArray,$discount);

$discount["discountCode"] = "halfPrice";
$discount["discount"] = .5;

array_push($discountsArray,$discount);

$discount["discountCode"] = "sand30";
$discount["discount"] = .3;

array_push($discountsArray,$discount);

$discount["discountCode"] = "spring30";
$discount["discount"] = .3;

array_push($discountsArray,$discount);

$discount["discountCode"] = "beach";
$discount["discount"] = .20;

$discount["discountCode"] = "sunny";
$discount["discount"] = .20;

array_push($discountsArray,$discount);

echo json_encode($discountsArray);





