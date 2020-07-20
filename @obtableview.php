<?php
include('db.class.php'); // call db.class.php


$getSaro = $_GET['getsaroID'];
$getUacs = $_GET['getuacs'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>

  <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  

</head>
<body>
    <div class="box"style="border-style:groove" style="overflow-x:auto;">
      <div class="box-body">
        <div class=""style="overflow-x:auto;"> 
          <div class=""style="overflow-x:auto;">
            <br>
           
            <form method = "POST" action = "@Functions/obviewexport.php">
           <!--  Getting Hidden Variables -->
            <input type="text" class="text" name="saro" value="<?php echo $getSaro?>" hidden>
            <input type="text" class="text" name="uacs" value="<?php echo $getUacs?>" hidden>
           
            <!--  Getting Hidden Variables -->


            <h3 align="" >&nbspDisbursement for the Fund Source :  <label ><?php echo $getSaro?></label></h3>
            <h3 align="" >&nbspDisbursement for the UACS :   <label name="uacs" ><?php echo $getUacs?></label></h3>
            <h3 align="" >&nbspAllotment Amount :   <label ><?php
              
              $servername = "localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
              
            $conn = new mysqli($servername, $username, $password,$database);
             $getAmount = mysqli_query($conn, "SELECT * FROM  saro where  saronumber = '$getSaro' and uacs = '$getUacs' ");
             $rowAmount = mysqli_fetch_array($getAmount);
             $amount = $rowAmount['amount'];
            echo number_format($amount,2)?></label></h3>
           

            <h3 align="" >&nbspTotal Obligation Amount :   <b><?php $getSaro = $_GET['getsaroID'];
          
            
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            $conn = new mysqli($servername, $username, $password,$database);
            $AmountAll = mysqli_query($conn, "SELECT sum(amount) as a FROM saroob where saronumber = '$getSaro' and uacs = '$getUacs' and status='Obligated' "); 
            $rowAmount = mysqli_fetch_array( $AmountAll);

            echo  number_format($rowAmount['a'],2)?></b>
            
          
            </h3>

            <h3 align="" >&nbspBalance :   <b><?php $getSaro = $_GET['getsaroID'];
          
            
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            $conn = new mysqli($servername, $username, $password,$database);
            $AmountAll = mysqli_query($conn, "SELECT balance as a FROM saro where saronumber = '$getSaro' and uacs = '$getUacs' "); 
            $rowAmount = mysqli_fetch_array( $AmountAll);

            echo  number_format($rowAmount['a'],2)?></b>
            
          </h3>


             <input type="text" class="text" name="totalob" value="<?php echo $rowAmount['a'];?>" hidden>


            <br>

            <li class="btn btn-warning"><a href="saro.php" style="color:white;text-decoration: none;">Back</a></li>

            <br>
            <br>
            <br>

            <div class="class">
              
            
            <div class="col-md-3">
                  <label for="">FROM</label>
                  <select class="form-control " name="datefrom" style="width: 100%;">
                    <option value="January">January</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                  </select>
            </div>

            <div class="col-md-3">
                  <label for="">TO</label>
                  <select class="form-control " name="dateto" style="width: 100%;">
                    <option value="">Select Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                  </select>
            </div>
            <br>
            
            <div class="col-md-4">
           <!--  <form action=""> -->
          



           &nbsp<button type="submit" name="submit"  class="btn btn-success ">Export</button>
            
            <!-- <li class="btn btn-success"><a href="@Functions/obviewexport.php?getData = <?php $getD = $_POST['dateGet']; echo $getD; ?>" style="color:white;text-decoration: none;">Export</a></li> -->
            
           
           

            </div>

            </form>
            </div>


             <div class="box-header with-border"style="overflow-x:auto;">
            </div>
    <br>
    <br>
   
   
  <div class="section group"  style="overflow-x:auto;">
        
     
        
      <!--   <div class="col-md-5" style="overflow-x:auto;">
         
       

          <form method = "POST" action = "@Functions/obdateexport.php">
                    <div class="input-group date" style="overflow-x:auto;">
                        <div class="input-group-addon" style="overflow-x:auto;">
                        FROM   <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 200px">
                    
                    <div class="input-group date" style="overflow-x:auto;">
                        <div class="input-group-addon" style="overflow-x:auto;">
                        TO <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 200px">
                        &nbsp<button type="submit" name="submit"  class="btn btn-success ">Filter/Export Data</button>
                    </div>                        
                      
          </form>
        </div>
        <br>
        <br> -->
        
    </div>
      
      <!-- table here -->
     
      <table id="example1" class="table-responsive table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
                <thead>
                <tr style="background-color: white;color:blue;">
                      
                        <!-- <th style="text-align:center" width="800">DATE RECEIVED</th> -->
                        <th style="text-align:center" width="600">DATE</th>
                        <!-- <th style="text-align:center" width="800">DATE RETURNED</th> -->
                        <!-- <th style="text-align:center" width="800">DATE RELEASED</th> -->
                        <th style="text-align:center" width="400">ORS NUMBER</th>
                        <th style="text-align:center" width="600">SARO NUMBER</th>
                        <th style="text-align:center" width="800">REMARKS</th>
                        <th style="text-align:center" width="800">PPA</th>
                        <th style="text-align:center" width="800">UACS</th>
                        <th style="text-align:center" width="900">PAYEE</th>
                        <th style="text-align:center" width="800">PARTICULAR</th>
                        <th style="text-align:center" width="800">AMOUNT</th>
                        <th style="text-align:center" width="800">STATUS</th>
                        <!-- <th style="text-align:center" width="800">ACTION</th> -->
                       
                    </tr>
                </thead>
            
            <?php

            $getSaro = $_GET['getsaroID'];

            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM saroob where saronumber = '$getSaro' and uacs = '$getUacs' and status='Obligated' order by date desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $datereceived = $row["datereceived"];
                  $datereceived11 = date('F d, Y', strtotime($datereceived));

                  $datereprocessed = $row["datereprocessed"];
                  $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

                  $datereturned = $row["datereturned"];
                  $datereturned11 = date('F d, Y', strtotime($datereturned));

                  $datereleased = $row["datereleased"];
                  $datereleased11 = date('F d, Y', strtotime($datereleased));

                  $ors = $row["ors"];
                  $ponum = $row["ponum"];
                  $payee = $row["payee"];
                  $particular = $row["particular"];
                  $saronumber = $row["saronumber"];
                  $ppa = $row["ppa"];
                  $uacs = $row["uacs"];
                  $amount = $row["amount"];
                  $date = $row["date"];
                  $remarks = $row["remarks"];
                  $sarogroup = $row["sarogroup"];
                  $status = $row["status"];

                    $amount1 = number_format($amount,2);
                        echo "<tr align = ''>
                    
                     
                      
                        <td align = 'center'>$datereprocessed11</td>
                        
                    
                      
                        <td align = 'center'>$ors</td>
                        <td align = 'center'>$saronumber</td>
                        <td align = 'center'>$remarks</td>
                        <td align = 'center'>$ppa</td>
                        <td align = 'center'>$uacs</td>

                        <td align = 'center'>$payee</td>
                        <td align = 'center'>$particular</td>
                      
                      
                        <td align = 'center'>$amount1</td>
                     
                        <td style='background-color:green' align = 'center'><b>$status</b></td>
    
                      
    
                        </tr>";
                      
                    
                }
                echo "</table>";
            ?>       
            </table>
       
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



