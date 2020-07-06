
<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'travelclaim_functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
  button{
    font-family:'Arial';

  }
  table tr{ 
    font-family:'Cambria';
  }
  .table-header{
    color:black;
    background-color:#B0BEC5; 

  }
  td{
    padding:5px;
  }
  td.label-text{ 
    background-color:#B0BEC5; 

  }
  .borderless {
  outline: 0;
  border-width: 0 0 2px;
  border-color: blue
}
.borderless:focus {
  border-color: green
}
div.pac-container {
    z-index: 99999999999 !important;
}
.border-disabled{
  border: 2px solid gray;
}
.box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
    }
    .box .text{
      padding:10%;

        position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 0;
        right: 0;
        top:0; /* Adjust this value to move the positioned div up and down */
        width: 100%; /* Set the width of the positioned div */
    }

    .scroll{
    height:300px;display:block;overflow-y:hidden; 
    }
    .scroll:hover{
  overflow-y: scroll;

    }
 



</style>
<?php
// PHP FUNCTION

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
            $query1 = "SELECT * FROM tbltravel_claim_info2 INNER JOIN tbltravel_claim_info on tbltravel_claim_info2.ID = tbltravel_claim_info.TC_ID WHERE tbltravel_claim_info.`TC_ID` = '".$id."' and tbltravel_claim_info.`DATE` = '".$date."' ORDER BY DATE";
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
        
        <tr style =" display:table; table-layout:fixed; width:100%;">>
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
            <td style = "width:9.5%;"><button class = "btn btn-md btn-danger"  id = "btnids<?php echo $row1['ID']; ?>" data-id = "<?php echo $row1['ID'];?>" value = "<?php echo $row1['ID'];?>"><i class = "fa fa-trash"></i>&nbsp;Delete</button></td>

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
        $query = "SELECT * FROM `tbltravel_claim_info2` WHERE `RO_TO_OB` LIKE '%".$_GET['ro_no']."%'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
          $rnums = mysqli_num_rows($result);
            while($row = mysqli_fetch_array($result))
            {
              $rnums = mysqli_num_rows($result1);
      
              
            ?>


            <tr>
            <thead style =" display:table; table-layout:fixed; width:100%;">
                <th class = "table-header" style = "text-align:center;width:11%;" rowspan = 2>
                  Date
                </th>
                <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                <th class = "table-header" style = "text-indent:10px;text-align:center;" colspan = 2>Time</th>
                <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Means of Transportation</th>
                <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Transportation</th>
                <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Per Diem</th>
                <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Others</th>
                <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Total Amount</th>
                <?php 
if(basename($_SERVER['PHP_SELF']) == 'ViewTravelClaim.php')
{

}else{
?>
                <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan =3>Action</th>

<?php
}
                ?>
              </tr>
              <tr>
                <th class = "table-header"  style = "text-align:center;">Arrival</th>
                <th class = "table-header"  style = "text-align:center;">Departure</th>
            </thead>

              </tr>
<?php 
// TBODY
rowCount();
?>
            <tr>
                <td colspan = 10 style = "background-color:#B0BEC5;"> <?php echo '<b>'.$row['RO_TO_OB'].'</b>'; ?> </td>
            </tr>
        
            
        
            <?php
            aa($row['ID']);
            }
            ?>
            <tr>
                <!-- <td colspan = 10>
                    <?php 
                    if(mysqli_num_rows($result) > 0)
                        {
                            ?>
                                <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
                            <?php
                        }else{
                            ?>
                                <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
                            <?php
                        }
                        ?>
                        
                </td> -->
            </tr>
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
                <td colspan = 10 style = "background-color:#B0BEC5;">
                    <!-- <input type = "checkbox"> -->
                    <input type = "text" style = "width:100%;padding:5px;border:1px solid gray;" value = "<?php echo $row['RO_TO_OB']; ?>" readonly />
                </td>
            </tr>
            <tr>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['DATE'];?>"/></td>
                <td><textarea ><?php echo $row['PLACE'];?></textarea></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['ARRIVAL'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['DEPARTURE'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['MOT'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['TRANSPORTATION'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['PERDIEM'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['OTHERS'];?>"/></td>
                <td><input type = "text" class = "form-control" value = "<?php echo $row['TOTAL_AMOUNT'];?>"/></td>
                <?php 
if(basename($_SERVER['PHP_SELF']) == 'ViewTravelClaim.php')
{
}
else{
?>
                <td><button class = "btn btn-md btn-danger" id = "btnids" data-id = "<?php echo $row['ID'];?>" value = "<?php echo $row['ID'];?>"><i class = "fa fa-trash"></i>Delete</button></td>

<?php
}
?>
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
  if($row_cnt == 1)
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

        
    

        
    



?>
</head>


<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>View Itinerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="CreateTravelClaim.php?username=<?php echo $username;?>&division=<?php echo $_SESSION['division'];?>" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
        <div class="box-body">
            <div class="well" style = "padding:20px;">
            <H5 style = "margin-left:1300px;"><i>Appendix 45</i></H5>

            <center>
            
            <h1>ITINERARY OF TRAVEL </h1>
            <table  cellpadding="0" cellspacing="0" width="80%" border="1">
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
                  <td colspan = 4><input type = "text" class = "form-control" style = "font-weight:bold;"value = "<?php echo getCompleteName();?>" readonly/></td>
                  <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                  <td colspan = 4><input type = "text" class = "form-control datepicker1" id = "datepicker1" value = "<?php echo date('F d, Y');?>"/></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Position:</label></td>
                    <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo getPosition();?>" readonly/></td>
                      <td colspan = 5 rowspan = 2>
                        <label>Purpose:</label> <label style="color: Red;" >*</label><textarea rows = 4 col=10 style = "width:100%;resize:none;" id = "or"><?php echo $_GET['ro_no'];?></textarea></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Official Station: </label></td>
                  <td colspan = 4> <?php echo getOffice(); ?> </td>
                </tr>
              </thead>
            </table>
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1" >
               <?php echo showData();?>
          
            </table>
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1">
              <tr>
                  <td colspan = 10>
                      <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                      <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
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
  
  
      
           
            
            </center>
                

</div>  
</div>  


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>
<!-- ================= add travel =================== -->
<div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Travel</h4>
                <button type="button" class="close" data-dismiss="modal">&times; 
                </button>
                </div>
                <div class="modal-body">
                <form method = "POST" action = "addTravelData.php">
                        <table class="table table-bordered" style = "width:100%;"> 
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">RO/TO/OB No.<span style = "color:red;">*</span></td>
                                    <td class="col-md-5"><input  type = "text" class = "form-control" name = "rto" id = "ro_txt"    /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">No. of Travel Days<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type="text" class = "form-control" name = "ntd" autocomplete = off  >
                                            </td>
                                                </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type = "text"  class = "form-control datepicker2" id = "datepicker2" name = "start"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                            </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">End Date</td>
                                    <td class="col-md-5"><input  type = "text"  class = "form-control datepicker3" id = "datepicker3" name = "end"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Origin<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                      <input type="text" class="form-control" id="search_input" name = "origin" placeholder="Type address..." />
                                    
                                    </td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Destination<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                    <input type="text" class="form-control" id="search_input2" name = "destination" placeholder="Type address..." />
                                    
                                    </td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>  
                                    <td class="col-md-5">
                                    <input  type = "text" class = "form-control" name = "venue" alue = "" />
                                        </td>
                                            </tr>
                        
                        </table>
                        <input type = "submit" class = "pull-right btn btn-success btn-md" value = "Save" name = "submit"/>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
      </div>
      <!-- ================ travel dates ============== -->
      <div class="modal fade" id="add_travel_dates">
        <div class="modal-dialog" style = "width:50%;">
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Add Travel Dates</h4>
                <button type="button" class="close" data-dismiss="modal">&times; </button>
            </div>
            <div class="modal-body" style = " max-height: calc(100vh - 200px); overflow-y: auto;">
              <div class="box-body">
              <form method = "POST" action = "saveTravelInfo.php">
                <div class="well" style = "padding:10px;">

                  <div class="box-body">
                    <div class = "row">
                      <div class = "col-sm-12 col-md-12 col-lg-12">
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Date</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name = "date" class="form-control datepicker4" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Time Going to Venue</label>
                                    <input type = "time" name = "from1" class = "form-control "/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>&nbsp;</label>
                                  <input type = "time" name = "to1" class = "form-control"/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label style = "font-size:13px;">Time Going Home or back to Official Station</label>
                                    <input type = "time" name = "from2" class = "form-control"/>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>&nbsp;</label>
                                  <input type = "time" name = "to2" class = "form-control" style = "margin-top:15px;"/>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Others</label>
                                    <input type="text" name = "others" class="form-control" >
                                </div>
                              </div>
                          </div>
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                            <div class="col-md-12 well perdiem">
                            <div>
        <!-- <img src="images/50km.png" alt="Flying Kites" style = "width:100%;height:auto;"> -->
        <div class="form-group">
                                  <label>
                                  Per Diem
                                  </label>
                                  <label class = "pull-right">
                                  <input type ="hidden" value = "<?php echo getDistance();?>" id = "distance"/>
                                  Distance: <?php echo getDistance();?>
                                  </label>
                              </div>
                              <div class="form-group">
                                <label>
                                Meals
                                </label><br>
                                <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1" id = "cb1"> <b>Will Claim Meals</b><br>

                                <input style = "margin-left:14px" type="checkbox" name="breakfast" class="minimal-red checkboxgroup" id = "breakfast" value = "breakfast"> Breakfast
                                <input type="checkbox" name="lunch" class="minimal-red checkboxgroup" id= "lunch" value = "lunch"> Lunch
                                <input type="checkbox" name="dinner"  class="minimal-red checkboxgroup" id="dinner" value = "dinner"> Dinner
                              </div>
                              <div class="form-group">
                                <label>
                                Accomodation
                                </label><br>
                                <input type="checkbox"  name = "accomodation" class="minimal-red" id = "wa" value = "With Accomodation accomodation_chkbox"><b> Will Claim Accomodation</b><br>
                                <input style = "margin-left:14px" type="checkbox"  name = "with_receipt" class="minimal-red receipt" id = "wr" value ="With Receipt"> With Receipt
                                <input type="text" disabled name="wor_txt"  id = "wor_txt" class = "borderless" style = "width:50%;"/>
                                <br>
                                <input style = "margin-left:14px"type="checkbox"  name = "wor_txt" class="minimal-red receipt" id = "wor" value ="Without Receipt"> Without Receipt
                              </div>
        </div>
                            
                             
                            </div>
                          </div>
                      </div>
                    </div>
                    <div style = "padding:10px;" >
                    <div class="box-body myTemplate2">
                      <div class="row ">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>From</label>
                              <input type="text" name = "from3[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>To</label>
                              <input type = "text" name = "to3[]" class = "form-control"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Means of Transportation</label>
                              
                              <input type="text" name = "mot[]" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Transportation Fare</label>
                              <input type = "text" name = "transpo_fare[]" class = "form-control"  />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <span class = "btn btn-success btn-md pull-right" id= "add_fare">Add Fare</span>
                  </div>



                  </div>

            

                  <div class = "well" style = "padding:10px;" id = "travelPanel">
                  </div>
                  <button type = "submit" class = "btn btn-success btn-md pull-right">Save </button>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

              </form>
                  </div>
                </div>
                 
              </div>
              
            </div>
          
          
        </div>
      </div>
    </div>
    

<script>
 var myCounter = 1;

 $('#add_fare').click(function(){
    $('.myTemplate2')
   .clone()
   .removeClass("myTemplate2")
   .addClass("additionalDate")
   .show()
   .appendTo('#travelPanel');
   
  myCounter++;
     
  $(".datepicker6").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 

  $(".datepicker5").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 


});
$(document).on('click','#editbtn',function(e){
 

var purpose = $('#or').val();
$('#ro_txt').val(purpose);
if(purpose == '' || purpose == null)
{
  
  alert('Required Field:All fields with * are required!.');
$('#editModal').modal().hide();

}else{

}
});


  $('.receipt').on('change', function() { 
      $('.receipt').not(this).prop('checked', false);  
  });
  // checkbox validation
  $(document).ready(function(){
    $('#datepicker4').val($('#travel_date').val());
        $('#wor').click(function(){
            if($(this).prop("checked") == true){
              
        $("#wor_txt").prop('disabled',true);
        $("#wor_txt").val('');

            }
            else if($(this).prop("checked") == false){
              $("#wor_txt").prop('disabled',false);
            }
        });
        $('#wa').click(function(){
            if($(this).prop("checked") == true){
        $("#wor_txt").prop('disabled',true);
              
            }
        });
        $('#wr').click(function(){
            if($(this).prop("checked") == true){
        $("#wor_txt").prop('disabled',false);
              
            }
        });
    });


    
      enable_cb1();
      enable_cb2();
  $("#cb1").click(enable_cb1);
  $("#wa").click(enable_cb2);
  function enable_cb1() {
    if (this.checked) {
      if($('.checkboxgroup').val() == 'breakfast')
      {
        $('#breakfast').not(this).prop('checked', true);  
        $('#lunch').not(this).prop('checked', true);  
        $('#dinner').not(this).prop('checked', true);  
      }
      $("#breakfast").removeAttr("disabled");
      $("#lunch").removeAttr("disabled");
      $("#dinner").removeAttr("disabled");
    } else {

      $('#breakfast').not(this).prop('checked', false);  
      $('#lunch').not(this).prop('checked', false);  
      $('#dinner').not(this).prop('checked', false);  

      $("#breakfast").attr("disabled", true);
      $("#lunch").attr("disabled", true);
      $("#dinner").attr("disabled", true);
      
    }
  }
  function enable_cb2()
  {
    if (this.checked) {
      if($('.receipt').val() == 'With Receipt')
      {
        $('#wr').not(this).prop('checked', true);  
        $('#wor').not(this).prop('checked', true);  
      }
      $("#wr").removeAttr("disabled");
      $("#wor").removeAttr("disabled");
    }else{
      $('#wr').not(this).prop('checked', false);  
      $('#wor').not(this).prop('checked', false); 
      
      $("#wr").attr("disabled", true);
      $("#wor").attr("disabled", true);
    }

  }
  function disabledDIV()
  {
   var distance =  $('#distance').val();
   distance = distance.replace('km', '');
   console.log($('#distance').val());
      if(distance > 50)
   {
   

   }else{


    $("#breakfast").attr("disabled", true);
      $("#lunch").attr("disabled", true);
      $("#dinner").attr("disabled", true);
      $("#cb1").attr("disabled", true);
      $("#wa").attr("disabled", true);
      $('.perdiem').addClass('border-disabled');

   }

  }
  disabledDIV();

</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCivQZ8zHOKTj3mi7L7pzmebaWY0FF_yr0"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
    var searchInput = 'search_input';
    var searchInput2 = 'search_input2';

    $(document).ready(function () {
        var autocomplete;
        var autocomplete2;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
            /*componentRestrictions: {
                country: "USA"
            }*/
        });

        autocomplete2 = new google.maps.places.Autocomplete((document.getElementById(searchInput2)), {
            types: ['geocode'],
            /*componentRestrictions: {
                country: "USA"
            }*/
        });
        
        
    });  
    </script>

