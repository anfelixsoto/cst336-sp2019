<!--$apikey = '12230909-e4f375022b2664344da24938c'-->

<!DOCTYPE html>
<html>
    <head>
    
        <title>Pixabay Image Search</title>
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
        <h1>Pixaby Image Search</h1>
        Search: <input type="text" name="search"><button type="button" id="search" class="btn btn-primary">Search</button><span id="message"></span>
        <button id='favoriteView' type='button' class='btn btn-warning'>Favorite Views</button><br></br>
        <table id="results">
            <th</th>
            <th></th>
            <th></th>
        </table>
    </body>
    
    <script>
    /* global $ */
        $(document).ready(function(){
            $("#search").on('click',function(){
                var count = 0;
                var api_key = '12230909-e4f375022b2664344da24938c';
                var URL = "https://pixabay.com/api/?key="+api_key+"&q="+encodeURI($("[name=search").val());
                $("#message").html(" ").css("color","black");
                $("#results").html(" ").css("color","black");
                $.getJSON(URL,function(data){
                    if(parseInt(data.totalHits) > 0){
                        $.each(data.hits,function(i,hit){
                            if(i % 4 == 0){
                                $("#results").append("<tr>");
                            }else{
                                $("#results").append("<td class='image' id='" + (hit.largeImageURL) + "'><img src='" + (hit.largeImageURL) + "'width='200' height='200'/><br>" +
                            "<button type='button' class='favorite' id='" + (hit.id) + "' value='" + (hit.largeImageURL) + "'><img src='img/favorite.png' width='24' height='24'></button>" + (hit.likes) + " " +  
                            "<img src='img/comments.png' width='24' height='24'/>" + (hit.comments) + " " + 
                            "Views: " + (hit.views) + "</td>");
                            }
                        });
                    }else{
                        $("#message").append("Unable to find " + $("[name=search]").val()).css("color","red"); 
                    }
                });
            });
            $(document).on('click','.favorite',function(){
               console.log($(this).attr("id"));
               console.log($(this).attr("value"));
               console.log($("[name=search").val());
               $.ajax({
                  type:"POST",
                  url:"api/addFavorite.php",
                  dataType: "json",
                  data :{
                      "search_name": $("[name=search").val(),
                      "image_id": $(this).attr("id"),
                      "search_name": $("[name=search]").val(),
                  }
               });
            });
            
            $("#favoriteView").on('click',function(){
               window.location = "favorites.php"; 
            });
        });
    </script>
</html>