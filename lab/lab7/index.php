<?php
    session_start();

    if (!isset($_SESSION['email'])){
      header("Location: login.html");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Otter Mart Product Management</title>
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
            }
        </style>
    </head>
    <body>
            <h1>
                Otter Mart Product Management
                <button id="refresh" class="btn btn-light">Refresh</button>
                <button id="logout" class="btn btn-success">Logout</button>
            </h1>
            
            <div>
                Catergory:
                <select name="category" id="categories">
                    <option value=" ">Select One</option>
                </select>
                <button id="searchForm" class="btn btn-success">Search</button>
                <button id="addButton" class="btn btn-primary">Add</button>
                <br>
                
                <div id="message"></div>
                <br>
                
                <div id="results"></div>
                
            </div>
            
            <div class="modal fade" id="addingProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="newDetails">
                                Catergory:
                                <select name="category" id="categories">
                                    <option value=" ">Select One</option>
                                    <option value="5">Books</option>
                                    <option value="4">Computers</option>
                                    <option value="1">Electronics</option>
                                    <option value="7">Movies</option>
                                    <option value="3">Sports</option>
                                    <option value="6">Toys</option>
                                    <option value="2">Video Games</option>
                                </select><br><br>
                                Product Name: <input type="text" id="nProductName" required></input><br><br>
                                Description: <input  type="text" id="nProductDes" required></input><br><br>
                                Picture Link: <input type="text" id="nProductPic" required></input><br><br>
                                Price: <input type="text" id="nProductPrice" required></input>
                            </div>
                        </div>
                        <div class="modal-footer" id="modalFooter">
                            <button type="button" id="saveProduct" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="productHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Product Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="productDetails"></div>
                        </div>
                        <div class="modal-footer" id="productModal">
                            <button type="button" id="editBttn" class="btn btn-light">Edit</button>
                            <button type="button" id="deleteBttn" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div id="editDetails"></div>
                        </div>
                        <div class="modal-footer" id="addModalFooter">
                            <button type="button" class="bttn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
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
                    type: "GET",
                    url: "api/getCategories.php",
                    dataType: "json",
                    success: function(data, status) {
                        data.forEach(function(key) {
                            $("#categories").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
                        });
                    }
                });
                
                $("#refresh").on("click",function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getProduct.php",
                        dataType: "json",
                        success: function(data, status) {
                            $("#results").html("<h3>List of Products:</h3>");
                            data.forEach(function(key) {
                                $("#results").append(key['productId'] + "." + " ");
                                $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>" + key['productName'] + "</a><br>");
                            });
                        }
                    }); 
                });
                
                $("#searchForm").on("click", function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getSearchResults.php",
                        dataType: "json",
                        data: {
                            "category": $("[name=category]").val()
                        },
                        success: function(data, status) {
                            if($("[name=category").val() >= 1){
                                $("#results").html("<h3>List of Products:</h3>");
                                data.forEach(function(key) {
                                    $("#results").append(key['productId'] + "." + " ");
                                    $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>" + key['productName'] + "</a><br>");
                                    $("#message").hide();
                                });
                            } else {
                                $("#message").append("Please select a category from the list!").css("color","red");
                            }
                        }
                    });
                });
                
                $("#addButton").on("click",function(){
                   //$("#addingProducts").modal("show");
                   $.ajax({
                       type: "POST",
                       url:"api/addProduct.php",
                       dataType: "json"
                   })
                });
                
                $.ajax({
                    type: "GET",
                    url: "api/getProduct.php",
                    dataType: "json",
                    success: function(data, status) {
                        $("#results").html("<h3>List of Products:</h3>");
                        data.forEach(function(key) {
                            $("#results").append(key['productId'] + "." + " ");
                            $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>" + key['productName'] + "</a><br>");
                        });
                    }
                });
                $("#saveProduct").on("click",function(){
                    console.log( $("[name=category]").val());
                    console.log($("#nProductName").val());
                    console.log($("#nProductDes").val());
                    console.log($("#nProductPic").val());
                    console.log($("#nProductPrice").val());
                    $.ajax({
                        type: "POST",
                        url: "api/addProduct.php",
                        dataType: "json",
                        data: {
                            "catId": $("[name=category]").val(),
                            "productName": $("#nProductName").val(),
                            "productDescription": $("#nProductDes").val(),
                            "pictureImage": $("#nProductPic").val(),
                            "price": $("#nProductPrice").val()
                        }
                    });
                });
                
                $(document).on('click', '.historyLink', function(){
                    $('#productHistoryModal').modal("show");
                    $.ajax({
                        type: "GET",
                        url: "api/getProductHistory.php",
                        dataType: "json",
                        data: {"productId" : $(this).attr("id")},
                        success: function(data, status) {
                            if (data.length != 0) { // Checks if the API returned a non-empty list
                                $("#productDetails").html(""); //clears content
                                $("#productDetails").append(data[0]['productName'] + "<br />");
                                $("#productDetails").append("<img src='" + data[0]['productImage'] + "' width='200'/> <br />");
                                data.forEach(function(key) {
                                    $("#productDetails").append("Description: " + key['productDescription'] + "<br />");
                                    $("#productDetails").append("Unit Price: $" + key['price'] + "<br />");
                                });
                            }
                        }
                    });
                });
                
                $("#logout").on("click", function() {
                    window.location = "logout.php";
                });
            });
            
        </script>
    </body>
</html>