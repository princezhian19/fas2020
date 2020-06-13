<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2030 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
?>
<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
$division = $_SESSION['division'];



}
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

  //Get Office
$select_user = mysqli_query($conn,"SELECT FIRST_M,MIDDLE_M,LAST_M,DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username1'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
$f = $rowdiv['FIRST_M'];
$m = $rowdiv['MIDDLE_M'];
$l= $rowdiv['LAST_M'];

$fullname = $f.' '.$m.' '.$l;


//Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C, DESIGNATION FROM tblemployeeinfo WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
$DESIGNATION = $rowdiv['DESIGNATION'];
//echo $DESIGNATION;


//Get Position
$select_position = mysqli_query($conn,"SELECT  POSITION_M FROM tblposition WHERE POSITION_C = '$DESIGNATION'");
$rowdiv1 = mysqli_fetch_array($select_position);
$POSITION_M = $rowdiv1['POSITION_M'];
//echo $POSITION_M;

$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];

//echo $DIVISION_M;

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';
?>



<?php
// include('db.class.php'); // call db.class.php
$edit="edit";
?>
<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Vehicle Request</h1>
<table class="table" > 

<!-- Header -->
<tr>
<td class="col-md-2">

<li class="btn btn-success"><a href="VehicleRequestCreate.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Create</a></li>  
</td>

<td class="col-md-6" >


</td>





</tr>
<!-- Header -->
</table>  
<div style="overflow-x:auto;">
          <br>
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">

                  <th width =''>CTRL NO</th> 
                  <th width = ''>VEHICLE REQUEST</th>
                  
                  <th width = ''>TYPE</th>
                  <th width = ''>NAME</th>
                  <th width = ''>OFFICE</th>
                  <th width = ''>PURPOSE</th>
                  <th width = ''>DESTINATION</th>
                  <th width = ''>NO OF PAX</th>
                  <th width = ''>PASSENGER/S NAME</th>
                  <th width = ''>DEPARTURE </th>
                  <th width = ''>RETURN </th>
                  <th width = ''>SUBMITTED DATE</th>
                  <th width = ''>RECEIVED DATE</th>
                  <th width = ''>ASSIGNED</th>
                  <th width = ''>RECOMMENDING</th> 
                  <th width = ''>APPROVED</th> 
                  <th width = ''>SERVED COPY</th> 
                  
                  <th width = ''>ACTION</th>
                  

                </tr>
                </thead>
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);

          
            
            if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial')
            {
              $view_query = mysqli_query($conn, "SELECT * from vr order by id desc");
            }
            else{
              $view_query = mysqli_query($conn, "SELECT * from vr where office ='$DIVISION_M' order by id desc");

            }
          

                while ($row = mysqli_fetch_assoc($view_query)) {

                  $id=$row['id'];
                  $vrno = $row['vrno'];

                  $vrdate1 = $row['vrdate'];
                  $vrdate = date('F d, Y', strtotime($vrdate1));

                  $vrtime1 = $row['vrtime'];
                  $vrtime=  date("g:i A",strtotime($vrtime1));

                  $nod= $row['nod'];
                  $type = $row['type'];
                  $name = $row['name'];
                  $office = $row['office'];
                  $position = $row['position'];
                  $mobile = $row['mobile'];
                  $remarks = $row['remarks'];
                  $purpose = $row['purpose'];
                  $destination = $row['destination'];
                  $nop = $row['nop'];
                 
                
                  $departuredate1 = $row['departuredate'];
                  $departuredate = date('F d, Y', strtotime($departuredate1));
                
            
                  $departuretime1 = $row['departuretime'];
                  $departuretime=  date("g:i A",strtotime($departuretime1));


                  $returndate1 = $row['returndate'];
                  $returndate = date('F d, Y', strtotime($returndate1));
                
            
                  $returntime1 = $row['returntime'];
                  $returntime=  date("g:i A",strtotime($returntime1));


                  $submitteddate1 = $row['submitteddate'];
                  $submitteddate = date('F d, Y', strtotime($submitteddate1));
                  $submittedby = $row['submittedby'];


                  $receiveddate1 = $row['receiveddate'];
                  $receiveddate = date('F d, Y', strtotime($receiveddate1));
                  $receivedby = $row['receivedby'];
                 
                  $cancelleddate1 = $row['cancelleddate'];
                  $cancelleddate = date('F d, Y', strtotime($cancelleddate1));
                  $cancelledby = $row['cancelledby'];
                

                  $reason = $row['reason'];
                  $status=$row['status'];
                  $pos=$row['pos'];
               

               ?>

                <tr align = ''>

             
                <td><?php echo  $vrno;?></td>

                 
                <?php if ($vrdate1 == '0000-00-00'): ?>
                <td></td>
                <?php else: ?>
                  <td><?php echo  $vrdate.'<br>'.$vrtime?></td>
                <?php endif ?>


                <?php if ($type == 'Day/s'): ?>
                <td><?php echo  $nod.' '.$type?></td>
                <?php else: ?>
                  <td><?php echo $type?></td>
                <?php endif ?>

                
                <td><?php echo  $name?></td>
                <td><?php echo  $office?></td>

                
                <td><?php echo  $purpose?></td>
                <td><?php echo  $destination?></td>
                <td><?php echo  $nop?></td>
                <td><?php 
                $passengers = mysqli_query($conn, "SELECT name from vr_passengers where vrid = '$vrno' order by id asc");
                while ($row1 = mysqli_fetch_assoc($passengers)) {
                  $pname = $row1['name'];
                  echo  $pname.'<br>';
                }
               
                
               ?>
                </td>

   
                <?php if ($departuredate1=='0000-00-00'): ?>
                <td></td>
                <?php else: ?>
               <td><?php echo  $departuredate.'<br>'.$departuretime?></td>
                <?php endif ?>

               
                <?php if ($returndate=='0000-00-00'): ?>
                <td></td>
                <?php else: ?>
               <td><?php echo  $returndate.'<br>'.$returntime?></td>
                <?php endif ?>

             
              
                <?php if ($submitteddate1 == '0000-00-00'): ?>
                  <?php if ($username1 == 'itdummy1' || $username1 == 'bosoltura' || $username1 == 'ctronquillo' || $username1 == 'jamonteiro' || $username1 == 'rlsegunial'|| $username1 == ''|| $username1 == ''):?>
                  <td></td>
                  <?php else: ?>
                  <?php if ($status!='cancelled'):?> 
                      <?php if ($office==$DIVISION_M):?> 
                      <td><a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to submit this Vehicle Request?');" href='vehicle_submit.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Submit</a></td>
                      <?php else: ?>
                      <td></td>
                      <?php endif ?>
                  
                  <?php else: ?>
                  <td></td>
                  <?php endif ?>
                  <?php endif ?>
        
                  <?php else: ?>
                  <td><?php echo $submitteddate .'<br>'.$submittedby.''?></td>
                  <?php endif ?>

                  





                <?php if ($receiveddate1 == '0000-00-00' && $submitteddate1!='0000-00-00'): ?>
                  <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial'):?>
                              <?php if ($status=='cancelled'):?>
                              <td></td>
                              <?php else: ?>
                                <td><a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to receive this Vehicle Request?');" href='vehicle_receive.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Receive</a></td>
                              <?php endif ?>
                          <?php else: ?>
                          <td ></td>
                          <?php endif ?> 
                        <?php else: ?>
                         
                        <td>
                            
                          <?php if ($receiveddate1 == '0000-00-00'): ?>
                          <!-- //no dates -->
                          <?php else: ?>
                            <?php echo $receiveddate .'<br>'.$receivedby.''?>
                          <?php endif ?>

                        </td>
                         
                          <?php endif ?>


                          <td><a class="btn btn-success btn-xs" onclick="" href='#?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Assign</a></td>
                <td><a class="btn btn-success btn-xs" onclick="" href='#?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Recommend</a></td>
                <td><a class="btn btn-success btn-xs" onclick="" href='#?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Approve</a></td>
                <td><a class="btn btn-success btn-xs" onclick="" href='#?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Serve Copy</a></td>







                <td>
                    <?php if ($submitteddate1 == 0000-00-00): ?>
                          <!--  -->
                              <?php if ($status!='cancelled'):?>
                                
                                <!-- href='/TravelOrder/Report/pages/TO.php?id=<?php echo $id;?>&division=<?php echo $division?>&pos=<?php echo $pos;?>' -->
                                  
                              
                                <a   title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                <br>
                             
                                  <a href='VehicleRequestUpdate.php?id=<?php echo $id;?>&pos=<?php echo $pos;?>&vrno=<?php echo $vrno;?>&type=<?php echo $type;?>' onclick="myFunctionPassengers()" data-vrno = <?php echo $vrno?>  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>&nbsp;&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;</a>
                                  <br>
                                  
                                
                                 <a name="Cancel" value="" id="Cancel" onclick="myFunction(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="#cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 
                              <?php else: ?>
                               
                                <a href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> Export</a>
                                
                                <label style="color:red">Cancelled</label> <?php echo $cancelleddate.'&nbsp;'.$cancelledby.'<br>'.'Reason: '.$reason ?>
                              <?php endif ?>
                        
                        <?php else: ?>


                              <?php if ($status=='cancelled'):?>
                               

                                <a   href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                
                                <label style="color:red">Cancelled</label> <?php echo $cancelleddate.'&nbsp;'.$cancelledby.'<br>'.'Reason: '.$reason ?>
                                <br>
                              <?php else: ?>
                            
                             
                                  <a  href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                  <br>
                                 <a name="Cancel" value="" id="Cancel" onclick="myFunction(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 
                              <?php endif ?>
                    <?php endif ?>
                        
               
                        
                </td>
                
               

                </tr>

            
            <?php }?>



             
            </table>
</div>
                
                </div>
            </div>
                 

           
        
        <!-- //Setting ID -->
        <script>
        function myFunction(idget) {

          var idtomodal = idget.getAttribute("data-idtomodal");
          var id1 = $("input[name='id1']");
          id1.val(idtomodal);

         
       
        }
        </script>
          <!-- //Setting ID -->
      
    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable=$('#example1').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true,
            "order": [[ 1, "asc" ]],
            aLengthMenu: [ [10, 20, -1], [ 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
            });
        
    } );
</script>




</body>
</html>



   <!-- modals -->

   <div id="cancel_data_Modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Vehicle Request</h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="vehicle_cancel.php">
              
              <label>Reason</label>
              <input required type="text" name="reason" id="reason" class="form-control" />
                                  
              <br>
              
              
              <button type="submit" name="cancel" class="btn btn-warning pull-right">Cancel</button>


              <input hidden type="text" name="id1" id="id1" value="" class=""/>
              <br>
              <input hidden type="text" name="user" id="user" value="<?php echo $username1?>" class=""/>
              <br>
              <input hidden type="text" name="now" id="now" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
             
             
              <br />

              <!-- <input type="submit" name="submit" id="submit" value="Cancel" class="btn btn-warning" /> -->

             
          
              
              </form>
            </div>
            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
            </div>
          </div>
          </div>

          <div id="dataModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Travel Order</h4>
            </div>
            <div class="modal-body" id="employee_detail">
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->

              
            </div>
            </div>
          </div>
          </div>
        <!-- modals -->



        <script>
                  function myFunctionPassengers() {

                    var vrno = idget.getAttribute("data-vrno");
                    var passengers = $("input[name='passengers']");

                    $.ajax({
                    method:'POST',
                    url:"vr_passengers.php?",
                    data: {vrno:vrno},
                        success : function(data) {
                          passengers.val(data);
                          //alert(data);
                        }
                    });
                   
                  }
</script>