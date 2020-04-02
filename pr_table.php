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
             
              <th>PR NO</th>
              <th>PR DATE</th>
              <th>OFFICE</th>
              <th width="200">TYPE</th>
              <th width="300">PURPOSE</th>
              <th>TARGET DATE</th>
              <th width="">ACTION</th>
            </tr>
          </thead>
          <?php
          $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $view_query = mysqli_query($conn, "SELECT * FROM pr where pmo='FAD' order by id desc");
          while ($row = mysqli_fetch_assoc($view_query)) {
            $getID = $row["id"]; 
            $id = $row["id"];
            $pr_no = $row["pr_no"];  
            $pmo = $row["pmo"];
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
                   <a href='ViewRFQdetails.php?id=<?php echo $getID; ?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 
                   <a  href='ViewPRv.php?id=<?php echo $id; ?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a>
                 </td>
               </tr>
             <?php } ?>
           </table>
         </div>
       </div>
     </div>
   </div>


