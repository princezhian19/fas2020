<?php 
include 'travelclaim_functions.php';

include 'connection.php';
$query1 = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_SESSION['username']."'  ORDER BY ID DESC LIMIT 1";
$result1 = mysqli_query($conn, $query1);
$a = '';
    if($row1 = mysqli_fetch_array($result1))
    {
            $query2 = "SELECT sum(`TOTAL_AMOUNT`)AS 'total' FROM tbltravel_claim_info inner join tbltravel_claim_info2 on  tbltravel_claim_info.TC_ID = tbltravel_claim_info2.ID  
            WHERE `RO_TO_OB` = '".$_POST['purpose']."'";
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2) > 0)
            {
                if($row2 = mysqli_fetch_array($result2))
                {
                  switch ($_POST['action']) {
                    case 'edit':
                      $a = '<span style = "color:blue;margin-left:86%;font-weight:bold;" >₱ &nbsp;'.sprintf("%.2f",$row2['total']).'</span>';

                      break;
                    
                    case 'view':
                    $a = '<span style = "color:red;margin-left:80%;font-weight:bold;" >₱ &nbsp;'.sprintf("%.2f",$row2['total']).'</span>';

                      break;
                  }
                  
                }
            }
        }


?>
<tr>
            <!-- <td colspan = 10> -->
                <!-- <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button> -->
            <!-- </td> -->
        </tr>
        <tr>
            <td colspan = 10>TOTAL<?php echo $a;?></td>
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