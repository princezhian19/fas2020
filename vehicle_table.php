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
&nbsp;&nbsp;

<li class="btn btn-success"><a href="VehicleRequestSchedule.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Trip Schedule</a></li>  



</td>

<td class="col-md-1">


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

                  <th width =''>CTRL NO.</th> 
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
                  <th width = ''>SUBMITTED</th>
                  <th width = ''>RECEIVED</th>
                  <th width = '500'>ASSIGNED</th>
                  <th width = ''>RECOMMENDING</th> 
                  <th width = ''>APPROVED</th> 
                  <th width = ''>SERVED COPY</th> 
                  
                  <th width = '500'>ACTION</th>
                  

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

                 
                  $assigneddate1=$row["assigneddate"];
                  $assigneddate = date('F d, Y', strtotime($assigneddate1));

                  $assignedtime1=$row["assignedtime"];
                  $assignedtime = date('H:i', strtotime($assignedtime1));

                  $dispatcher=$row["dispatcher"];
                  $nov=$row["nov"];

                  $av=$row["av"];
                  $ad=$row["ad"];
                  $plate=$row["plate"];

                  $av1=$row["av1"];
                  $ad1=$row["ad1"];
                  $plate1=$row["plate1"];

                  $av2=$row["av2"];
                  $ad2=$row["ad2"];
                  $plate2=$row["plate2"];


                  $vremarks=$row["vremarks"];
                  $rstatus=$row["rstatus"];

                  $recommenddate1=$row["recommenddate"];
                  $recommenddate = date('F d, Y', strtotime($recommenddate1));

                  $recommendby=$row["recommendby"];

                  $approveddate1=$row["approveddate"];
                  $approveddate = date('F d, Y', strtotime($approveddate1));

                  $approvedby=$row["approvedby"];

                  $astatus=$row["astatus"];

                  $serveddate1=$row["serveddate"];
                  $serveddate = date('F d, Y', strtotime($serveddate1));

                  $servedby=$row["servedby"];
               

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



                          <!--   Assign -->

                          <?php if ($receiveddate1 != '0000-00-00'): ?>
                            <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial' ):?>
                             
                                <?php if ($assigneddate1 == '0000-00-00' && $status != 'cancelled'): ?>
                                  <td>
                                  <a name="assign" value="" id="assign" onclick="myFunction1(this)" data-assignID="<?php echo $id;?>" data-toggle="modal" data-target="#assign_data_Modal" title="Assign" class = "btn btn-success btn-xs" > <i class='fa'></i> Assign</a> 
                                 
                                </td>  
                                <?php else: ?>
                                <td>
                                <?php if ($recommenddate1 != '0000-00-00'): ?>
                                <?php echo $av.'<br>'.$ad?>
                                <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av1.'<br>'.$ad1?>
                                <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av2.'<br>'.$ad2?>
                                <?php else: ?>
                                  <?php echo $av.'<br>'.$ad?>
                                  <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av1.'<br>'.$ad1?>
                                <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av2.'<br>'.$ad2?>
                                  <!-- <a href='VehicleRequestUpdate.php?id=<?php echo $id;?>&pos=<?php echo $pos;?>&vrno=<?php echo $vrno;?>&type=<?php echo $type;?>' onclick="myFunctionPassengers()" data-vrno = <?php echo $vrno?>  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit </a> -->


                                <?php endif ?>
                              

                                </td>
                                <?php endif ?>
                          
                            <?php else: ?>
                            <td >
                                <?php echo $av.'<br>'.$ad?>
                                <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av1.'<br>'.$ad1?>
                                <br>
                                <?php echo ' '?>
                                <br>
                                <?php echo $av2.'<br>'.$ad2?>
                            </td>
                            <?php endif ?>

                            <?php else: ?>
                         
                            <td>
                         
                            </td>
                          
                            <?php endif ?>
                            <!--   Assign -->
                            
                            <!--   Recommend -->
                            <?php if ($assigneddate1 != '0000-00-00'): ?>
                              <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial'):?>
                             
                                  <?php if ($recommenddate1 == '0000-00-00' && $status != 'cancelled'): ?>
                                  <td>
                                  <a name="recommend" value="" id="recommend" onclick="myFunction2(this)" data-rvalue="<?php echo $id;?>" data-toggle="modal" data-target="#recommending_data_Modal" title="Recommend" class = "btn btn-success btn-xs" > <i class='fa'></i> Recommend</a> 
                                 
                                  </td>  
                                <?php else: ?>
                                <td>

                                <?php if ($recommenddate1 == '0000-00-00'): ?>
                                <!-- //no dates -->
                                <?php else: ?>
                                <?php echo $recommenddate.'<br>'.$recommendby.'<br>'.$rstatus?>
                                <?php endif ?>
                               
                                </td>
                                <?php endif ?>


                             
                            <?php else: ?>
                            <td >
                            
                            <?php if ($recommenddate1 == '0000-00-00'): ?>
                                <!-- //no dates -->
                                <?php else: ?>
                                <?php echo $recommenddate.'<br>'.$recommendby.'<br>'.$rstatus?>
                                <?php endif ?>
                            </td>
                            <?php endif ?>
                            <?php else: ?>
                         
                            <td></td>
                          
                            <?php endif ?>

                            <!--   Recommend -->

                            <!--   Approve -->
                            <?php if ($recommenddate1 != '0000-00-00'): ?>
                              <?php if ($username1 == 'cvferrer' || $username1 == 'aoiglesia' || $username1 == '' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial'):?>
                             
                                  <?php if ($approveddate1 == '0000-00-00' && $status != 'cancelled'): ?>
                                  <td>
                                  
                                  <!-- <a  class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to approve this Vehicle Request?');" href='vehicle_approve.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Approve">Approve</a> -->
                                  <a name="approve" value="" id="approve" onclick="myFunction3(this)" data-avalue="<?php echo $id;?>" data-toggle="modal" data-target="#approve_data_Modal" title="Recommend" class = "btn btn-success btn-xs" > <i class='fa'></i> Approve</a>   
                                
                                </td>  
                                <?php else: ?>
                                <td>

                                <?php if ($approveddate1 == '0000-00-00'): ?>
                                <!-- //no dates -->
                                <?php else: ?>
                                <?php echo $approveddate.'<br>'.$approvedby.'<br>'. $astatus?>
                                <?php endif ?>
                               
                                </td>
                                <?php endif ?>


                             
                            <?php else: ?>
                            <td >
                            <?php if ($approveddate1 == '0000-00-00'): ?>
                                <!-- //no dates -->
                                <?php else: ?>
                                <?php echo $approveddate.'<br>'.$approvedby.'<br>'. $astatus?>
                                <?php endif ?>
                            </td>
                            <?php endif ?>
                            <?php else: ?>
                         
                            <td></td>
                          
                            <?php endif ?>

                          <!--   Approve -->




                          <!--   Serve -->
                          <?php if ($approveddate1 != '0000-00-00'): ?>
                            <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial'):?>

                          <?php if ($serveddate1 == '0000-00-00' && $status != 'cancelled'): ?>
                          <td>

                          <a  class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to serve this Vehicle Request?');" href='vehicle_serve.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Serve">Serve</a>
                          </td>  
                          <?php else: ?>
                          <td>

                          <?php if ($serveddate1 == '0000-00-00'): ?>
                          <!-- //no dates -->
                          <?php else: ?>
                          <?php echo $serveddate.'<br>'.$servedby?>
                          <?php endif ?>

                          </td>
                          <?php endif ?>



                          <?php else: ?>
                          <td >
                          <?php if ($serveddate1 == '0000-00-00'): ?>
                          <!-- //no dates -->
                          <?php else: ?>
                          <?php echo $serveddate.'<br>'.$servedby?>
                          <?php endif ?>

                          </td>
                          <?php endif ?>
                          <?php else: ?>

                          <td></td>

                          <?php endif ?>

                          <!--   Serve -->
                        
             


                  <td>
                    <?php if ($submitteddate1 == 0000-00-00): ?>
                          <!--  -->
                              <?php if ($status!='cancelled'):?>
                                
                              
                              
                                <a   title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                <br>
                             
                                  <a href='VehicleRequestUpdate.php?id=<?php echo $id;?>&pos=<?php echo $pos;?>&vrno=<?php echo $vrno;?>&type=<?php echo $type;?>' onclick="myFunctionPassengers()" data-vrno = <?php echo $vrno?>  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>&nbsp;&nbsp;&nbsp; Edit &nbsp;&nbsp;&nbsp;</a>
                                  <br>
                                  
                                
                                 <a name="Cancel" value="" id="Cancel" onclick="myFunction(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="#cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 
                              <?php else: ?>
                               
                                <a href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> Export</a>
                                
                                <label style="color:red">Cancelled</label> 
                                <br>
                                <?php echo $cancelleddate.'<br>'.$cancelledby.'<br>'.'Reason: '.$reason ?>
                              <?php endif ?>
                        
                        <?php else: ?>


                              <?php if ($status=='cancelled'):?>
                               

                                <a   href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                
                                <label style="color:red">Cancelled</label>
                                <br>
                                <?php echo $cancelleddate.'<br>'.$cancelledby.'<br>'.'Reason: '.$reason ?>
                                <br>
                              <?php else: ?>
                            
                             
                                  <a  href='' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i>&nbsp; Export&nbsp;</a>
                                  <br>
                                 <a name="Cancel" value="" id="Cancel" onclick="myFunction(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="#cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 
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

        <!-- //Setting assign ID -->
        <script>
        function myFunction1(assignvalue) {

          var assignID1 = assignvalue.getAttribute("data-assignID");
          var assignID = $("input[name='assignID']");
          assignID.val(assignID1);

         
       
        }
        </script>
          <!-- //Setting assign ID -->


            <!-- //Setting recommending ID -->
        <script>
        function myFunction2(rvalue) {

          var rvalue1 = rvalue.getAttribute("data-rvalue");
          var rvalue = $("input[name='rvalue']");
          rvalue.val(rvalue1);

         
       
        }
        </script>
          <!-- //Setting recommending ID -->

          
            <!-- //Setting approve ID -->
        <script>
        function myFunction3(avalue) {

          var avalue1 = avalue.getAttribute("data-avalue");
          var avalue = $("input[name='avalue']");
          avalue.val(avalue1);

         
       
        }
        </script>
          <!-- //Setting approve ID -->
      
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


<!-- assign -->

<div id="assign_data_Modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Assign Vehicle Request</h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="vehicle_assign.php">
              
            
              
              <table class="table">
                  <tr>
                  <td >
                  <label> Assigned Date <span style = "color:red;">*</span></label>  
                 </td>

                  <td class="" colspan="2" >
                  <input  required type="text" class="form-control" name="assigneddate" id="datepicker1" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('m/d/Y') ?>" >

                  </td>
                  </tr>
                  
                  <tr>
                  <td >  <label> Assigned Time <span style = "color:red;">*</span></label>  </td>
                  
                  <td class="" colspan="2" >
                  <input  required type="time" class="form-control" name="assignedtime" id="assignedtime" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('H:i') ?>" >

                  </td>
                  </tr>

                  <tr>
                  <td>   <label> Dispatcher <span style = "color:red;">*</span></label>  </td>
                  
                  <td class=""  colspan="2">
                  <input readonly required type="text" class="form-control" name="dispatcher" id="dispatcher" value="<?php echo $username1?>" >

                  </td>
                  </tr>


                  <tr>
                  <td ><label>  No. of Assigned Vehicle <span style = "color:red;">*</span></label> </td>
                  
                  <td class="" colspan="2">
                  <input  required type="number" class="form-control" name="nov" id="nov" value = "" >

                  </td>
                  </tr>


              <tr>

                  <td class="col-md-4" >
                 <!--   Driver 1 -->
           
          <label>Assigned Vehicle 1 <span style = "color:red;">*</span></label> 
                
                <!-- <input  required type="Text" class="form-control" name="assignvehicle" id="assignvehicle" value = "" > -->
                <select required class="form-control" style="width: 100%;" name="av" id="av" >
                    <option value="">Select Vehicle</option>
                    <option value="Isuzu Cross Wind-8974">Isuzu Cross Wind-8974</option>
                    <option value="Isuzu Cross Wind-8994">Isuzu Cross Wind-8994</option>
                    <option value="Isuzu Pick-up">Isuzu Pick-up</option>
                   
                </select>
               
             
              
              
             <label>Assigned Driver 1 <span style = "color:red;">*</span></label>
                <select required class="form-control" style="width: 100%;" name="ad" id="ad" >
                    <option value="">Select Driver</option>
                    <option value="Daniel Narciso">Daniel Narciso</option>
                    <option value="Joachim Lacdang">Joachim Lacdang</option>
                    <option value="Louie Blanco">Louie Blanco</option>
                   
                </select>
               
              
              
                <label>Plate Number <span style = "color:red;">*</span></label>
                <input readonly required type="Text" class="form-control" name="plate" id="plate" value = "" >
               
              
                <!--   Driver 1 -->

                  </td>

                  <td class="col-md-4" >
                 

                  <!--   Driver 1 -->
           
          <label>Assigned Vehicle 2 <span style = "color:red;"></span></label> 
                
                <!-- <input  required type="Text" class="form-control" name="assignvehicle" id="assignvehicle" value = "" > -->
                <select required class="form-control" style="width: 100%;" name="av1" id="av1" >
                    <option value="">Select Vehicle</option>
                    <option value="Isuzu Cross Wind-8974">Isuzu Cross Wind-8974</option>
                    <option value="Isuzu Cross Wind-8994">Isuzu Cross Wind-8994</option>
                    <option value="Isuzu Pick-up">Isuzu Pick-up</option>
                   
                </select>
               
             
              
              
             <label>Assigned Driver 2 <span style = "color:red;"></span></label>
                <select required class="form-control" style="width: 100%;" name="ad1" id="ad1" >
                    <option value="">Select Driver</option>
                    <option value="Daniel Narciso">Daniel Narciso</option>
                    <option value="Joachim Lacdang">Joachim Lacdang</option>
                    <option value="Louie Blanco">Louie Blanco</option>
                   
                </select>
               
              
              
                <label>Plate Number <span style = "color:red;"></span></label>
                <input readonly required type="Text" class="form-control" name="plate1" id="plate1" value = "" >
               
              
                <!--   Driver 1 -->
                  </td>

                  <td class="col-md-4" >
                 


                  <!--   Driver 1 -->
           
          <label>Assigned Vehicle 3 <span style = "color:red;"></span></label> 
                
                <!-- <input  required type="Text" class="form-control" name="assignvehicle" id="assignvehicle" value = "" > -->
                <select required class="form-control" style="width: 100%;" name="av2" id="av2" >
                    <option value="">Select Vehicle</option>
                    <option value="Isuzu Cross Wind-8974">Isuzu Cross Wind-8974</option>
                    <option value="Isuzu Cross Wind-8994">Isuzu Cross Wind-8994</option>
                    <option value="Isuzu Pick-up">Isuzu Pick-up</option>
                   
                </select>
               
             
              
              
             <label>Assigned Driver 3 <span style = "color:red;"></span></label>
                <select required class="form-control" style="width: 100%;" name="ad2" id="ad2" >
                    <option value="">Select Driver</option>
                    <option value="Daniel Narciso">Daniel Narciso</option>
                    <option value="Joachim Lacdang">Joachim Lacdang</option>
                    <option value="Louie Blanco">Louie Blanco</option>
                   
                </select>
               
              
              
                <label>Plate Number <span style = "color:red;"></span></label>
                <input readonly required type="Text" class="form-control" name="plate2" id="plate2" value = "" >
               
              
                <!--   Driver 1 -->
                  </td>
            
              </tr>

                  <tr>
                  <td > <label>Remarks <span style = "color:red;"></span></label></td>
                  
                  <td class="" colspan="2" >
                  <input  type="text" class="form-control" style="height: 70px; width:100%;" name="vremarks" id="vremarks" value = "" >

                  </td>
                  </tr>

              </table>


              <br>
            
              
              
              <button type="submit" name="assign" class="btn btn-primary pull-right">Assign</button>


              <input hidden type="text" name="assignID" id="assignID" value="" class=""/>
              <br>
              <input  hidden type="text" name="userv" id="userv" value="<?php echo $username1?>" class=""/>
              <br>
              <input hidden  type="text" name="nowv" id="nowv" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
        </form>
        
            </div>
           
            </div>
            </div>
          </div>
          </div>
  <!-- assign -->




  <!-- recommending -->

<div id="recommending_data_Modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Recommend Vehicle Request</h4>
              
            </div>
            
           
              <form method="POST" id="insert_form" action="vehicle_recommend.php">
              
            
              
              <table class="table">
                  <tr>
                  <td class="col-md-3" >

                

                  </td>

                  <td class="col-3" >

                  <button type="submit" name="r" onclick="return confirm('Are you sure you want to recommend this Vehicle Request?');" class="btn btn-primary pull-right">Recommend</button>

                  </td>

                  <td class="col-3" >

                  <button type="submit" name="nr" onclick="return confirm('Are you sure you dont want to recommend this Vehicle Request?');"  class="btn btn-primary pull-right">Don't Recommend</button>

                  </td>

                  <td class="col-md-3" >


                  </td>

                 
                  </tr>
                  
                

              </table>




              <input hidden  type="text" name="rvalue" id="rvalue" value="" class=""/>
             
              <input hidden   type="text" name="userr" id="userr" value="<?php echo $username1?>" class=""/>
             
              <input hidden  type="text" name="nowr" id="nowr" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
            <br>
        </form>
            </div>
           
            </div>
            </div>
          </div>
         
  <!-- recommending -->



  <!-- approving -->

<div id="approve_data_Modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Approve Vehicle Request</h4>
              
            </div>
            
           
              <form method="POST" id="insert_form" action="vehicle_approve.php">
              
            
              
              <table class="table">
                  <tr>
                  <td class="col-md-3" >

                

                  </td>

                  <td class="col-3" >

                  <button type="submit" name="approved" onclick="return confirm('Are you sure you want to approve this Vehicle Request?');" class="btn btn-primary pull-right">Approve</button>

                  </td>

                  <td class="col-3" >

                  <button type="submit" onclick="return confirm('Are you sure you dont want to disapprove this Vehicle Request?');" name="disapproved" class="btn btn-primary pull-right">Disapprove</button>

                  </td>

                  <td class="col-md-3" >


                  </td>

                 
                  </tr>
                  
                

              </table>




              <input hidden  type="text" name="avalue" id="avalue" value="" class=""/>
             
              <input hidden   type="text" name="usera" id="usera" value="<?php echo $username1?>" class=""/>
             
              <input hidden  type="text" name="nowa" id="nowa" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
            <br>
        </form>
            </div>
           
            </div>
            </div>
          </div>
         
  <!-- approving -->


        
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







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker1').timepicker({
      showInputs: true
    })

    $('.timepicker2').timepicker({
      showInputs: true
    })
  })
</script>

<script>
$(document).ready(function(){
  $("#av").change(function (){

    
    assignvehicle = document.getElementById("av").value;

   
    if(assignvehicle=='Isuzu Cross Wind-8974'){
   
      
        var plate = $("input[name='plate']"); 
       
      
        plate.val('CN 8974');
     
     
    }
    else if(assignvehicle=='Isuzu Cross Wind-8994'){
      
      var plate = $("input[name='plate']"); 
       
      
       plate.val('CN 8994');
       
       
    }

    else if(assignvehicle=='Isuzu Pick-up'){
      
      var plate = $("input[name='plate']"); 
       
      
       plate.val('GNJ 918');
       
       
    }
    else{

      var plate = $("input[name='plate']"); 
       
      
       plate.val('');
    }
   
    //alert(cat);

  });
});
</script>





<script>
$(document).ready(function(){
  $("#av1").change(function (){

    
    assignvehicle1 = document.getElementById("av1").value;

   
    if(assignvehicle1=='Isuzu Cross Wind-8974'){
   
      
        var plate1 = $("input[name='plate1']"); 
       
      
        plate1.val('CN 8974');
     
     
    }
    else if(assignvehicle1=='Isuzu Cross Wind-8994'){
      
      var plate1 = $("input[name='plate1']"); 
       
      
       plate1.val('CN 8994');
       
       
    }

    else if(assignvehicle1=='Isuzu Pick-up'){
      
      var plate1 = $("input[name='plate1']"); 
       
      
       plate1.val('GNJ 918');
       
       
    }
    else{

      var plate1 = $("input[name='plate1']"); 
       
      
       plate1.val('');
    }
   
    //alert(cat);

  });
});
</script>



<script>
$(document).ready(function(){
  $("#av2").change(function (){

    
    assignvehicle2 = document.getElementById("av2").value;

   
    if(assignvehicle2=='Isuzu Cross Wind-8974'){
   
      
        var plate2 = $("input[name='plate2']"); 
       
      
        plate2.val('CN 8974');
     
     
    }
    else if(assignvehicle2=='Isuzu Cross Wind-8994'){
      
      var plate2 = $("input[name='plate2']"); 
       
      
       plate2.val('CN 8994');
       
       
    }

    else if(assignvehicle2=='Isuzu Pick-up'){
      
      var plate2 = $("input[name='plate2']"); 
       
      
       plate2.val('GNJ 918');
       
       
    }
    else{

      var plate2 = $("input[name='plate2']"); 
       
      
       plate2.val('');
    }
   
    //alert(cat);

  });
});
</script>


<!-- Validation -->
<script>
$(document).ready(function(){
  $("#ad").change(function (){

    
    driver = document.getElementById("ad").value;

    driver1 = document.getElementById("ad1").value;

    driver1 = document.getElementById("ad2").value;

   
    if(driver=='Daniel Narciso'){
   
    /*   $(" #ad1 option[value='Daniel Narciso']").remove(); 
      $(" #ad2 option[value='Daniel Narciso']").remove();  */
      
     
     
    }
    else{
     

    }



  });
});
</script>





