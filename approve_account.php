<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body"> 
        <h3 align="">Account Approval</h3>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="background-color: white;" >
          <thead >
            <tr style="background-color: white;color:blue;">
              <th width="150">OFFICE</th>
              <th width="150">FIRST NAME</th>
              <th width="150">MIDDLE NAME</th>
              <th width="150">LAST NAME</th>
              <th width="180">ACTION</th>
            </tr>
          </thead>
          <?php
          $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $QUERY = mysqli_query($conn, "SELECT tblpersonneldivision.DIVISION_M,tblemployee.UNAME,tblemployee.EMP_N,tblemployee.LAST_M,tblemployee.MIDDLE_M,tblemployee.FIRST_M FROM tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C WHERE tblemployee.ACTIVATED = 'No' AND tblemployee.BLOCK ='N' ORDER BY tblemployee.EMP_N DESC ");
          while ($row = mysqli_fetch_assoc($QUERY)) {
            $id = $row["EMP_N"];
            $DIVISION_M = $row["DIVISION_M"];
            $UNAME = $row["UNAME"];
            $LAST_M = $row["LAST_M"];
            $FIRST_M = $row["FIRST_M"];  
            $MIDDLE_M = $row["MIDDLE_M"];
            ?>
            <tr>
              <td><?php echo $DIVISION_M;?></td>
              <td><?php echo $FIRST_M;?></td>
              <td><?php echo $MIDDLE_M;?></td>
              <td><?php echo $LAST_M;?></td>
              <td>
                <a onclick="return confirm('Are you sure you want to Activated this Account now?');" href='approve.php?id=<?php echo $id;?>&username=<?php echo $username;?>' title="activate" class = "btn btn-success btn-xs" > <i class='fa fa-fw fa-check-square-o'></i> Approve</a>  
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>


