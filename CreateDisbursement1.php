<?php session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

/* $datenow = date('Y-m-d');
echo $datenow; */
?>


<?php
if (isset($_POST['submit'])) {
$dv = $_POST['dv'];
$ors = $_POST['ors'];
$sr = $_POST['sr'];
$ppa = $_POST['ppa'];
$uacs = $_POST['uacs'];
$payee = $_POST['payee'];
$particular = $_POST['particular'];
$amount = $_POST['amount'];
$datereceived = $_POST['datereceived'];
$dr = date('Y-m-d', strtotime($datereceived));
$timereceived = $_POST['timereceived'];
$tr = date('h:i a', strtotime($timereceived));
$tax = $_POST['tax'];
$gsis = $_POST['gsis'];
$pagibig = $_POST['pagibig'];
$philhealth = $_POST['philhealth'];
$other = $_POST['other'];
$remarks = $_POST['remarks'];
$status = $_POST['status'];


$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
$conn = new mysqli($servername, $username, $password,$database);

//$query = mysqli_query($conn,"UPDATE disbursement SET date_proccess=now(), datereleased = now(), dv = '$dv',ors = '$ors',sr = '$sr',ppa = '$ppa',uacs = '$uacs',payee = '$payee',particular = '$particular',amount = '$amount',datereceived = '$dr',timereceived = '$tr',tax = '$tax',gsis = '$gsis',pagibig = '$pagibig',philhealth = '$philhealth',other = '$other',remarks = '$remarks',status = '$status' WHERE ID ='$id' ");
// $datenow = date('Y-m-d');

$query = mysqli_query($conn,"INSERT INTO disbursement (dv,ors,sr,ppa,uacs,payee,particular,amount,datereceived,timereceived,tax,gsis,pagibig,philhealth,other,remarks,status) 
  VALUES ('$dv','$ors ','$sr','$ppa','$uacs','$payee','$particular','$amount','$dr','$tr','$tax','$gsis','$pagibig','$philhealth','$other','$remarks','$status')");

if($query){
$update = mysqli_query($conn,"Update disbursement set total = tax+gsis+pagibig+philhealth+other where dv = '$dv'");
$update1 = mysqli_query($conn,"Update disbursement set net = amount - total where dv = '$dv' ");
$update2 = mysqli_query($conn,"UPDATE disbursement SET date_proccess=now(), datereleased = now() WHERE dv ='$dv' ");



  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='disbursement.php';
    </SCRIPT>");
}
else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!');
    </SCRIPT>");
}
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-wid, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 

    <!-- Auto Complete -->
    


</head>
<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'seolivar' ) { include('test1.php'); 
}else{ 

     if ($OFFICE_STATION == 1) {
  include('sidebar2.php');
           
        }else{
  include('sidebar3.php');
         
        } 
}
 ?>
<body class="hold-transition skin-red-light fixed sidebar-mini">
<div class="wrapper">

  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Accounting</li>
        <li class="active">Create Disbursement</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
          <br>
          <h1 align="">&nbspCreate Disbursement</h1>
          <div class="box-header with-border">
            <br>
            <li class="btn btn-success"><a href="disbursement.php" style="color:white;text-decoration: none;">Back</a></li>
            <br>
            <br>
            <form method="POST">
              <div class="class-bordered" >
                <div class="row">
                  <div class="col-md-6">
                    <label>DVs no.</label>
                    <input  type="text" class="form-control" style="height: 35px;" id="" placeholder="Enter DV No." name="dv" required>
                    <br>
                    <label>ORS No.</label>
                    <input value="<?php echo $ors;?>" type="text" class="form-control" style="height: 35px;" id="ors" placeholder="Search ORS Number" name="ors">
                    <table class="table table-striped table-hover" id="main">
                      <tbody id="result">
                      </tbody>
                    </table>
                    <br>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script type="text/javascript">
                      $(document).ready(function(){
                        function load_data(query)
                        {
                          $.ajax({
                            url:"@disbursementvalue.php",
                            method:"POST",
                            data:{query:query},
                            success:function(data)
                            {
                              $('#result').html(data);
                            }
                          });
                        }
                        $('#ors').keyup(function(){
                          var search = $(this).val();
                          if(search != '')
                          {
                            load_data(search);
                          }
                          else
                          {
                            load_data();
                            document.getElementById('sr').value = "";
                            document.getElementById('ppa').value = "";
                            document.getElementById('uacs').value = "";
                    document.getElementById('payee').value = "";
                    document.getElementById('particular').value = "";
                    document.getElementById("amount").value = "";
                    
                  }
                });
                      });
                      function showRow(row)
                      {
                        var x=row.cells;
                        document.getElementById("sr").value = x[1].innerHTML;
                        document.getElementById("ppa").value = x[2].innerHTML;
                        document.getElementById("uacs").value = x[3].innerHTML;
                document.getElementById("payee").value = x[4].innerHTML;
                document.getElementById("particular").value = x[5].innerHTML;
                document.getElementById("amount").value = x[6].innerHTML;
              }
            </script>

            <label>SR no.</label>
            <input  type="text" class="form-control" style="height: 35px;" id="sr" placeholder="Enter DV No." name="sr" readonly>
            <br>
            <label>PPA</label>
            <input  type="text" class="form-control" style="height: 35px;" id="ppa" placeholder="Enter DV No." name="ppa" readonly>
            <br>
            <label>UACS</label>
            <input  type="text" class="form-control" style="height: 35px;" id="uacs" placeholder="Enter DV No." name="uacs" readonly>
            <br>
            <label>Payee</label>
            <input   type="text" class="form-control" style="height: 35px;" id="payee" placeholder="Enter DV No." name="payee" >
            <br>  
            <label>Particular</label>
            <input   type="text" class="form-control" style="height: 35px;" id="particular" placeholder="Enter DV No." name="particular" >
            <br>  
            <label>Amount</label>
            <input   type="text" class="form-control" style="height: 35px;" id="amount" placeholder="Enter DV No." name="amount" >
            <br>   
          </div>
          <div class="col-md-6">
            <label>Date Received</label>
            <br>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input value="" type="date" class="form-control pull-right" id="datePicker1" placeholder='Enter Date' name="datereceived" >
            </div>
            <br>
            <label>Time Received</label>
            <br>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input value="<?php echo $date2;?>" type="time" class="form-control pull-right" id="" placeholder='Enter Date' name="timereceived">

            </div>
            <br>
            <br>
            <label>Tax</label>
            <input  type="Number" class="form-control" style="height: 35px;" id="tax" placeholder="Enter Tax" name="tax">
            <br> 
            <label>GSIS</label>
            <input  type="Number" class="form-control" style="height: 35px;" id="gsis" placeholder="Enter GSIS" name="gsis">
            <br> 
            <label>PAG IBIG</label>
            <input  type="Number" class="form-control" style="height: 35px;" id="pagibig" placeholder="Enter Pag Ibig" name="pagibig">
            <br> 
            <label>PhilHealth</label>
            <input  type="Number" class="form-control" style="height: 35px;" id="philhealth" placeholder="Enter Phil Health" name="philhealth">
            <br>
            <label>Other Payables</label>
            <input  type="Number" class="form-control" style="height: 35px;" id="other" placeholder="Enter Phil Health" name="other">
            <br>  
            <label>Remarks</label>
            <input  type="text" class="form-control" style="height: 35px;" id="remarks" placeholder="Enter Remarks" name="remarks">
            <br>
            <label>Status</label>
            <select class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
             <option value = "Disbursed">Disbursed</option>
             <option value = "Pending">Pending</option>
           </select>
         </div>
       </div>
     </div>
     &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-success btn-s">Proccess</button>
   </div>
  
   
 </div>
</form>
</div>


</div>
<footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
    </footer>
    <br>
  
</section>


</body>
</html>
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