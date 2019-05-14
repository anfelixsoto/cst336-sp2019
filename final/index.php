<?php
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        header("Location:login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title"></title>
        <link href="style/styles.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>
    
    <style>
        #appointments, td,th{
            text-align: center;
        }.deleteBttn, .removeBttn{
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            background-color: red;
            color: white;
        }
    </style>
    <body>
        <div class="heading" >
            <div class = "left">
            </div>
            <div class = "center">
                <div id = "text">
                    <div id = "textCenter"></div>
                </div>
            </div>
            <div class ="right">
                <div id="logout">
                    <button type="button" class="btn btn-primary" id="logoutButton">Logout</button>
                </div>
            </div>
        </div>
        <div class ="mainBody">
            <div id = "user">
            </div>
            <div id = "historyFont">
                <br>
                <div id="invitations">
                    Invitation Link <input type="text" name="invationLink"/>
                </div>
                <div id="table">
                    <h1 id="current">Current Appointment(s)</h1>
                    <table width="950" id="appointments">
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>Duration</th>
                        <th>Booked by</th>
                        <!--<th><a href='#' class="makeAppointment">Add Multiple Time Slots</a></th>-->
                        <th><button type="button" class="btn btn-default" id="addSingleBttn">Add Appointment</button></th>
                    </table>
                </div>
            </div>
            <div id="history"></div><br>
            <div id= "playlistHeader"></div>
            <div><table id="playlist"></table></div><br>
            </div>
            <h3 id="alert"></h3>
        </div>
        
        <div class="modal fade" id="AppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="AppointmentBody"></div>
                    </div>
                    <div class="modal-footer" id="AppointmentFooter">
                        
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <footer class = "bottomPart"></footer>
    
    <script>
    /* global $ */
        var userName = document.getElementById("user");
        var titleName = document.getElementById("title");
        var titleHeader = document.getElementById("textCenter")
        $(document).ready(function(){
            $.ajax({
                type:"GET",
                url:"api/getUser.php",
                dataType:"json",
                success:function(data,status){
                     data.forEach(function(key){
                        titleHeader.innerHTML = "Welcome back, " + key['name'];
                        titleName.innerHTML = (key['name']).toUpperCase() + "'s DASHBOARD";
                    });
                }
            });
            
            var start;
            var duration;
            $.ajax({
              type:"GET",
              url:"api/getUserAppointments.php",
              dataType:"json",
              success:function(data,status){
                  data.forEach(function(key){
                      if(key['start_time'] > 1200){
                            start = "A.M.Accounts";
                        }else {
                            start = "P.M.";
                        }
                      duration = (key['end_time'] - key['start_time'])/100;
                        if(duration < 1){
                            $("#appointments").append("<tr>" + 
                            "<td>" + key['date'] + "</td>" + 
                            "<td>" + (key['start_time']/100) + ":00" + " " + start + "</td>" +  
                            "<td>" + (duration * 100) + " mins</td>" + " " +
                            "<td> Not Booked </td>" + " " +
                            "<td><button class='detailsBttn' id='" + key['id'] + "'>Details</button>" + " " + 
                            "<button class='deleteBttn' id='" + key['id'] + "'>Deleted</button></td></tr>");
                        }else {
                            $("#appointments").append("<tr>" + 
                            "<td>" + key['date'] + "</td>" + 
                            "<td>" + (key['start_time']/100) + ":00" + " " + start + "</td>" +  
                            "<td>" + duration + " hr(s)</td>" + " " +
                            "<td> Not Booked </td>" + " " +
                            "<td><button class='detailsBttn' id='" + key['id'] + "'>Details</button>" + " " + 
                            "<button class='deleteBttn' id='" + key['id'] + "'>Deleted</button></td></tr>");
                        }
                  });
              }
            });
            var end;
            $(document).on('click','.detailsBttn',function(){
                $("#AppointmentModal").modal("show");
                $("#modalTitle").html("");
                $("#AppointmentBody").html("");
                $("#AppointmentFooter").html("");
                $.ajax({
                    type:"GET",
                    url:"api/getSingleAppointment.php",
                    dataType:"json",
                    data:{"id":$(this).attr("id")},
                    success:function(data,status){
                        if(data.start_time > 1200){
                            start = "A.M.Accounts";
                        }else {
                            start = "P.M.";
                        }
                        if(data.end_time > 1200){
                            end = "A.M.Accounts";
                        }else {
                            end = "P.M.";
                        }
                        $("#modalTitle").append("Appointment Details");
                        if(data.length != 0){
                            $("#AppointmentBody").append("<p>Here are the appointment details</p>" + 
                            "Start Time: " + data[0]['date'] + " " + (data[0]['start_time']/100) + ":00" + start + "<br></br>" +
                            "End Time: " + data[0]['date'] + " " + (data[0]['end_time']/100) + ":00" + end);
                            $("#AppointmentFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>");
                        }
                    }
               })
            });
            
            $(document).on('click','.deleteBttn',function(){
                $("#AppointmentModal").modal("show");
                $("#modalTitle").html("");
                $("#AppointmentBody").html("");
                $("#AppointmentFooter").html("");
                $.ajax({
                    type:"GET",
                    url:"api/getSingleAppointment.php",
                    dataType:"json",
                    data:{"id":$(this).attr("id")},
                    success:function(data,status){
                        if(data.start_time > 1200){
                            start = "A.M.Accounts";
                        }else {
                            start = "P.M.";
                        }
                        if(data.end_time > 1200){
                            end = "A.M.Accounts";
                        }else {
                            end = "P.M.";
                        }
                        $("#modalTitle").append("Delete Appointment");
                        if(data.length != 0){
                            $("#AppointmentBody").append("Start Time: " + data[0]['date'] + " " + (data[0]['start_time']/100) + ":00" + " " + start + "<br></br>" +
                            "End Time: " + data[0]['date'] + " " + (data[0]['end_time']/100) + ":00" + end + "<br></br>" +
                            "<p>Are you sure you want to remove the time slot? This cannot be undone.</p>");
                            $("#AppointmentFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>");
                            $("#AppointmentFooter").append("<button type='button' class='removeBttn' id='" + data[0]['id'] + "'>Yes! Remove it!</button>");
                        }
                    }
               });
               
            });
            
            $(document).on('click', '.removeBttn',function(){
                $.ajax({
                   type:"POST",
                   url:"api/remove.php",
                   dataType:"json",
                   data:{"id":$(this).attr("id")},
                   success:function(data,status){
                       if(data.delete){
                           location.href = "index.php";
                       }else{
                           alert("There has been an error!");
                       }
                   }
                });
            })
            
            function convertDigitIn(str){
                return str.split('-').reverse().join('/');
            }
            
            $("#logoutButton").on('click',function(){
                window.location = "logout.php";  
            });
            
            // $(document).on('click','.makeAppointment',function(){
            //   $("#AppointmentModal").modal("show");
            //   $("#modalTitle").html("");
            //   $("#AppointmentBody").html("");
            //   $("#AppointmentFooter").html("");
            //   $("#modalTitle").append("Add Time Slots - Wasn't able to make it work");
            //   $("#AppointmentBody").append("Start Date <input type='date' name='startDate'></><br></br>");
            //   $("#AppointmentBody").append("End Date <input type='date' name='endDate'></><br></br>");
            //   $("#AppointmentBody").append("Start Time <input type='number' name='startTime' min='1' max='12'><br></br>");
            //   $("#AppointmentBody").append("Number of Appointments <input type='number' name='duration' min='1' max='12'><br></br>");
            //   $("#AppointmentBody").append("Length of Appointmets <input type='number' name='duration' min='1' max='12'><br>");
            //   $("#AppointmentBody").append("<p>An appointment slot will be created for amount of time specified starting at the time of day specified for each day between the Start Date and the Ends Date</p>");
            //   $("#AppointmentFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>");
            //   $("#AppointmentFooter").append("<button type='button' class='btn btn-info' id='add'>Add Times</button>");
            // });
        
            
            $("#addSingleBttn").on('click',function(){
              $("#AppointmentModal").modal("show");
               $("#modalTitle").html("");
               $("#AppointmentBody").html("");
               $("#AppointmentFooter").html("");
               $("#modalTitle").append("Add Time Slot");
               $("#AppointmentBody").append("Date <input type='date' name='date'></><br></br>");
               $("#AppointmentBody").append("Start Time <input type='number' name='startTime' min='1' max='2'><br></br>");
               $("#AppointmentBody").append("End Time <input type='number' name='endTime' min='1' max='2'><br></br>");
               $("#AppointmentFooter").append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>");
               $("#AppointmentFooter").append("<button type='button' class='singleAdd' id='singleAdd'>Add</button>");  
            });
            
            $(document).on('click','.singleAdd',function(){
               $.ajax({
                  type:"POST",
                  url:"api/addSingleAppointment.php",
                  dataType:"json",
                  data:{
                        "date":$('[name=date]').val(), 
                        "startTime": $('[name=startTime]').val(), 
                        "endTime": $('[name=endTime]').val()},
                    success:function(data,status){
                        location.href = "index.php";
                    }
               });
            });
            
        });
    </script>
</html>