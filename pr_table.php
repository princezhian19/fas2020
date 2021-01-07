<?php session_start();
if(!isset($_SESSION['username'])){
  header('location:index.php');
}else{
  error_reporting(0);
  ini_set('display_errors', 0);
  $username = $_SESSION['username'];
  $division = $_SESSION['division'];
}


if (isset($_POST['submit'])) {
  $reason = $_POST['reason'];
  $idC = $_POST['idC'];

  $update = mysqli_query($conn,"UPDATE pr SET canceled = '$reason', canceled_date = now(),username='$username' WHERE id = $idC ");
  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('PR Successfuly Canceled!');
      window.location.href = 'ViewPR1.php';
      </SCRIPT>");
     }

  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body"> 
          <h1 align="">Purchase Request</h1>
          <br>
          <li class="btn btn-success"><a href="CreatePR.php" style="color:white;text-decoration: none;">Create</a></li>
          <br>
          <br>
          <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">

                <th width="150">PR NO</th>
                <th width="150">PR DATE</th>
                <th>OFFICE</th>
                <th width="150">TYPE</th>
                <th width="300">PURPOSE</th>
                <th width="150">TARGET DATE</th>
                <th width="150">SUBMITTED DATE</th>
                <th width="150">RECEIVED DATE</th>
                <th width="350">ACTION</th>
              </tr>
            </thead>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <?php

            $user_id = ""; 

            $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



            $username = $_SESSION['username'];


               // echo "SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'";
            $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
            $rowdiv = mysqli_fetch_array($select_user);
            $DIVISION_C = $rowdiv['DIVISION_C'];
            if ($DIVISION_C == '10' || $DIVISION_C == '11' || $DIVISION_C == '12' || $DIVISION_C == '13' || $DIVISION_C == '14' || $DIVISION_C == '15' || $DIVISION_C == '16' ) {

              $user_id = 'FAD';


            }else if($DIVISION_C == '3' || $DIVISION_C == '5'){

              $user_id = 'ORD';

            }else if($DIVISION_C == '17'){

              $user_id = 'LGCDD';

            }
            else if($DIVISION_C == '9'){

              $user_id = 'LGMED-PDMU';

            }
            else if($DIVISION_C == '7'){

              $user_id = 'LGCDD-MBTRG';

            }
            else if($DIVISION_C == '18'){

              $user_id = 'LGMED';

            }

            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query11 = mysqli_query($conn, "SELECT * FROM pr order by id desc ");
            // $view_query11 = mysqli_query($conn, "SELECT * FROM pr where pmo = '$user_id' order by id desc ");
            while ($row = mysqli_fetch_assoc($view_query11)) {
              $getID = $row["id"];
              $id = $row["id"];
              $pr_no = $row["pr_no"];  
              $pmo = $row["pmo"];
              $canceled = $row["canceled"];
              $received_by1 = $row["received_by"];
              $submitted_by1 = $row["submitted_by"];
              $submitted_date = $row["submitted_date"];
              $submitted_date1 = date('F d, Y', strtotime($submitted_date));

              $received_date = $row["received_date"];
              $received_date1 = date('F d, Y', strtotime($received_date));

              $purpose = $row["purpose"];
              $pr_date = $row["pr_date"];
              $pr_date11 = date('F d, Y', strtotime($pr_date));

              $type = $row["type"];

              $target_date = $row["target_date"];
              $target_date11 = date('F d, Y', strtotime($target_date));
              ?>
              <tr>
                <?php if ($pr_no == ''): ?>
                  <td><a href="set_pr.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs">Set Pr</a></td>
                  <?php else: ?>
                    <td><?php echo $pr_no;?></td>
                  <?php endif ?>
                  <?php if ($pr_date == "0000-00-00"): ?>
                    <td></td>
                    <?php else:?>
                      <td><?php echo $pr_date11;?></td>
                    <?php endif?>



                    <td><?php echo $pmo;?></td>
                    <?php if ($type == "1"): ?>
                      <td><?php echo "Catering Services";?></td>
                    <?php endif?>
                    <?php if ($type == "2"): ?>
                      <td><?php echo "Meals, Venue and Accommodation";?></td>
                    <?php endif?>
                    <?php if ($type == "3"): ?>
                      <td><?php echo "Repair and Maintenance";?></td>
                    <?php endif?>
                    <?php if ($type == "4"): ?>
                      <td><?php echo "Supplies, Materials and Devices";?></td>
                    <?php endif?>
                    <?php if ($type == "5"): ?>
                      <td><?php echo "Other Services";?></td>
                    <?php endif?>
                    <?php if ($type == "6"): ?>
                      <td><?php echo "Reimbursement and Petty Cash";?></td>
                    <?php endif?>
                    <td><?php echo $purpose;?></td>
                    <td><?php echo $target_date11;?></td>
                    <td>
                      <?php if ($submitted_date == NULL): ?>
                        <a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to Submit this PR?');" href='submit_pr.php?id=<?php echo $id; ?>&username=<?php echo $username;?>'title="Submit"><i class="fa fa-fw fa-send-o"></i>Submit</a>
                        <?php else: ?>
                          <?php echo $submitted_date1?><br>
                          <strong><i><?php echo $submitted_by1?></i></strong>

                        <?php endif ?>
                      </td>

                      <?php if ($received_date == NULL): ?>
                        <td></td>
                        <?php else: ?>
                          <td><?php echo $received_date1?><br>
                          <strong><i><?php echo $received_by1?></i></strong>
                          </td>
                        <?php endif ?>

                        <td>
                          <?php if ($submitted_date == NULL): ?>

                            <a  href='ViewPRv.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> |
                            <a href='ViewRFQdetails.php?id=<?php echo $getID;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a>  
                            <?php if ($canceled == NULL): ?>
                             | <a data-toggle="modal"  data-target="#modal-info_<?php echo $row['id']; ?>"   class = "btn btn-warning btn-xs"><i class="fa fa-fw fa-close"></i>Cancel</a>  
                             <?php else: ?>
                               | <font style="color:red;">Canceled </font><?php echo $canceled;?>

                             <?php endif ?>
                             <?php else: ?>
                              <a  href='ViewPRv.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> 
                              <?php if ($canceled == NULL): ?>
                               | <a data-toggle="modal"  data-target="#modal-info_<?php echo $row['id']; ?>"   class = "btn btn-warning btn-xs"><i class="fa fa-fw fa-close"></i>Cancel</a>  
                               <?php else: ?>
                                 | <font style="color:red;">Canceled </font><?php echo $canceled;?>

                               <?php endif ?> 
                             <?php endif ?>

                           </td>
                  <!-- <td>
                   <a href='ViewRFQdetails.php?id=<?php echo $getID;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 
                   <a href='ViewPRv.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a>
                 </td> -->
               </tr>
               <div class="modal modal-default fade" id="modal-info_<?php echo $row['id']; ?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Cancel Purchase Request</h4>
                      </div>
                      <div class="modal-body">
                        <form method="POST" >
                         <label style="padding-right: 20px;">Reason <!-- <font style="color:red;">*</font></font>&nbsp&nbsp<i><font style="color:red;">should not exceed 50 characters</i> </font>--></label><input  class="form-control" type="text" name="reason"><br>
                         <input type="text" name="idC" hidden  value="<?php echo $getID?>">
                       </div>
                       <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-warning" name="submit">Cancel</button>
                      </div>
                    </div>
                  </form>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            <?php } ?>
          </table>
        </div>
      </div>

    </div>

  </div>


