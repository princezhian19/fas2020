<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Directory of DILG-IV-A Employees</h1>
        <br>
        <li class="btn btn-success"><a href="CreateEmployee.php" style="color:white;text-decoration: none;">Add</a></li>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>FIRST NAME</th>
                <th>MIDDLE NAME</th>
                <th>LAST NAME</th>
                <th>OFFIE</th>
                <th>POSITION</th>
                <th>DESIGNATION</th>
                <th>MOBILE NO</th>
                <th>PERSONAL EMAIL ADDRESS</th>
                <th>OFFICE CONTACT NO</th>
                <th>OFFICE EMAIL ADDRESS</th>
                <th>BIRTHDAY</th>
                <th>ACTION</th>
                <th></th>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT tblemployee.EMP_N,tblemployee.FIRST_M,tblemployee.MIDDLE_M,tblemployee.LAST_M,tblemployee.BIRTH_D,tblemployee.EMAIL,tblemployee.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployee.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployee.DESIGNATION");

            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["EMP_N"];
              $FIRST_M = $row["FIRST_M"];  
              $MIDDLE_M = $row["MIDDLE_M"];  
              $LAST_M = $row["LAST_M"];
              $DIVISION_M = $row["DIVISION_M"];
              $POSITION_M = $row["POSITION_M"];
              $DESIGNATION_M = $row["DESIGNATION_M"];
              $MOBILEPHONE = $row["MOBILEPHONE"];
              $EMAIL = $row["EMAIL"];
              $BIRTH_D = $row["BIRTH_D"];
              $BIRTH = date('F d',strtotime($BIRTH_D));
              ?>
              <tr>
                <td width="1000"><?php echo $FIRST_M;?></td>
                <td width="1000"><?php echo $MIDDLE_M;?></td>
                <td width="1000"><?php echo $LAST_M;?></td>
                <td width="2000"><?php echo $DIVISION_M;?></td>
                <td width="150"><?php echo $POSITION_M;?></td>
                <td width="1000"><?php echo $DESIGNATION_M;?></td>
                <td width="1000"><?php echo $MOBILEPHONE;?></td>
                <td width="1000"><?php echo $EMAIL;?></td>
                <td width="1000"><?php echo $MOBILEPHONE;?></td>
                <td width="1000"><?php echo $EMAIL;?></td>
                <td width="1000"><?php echo $BIRTH;?></td>

                <?php if ($username == 'magonzales' || $username == 'hpsolis' || $username == 'jbaco' || $username == 'gpvillanueva' || $username == 'rmsaturno'  ): ?>
                <td width="150">
                 <a href='UpdateEmployee.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a>
               </td>
               <td><a onclick="return confirm('Are you sure you want to Delete this Account now?');" href='delete_account2.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
               <?php else: ?>
                <td></td>
                <td></td>
                <?php endif ?>


             </tr>
           <?php } ?>
       </table>
     </div>
   </div>
 </div>
</div>



