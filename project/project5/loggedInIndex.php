<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Project 5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">
        <h2>
            Project 5
            <button id="logout" type="button" class="btn btn-primary">Log Out</button>
            <button type="button" class="btn btn-info" id="upload">Upload File</button>
        </h2>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/la.jpg" alt="Los Angeles" style="width:100%;">
                </div>

                <div class="item">
                    <img src="img/chicago.jpg" alt="Chicago" style="width:100%;">
                </div>

                <div class="item">
                    <img src="img/ny.jpg" alt="New york" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
        </div>
    </div>

    <div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">File Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                <div class="modal-body">
                    <div id="uploadDetails">
                        <form method="POST" action="uploadFile.php" enctype="multipart/form-data">
                            <!--Use multiple attribute and array for input name-->
                            Select file: <input type="file" multiple name="fileName[]" /> <br />
                            <input class="btn btn-light" type="submit" name="uploadForm" value="Upload File" />
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    /* global $ */
    $(document).ready(function() {
        $("#upload").on('click',function(){
            $("#fileUploadModal").modal("show");
        });
        
        $("#logout").on("click",function(){
           window.location = "logout.php"; 
        });
    });
</script>

</html>