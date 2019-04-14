<?php
$products = array();
$products ["productId"] = "50";
$products ["productName"] = "Nintendo Switch";
$products ["productDescription"] = "Experience Nintendo Switch on the Big Screen TV or Take it on the Go as a Handheld! At Home on the Go or at Grandmas House—Spend Quality Time Together With Nintendo Switch. Light Weight. Portable. Over 1500 Titles Avail. Multiple Ways to Play.";
$products ["productImage"] = "https://www.telegraph.co.uk/content/dam/technology/2017/03/01/Nintendo-Switch-cover_trans_NvBQzQNjv4BqZgEkZX3M936N5BQK4Va8RWtT0gK_6EfZT336f62EI5U.jpg?imwidth=450";
$products ["Price"] = "299.99";
$products ["catId"] = "1";

$productArray = array();
array_push($productArray, $products);

$products ["productId"] = "51";
$products ["productName"] = "Xbox One X";
$products ["productDescription"] = "All games look and play great on Xbox One X, but games that have earned the Xbox One X Enhanced logo have been updated or built specifically to take full advantage of the world's most powerful console.";
$products ["productImage"] = "https://multimedia.bbycastatic.ca/multimedia/products/500x500/115/11558/11558330.jpg";
$products ["Price"] = "399.99";
$products ["catId"] = "1";;

array_push($productArray,$products);

$products ["productId"] = "52";
$products ["productName"] = "Samsung Galaxy S10";
$products ["productDescription"] = "The Next Generation Is Here. Buy Your Samsung Galaxy S10 Today. One UI Design Language. Automated Bixby Routines. Cinematic Display. Styles: Prism White, Prism Black, Prism Blue, Flamingo Pink, Ceramic White, Ceramic Black.";
$products ["productImage"] = "https://www.bhphotovideo.com/images/images2500x2500/samsung_sm_g973uzbaxaa_galaxy_s10_sm_g973u_128gb_1456401.jpg";
$products ["Price"] = "743.99";
$products ["catId"] = "1";

array_push($productArray,$products);

$products ["productId"] = "53";
$products ["productName"] = "Microsoft - Surface Pro";
$products ["productDescription"] = "12.3' Touch Screen - Intel Core M3 - 4GB Memory - 128GB SSD - With Keyboard - Platinum";
$products ["productImage"] = "https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6305/6305982ld.jpg;maxHeight=1000;maxWidth=1000";
$products ["Price"] = "649.00";
$products ["catId"] = "1";

array_push($productArray,$products);

$products ["productId"] = "54";
$products ["productName"] = "C++ All-in-One For Dummies 3rd Edition";
$products ["productDescription"] = "C++ is the workhorse of programming languages and remains one of the most widely used programming languages today. It's cross-platform, multi-functional, and updates are typically open-source. The language itself is object-oriented, offering you the utmost control over data usage, interface, and resource allocation. If your job involves data, C++ proficiency makes you indispensable.";
$products ["productImage"] = "https://images-na.ssl-images-amazon.com/images/I/51Vh1EWAFDL._SX397_BO1,204,203,200_.jpg";
$products ["Price"] = "23.67";
$products ["catId"] = "5";

array_push($productArray,$products);

$products ["productId"] = "55";
$products ["productName"] = "Surface Book 2";
$products ["productDescription"] = "Powerhouse performance. The most powerful Surface laptop, Surface Book 2 is built for professional-grade software and the latest games.* Up to 17 hours of battery life[1] and high-resolution touchscreen let you work your way anywhere.";
$products ["productImage"] = "https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE1FU5k?ver=e2c0&q=90&m=6&h=705&w=1253&b=%23FFF0F0F0&o=f&p=140&aim=true";
$products ["Price"] = "1,149.00";
$products ["catId"] = "5";

array_push($productArray,$products);

echo json_encode($productArray[rand(0,5)]);