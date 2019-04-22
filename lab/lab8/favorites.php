<!DOCTYPE html>
<html>
    <head>
        <title>Favorite Views</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <style>
            .favorite{
                border: none;
                background: none;
            }
        </style>  
    </head>
    <body>
        <h1>
            Favorite Views
            <button id='mainPage'type='button' class="btn btn-primary">Main Search Page</button>
        </h1>
        
        <table id="results">
            <th></th>
            <th></th>
            <th></th>
        </table>
    </body>
    
    <script>
    /* global $ */
    $("#mainPage").on('click',function(){
        window.location = "index.php";
    });
    
    $(document).ready(function(){
       $.ajax({
            type:"GET",
            url: "api/getFavorites.php",
            dataType: "json",
            success:function(data,status){
                data.forEach(function(key){
                   $("#results").append("<td><img src='" + key['image_url'] + "' width='200'/><br>");
                   if(key['favorite'] == 1){
                       $("#results").append("<button type='button' class='favorite'  value='" + key['favorite'] + "'id='" + key['image_url'] +
                       "'><img src=img/favorite-on.png width='24' height='24'></button></td>");
                   }else {
                       $("#results").append("<button type='button' class='favorite' value='" + key['favorite'] + "'id='" + key['image_url'] +
                       "'><img src=img/favorite.png width='24' height='24'></button></td>"); 
                   }
                });
            }
       }); 
    });
    </script>
</html>
