<?php
    session_start();
    
    if(!isset($_SESSION['email'])){
        header("Location:login.html");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
        <style>
            body {
                margin-top: 50px;
                margin: 70px;
            }footer{
                text-align:center;
            }table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
            }
        </style>
    </head>
    <body>
        
        <h1>
            Otter Mart Product Management
            <button id="refresh" class="btn btn-light">Refresh</button>
            <button id="logout" class="btn btn-success">Logout</button>
        </h1>
        <div id="list"></div>
        <table id="results">
            
            <th>Product Id</th>
            <th>Product Name</th>
            <th></th>
            <th></th>
            
            
        </table>
    </body>
    
    <footer>
        <hr> CST 336. 2019&copy; Felix <br />
        <strong>Disclaimer:</strong> The information in this webpage is fictitous. <br /> It is used for academic purpose only.
        <br />
        <img src="img/csumb.png" alt="CSUMB Logo" />
    </footer>
    
    <script>
    /* global $ */
        $(document).ready(function(){
           $.ajax({
              type:"GET",
              url:"api/getProduct.php",
              dataType: "json",
              success:function(data,status){
                  $("#list").html("<h3>List of Products:</h3>");
                  data.forEach(function(key){
                    $("#results").append("<tr> " +
                    "<td>" + key['productId'] + "</td>" +
                    "<td><a href='#' class='historyLink' id='" + key['productId'] + "'>" + key['productName'] + "</a><br>" +
                    "<td><button class='btn btn-light' id='" + key['productId'] + "'>Edit</button>" +
                    "<td><button class='btn btn-danger' id='" + key['productId'] + "'>Delete</button>" +
                    "</tr>"); 
                  });
              }
           });
           
            $("#logout").on("click", function() {
                window.location = "logout.php";
            });
        });
    </script>
</html>