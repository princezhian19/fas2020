  <div class="box box-default">
    <div class="box-header with-border">
     <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <br>
          <h1 align="">ORS and BURS</h1>
          <div class="box-header with-border">
          </div>
          <br>
          <li class="btn btn-success"><a href="CreateBURS.php" style="color:white;text-decoration: none;">Create</a></li>
          <br>
          <br>
          <table id="example1" class="table table-bordered-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>PAYEE</th>
                <th>PARTICULAR</th>
                <th>AMOUNT</th>
                <th>OFFICE</th>
                <th>PO NO.</th>
                <th>STATUS</th>
                <th width="150">ACTION</th>
              </tr>
            </thead>
            <?php
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT burs.dv_create,burs.status,burs.id,pmo.pmo_title,burs.po_no,burs.supplier,burs.address,burs.purpose,burs.amount FROM burs LEFT JOIN pmo on pmo.id = burs.office order by burs.id desc ");
            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $office = $row["pmo_title"];
              $po_no = $row["po_no"];  
              $supplier = $row["supplier"];
              $address = $row["address"];
              $purpose = $row["purpose"];
              $amount1 = $row["amount"];
              $amount = number_format($amount1,2);
              $status = $row["status"];
              $date_received = $row["date_received"];
              $dv = $row["dv_create"];
              $format_amount = number_format($amount,2);
              ?>
              <tr>
                <td><?php echo $supplier;?></td>
                <td><?php echo $purpose;?></td>
                <td><?php echo $amount;?></td>
                <td><?php echo $office;?></td>
                <td><?php echo $po_no;?></td>
                <td><?php if ($status == 0) {
                  echo "Needs to Submit";
                }elseif ($status == 1) {
                  echo "Submitted";
                }elseif ($status == 2 || $status == 4) {
                  echo "Received";
                }elseif ($status == 3) {
                  echo '<b style="color:red">Returned</b>';
                }elseif ($status == 6) {
                  echo 'Released';
                }
                else{
                  echo "Approved";
                }
                ?>
              </td>
              <td>
                <!-- if dv_create status is 0 and status is 2(meaning na recieved na ni budget) execute this :: 0 means wala pa sya sa DV-->
                <?php if ($dv == 0 AND $status == 2): ?>
                  <!-- if status is 1 to 5 change the text from edit to view :: 1 to 5 means na submit na d na pdeng i edit -->
                  <?php if ($status == 1  || $status == 2  || $status == 3  || $status == 4  || $status == 5 ): ?>
                    <a class="btn btn-primary btn-xs" href='UpdateBURS.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf06e;</i> View </a> | <a onclick="return confirm('Are you sure you want to Create DV?');"class="btn btn-success btn-xs" href="add_dv.php?id=<?php echo $id;?>&stat=2">Create Dv</a>
                    <?php else: ?>
                      <a class="btn btn-primary btn-xs" href='UpdateBURS.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf044;</i> Edit </a> | <a class="btn btn-success btn-xs" href='submit_burs.php?id=<?php echo $id; ?>&stat=2'>Submit</a>
                    <?php endif ?>
                    <?php else: ?>
                      <!-- if dv_create status is 1 execute this :: 1 means nsa DV na sya-->
                      <!-- if status is 1 to 5 change the text from edit to view :: 1 to 5 means na submit na d na pdeng i edit -->
                      <?php if ($status == 1  || $status == 2  || $status == 6  || $status == 4  || $status == 5 ): ?>
                        <a class="btn btn-primary btn-xs" href='UpdateBURS.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf06e;</i> View </a> 
                        <?php else: ?>
                          <a class="btn btn-primary btn-xs" href='UpdateBURS.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf044;</i> Edit </a> | <a class="btn btn-success btn-xs" href='submit_burs.php?id=<?php echo $id; ?>&stat=2'><i class="fa fa-fw fa-send-o"></i> Submit</a>
                        <?php endif ?>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  


