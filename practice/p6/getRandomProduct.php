<?php
$products = array();
$products ["product"] = "Mircofiber Beach Towel";
$products ["price"] = 40;
$products ["qty"] = 2;

$productArray = array();
array_push($productArray, $products);

$products ["product"] = "Flip-flop";
$products ["price"] = 30;
$products ["qty"] = 5;

array_push($productArray,$products);

$products ["product"] = "Sunscreen 80SPF";
$products ["price"] = 25;
$products ["qty"] = 3;

array_push($productArray,$products);

$products ["product"] = "Plastic Flying Disc";
$products ["price"] = 15;
$products ["qty"] = 4;

array_push($productArray,$products);

$products ["product"] = "Umbrella";
$products ["price"] = 75;
$products ["qty"] = 1;

array_push($productArray,$products);

echo json_encode($productArray[rand(0,4)]);

