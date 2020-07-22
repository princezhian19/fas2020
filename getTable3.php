<?php 

include 'travelclaim_functions.php';
?>
<tr>
            <!-- <td colspan = 10> -->
                <!-- <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button> -->
            <!-- </td> -->
        </tr>
        <tr>
            <td colspan = 10>TOTAL <span id = "total"></span></td>
          </tr>
        <tr>
            <td rowspan = 5 colspan = 5 style = "text-align:justify;"> 
            I certify that : (1) I have reviewed the foregoing  itinerary,    (2)  the  travel  is necessary to  the service, (3) the period covered   is   reasonable   and   (4)  the expenses claimed are proper.   
            <CENTER><br>_____________________________________________<br>
            <b>DR. CARINA S. CRUZ</b></CENTER>
            </td>
            <br>
            <td colspan = 5 rowspan = 2>Prepared by:
            <CENTER><br>_____________________________________________<br>
            <?php echo viewCompleteName($_POST['username']);?></CENTER>
            </td>
          
          </tr>
          <tr>
          </tr>
          <tr>
            <td colspan = 5 rowspan = 2>Approved By <CENTER><br>_____________________________________________<br> <b> ARIEL O. IGLESIA	</b> </CENTER> </td>
          </tr>
          <tr>
          
          </tr>