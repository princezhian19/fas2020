<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Request For Quotation</h1>    

            <br>
            <br>
            <table id="" class="table table-striped table-bordered" >
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th width="100">PR NO</th>
                  <th width="100">PR DATE</th>
                  <th width="100">OFFICE</th>
                  <th width="100">MODE OF PROCUREMENT</th>

                  <th width="100">RFQ NO</th>
                  <th width="100">RFQ DATE</th>
                  <th width="100">ABC</th>

                </tr>
              </thead>
              <?php
              $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
              $view_query = mysqli_query($conn, "SELECT a.submitted_date,a.received_by,a.canceled,a.canceled_date,a.received_date,a.id,a.pr_no,a.pmo,a.purpose,a.pr_date,a.type,a.target_date,a.stat,b.rfq_no,b.rfq_mode_id,mop.mode_of_proc_title,b.rfq_date,b.id as rfqID FROM pr as a left join rfq as b ON a.pr_no=b.pr_no left join mode_of_proc mop on mop.id = b.rfq_mode_id WHERE b.pr_no IS NOT NULL Order by a.id DESC");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $rfqID = $row["rfqID"];
                $id = $row["id"];
                $pr_no = $row["pr_no"];  
                $pmo = $row["pmo"];
                $canceled_date = $row["canceled_date"];
                $received_by1 = $row["received_by"];
                $canceled = $row["canceled"];
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
                $mode_of_proc_title =  $row["mode_of_proc_title"];
                $rfq_date =  $row["rfq_date"];
                $rfq_date1 = date('F d, Y', strtotime($rfq_date));

                $select_tots = mysqli_query($conn,"SELECT sum(total_amount) as abc FROM rfq_items WHERE rfq_id = $rfqID");
                $rowtots = mysqli_fetch_array($select_tots);
                $totsabc = $rowtots['abc'];
                /* getting values for flags */
                $sq = $row["sq"];
                $aoq = $row["aoq"];
                $po = $row["po"];
                ?>
                <tr>
                  <td><a href="ViewPRv.php?id=<?php echo $id?>&username=<?php echo $_SESSION['username']?>"><?php echo $pr_no;?></a>
                    <?php echo "<br>" ?>
                  </td>
                  <td><?php echo $pr_date1;?></td>
                  <td><?php echo $pmo;?></td>
                  <td><?php echo $mode_of_proc_title;?></td>
                
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
                            <?php echo "<br>" ?>
                              <!-- <?php echo $mode_of_proc_title ?> -->
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
                    <?php echo number_format($totsabc,2) ?>
                          
                        </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
