<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Request For Quotation</h1>    

        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" >
            <thead>
                <tr style="background-color: white;color:blue;">
                    <th width="100">PR NO</th>
                    <th width="100">PR DATE</th>
                    <th width="100">OFFICE</th>
                    <th width="100">TYPE</th>
                    <th width="200">PURPOSE</th>
                    <th width="100">TARGET DATE</th>
                    <th width="100">RECEIVE PR</th>
                    <th width="100">RFQ NO</th>
                    <th width="100">RFQ DATE</th>
                    <th width="100">AWARDING</th>
                    <th width="100">PURCHASE ORDER</th>
                    
                </tr>
            </thead>
            <?php
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT a.submitted_date,a.received_date,a.id,a.pr_no,a.pmo,a.purpose,a.pr_date,a.type,a.target_date,a.stat,b.rfq_no,b.rfq_date FROM pr as a left join rfq as b ON a.pr_no=b.pr_no Order by a.id DESC");
            while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];
                $pr_no = $row["pr_no"];  
                $pmo = $row["pmo"];
                $submitted_date = $row["submitted_date"];
                $received_date1 = $row["received_date"];
                $received_date = date('F d, Y', strtotime($received_date1));
                $purpose = $row["purpose"];
                $pr_date = $row["pr_date"];
                $pr_date1 = date('F d, Y', strtotime($pr_date));
                $type = $row["type"];
                $target_date = $row["target_date"];
                $target_date1 = date('F d, Y', strtotime($target_date));
                $stat = $row["stat"];
                $rfq_no =  $row["rfq_no"];
                $rfq_date =  $row["rfq_date"];
                $rfq_date1 = date('F d, Y', strtotime($rfq_date));

                /* getting values for flags */
                $sq = $row["sq"];
                $aoq = $row["aoq"];
                $po = $row["po"];
                ?>
                <tr>
                    <td><a href="ViewPRv.php?id=<?php echo $id?>&username=<?php echo $_SESSION['username']?>"><?php echo $pr_no;?></a></td>
                    <td><?php echo $pr_date1;?></td>
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
                  <td><?php echo $target_date1;?></td>

                  <?php if ($submitted_date == NULL): ?>
                      <td>DRAFT</td>
                      <?php else: ?>
                        <?php if ($submitted_date != NULL AND $received_date1 == NULL): ?>
                            <td>
                              <a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to Received this item?');" href='received_pr.php?id=<?php echo $id; ?>  ' title="Submit"> 
                              Receive </a>    
                          </td>
                          <?php else: ?>
                              <td><?php echo $received_date?></td>
                          <?php endif ?>
                      <?php endif ?>
                      <td>
                        <!-- <a href="ViewPRv.php?id=<?php echo $id ?>"><?php echo $rfq_no;?></a> -->

                        <!-- RFQ -->
                        <?php if ($stat == "1"): ?>
                         <?php
                         $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                         $rowrfq = mysqli_fetch_array($view_queryrfq);
                         $rfqid = $rowrfq['id'];
                         ?>
                         <a class="" href='RFQdetails.php?id=<?php echo $rfqid; ?>'> 
                            <?php echo $rfq_no; ?>
                        </a>
                    <?php endif?>
                    <?php if ($stat == "0"): ?>
                        <a class="btn btn-success btn-xs" href='CreateRFQ.php?prID=<?php echo $id;?>' >Create</a>
                    <?php endif?>
                </td>
                <?php if ($rfq_date == ""): ?>
                  <td></td>
              <?php endif?>  
              <?php if ($rfq_date != ""): ?>
                  <td><?php echo $rfq_date1;?></td>
              <?php endif?>
              <td>
                <!--End RFQ -->
                <!-- Supplier Qoute -->
                <?php if ($stat == "1"): ?>
                    <?php
                    $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                    $rowrfq = mysqli_fetch_array($view_queryrfq);
                    $rfqid = $rowrfq['id'];
                    $query_2 = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfqid ");
                    $row_2 = mysqli_fetch_array($query_2);
                    $rfq_items_id = $row_2['id'];
                    $selectABS = mysqli_query($conn,"SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfqid' and abstract_no is not NULL");
                    $rowABS = mysqli_fetch_array($selectABS);
                    $supplier_id = $rowABS['supplier_id'];
                    $abstract_id = $rowABS['id'];
                    $rowaoq_id = $rowABS['abstract_no'];
                    $query_aoq = mysqli_query($conn,"SELECT * FROM  aoq_data WHERE id = '$rowaoq_id'"); 
                    $aoq = mysqli_fetch_array($query_aoq);
                    $aoq_no =  $aoq['aoq_no'];
                    $select_sup = mysqli_query($conn,"SELECT supplier_title from supplier WHERE id = '$supplier_id'");
                    $rowSup = mysqli_fetch_array($select_sup);
                    $win_supplier = $rowSup['supplier_title'];
                    $query_3 = mysqli_query($conn,"SELECT * FROM supplier_quote WHERE rfq_item_id = '$rfq_items_id'");
                    ?>
                    <?php if (mysqli_num_rows($query_3) == 0): ?>
                       <a class="btn btn-success btn-xs" href='CreateAoq.php?rfq_id=<?php echo $rfqid; ?>&rfq_items=<?php echo $rfq_items_id; ?>' title="View"> Award</a>
                       <?php else : ?>
                        <?php if (mysqli_num_rows($selectABS) > 0): ?>
                            <a  href='UpdateAoq.php?rfq_id=<?php echo $rfqid; ?>&supplier_id=<?php echo $supplier_id; ?>&abstract_id=<?php echo $abstract_id; ?>' title="View"><?php echo $win_supplier?> </a>
                            <?php else: ?>
                               <a class="btn btn-success btn-xs" href='CreateAoq.php?rfq_id=<?php echo $rfqid; ?>&rfq_items=<?php echo $rfq_items_id; ?>' title="View"> Award</a>
                           <?php endif ?>
                       <?php endif?>
                   <?php endif?>
                   <?php if ($stat == "0"): ?>
                   <?php endif?> 
               </td>
               <!-- End Supplier Qoute -->
               <!-- Abstract of quote -->
               <!-- End Abstract of quote -->
               <!-- Purchase Order -->
               <td>
                <?php if ($stat == "1"): ?>
                    <?php
                    $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                    $rowrfq = mysqli_fetch_array($view_queryrfq);
                    $rfqid = $rowrfq['id'];
                    $query_3 = mysqli_query($conn,"SELECT * FROM  selected_quote WHERE rfq_id = '$rfqid'");
                    $rowpoid = mysqli_fetch_array($query_3);
                    $rowpo_id = $rowpoid['po_id'];
                    ?>
                    <?php if (mysqli_num_rows($query_3) > 0): ?>
                      <?php if ($rowpo_id==NULL): ?>
                        <?php if (mysqli_num_rows($selectABS) > 0): ?>
                         <a class="btn btn-success btn-xs"  href='CreatePO.php?rfq_id=<?php echo $rfqid; ?>&supplier_id=<?php echo $supplier_id; ?>' title="View"> Create </a>
                         <?php else : ?>
                          <a class="" href='ViewPO.php?rfq_id=<?php echo $rfqid; ?>&supplier_id=<?php echo $supplier_id; ?>' title="View"> <?php echo $po_no; ?></a>
                      <?php endif?> 
                         <?php else : ?>
                          <?php
                          $query_4 = mysqli_query($conn,"SELECT * FROM  po WHERE id = '$rowpo_id'");
                          $po_id = mysqli_fetch_array($query_4);
                          $po_idget = $po_id['id'];
                          $po_no = $po_id['po_no'];
                          ?>
                          <a class="" href='ViewPO.php?rfq_id=<?php echo $rfqid; ?>&supplier_id=<?php echo $supplier_id; ?>' title="View"> <?php echo $po_no; ?></a>
                      <?php endif?> 
                  <?php endif?> 
              <?php endif?>
              <?php if ($stat == "0"): ?>
              <?php endif?>
          </td>
          <!--End Purchase Order -->
      </tr>
  <?php } ?>
</table>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
