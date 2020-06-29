<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
 <title>FAS</title>
<div class="box">
<div class="box-body">

<h1>Trip Schedule</h1>
<br>
<li class="btn btn-warning"><a href="VehicleRequest.php" style="color:white;text-decoration: none;">Back</a></li>

<div class="row">
    <div class="col-md-4">

        <br>
        <br>
            
            <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
            <table class="table table-bordered" style="border-width: 3px;max-width:100%;">
            <tr>
            <td colspan = "2"><b><input  class='calFilter' type="checkbox" name = "offices[]" value="0"  id = "all" ></label>
            All Drivers</b></td>
            </tr>

            <tr>
            <td style="background-color: #D5D911; color:white;WIDTH:50%;">
            <input class='calFilter' type="checkbox" name = "offices[]" value="Reynaldo Parale" id = "ReynaldoParale" ><label style = "margin-left:15%;">Reynaldo Parale</label>
            </td>
            <td style="background-color: #607D8B; color:#fff;padding:9px;WIDTH:50%;">
            <input class='calFilter' type="checkbox" name = "offices[]" value="Louie Blanco" id = "LouieBlanco"><label style = "margin-left:15%;">Louie Blanco</label>
            </td>
            </tr>
            <tr>
            <td style="background-color: #E60785; color:white;">
            <input class='calFilter' type="checkbox" name = "offices[]" value="Joachim Lacdang" id = "JoachimLacdang"><label style = "margin-left:15%;">Joachim Lacdang</label>
            </td>
            <td style="background-color:#FF9800 ; color:white;;padding:9px;">
            <input class='calFilter' type="checkbox" name = "offices[]" value="Medel Saturno" id = "MedelSaturno"><label style = "margin-left:15%;">Medel Saturno</label>
            </td>
            </tr>
            <tr>
            <td style="background-color: #48BD0D; color:white;">
            <input class='calFilter' type="checkbox" name = "offices[]" value="Daniel Narciso" id = "DanielNarciso"><label style = "margin-left:15%;">Daniel Narciso</label>
            </td>


            </tr>
            <tr>

            </tr>
            </table>
            <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial' ):?>
            <button class="btn btn-success pull-right"><a style = "color:#fff;"  id = "export"  >Export</a></button>

            <?php else: ?>

            <td>

            </td>

            <?php endif ?>
            </div>

    </div>

    <!-- Calendar -->
    <div class="col-md-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
 <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'vehicle_load.php',
    selectable:true,
    selectHelper:true,


    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     /* if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     } */

    

    $('#assigneddate').prop("disabled", true); 
    $('#assignedtime').prop("disabled", true); 
    $('#dispatcher').prop("disabled", true); 
    $('#nov').prop("disabled", true); 
    $('#av').prop("disabled", true); 
    $('#ad').prop("disabled", true); 
    $('#plate').prop("disabled", true); 
    $('#vremarks').prop("disabled", true); 

    // $('#myModal').modal('show');

  
    $('#myModal').find('#datepicker1').val(moment(event.start).format('MM/DD/YYYY'));
    if(event.end == '0000-00-00 00:00:00' || event.end == null || event.end == '1970-01-01 00:00:00')
    {  
    $('#myModal').find('#datepicker2').val('');
    }else{
    $('#myModal').find('#datepicker2').val(moment(event.end).subtract(1, "days").format('MM/DD/YYYY'));

    }    
    // $('#myModal').find('#datepicker2').val(moment(event.end).format('MM/DD/YYYY'));
    $('#myModal').find('#datepicker3').val(moment(event.posteddate).format('MM/DD/YYYY'));
    $('#myModal').find('#descriptiontxtbox').val(event.description);
    $('#myModal').find('#remarks').val(event.remarks);
    $('#myModal').find('#postedby').val(event.postedby);
    $('#myModal').find('#venuetxtbox').val(event.venue);
    $('#myModal').find('#enptxtbox').val(event.enp);
    $("#myModal2").modal("show");

    },
    
    



   });
  });
   
  </script>
 </head>
 <body>
  <br />
  <!-- <h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2> -->
  <br />
  <!-- <div class="container"> -->
   <div id="calendar"></div>
  <!-- </div> -->


    </div>
     <!-- Calendar -->
</div>




</div>
</div>

 </body>
</html>