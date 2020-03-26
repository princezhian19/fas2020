
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

                $conn = mysqli_connect("localhost","root","","db_dilg_pmis");

                $username = $_SESSION['username'];

                // echo "SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'";
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
                //echo $user_id;
                $conn = mysqli_connect("localhost","root","","db_dilg_pmis");
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
     



     
     <!-- Obligation -->
<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$user = $_SESSION['username'];
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>


<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                
                  <strong>Monitoring of ORS and BURS</strong>
                  <p></p>
             <br>

             <table id="example2" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                 
                  <th>DATE RECEIVED</th>
                  <th>DATE OBLIGATED</th>
                  <!-- <th>DATE RETURNED</th> -->
                  <th>DATE RELEASED</th>
                  <th>ORS NUMBER</th>
                  <th>PO NUMBER</th>
                  <th>PAYEE</th>
                  <th>PARTICULAR</th>
                <!--   <th>SARO NUMBER</th>
                  <th>PPA</th>
                  <th>UACS</th> -->
                  <th>AMOUNT</th>
                 <!--  <th>REMARKS</th>
                  <th>GROUP</th> -->
                  <th>STATUS</th>
                 <!--  <th>ACTION</th> -->
                  
                </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "db_dilg_pmis";
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT * FROM saroob where status = 'Obligated' order by date desc");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];  

                $datereceived = $row["datereceived"];
                if ($datereceived == '0000-00-00') {
                  $datereceived11 = '';
                }else{
                  $datereceived11 = date('F d, Y', strtotime($datereceived));
                }

                $datereprocessed = $row["datereprocessed"];
                if ($datereprocessed == '0000-00-00') {
                  $datereprocessed11 = '';
                }else{
                  $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

                }
                /* $datereturned = $row["datereturned"];
                if ($datereturned == '0000-00-00') {
                  $datereturned11 = '';
                }else{
                  $datereturned11 = date('F d, Y', strtotime($datereturned));
                } */

                $datereleased = $row["datereleased"];
                if ($datereleased == '0000-00-00') {
                  $datereleased11 = '';
                }else{
                  $datereleased11 = date('F d, Y', strtotime($datereleased));
                }
                $ors = $row["ors"];
                $ponum = $row["ponum"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $saronumber = $row["saronumber"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $amount1 = $row["amount"];
                $amount = number_format( $amount1,2);
                $date = $row["date"];
                $remarks = $row["remarks"];
                $sarogroup = $row["sarogroup"];
                $status = $row["status"];
                ?>
                <tr>
                 
                  <?php if ($datereceived !='0000-00-00' ): ?>
                    <td><?php echo $datereceived11;?></td>
                    <?php else: ?>
                      <td><a class="btn btn-primary btn-xs" href='received_burs.php?id=<?php echo $id; ?>&stat=1' >Received</a> </a></td>
                    <?php endif ?>



                    <?php if ($datereceived !='0000-00-00'): ?>
                      <?php if ($datereprocessed !='0000-00-00'): ?>
                        <td><?php echo $datereprocessed11;?></td>
                        <?php else: ?>
                          <td><a class="btn btn-success btn-xs" href='CreateObligation.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                        <?php endif ?>

                      <?php else: ?>
                          <td></td>
                        <?php endif ?>

                        <?php if ($datereprocessed !='0000-00-00'): ?>
                            <?php if ($datereleased =='0000-00-00' || $datereleased == '1970-01-01'): ?>
                               <td><a class="btn btn-success btn-xs" href='release_burs.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                             <?php else: ?> 
                             <td><?php echo $datereleased11;?></td>
                             <?php endif ?>
                             <?php else: ?> 
                               <td></td>
                             <?php endif ?>




                             
                             <td><?php echo $ors;?></td>
                             <td><?php echo $ponum;?></td>
                             <td><?php echo $payee;?></td>
                             <td><?php echo $particular;?></td>
                             <!-- <td><?php echo $saronumber;?></td>
                             <td><?php echo $ppa;?></td>
                             <td><?php echo $uacs;?></td> -->
                             <td><?php echo $amount;?></td>
                            <!--  <td><?php echo $remarks;?></td>
                             <td><?php echo $sarogroup;?></td> -->
                             <?php if ($status =='Pending'): ?>
                              <td style='background-color:red'><b>Pending</b></td>
                              <?php else: ?>
                                <?php if ($status == 'Obligated'): ?>
                                  <td style='background-color:green'><b>Obligated</b></td>
                                  <?php else: ?>
                                    <td></td>
                                  <?php endif ?>
                                <?php endif ?>
                               <!--  <td>
                                  <a href='@obupdate.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> 
                                
                                </a>
                                <a onclick="return confirm('Delete This Obligated Item?');" href='@Functions/obdeletefunction.php?getidDelete=$id'><i style='font-size:24px' class='fa fa-trash-o'></i></a>
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
  
  <script type="text/javascript">
    $(document).ready(function() {
      $('#exmaple2').DataTable();

    } );
 </script>

</html>

<!-- Obligation -->



<!-- DV -->



<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                
      <br>
      <strong>Monitoring of Disbursements</strong>
                  <p></p>
                  <table id="example3" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white; color:blue;">
                 
                  <th>DATE RECEIVED</th>
                  <th>DATE DISBURSED</th>
            
                  <th>DATE RELEASED</th>

                  <th>DV NUMBER</th>
                  <th>PO NUMBER</th>
                  <th>PAYEE</th>
                  <th>PARTICULAR</th>
             
                  <th>AMOUNT</th>
              
                  <th>STATUS</th>
             
                </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "db_dilg_pmis";
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT * FROM disbursement where status = 'Disbursed' order by datereleased desc");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];  

                $datereceived = $row["datereceived"];
                if ($datereceived == '0000-00-00') {
                  $datereceived11 = '';
                }else{
                  $datereceived11 = date('F d, Y', strtotime($datereceived));
                }

                $datereprocessed = $row["date_proccess"];
                if ($datereprocessed == '0000-00-00') {
                  $datereprocessed11 = '';
                }else{
                  $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

                }
                $datereturned = $row["datereturned"];
                if ($datereturned == '0000-00-00') {
                  $datereturned11 = '';
                }else{
                  $datereturned11 = date('F d, Y', strtotime($datereturned));
                }

                $datereleased = $row["datereleased"];
                if ($datereleased == '0000-00-00') {
                  $datereleased11 = '';
                }else{
                  $datereleased11 = date('F d, Y', strtotime($datereleased));
                }
                $dv = $row["dv"];
                $ponum = $row["ponum"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $saronumber = $row["saronumber"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $amount1 = $row["amount"];
                $amount = number_format( $amount1,2);
                $date = $row["date"];
                $remarks = $row["remarks"];
                $sarogroup = $row["sarogroup"];
                $status = $row["status"];
                ?>
                <tr>
                 
                  <?php if ($datereceived !='0000-00-00' ): ?>
                    <td><?php echo $datereceived11;?></td>
                    <?php else: ?>
                      <td></td>
                    <?php endif ?>


                 
                      <?php if ($datereprocessed !='0000-00-00'): ?>
                        <td><?php echo $datereprocessed11;?></td>
                        <?php else: ?>
                          <td></td>
                        <?php endif ?>
                      

                    
                              <?php if ($datereleased =='0000-00-00'): ?>
                               <td></td>
                             <?php else: ?> 
                             <td><?php echo $datereleased11;?></td>
                             <?php endif ?>
                           


                             <td><?php echo $dv;?></td>
                             <td><?php echo $ponum;?></td>
                             <td><?php echo $payee;?></td>
                             <td><?php echo $particular;?></td>
                           
                           
                             <td><?php echo $amount;?></td>
                        
                             <?php if ($status =='Pending'): ?>
                              <td style='background-color:red'><b>Pending</b></td>
                              <?php else: ?>
                                <?php if ($status == 'Disbursed'): ?>
                                  <td style='background-color:green'><b>Disbursed</b></td>
                                  <?php else: ?>
                                    <td></td>
                                  <?php endif ?>
                                <?php endif ?>
                            
                              
                              </tr> 
                            <?php } ?>
                          </table>
        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
<!-- DV -->

      


      <!-- Payment -->



<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                
                  <strong>Monitoring of Payments</strong>
                  <p></p>
             <br>

             <table id="example4" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
                <thead>
                <tr style="background-color: white;color:blue;">
                      
                      <!--   <th style="text-align:center" width="800">ACCOUNT NO</th> -->
                        <th style="text-align:center" width="800">DATE</th>
                        <th style="text-align:center" width="800">PAYEE</th>
                        <th style="text-align:center" width="800">PARTICULAR</th>
                        <th style="text-align:center" width="800">DV NUMBER</th>
                        <th style="text-align:center" width="800">LDDAP-ADA/CHECK</th>
                        <th style="text-align:center" width="800">ORS NUMBER</th>
                        <!-- <th style="text-align:center" width="800">PPA</th>
                        <th style="text-align:center" width="800">UACS</th>
                        <th style="text-align:center" width="800">GROSS</th>
                        <th style="text-align:center" width="800">TAX</th> -->
                        <th style="text-align:center" width="800">NET</th>
                        <th style="text-align:center" width="800">REMARKS</th>
                        <th style="text-align:center" width="800">STATUS</th>
                       
                       

                    </tr>
                </thead>
            
            <?php
            $servername = "localhost";

            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM ntaob where status ='Paid' order by id desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"]; 
                  
                  $accountno = $row["accountno"];

                  $date1 = $row["date"];
                  $date = date('F d, Y', strtotime($date1));

                  $payee = $row["payee"];
                  $particular = $row["particular"];
                  $dvno = $row["dvno"];
                  $lddap = $row["lddap"];
                  $orsno = $row["orsno"];
                  $ppa = $row["ppa"];
                  $uacs = $row["uacs"];

                  $gross1 = $row["gross"];
                  $gross = number_format( $gross1,2);

                  $totaldeduc = $row["totaldeduc"];
                  $totaldeduc = number_format( $totaldeduc,2);

                  $net1 = $row["net"];
                  $net = number_format( $net1,2);

                  $remarks = $row["remarks"];
                  $status = $row["status"];

               ?>

                <tr>
             
                

                <?php if ( $date1=="0000-00-00" ): ?>
                <td style="text-align:center" ></td>
                <?php else : ?>
                <td style="text-align:center" ><?php echo $date?></td>
                <?php endif ?>

                <td style="text-align:center" ><?php echo $payee?></td>
                <td style="text-align:center" ><?php echo $particular?></td>
                <td style="text-align:center" ><?php echo $dvno?></td>
                <td style="text-align:center" ><?php echo $lddap?></td>
                <td style="text-align:center" ><?php echo $orsno?></td>
                <td style="text-align:center" ><?php echo $net?></td>
                <td style="text-align:center" ><?php echo $remarks?></td>

                <?php if ($status =='Unpaid'): ?>
                              <td style='background-color:red'><b>Unpaid</b></td>
                              <?php else: ?>
                                <?php if ($status == 'Paid'): ?>
                                  <td style='background-color:green'><b>Paid</b></td>
                                  <?php else: ?>
                                    <td></td>
                                  <?php endif ?>
                                <?php endif ?>
               <!--  <td style="text-align:center" ><?php echo $status?></td> -->
              
               

                </tr>

            
            <?php }?>


            </table>
          




         
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Payment -->