<div class="row">
        <div class="col-md-12">
          <div class="box">

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h1>Dashboard</h1>
                  <strong>Monitoring for PRs</strong>
                  <p></p>
                  <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th>PR No.</th>
                        <th>Has RFQ</th>
                        <th>Has Supplier</th>
                        <th>Has Abstract</th>
                        <th>Has PO</th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","fascalab_2020");
                $view_query = mysqli_query($conn,"SELECT * FROM pr ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];
                   
                    ?>
                    <tr>
                        <td><?php echo $pr_no;?></td>
                        <td><?php 

                        $RFQ = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                        $rowID = mysqli_fetch_array($RFQ);
                        $rfq_id = $rowID['id'];
                        if (mysqli_num_rows($RFQ)>0) {
                          echo "<p style='color:green'><b>Has RFQ</b></p>";
                        }else{ 
                          echo "NO RFQ";
                          }
                        ?></td>
                        <td><?php 
                        $select_rfqID = mysqli_query($conn,"SELECT * FROM rfq_items WHERE rfq_id = '$rfq_id'  ");
                        $rowItems = mysqli_fetch_array($select_rfqID);
                        $itemsID = $rowItems['id'];
                        $selecta = mysqli_query($conn,"SELECT * FROM supplier_quote WHERE rfq_item_id = '$itemsID' ");
                        if (mysqli_num_rows($selecta) > 0) {
                          echo "<p style='color:green'><b>Has Supplier</b></p>";
                        }
                        else{
                        echo "NO Supplier";
                        }
                        ?></td>
                        <td><?php 
                        $selectABS = mysqli_query($conn,"SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfq_id'");
                        if (mysqli_num_rows($selectABS) > 0 ) {
                          echo "<p style='color:green'><b>Has Abstract</b></p>";
                        }else{
                        echo "NO Abstract";
                        }
                        ?></td>
                        <td><?php 
                        $selectPO = mysqli_query($conn,"SELECT * FROM selected_quote WHERE rfq_id = '$rfq_id'");
                        if (mysqli_num_rows($selectPO) > 0 ) {
                          echo "<p style='color:green'><b>Has PO</b></p>";

                        }else{
                        echo "NO PO";
                         } 
                         ?></td>
                      <!--   <td >
                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='export_ics.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                     </td>
                     <td >
                        &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_ics.php?id=<?php echo $id; ?>  ' title="Delete"> 
                            <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>
                        </td> -->
                    </tr>
                <?php } ?>
            </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>