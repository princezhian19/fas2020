<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body"> 
        <h3 align="">User Management</h3>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
          <thead>
            <tr style="background-color: white;color:blue;">
              <th width="150">USERNAME</th>
              <th width="150">LAST NAME</th>
              <th width="150">FIRST NAME</th>
              <th width="150">MIDDLE NAME</th>
              <th width="180">ACTION</th>
            </tr>
          </thead>
          <?php
          $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $QUERY = mysqli_query($conn, "SELECT UNAME,EMP_N,LAST_M,MIDDLE_M,FIRST_M FROM tblemployee WHERE ACTIVATED = 'YES' AND BLOCK ='N' ORDER BY LAST_M ASC ");
          while ($row = mysqli_fetch_assoc($QUERY)) {
            $id = $row["EMP_N"];
            $UNAME = $row["UNAME"];
            $LAST_M = $row["LAST_M"];
            $FIRST_M = $row["FIRST_M"];  
            $MIDDLE_M = $row["MIDDLE_M"];
            ?>
            <tr>
              <td><?php echo $UNAME;?></td>
              <td><?php echo $LAST_M;?></td>
              <td><?php echo $FIRST_M;?></td>
              <td><?php echo $MIDDLE_M;?></td>
              <td>
                <a href='UpdateAccount.php?id=<?php echo $id;?>&username=<?php echo $username;?>' title="edit" class = "btn btn-primary btn-xs" ><i class='fa fa-fw fa-edit'></i> Edit</a>  | <a onclick="return confirm('Are you sure you want to Block this Account now?');" href='block.php?id=<?php echo $id;?>&username=<?php echo $username;?>' title="block" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-close'></i> Block</a>  
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>


