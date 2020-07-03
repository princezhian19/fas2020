<div class="box">
  <div class="box-body">
        <div class=""> 
             <div class="table-responsive">
            <h1 align="">&nbspProperty Plant And Equipment</h1>
            <div class="box-header">
            </div>
            <br>
            <li class="btn btn-success"><a href="CreateRPCPPE.php" style="color:white;text-decoration: none;">Create</a></li>
            <form action="export_rpcppe.php">
            <div style="padding-left: 300px;">
              <div class="col-md-3">
              <div class="form-group" >
                <label>Date From</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input type="date" class="form-control " name="date_from" id="datepicker1" >
                  </div>
                </div>
               
                </div>
              <div class="col-md-3">
                 <div class="form-group" >
                <label>Date To</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input type="date" class="form-control " name="date_to" id="datepicker1" >
                  </div>
                </div>
                </div>
              <div class="col-md-3">
            <br>
                <button class="btn btn-success"  name="search">Export</button>
                </div>
                </div>
            <br>
            <br>
            </form>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th>ARTICLE</th>
                        <th>DESCRIPTION</th>
                        <th>OFFICE</th>
                        <th>PROPERTY NO.</th>
                        <th>DATE ACQUIRED</th>
                        <th>UNIT VALUE</th>
                        <th>UNIT OF MEASURE</th>
                        <th>PROPERTY CARD</th>
                        <th>PHYSICAL COUNT</th>
                        <th>SHORTAGE(QUANTITY)</th>
                        <th>SHORTAGE(VALUE)</th>
                        <th>REMARKS</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM rpcppe ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $article = $row["article"];  
                    $description = $row["description"];
                    $property_number = $row["property_number"];
                    $date_acquired = $row["date_acquired"];
                    $unit = $row["unit"];
                    $amount = $row["amount"];
                    $property_card = $row["property_card"];
                    $physical_count = $row["physical_count"];
                    $shortage_Q = $row["shortage_Q"];
                    $shortage_V = $row["shortage_V"];
                    $remarks = $row["remarks"];
                    $office = $row["office"];
                    ?>
                    <tr>
                        <td><?php echo $article;?></td>
                        <td><?php echo $description;?></td>
                        <td><?php echo $office;?></td>
                        <td><?php echo $property_number;?></td>
                        <td><?php echo $date_acquired;?></td>
                        <td><?php echo $unit;?></td>
                        <td><?php echo $amount;?></td>
                        <td><?php echo $property_card;?></td>
                        <td><?php echo $physical_count;?></td>
                        <td><?php echo $shortage_Q;?></td>
                        <td><?php echo $shortage_V;?></td>
                        <td><?php echo $remarks;?></td>
                        <td>
                        <a  href='ViewPPE.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i  class='fa'>&#xf06e;</i> Edit</a>
                        </td>
                        <td>
                     <a  onclick="return confirm('Are you sure you want to Delete this item?');" class="btn btn-danger btn-xs" href='delete_rpcppe.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i  class='fa fa-trash-o' ></i> Delete</a>
                        </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</div>
</div>
