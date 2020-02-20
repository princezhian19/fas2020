<?php



$getntano = $_GET['getntano'];
$getparticular = $_GET['getparticular'];

?>


<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>

  <!-- bootstrap datepicker -->
 
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

</head>
<body>
    <div class="" style="overflow-x:auto;">
      <div class="panel panel-default" style="overflow-x:auto;" >
        <div class=""  style="overflow-x:auto;"> 
          <div class=""  style="overflow-x:auto;">
            <br>
            
      
            <form method = "POST" action = "@Functions/obviewexport.php">
           <!--  Getting Hidden Variables -->
            <input type="text" class="text" name="ntano" value="<?php echo $getntano?>" hidden>
            <input type="text" class="text" name="particular" value="<?php echo $getparticular?>" hidden>
           
            <!--  Getting Hidden Variables -->


            <h1 align="" >&nbspNTA No. :  <label ><?php echo $getntano?></label></h1>
            <h1 align="" >&nbspParticular :   <label name="particular" ><?php echo $getparticular?></label></h1>
            <!-- <h1 align="" >&nbspAllotment Amount :   <label ><?php
              
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "db_dilg_pmis";
              
            $conn = new mysqli($servername, $username, $password,$database);
             $getAmount = mysqli_query($conn, "SELECT * FROM  nta where  nta = '$getntano' and particular = '$getparticular' ");
             $rowAmount = mysqli_fetch_array($getAmount);
             $amount = $rowAmount['amount'];
            echo number_format($amount,2)?></label></h1>
            -->

            <h1 align="" >&nbspDisbursed Amount :   <?php $getntano = $_GET['getntano'];
          
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "db_dilg_pmis";
            
            $conn = new mysqli($servername, $username, $password,$database);
            $AmountAll = mysqli_query($conn, "SELECT sum(net) as a FROM disbursement where nta = '$getntano' and ntaparticular = '$getparticular' and status='Disbursed' "); 
            $rowAmount = mysqli_fetch_array( $AmountAll);

            echo  number_format($rowAmount['a'],2)?></h1>
            <input type="text" class="text" name="totaldisbursed" value="<h><?php echo $rowAmount['a'];?>" hidden>


           


          </div>
          <div class="col-md-9">
        
<!-- x -->



        </div>


        <br>
      <br>


      </div>

    
        
   <div class="class">

   <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 500px; margin-left: 40px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example1 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script> -->
        
            
        <br>
      <br>
      <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th style="text-align:center" width="800"></th>
                  <th style="text-align:center" width="800">DVs No.</th>
                  <th style="text-align:center" width="800">ORS/BURS No.</th>
                  <th style="text-align:center" width="800">SR No.</th>
                  <th style="text-align:center" width="800">PPA</th>
                  <th style="text-align:center" width="800">UACS</th>
                  <th style="text-align:center" width="800">DATE RECEIVED</th>
                  <th style="text-align:center" width="800">DATE DISBURSE</th>
                  <th style="text-align:center" width="800">DATE RELEASE</th>
                  <th style="text-align:center" width="800">PAYEE</th>
                  <th style="text-align:center" width="800">PARTICULAR</th>
                  <th style="text-align:center" width="800">AMOUNT</th>
                  <th style="text-align:center" width="800">TAX</th>
                  <th style="text-align:center" width="800">GSIS</th>
                  <th style="text-align:center" width="800">PAGIBIG</th>
                  <th style="text-align:center" width="800">PHILHEALTH</th>
                  <th style="text-align:center" width="800">OTHER PAYABLES</th>
                  <th style="text-align:center" width="800">TOTAL DEDUCTIONS</th>
                  <th style="text-align:center" width="800">NET</th>
                  <th style="text-align:center" width="800">REMARKS</th>
                  <th style="text-align:center" width="800">STATUS</th>
                  <!-- <th style="text-align:center" width="800">ACTION</th> -->
                  <th style="text-align:center" width="800"></th>
                  
                </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "db_dilg_pmis";
            // Create connection
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT * FROM disbursement where nta='$getntano' and ntaparticular = '$getparticular' order by datereleased asc");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["ID"]; 
                $dv = $row["dv"];
                $ors = $row["ors"];
                $sr = $row["sr"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $datereceived = $row["datereceived"];
                $datereceived11 = date('F d, Y', strtotime($datereceived));
                $timereceived = $row["timereceived"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $amount = $row["amount"];
                $tax = $row["tax"];
                $gsis = $row["gsis"];
                $pagibig  = $row["pagibig"];
                $philhealth = $row["philhealth"];
                $other = $row["other"];
                $total = $row["total"];
                $net = $row["net"];
                $remarks = $row["remarks"];
                $status = $row["status"];
                $date_proccess = $row["date_proccess"];
                $date_proccess1 = date('F d, Y', strtotime($date_proccess));
                $datereleased1 = $row["datereleased"];
                $datereleased = date('F d, Y', strtotime($datereleased1));
                ?>
                <tr>
                  <td>&nbsp</td>
                  <td><?php echo $dv;?></td>
                  <td><?php echo $ors;?></td>
                  <td><?php echo $sr;?></td>
                  <td><?php echo $ppa;?></td>
                  <td><?php echo $uacs;?></td>
                  <?php if ($datereceived == '1970-01-01' || $datereceived =='0000-00-00'): ?>
                    <td><a href="received_dv.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs">Received</a></td>
                    <?php else: ?>
                      <td><?php echo $datereceived11;?></td>
                    <?php endif ?>
                    <!-- <?php if ($datereceived != '0000-00-00'): ?>
                      <td><a class="btn btn-success btn-xs" href='CreateDisbursement.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                      <?php else: ?>
                        <?php if ($datereleased != '0000-00-00'): ?>
                          <td><?php echo $datereleased;?></td>
                          <?php else: ?>
                            <td></td>
                          <?php endif ?>
                          <td></td>
                          <?php endif ?> -->
                          <?php if ($date_proccess != NULL): ?>
                            <td><?php echo $date_proccess1;?></td>
                            <?php else: ?>
                              <?php if ($datereceived != '0000-00-00'): ?>
                                <td><a class="btn btn-success btn-xs" href='@disbursementcreate.php?createid=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                                <?php else: ?>
                                  <td></td>
                                <?php endif ?>
                              <?php endif ?> 
                              <?php if ($datereleased != '0000-00-00'): ?>
                                <td><?php echo $datereleased;?></td>
                                <?php else: ?>
                                  <?php if ($date_proccess == NULL): ?>
                                    <td></td>
                                    <?php else: ?>
                                      <td><a class="btn btn-success btn-xs" href='release_dv.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                                    <?php endif ?>
                                  <?php endif ?>
                                  <td><?php echo $payee;?></td>
                                  <td><?php echo $particular;?></td>
                                  <td><?php echo $amount;?></td>
                                  <td><?php echo $tax;?></td>
                                  <td><?php echo $gsis;?></td>
                                  <td><?php echo $pagibig;?></td>
                                  <td><?php echo $philhealth;?></td>
                                  <td><?php echo $other;?></td>
                                  <td><?php echo $total;?></td>
                                  <td><?php echo $net;?></td>
                                  <td><?php echo $remarks;?></td>
                                 
                                  <?php if ($status=='Disbursed'): ?>
                                    <td style='background-color:green'><b>Disbursed</b></td>
                                    <?php else: ?>
                                      <?php if ($status=='Pending'): ?>
                                        <td style='background-color:red'><b>Pending</b></td>
                                        <?php else: ?>
                                          <td></td>
                                        <?php endif ?>
                                          <td></td>
                                      <?php endif ?>
                                     <!--  <td>
                                        <a href='@disbursementupdate.php?getid=<?php echo $id;?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                                        <a href='@Functions/ddeletefunction.php?getid=<?php echo $id;?>'> <i style='font-size:24px'> <i class='fa fa-trash-o'></i></i> </a>
                                      </td> -->
                                      <td>&nbsp</td>
                                    </tr>
                                  <?php } ?>    
                                </table>
           

            </div>
            </div>
         
      </div>
    </div>
    
</div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>
</div>
</div>

   
<div class="panel-footer"></div>
</div>
</div>



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
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

    //Date picker,
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

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


</body>
</html>



