<?php
    include '../connect.php';
    
    $conn=getDatabaseConnection("ottermart2");
    
    $sql = "INSERT INTO om_product (productId,productName,productDescription,productImage,price,catId) VALUES ('2','Xbox One X', 'Games Play better On the Xbox One X. Experience True 4K Ultra HDR Gaming.','https://www.walmart.com/ip/Microsoft-Xbox-One-X-1TB-Console-Black-CYV-00001/276629190?wmlspartner=wlpa&selectedSellerId=430&adid=22222222227100171792&wl0=&wl1=g&wl2=c&wl3=234245860200&wl4=aud-566049426705:pla-389850042692&wl5=9031901&wl6=&wl7=&wl8=&wl9=pla&wl10=114233360&wl11=online&wl12=276629190&wl13=&veh=sem&gclid=CjwKCAjwhbHlBRAMEiwAoDA346Bk_tmmGiT85oovtjCixnqMjU9yDigcDGuAprPVQJ7YG0XBpDJhIRoC3UwQAvD_BwE','382.00','1')"
    
?>