<?php
    session_start();
    
    if(!isset($_SESSION['email'])){
        header("Location:login.html");
    }
    
    require __DIR__ . '/../../vendor/autoload.php';

    $log = new Monolog\Logger('monolog-test');
    $log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../../app.log', Monolog\Logger::INFO));
    $log->info('I am inside the monolog test page');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>OtterMart Dashboard Admin Management</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        
        <style>
            .newBttn{
                border-radius:5px;
                background-color:blue;
                color: white;
                border: none;
                padding: 10px 24px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
            }body {
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
            Otter Mart Product Admin Management<br>
            <button id="addBttn" class="btn btn-primary">Add Product</button>
            <button id="logout" class="btn btn-success">Logout</button>
            <button id="mainPage" class="btn btn-warning">Main Page</button>
        </h1>
        <div id="list"></div>
        <div id="messages"></div>
            
        <table id="results">
            
            <th width='100px'>Product Id</th>
            <th>Product Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </table>
        
        <div class="modal fade" id="productHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="productDetails"></div>
                    </div>
                    <div class="modal-footer" id="productFooter">
                        
                    </div>
                </div>
            </div>
        </div>
        
        
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
                    "<td><button class='editBttn' id='" + key['productId'] + "'>Edit</button>" +
                    "<td><button class='deleteBttn' id='" + key['productId'] + "'>Delete</button>" +
                    "</tr>"); 
                  });
              }
           });
           
           $("#mainPage").on('click',function(){
               window.location = "searchIndex.php";
           });
           
           $("#addBttn").on('click',function(){
               $("#productHistoryModal").modal("show");
               $.ajax({
                  type:"GET",
                  url:"api/randomProduct.php",
                  dataType:"json",
                  success:function(data){
                    $("#productDetails").html("");
                    $("#productFooter").html("");
                    $("#productDetails").append("<span id='productImage'><img src='" + data.productImage + "' width='200'/></span><br><br>");
                    $("#productDetails").append("Product Name: <input type='text' id='productName' value='" + data.productName + "'</input><br><br>");
                    $("#productDetails").append("Product Image URL: <input type='text' id='pictureUrl' value='" + data.productImage + "'</input><br>");
                    $("#productDetails").append("Product Description: <textarea rows='4' id='productDes' cols='50' >" + data.productDescription +"</textarea><br>");
                    $("#productDetails").append("Prouct Price: <input type='text'  style='width: 55px' id='productPrice' value='" + data.Price + "'</input><br><br>");
                    $("#productDetails").append("Catergory: <input type='text' id='catId' size='1' value='" + data.catId + "'</input>");
                    $("#productFooter").append("<button type='button' class='newBttn' id='" + data.productId + "'>Save</button>");
                    $("#productFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                  }
               });
            });
            
            $(document).on('click','.newBttn',function(){
                $('#productHistoryModal').modal("hide");
               $.ajax({
                  method:"POST",
                  url:"api/addProduct.php",
                  dataType:"json",
                  data:{
                      "productId" : $(this).attr("id"),
                      "productName" : $("#productName").val(),
                      "productImage" : $("#pictureUrl").val(),
                      "productDescription" : $("#productDes").val(),
                      "price" : $("#productPrice").val(),
                      "catId" : $("#catId").val()
                  },
               });
            });
           
            $(document).on('click','.historyLink',function(){
                $('#productHistoryModal').modal("show");
                $.ajax({
                    type:"GET",
                    url:"api/getProductHistory.php",
                    dataType:"json",
                    data: {"productId":$(this).attr("id")},
                    success:function(data,status){
                        if(data.length != 0){
                            $("#productDetails").html(""); //clears content
                            $("#productTitle").html(" ");
                            $("#productFooter").html(" ");
                            $("#productDetails").append(data[0]['productName'] + "<br />");
                            $("#productDetails").append("<img src='" + data[0]['productImage'] + "' width='200'/> <br />");
                            $("#productFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                            data.forEach(function(key){
                                $("#productDetails").append("Description: " + key['productDescription'] + "<br />");
                                $("#productDetails").append("Unit Price: $" + key['price'] + "<br />");
                            });
                        }
                    }
                });
                
            });
           
            $(document).on('click','.editBttn',function(){
                $('#productHistoryModal').modal("show");
                $.ajax({
                   type:"GET",
                   url:"api/getProductHistory.php",
                   dataType:"json",
                   data: {"productId":$(this).attr("id")},
                   success:function(data,status){
                       if(data.length != 0){
                            $("#productDetails").html("");
                            $("#productFooter").html("");
                            $("#productDetails").append("<img src='" + data[0]['productImage'] + "' width='200'/> <br><br>");
                            $("#productDetails").append("Product Id:" + " " + data[0]['productId'] + "<br>");
                            $("#productDetails").append("Product Name: <input type='text' id='editName' value='" + data[0]['productName'] + "'</input><br><br>");
                            $("#productDetails").append("Product Image URL: <input type='text' id='editPicture' value='" + data[0]['productImage'] + "'</input><br>");                           
                            data.forEach(function(key){
                               $("#productDetails").append("Product Description: <textarea rows='4' id='editDes' cols='50' >" + key['productDescription'] +"</textarea><br>");
                               $("#productDetails").append("Prouct Price: <input type='text' style='width: 55px' id='editPrice' value='" + key['price'] + "'</input>");
                               $("#productFooter").append("<button type='button' class='saveBttn' id='" + key['productId'] + "'>Save</button>");
                               $("#productFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                            });
                        }
                   }
                });
            });
            
            $(document).on('click','.saveBttn',function(){
                $('#productHistoryModal').modal("hide");
                $.ajax({
                   type:"POST",
                   url:"api/editProduct.php",
                   dataType:"json",
                   data: {
                        "productId" : $(this).attr("id"),
                        "productName": $("#editName").val(),
                        "productImage": $("#editPicture").val(),
                        "productDescription": $("#editDes").val(),
                        "price": $("#editPrice").val()
                   },
                });
            });
            
            $(document).on('click','.deleteBttn',function(){
                $('#productHistoryModal').modal("show");
                $.ajax({
                   type:"GET",
                   url:"api/getProductHistory.php",
                   dataType:"json",
                   data: {"productId":$(this).attr("id")},
                   success:function(data,status){
                       if(data.length != 0){
                            $("#productDetails").html("");
                            $("#productFooter").html("");
                            $("#productDetails").append("Are you sure you want to delete <strong>" + data[0]['productName'] + "</strong>?<br>");                          
                            data.forEach(function(key){
                               $("#productFooter").append("<button type='button' class='confirmBttn' id='" + key['productId'] + "'>Confirm</button>");
                               $("#productFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>");
                            });
                        }
                   }
                });
            });
            
            $(document).on('click','.confirmBttn',function(){
                $("#productHistoryModal").modal("hide");
                $.ajax({
                   method:"POST",
                   url:"api/deleteProduct.php",
                   dataType:"json",
                   data: {"productId":$(this).attr("id")},
                   success:function(data,status){
                       $("#message").html("");
                       $("#message").html("Product has been deleted").css("color","green");
                   }
                });
            });
            
            $("#logout").on("click", function() {
                window.location = "logout.php";
            });
        });
    </script>
</html>