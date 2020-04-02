  <div class="box box-default">
    <div class="box-header with-border">
     <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <br>
          <h1 align="">&nbsp&nbsp&nbsp&nbspDisbursement Voucher</h1>
          <div class="box-header with-border">
          </div>
          <br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreateDV.php" style="color:white;text-decoration: none;">Create</a></li>
          <br>
          <br>
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
                <th>ACTION</th>
              </tr>
            </thead>
            <?php
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT dv.status,dv.id,pmo.pmo_title,dv.po_no,dv.supplier,dv.address,dv.purpose,dv.amount FROM dv LEFT JOIN pmo on pmo.id = dv.office  order by dv.id desc ");
            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $office = $row["pmo_title"];
              $po_no = $row["po_no"];  
              $supplier = $row["supplier"];
              $address = $row["address"];
              $purpose = $row["purpose"];
              $amount = $row["amount"];
              $status = $row["status"];
              $format_amount = number_format($amount,2);
              ?>
              <tr>
                <td><?php echo $supplier;?></td>
                <td><?php echo $purpose;?></td>
                <td><?php echo $format_amount;?></td>
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
                <?php if ($status == 3 ): ?>
                  <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf044;</i> Edit </a> | <a class="btn btn-success btn-xs" href='submit_dv.php?id=<?php echo $id; ?>&stat=2'>Submit</a>
                  <?php else: ?>
                    <?php if ($status == 1  || $status == 2  || $status == 6  || $status == 4  || $status == 5 ): ?>
                      <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf06e;</i> View </a> 
                      <?php else: ?>
                        <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' ><i class='fa'>&#xf044;</i> Edit </a> | <a class="btn btn-success btn-xs" href='submit_dv.php?id=<?php echo $id; ?>&stat=2'><i class="fa fa-fw fa-send-o"></i> Submit</a>
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

