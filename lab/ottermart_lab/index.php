<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> OtterMart Product Search </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <script>
            /*global $*/
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

                $("#searchForm").on("click", function(){
                    $.ajax({
                        type: "GET",
                        url: "api/getSearchResults.php",
                        dataType: "json",
                        data: {
                            "product" : $("#product").val(),
                            "category" : $("#categories").val(),
                            "priceFrom" : $("[name=priceFrom]").val(),
                            "priceTo" : $("[name=priceTo]").val(),
                            "orderBy" : $("[name=orderBy]:checked").val(),
                        },
                        success: function(data, status) {
                            $("#results").html("<h3> Products Found: </h3>");
                            data.forEach(function(key) {
                                $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>History</a> ");
                                $("#results").append(key['productName']+ " " +key['productDescription']+ " " +key['price'] + "<br>");
                            });
                        }
                    });
                }); //searchForm

                $(document).on('click', '.historyLink', function(){
                    $('#purchaseHistoryModal').modal("show");
                    $.ajax({
                        type: "GET",
                        url: "api/getPurchaseHistory.php",
                        dataType: "json",
                        data: {"productId" : $(this).attr("id")},
                        success: function(data, status) {
                            if (data.length != 0) { // Checks if the API returned a non-empty list
                                $("#history").html(""); //clears content
                                $("#history").append(data[0]['productName'] + "<br />");
                                $("#history").append("<img src='" + data[0]['productImage'] + "' width='200' /> <br />");
                                data.forEach(function(key) {
                                    $("#history").append("Purchase Date: " + key['purchaseDate'] + "<br />");
                                    $("#history").append("Unit Price: " + key['unitPrice'] + "<br />");
                                    $("#history").append("Quantity: " + key['quantity'] + "<br />");
                                });
                            } else {
                                $("#history").html("No purchase history for this item.");
                            }
                        }
                    });
                }); //historyLink


            });//documentReady
        </script>
        <style>
             h1 {
                background-color: lightblue;
                color:white;
                border-color: lightblue;
                border-radius: 50px;
            }body{
                text-align: center;
                font-family: 'ZCOOL QingKe HuangYou', cursive;
                border-radius: 50px;
                background-color: #CCFFCC;
                color: black;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }input,select {
                -moz-border-radius: 15px;
                border-radius: 10px;
                border: solid 2px black;
                padding: 5px
            }#searchForm{
                border-radius: 50px;
                background-color: #4CAF50;
                color: white;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 15%;
                opacity: 0.9;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="jumbotron"><h1>  OtterMart Product Search </h1></div>
            <form>
                Product: <input type="text" name="product" id="product" />
                <br><br>
                Category:
                    <select name="category" id="categories">
                        <option value=""> Select One </option>
                    </select>
                <br><br>
                Price:  From <input type="text" name="priceFrom" size="7"/>
                        To   <input type="text" name="priceTo" size="7"/>
                <br><br>
                Order result by:
                <br>
                <input type="radio" name="orderBy" value="price"/> Price <br>
                <input type="radio" name="orderBy" value="name"/> Name
                <br><br>
            </form>
            <button id="searchForm">Search</button>
            <br>
        </div>
        <br>
        <hr>
        <div id="results"></div>

        <!-- Modal -->
        <div class="modal fade" id="purchaseHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
              <div class="modal-body">
                  <div id="history"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

    </body>
</html>