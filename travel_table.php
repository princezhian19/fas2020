<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location:index.php');
  }else{
    error_reporting(0);
  ini_set('display_errors', 0);
  $username = $_SESSION['username'];
  $_SESSION['unique_id'] = 1;
  
  }
include('db.class.php'); // call db.class.php
include('travelclaim_functions.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
function aa($id)
{
    include 'connection.php';
    $query = "SELECT distinct(DATE) from tbltravel_claim_info";
    $result = mysqli_query($conn, $query);
    $date = array();
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $date = $row['DATE'];
            $query1 = "SELECT * FROM tbltravel_claim_info 
            INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
            WHERE tbltravel_claim_info.`RO` = '".$id."' and tbltravel_claim_info.`DATE` = '".$date."' ORDER BY DATE";
            $result1 = mysqli_query($conn, $query1);
            $saved = array();
    
            if(mysqli_num_rows($result1) > 0)
            {
                while($row1 = mysqli_fetch_array($result1))
                {
                    $saved[] = $row1["DATE"]; // you are missing []

                  if($row1['DATE'] == $row1['DATE'])
                  {
                      if($row1['DATE'] == $saved[1])
                      {
                          echo '<td></td>';
                      }else
                      {
                          ?>
                              <td style = "width:9.8%;"><input readonly id = "travel_date" type = "text" class = "form-control" style = "width:100%;" value = "<?php echo date('F d, Y', strtotime($row1['DATE']));?>"/></td>
                          <?php
                      }   
                      
                  }else{
                  ?>
                  
                  <tr style =" display:table; table-layout:fixed; width:100%;">
                      <?php }?>
                      <td ><textarea readonly cols = 13 style = "resize:none;background:#ECEFF1;border:1px solid #CFD8DC;"><?php echo $row1['PLACE'];?></textarea></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['ARRIVAL']));?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['DEPARTURE']));?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['MOT'];?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['TRANSPORTATION']);?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['PERDIEM']);?>"/></td>
                      <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
                      <td><input readonly type = "text" class = "form-control" style = "width:100%%;" value = "<?php echo sprintf("%.2f",$row1['TOTAL_AMOUNT']);?>"/></td>
                                                <?php 
                          if(basename($_SERVER['PHP_SELF']) == 'ViewTravelClaim.php')
                          {
                          }
                          else{
                          ?>
                                      <td style = "width:12%;">
                                        <span class = "btn btn-sm btn-primary"><i class = "fa fa-edit"></i>&nbsp;Edit</span>
                                        <span class = "btn btn-sm btn-danger"  id = "btnids<?php echo $row1['ID']; ?>" data-id = "<?php echo $row1['ID'];?>" value = "<?php echo $row1['ID'];?>"><i class = "fa fa-trash"></i>&nbsp;Delete</span>
                                      </td>

                          <?php
                          }
                          ?>

        </tr>
        
        <?php
        $row1['DATE'] = '';
        ?>
        <script>
          $(document).ready(function(){
              $( "#btnids<?php echo $row1['ID'];?>" ).click(function() {
                swal({
                      title: "Are you sure?",
                      text: "Your will not be able to recover this travel date!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      closeOnConfirm: false
                      },
                      function(){
                      swal("Deleted!", "Your travel date  has been deleted.", "success");
                          $.ajax({
                              url:"travelclaim_functions.php",
                              method:"POST",
                              data:{
                              function: 'deleteTravelOrder',
                              id: <?php echo $row1['ID'];?>,
                          },
                          success:function(data)
                          {
                      
                                setTimeout(function () {
                                window.location = "CreateTravelClaim.php?username=<?php echo $_GET['username'];?>&division=<?php echo $_GET['division'];?>";
                                }, 1000);

                            
                          }
                          });

                      });
              });
          });
        </script>
      <?php
                }
            }
        }
    }
}


function showData()
{
  include 'connection.php';
  $query = "SELECT * FROM `tbltravel_claim_info2`
  INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
  INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
  WHERE  `RO_TO_OB`= '".$_POST['ro']."'
  GROUP by tbltravel_claim_info.RO ";

  
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
          $rnums = mysqli_num_rows($result);
          ?>
              <thead style =" display:table; table-layout:fixed; width:100%;">
                <tr>
                  <th class = "table-header" style = "text-align:center;width:11%;" rowspan = 2> Date </th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" colspan = 2>Time</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Means of Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Per Diem</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Others</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Total Amount</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan =3>Action</th>
                </tr>
                <tr>
                  <th class = "table-header"  style = "text-align:center;">Arrival</th>
                  <th class = "table-header"  style = "text-align:center;">Departure</th>
                </tr>
              </thead>
          <?php
          if($rnums>0){
            rowCount();
          }else{rowCount();}
          ?>

            
          <?php
            while($row = mysqli_fetch_array($result))
            {
              
            ?>
            <tr>
                <td colspan = 10 style = "background-color:#B0BEC5;"><?php echo '<b>'.$row['RO_OT_OB'].'</b>'; ?> </td>
            </tr>
            
            
            <?php
            aa($row['ID']);
            }
            ?>
           </tbody>

            <?php
        }else{
            $query = "SELECT * FROM tbltravel_claim_info2 WHERE `NAME` = '".$_GET['username']."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                  
                    ?>

                  <tr>    
                      
                  </tr>
            <tr>
            </tr>
        
            <?php
                }
            }
            ?>
          

            <?php
        }

    
}
function rowCount(){
  include 'connection.php';
  $query1 = "SELECT * FROM tbltravel_claim_info2 INNER JOIN tbltravel_claim_info on tbltravel_claim_info2.ID = tbltravel_claim_info.TC_ID";
  $result1 = mysqli_query($conn, $query1);
  $row_cnt = $result1->num_rows;
  if($row_cnt == 0)
  {

  }
  else if($row_cnt == 1)
  {
    ?>
              <tbody class = "scroll" style ="height:90px;">

    <?php
  }else if($row_cnt == 2) {
    ?>
              <tbody class = "scroll" style ="height:180px;">

    <?php
  }else if($row_cnt == 3) {
    ?>
              <tbody class = "scroll" style ="height:270px;">

    <?php
  }else if($row_cnt == 4) {
    ?>
              <tbody class = "scroll" style ="height:360px;">

    <?php
  }else if($row_cnt == 5) {
    ?>
              <tbody class = "scroll" style ="height:450px;">

    <?php
  }else{
    ?>
              <tbody class = "scroll" style ="height:540px;display:block; height:300px; overflow:auto;">

    <?php

  }
}
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
  

echo '<input type = "hidden" id = "hidden_url" value = "'.$link.'"/>';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="panel panel-defasult">
          <div class="box-body"> 
          
            <div>
                <h1>Monitoring of Travel Claim Request</h1><br>
           <a href = "CreateTravelClaim.php?ro=&ui=1&username=<?php echo $username;?>" ><button class = "btn btn-md btn-success">Create</button></a><br><br><br>
                
            </div>
            
     
            
         
        
              <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                    <thead>
                        <th>NO</th>
                        <th>EMPLOYEE NAME</th>
                        <th>RO/OT/OB</th>
                        <th>NO. OF TRAVEL DAYS</th>

                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>ORIGIN</th>
                        <th>DESTINATION</th>
                        <th>DISTANCE</th>
                        <th>VENUE</th>

                        
                        <th style = "text-align:center;max-width:20%;">ACTION</th>
                    </thead>

                </table>

    

      <script src="jquery.min.js"></script>

</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style = "width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">ITINERARY OF TRAVEL</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table  cellpadding="0" cellspacing="0" width="100%" border="1"  class="table table-bordered table-hover">
              <thead>
                <tr>
                    <td class = "label-text">
                      <label>Entity Name: 
                        </td>
                          <td colspan = 10  >
                        <input type = "text" class = "form-control" value = "DILG Region IV-A" readonly/>
                      </td>
                  </tr>
          
              
                <tr>
                  <td class = "label-text">
                    <label>Fund Cluster:</label>
                      </td>
                        <td colspan = "4">
                      <input type = "text" class = "form-control" readonly/>
                    </td>
                  <td class = "label-text" colspan = 2>
                    <label>No:</label>
                      </td>
                        <td colspan = 4>
                      <input type = "text" class = "form-control" readonly/>
                    </td>
                </tr>
                <tr>
                  <td class = "label-text">
                    <label>Name: 
                      </td>
                  <td colspan = 4><input type = "text" class = "form-control" style = "font-weight:bold;"value = "<?php echo viewCompleteName($_GET['emp_name']);?>" readonly/></td>
                  <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                  <td colspan = 4><input type = "text" class = "form-control datepicker1" id = "datepicker1" value = "<?php echo date('F d, Y');?>"/></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Position:</label></td>
                    <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo viewPosition($_GET['emp_name']);?>" readonly/></td>
                      <td colspan = 5 rowspan = 2>
                        <label>Purpose:</label> <label style="color: Red;" >*</label><textarea name = "ro" rows = 4 col=10 style = "width:100%;resize:none;" id = "or" disabled><?php echo $_GET['ro'];?></textarea></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Official Station: </label></td>
                  <td colspan = 4> <?php echo viewOffice($_GET['emp_name']); ?> </td>
                </tr>
              </thead>
      </table>
      <table class="equalDivide" cellpadding="0" cellspacing="0" width="100%" border="1" >
               <?php echo showData();?>
          
            </table>
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="100%" border="1">
              <tr>
                  <td colspan = 10>
                      <!-- <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                      <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button> -->
                  </td>
              </tr>
              <tr>
                  <td colspan = 10>TOTAL <?php getTotal(); ?></td>
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
                  <?php echo '<b>'.getCompleteName().'</b>';?></CENTER>
                  </td>
                
                </tr>
                <tr>
                </tr>
                <tr>
                  <td colspan = 5 rowspan = 2>Approved By <CENTER><br>_____________________________________________<br> <b> ARIEL O. IGLESIA	</b> </CENTER> </td>
                </tr>
                <tr>
                
                </tr>
            
                
            </table>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
          $(document).ready(function() {
            
        
              var action = '';
              var table = $('#example').DataTable( {
        
                'scrollX'     : true,
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                  "processing": true,
                  "serverSide": false,
                  "ajax": "DATATABLE/travel_claim.php"
                  ,
                  "columnDefs": [ {
                      "targets":10,
                      "render": function (data, type, row, meta ) {  
                      action = "<button  class = 'btn btn-sm btn-success' id = 'view' style = 'font-family:Arial'><i class = 'fa fa-eye'></i>View</button>";
                      // &nbsp;<button class = 'btn btn-md btn-primary'><i class = 'fa fa-edit'></i>Edit</button>&nbsp;<button class = 'btn btn-md btn-danger'><i class = 'fa fa-trash'></i> Delete</button>
                      return action;
                      }
                  }]
                

              } );



              
              $('#example tbody').on( 'click', '#view', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var RO = data[2];
                $.ajax({
                  url: 'travel_table.php',
                  type: 'POST',
                  data: {'ro':RO},
                  success: function(data) {

                  }
                });
                $('#exampleModal').modal({
                keyboard: false
                });
               $('#or').val(data[2]);
                // window.location="ViewTravelClaim.php?emp_name="+data[1]+"&ro="+data[2];
              } );
          });
              </script>
