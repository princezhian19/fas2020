<?php
   $pr_date11 ="";
?>
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


                  $pmoUser="";
                  $conn = mysqli_connect("localhost","root","","db_dilg_pmis");
                  $user = $_SESSION['username']; $QQ = mysqli_query($conn,"SELECT * FROM end_users WHERE username = '$user'");

                  $rowUser=mysqli_fetch_array($QQ);$user_id=$rowUser['pmo_id'];
                  if ($user_id == 1){
                    $pmoUser="ORD";
                  }
                  if ($user_id == 3){
                    $pmoUser="LGMED";
                  }



                  if ($user_id == 4){
                  $pmoUser="LGCDD";
                  }
                  


                  if ($user_id == 5){
                    $pmoUser="FAD";
                  }
                    


                  if ($user_id == 6){
                    $pmoUser="LGMED-PDMU";
                  }
                  


                  if ($user_id == 7){
                    $pmoUser="LGCDD-MBRTG";

                  }


                $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $view_query = mysqli_query($conn,"SELECT * FROM pr  where pmo = '$pmoUser'  order by id desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];
                    
                    $pr_date = $row["pr_date"];

                    
                  /*   if($pr_date = '0000-00-00'){
                      
                    }
                    else{
                      $pr_date11 = date('F d, Y', strtotime($pr_date));

                    }
                     */
                   $pr_date11 = date('F d, Y', strtotime($pr_date));
                 
                    $pmo = $row["pmo"];
                    $purpose = $row["purpose"];
                    
                    $target_date = $row["target_date"];
                    $target_date11 = date('F d, Y', strtotime($target_date));

                   
                    ?>
                    
                     <tr>
                         <td><a href="ViewPRv1.php?id=<?php echo $id ?>"><?php echo $pr_no;?></a></td>
                        <td><?php echo $pr_date11;?></td>
                        
                        <td><?php echo $pmo;?></td>
                        <td><?php echo $purpose;?></td>
                        <td><?php echo $target_date;?></td>

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
                        $selectABS = mysqli_query($conn,"SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfq_id'");
                        if (mysqli_num_rows($selectABS) > 0 ) {
                        $rowABS = mysqli_fetch_array($selectABS);
                        $supplier_id = $rowABS['supplier_id'];
                        $select_sup = mysqli_query($conn,"SELECT supplier_title from supplier WHERE id = '$supplier_id'");
                        $rowSup = mysqli_fetch_array($select_sup);
                        $win_supplier = $rowSup['supplier_title'];
                          echo "<p style='color:green'><b>$win_supplier</b></p>";
                        }else{
                        echo "";
                        }
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
                        ?>
                        
                      
                      
                      </td>

                    
                    </tr>
                <?php }  ?>
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
              $view_query = mysqli_query($conn, "SELECT * FROM saroob order by date desc");
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