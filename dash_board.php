<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h1>Dashboard</h1>
                  <strong>Monitoring of PRs</strong>
                  <p style="float:right;"><a href="MonitoringPr.php" class="btn btn-success btn-s">See All</a></p>
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
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                  $view_query = mysqli_query($conn,"SELECT * FROM pr where pmo='$user_id' order by id desc LIMIT 3  ");

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
     
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                <p style="float:right;"><a href="MonitoringOrs.php" class="btn btn-success btn-s">See All</a></p>
                  <strong>Monitoring of ORS and BURS</strong>
                  <p></p>
             <br>

             <table id="example2" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                 
                  <th width="200">DATE RECEIVED</th>
                  <th width="200">DATE OBLIGATED</th>
                  <th width="200">DATE RELEASED</th>
                  <th width="200">ORS NUMBER</th>
                  <th width="200">PO NUMBER</th>
                  <th WIDTH="200">PAYEE</th>
                  <th width="500">PARTICULAR</th>
                  <th width="200">AMOUNT</th>
                  <th width="200">STATUS</th>
                </tr>
              </thead>
              <?php
              $view_query = mysqli_query($conn, "SELECT * FROM saroob where status = 'Obligated' order by date desc LIMIT 3");
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
                             <td><?php echo $amount;?></td>
                             <?php if ($status =='Pending'): ?>
                              <td style='background-color:red'><b>Pending</b></td>
                              <?php else: ?>
                                <?php if ($status == 'Obligated'): ?>
                                  <td style='background-color:green'><b>Obligated</b></td>
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
  
  <script type="text/javascript">
    $(document).ready(function() {
      $('#exmaple2').DataTable();

    } );
 </script>

</html>

<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                <p style="float:right;"><a href="MonitoringDv.php" class="btn btn-success btn-s">See All</a></p>
      <strong>Monitoring of Disbursements</strong>
                  <p></p>
                  <table id="example3" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white; color:blue;">
                  <th width="200">DATE RECEIVED</th>
                  <th width="200">DATE DISBURSED</th>
                  <th width="200">DATE RELEASED</th>
                  <th width="200">DV NUMBER</th>
                  <th width="200">PO NUMBER</th>
                  <th WIDTH="200">PAYEE</th>
                  <th width="500">PARTICULAR</th>
                  <th width="200">AMOUNT</th>
                  <th width="200">STATUS</th>
                </tr>
              </thead>
              <?php
              $view_query = mysqli_query($conn, "SELECT * FROM disbursement where status = 'Disbursed' order by datereleased desc LIMIT 3");
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
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                <p style="float:right;"><a href="MonitoringPayment.php" class="btn btn-success btn-s">See All</a></p>
                  <strong>Monitoring of Payments</strong>
                  <p></p>
             <br>
             <table id="example4" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
                <thead>
                <tr style="background-color: white;color:blue;">
                        <th style="text-align:center" width="200">DATE</th>
                        <th style="text-align:center" width="200">PAYEE</th>
                        <th style="text-align:center" width="500">PARTICULAR</th>
                        <th style="text-align:center" width="200">DV NUMBER</th>
                        <th style="text-align:center" width="200">LDDAP-ADA/CHECK</th>
                        <th style="text-align:center" width="200">ORS NUMBER</th>
                        <th style="text-align:center" width="200">NET</th>
                        <th style="text-align:center" width="200">REMARKS</th>
                        <th style="text-align:center" width="200">STATUS</th>
                    </tr>
                </thead>
            
            <?php
            $view_query = mysqli_query($conn, "SELECT * FROM ntaob where status ='Paid' order by id desc LIMIT 3");
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
                </tr>
            <?php }?>
            </table>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('.select2').select2()
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('[data-mask]').inputmask()
    $('#reservation').daterangepicker()
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    $('#datepicker1').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    $('.my-colorpicker1').colorpicker()
    $('.my-colorpicker2').colorpicker()
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
$(document).ready(function(){
  $("#result").click(function(){
    $("#main").hide();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#result1").click(function(){
    $("#main1").hide();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#result2").click(function(){
    $("#main2").hide();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#result3").click(function(){
    $("#main3").hide();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#result4").click(function(){
    $("#main4").hide();
  });
});
</script>