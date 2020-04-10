<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Monitoring of PRs</h1>
            <strong></strong>
            <p></p>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th>PR NO</th>
                  <th>PR DATE</th>
                  <th>OFFICE</th>
                  <th width="300">PURPOSE</th>
                  <th width="100">TARGET DATE</th>
                  <th>RFQ NO</th>
                  <th>RFQ DATE</th>
                  <th width="100">WINNING SUPPLIER</th>
                  <th>PO NO</th>
                  <th>PO DATE</th>
                </tr>
              </thead>
              <?php

              $user_id = ""; 
              $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
              $username = $_SESSION['username'];

              $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
              $rowdiv = mysqli_fetch_array($select_user);
              $DIVISION_C = $rowdiv['DIVISION_C'];


              if ($DIVISION_C == '10' || $DIVISION_C == '11' || $DIVISION_C == '12' || $DIVISION_C == '13' || $DIVISION_C == '14' || $DIVISION_C == '15' || $DIVISION_C == '16' ) {

                $user_id = 'FAD';

                
              }else if($DIVISION_C == '3' || $DIVISION_C == '5'){

                $user_id = 'ORD';

              }else if($DIVISION_C == '17'){

                $user_id = 'LGCDD';

              }
              else if($DIVISION_C == '9'){

                $user_id = 'LGMED-PDMU';

              }
              else if($DIVISION_C == '7'){

                $user_id = 'LGCDD-MBTRG';

              }
              else if($DIVISION_C == '18'){

                $user_id = 'LGMED';

              }
              $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
              $view_query = mysqli_query($conn,"SELECT * FROM pr where pmo='$user_id' order by id desc ");

              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];
                $pr_no = $row["pr_no"];
                $pr_date = $row["pr_date"];

                $pr_date11 = date('F d, Y', strtotime($pr_date));
                $pmo = $row["pmo"];
                $purpose = $row["purpose"];
                
                $target_date = $row["target_date"];
                $target_date11 = date('F d, Y', strtotime($target_date));

                
                ?>
                <tr>
                 <td><a href="ViewPRv.php?id=<?php echo $id ?>"><?php echo $pr_no;?></a></td>
                 <td><?php echo $pr_date11;?></td>
                 <td><?php echo $pmo;?></td>
                 <td><?php echo $purpose;?></td>
                 <td><?php echo $target_date11;?></td>

                 <td><?php 

                 $RFQ = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                 $rowID = mysqli_fetch_array($RFQ);
                 $rfq_id = $rowID['id'];
                 $rfq_no = $rowID['rfq_no'];
                 $rfq_date = $rowID['rfq_date'];
                 $rfq_date11 = date('F d, Y', strtotime($rfq_date));
                 if (mysqli_num_rows($RFQ)>0) {
                  echo "<p style='color:green'><b>$rfq_no</b></p>";
                }else{ 
                  echo " ";
                }
                ?></td>
                <td><?php 
                if (mysqli_num_rows($RFQ) > 0) {
                  echo "<p style='color:green'><b>$rfq_date11</b></p>";
                }else{ 
                  echo " ";
                }
                ?></td>
                <td><?php 
                $selectABS = mysqli_query($conn,"SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfq_id' and abstract_no is not NULL");
                        //echo "SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfq_id'";
                /*  if (mysqli_num_rows($selectABS) > 0 ) { */
                  $rowABS = mysqli_fetch_array($selectABS);
                  $supplier_id = $rowABS['supplier_id'];
                       // echo $supplier_id;

                  $select_sup = mysqli_query($conn,"SELECT supplier_title from supplier WHERE id = '$supplier_id'");
                  $rowSup = mysqli_fetch_array($select_sup);
                  $win_supplier = $rowSup['supplier_title'];
                  echo "<p style='color:green'><b>$win_supplier</b></p>";
                  
                          //echo "SELECT supplier_title from supplier WHERE id = '$supplier_id'";

                      /*   }else{
                        echo "";
                      } */
                      ?></td>
                      <td><?php 
                      $selectPO = mysqli_query($conn,"SELECT po.po_no FROM selected_quote sq LEFT JOIN po on po.id = sq.po_id WHERE sq.rfq_id = '$rfq_id'");
                      if (mysqli_num_rows($selectPO) > 0 ) {
                        $rowPO = mysqli_fetch_array($selectPO);
                        $po = $rowPO['po_no'];
                        echo "<p style='color:green'><b>$po</b></p>";

                      }else{
                        echo "";
                      } 
                      ?></td>
                      <td><?php 
                      $selectPO_date = mysqli_query($conn,"SELECT po.po_no,po.po_date FROM selected_quote sq LEFT JOIN po on po.id = sq.po_id WHERE sq.rfq_id = '$rfq_id'");
                      $rowPO_date = mysqli_fetch_array($selectPO_date);
                      $po_date = $rowPO_date['po_date'];
                      $po_date11 = date('F d, Y', strtotime($po_date));
                      
                      if($po_date==""){
                        echo "<p style='color:green'><b></b></p>";

                      }
                      else{
                        echo "<p style='color:green'><b>$po_date11</b></p>";

                      }
                      ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
