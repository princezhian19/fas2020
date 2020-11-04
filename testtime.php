<?PHP
session_start();
$username = $_SESSION['complete_name2'];

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
            $query1 = "SELECT tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
            tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
            INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
            WHERE tbltravel_claim_info.`RO` = '".$id."' and tbltravel_claim_info.`DATE` = '".$date."' ORDER BY DATE";
            $result1 = mysqli_query($conn, $query1);
            $saved = array();
            if(mysqli_num_rows($result1) > 0)
            {
                while($row1 = mysqli_fetch_array($result1))
                {
                    $saved[] = $row1["DATE"]; // you are missing []
                    $receipt = $row1['RECEIPT'];
                    $perdiem = $row1['PERDIEM'];
                    if($receipt == '' || $receipt == null)
                    {
                      $receipt = 0;
                    }
                    $tot = $receipt + $perdiem;

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
                        <td><input readonly type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$tot);?>"/></td>
                        <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
                        <td><input readonly type = "text" class = "form-control" style = "width:100%%;" value = "<?php echo sprintf("%.2f",$row1['TOTAL_AMOUNT']);?>"/></td>
                        <?php 
                          if ( $_SESSION['complete_name2']  == $_POST['uname'] || $username == 'nrbartolabac' || $username == 'itdummy1' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') 
                          {


                            ?>
                            <td style = "width:9%;">
                            <!-- <span class = "btn btn-sm btn-primary" style = "width:100%;"><i class = "fa fa-edit"></i>&nbsp;Edit</span> -->
                            <span class = "btn btn-sm btn-danger"  style = "width:100%;" id = "btnids<?php echo $row1['dID']; ?>" data-id = "<?php echo $row1['ID'];?>" value = "<?php echo $row1['ID'];?>"><i class = "fa fa-trash"></i>&nbsp;Delete</span>
                            </td>
                            <?php

                          }else
                          {
                            ?>


                            <?php
                          }
                        ?>
                    </tr>
        
                    <?php
                      $row1['DATE'] = '';
                    ?>
                    <script>
                      $(document).ready(function(){
                          $( "#btnids<?php echo $row1['dID'];?>" ).click(function() {
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
                                          "action": 'deleteTravelOrder',
                                          "id": <?php echo $row1['dID'];?>,
                                      },
                                      success:function(data)
                                      {
                                  
                                        setTimeout(function () {
                                            window.location = "CreateTravelClaim.php?username=<?php echo $_SESSION['username'];?>&division=<?php echo $_SESSION['division'];?>";
                                            }, 1000);

                                        
                                      }
                                      });
                                  }
                                  );
                          });
                      });
                    </script>
      <?php
                }
            }
        }
    }
}
function edit($id)
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
            $query1 = "SELECT tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `OTHERS`, `TOTAL_AMOUNT`,
            tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
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
                              <td style = "width:9.8%;"><input  id = "travel_date" type = "text" class = "form-control" style = "width:100%;" value = "<?php echo date('F d, Y', strtotime($row1['DATE']));?>"/></td>
                          <?php
                      }   
                      
                  }else{
                  ?>
                  
                    <tr style =" display:table; table-layout:fixed; width:100%;">
                        <?php }?>
                        <td ><textarea  name ="place[]" cols = 13 style = "resize:none;background:#ECEFF1;border:1px solid #CFD8DC;"><?php echo $row1['PLACE'];?></textarea></td>
                        <td><input  type = "text" name = "arrival[]" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['ARRIVAL']));?>"/></td>
                        <td><input  type = "text" name = "departure[]" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['DEPARTURE']));?>"/></td>
                        <td><input  type = "text" name = "mot[]" class = "form-control" value = "<?php echo $row1['MOT'];?>"/></td>
                        <td><input  type = "text" name = "transportation[]" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['TRANSPORTATION']);?>"/></td>
                        <td><input  type = "text" class = "form-control" value = "<?php echo sprintf("%.2f",$row1['PERDIEM']);?>"/></td>
                        <td><input  type = "text" name = "others[]" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
                        <td><input  type = "text" class = "form-control" style = "width:100%%;" value = "<?php echo sprintf("%.2f",$row1['TOTAL_AMOUNT']);?>"/></td>
                       
                    </tr>
        
                    <?php
                      $row1['DATE'] = '';
                    ?>
                    <script>
                      $(document).ready(function(){
                          $( "#btnids<?php echo $row1['dID'];?>" ).click(function() {
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
                                          "action": 'deleteTravelOrder',
                                          "id": <?php echo $row1['dID'];?>,
                                      },
                                      success:function(data)
                                      {
                                  
                                        setTimeout(function () {
                                            window.location = "CreateTravelClaim.php?username=<?php echo $_SESSION['username'];?>&division=<?php echo $_SESSION['division'];?>";
                                            }, 1000);

                                        
                                      }
                                      });
                                  }
                                  );
                          });
                      });
                    </script>
      <?php
                }
            }
        }
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
          
    


switch ($_POST['action']) {
  case 'view':
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
                <th class = "table-header" style = "text-align:center;width:11%;" rowspan = 2>Date</th>
                <th class = "table-header" style = "text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                <th class = "table-header" style = "text-align:center;" colspan = 2>Time</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Means of Transportation</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Transportation</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Per Diem</th>
                <th class = "table-header" style = "text-align:center;" rowspan = 2>Others</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Total Amount</th>
                <?php 
                  $query1 = "SELECT * FROM `tbltravel_claim_info2`
                  INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                  INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                  WHERE  `RO_TO_OB`= '".$_POST['ro']."'
                  GROUP by tbltravel_claim_info.RO ";
                  $result1 = mysqli_query($conn, $query1);
                  if(mysqli_num_rows($result1) > 0)    
                  {
                      $name1 = '';
                      while($row1 = mysqli_fetch_array($result1))
                      {
                        $name1 = $row1['NAME'];
                        echo $name1;
                        if ($username == $_POST['uname'] || $username == 'charlesodi' || $username == 'itdummy1' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') 
                          {
                          

                            ?>
                            <th class = "table-header"  style = "text-align:center;" rowspan =3>Action</th>
                            <?php
                          }
                      }
                  }
                ?>
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
        ?>
        <tr>    
        </tr>
        <tr>
        </tr>
        <?php
      }

  
  break;

  case 'edit':
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
                <th class = "table-header" style = "text-align:center;width:11%;" rowspan = 2>Date</th>
                <th class = "table-header" style = "text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                <th class = "table-header" style = "text-align:center;" colspan = 2>Time</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Means of Transportation</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Transportation</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Per Diem</th>
                <th class = "table-header" style = "text-align:center;" rowspan = 2>Others</th>
                <th class = "table-header"  style = "text-align:center;" rowspan = 2>Total Amount</th>
                <?php 
                  $query1 = "SELECT * FROM `tbltravel_claim_info2`
                  INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                  INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                  WHERE  `RO_TO_OB`= '".$_POST['ro']."'
                  GROUP by tbltravel_claim_info.RO ";
                  $result1 = mysqli_query($conn, $query1);
                  if(mysqli_num_rows($result1) > 0)    
                  {
                      $name1 = '';
                    // Table header action
                  }
                ?>
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
            edit($row['ID']);
          }
          ?>
        </tbody>

          <?php
      }else{
        ?>
        <tr>    
        </tr>
        <tr>
        </tr>
        <?php
      }
  break;
  
  default:
    # code...
    break;
}

?>