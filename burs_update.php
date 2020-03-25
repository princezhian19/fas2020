<?php
require_once('functions.php'); 
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$username = $_SESSION['username'];
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM burs WHERE id = '$id'");
$row = mysqli_fetch_array($query);
$office = $row['office'];
$po_no = $row['po_no'];
$supplier = $row['supplier'];
$address = $row['address'];
$purpose = $row['purpose'];
$amount = $row['amount'];
$doc_type = $row['doc_type'];
$status = $row['status'];

if (isset($_POST['submit'])) {
  $po_no1 = $_POST['po_no'];
  $supplier1 = $_POST['supplier'];
  $purpose1 = $_POST['purpose'];
  $amount1 = $_POST['amount'];
  $address1 = $_POST['address'];
  $burs1 = $_POST['burs'];

  $update = mysqli_query($conn,"UPDATE burs SET doc_type = '$burs1' , po_no = '$po_no1', supplier = '$supplier1',purpose = '$purpose1', amount = '$amount1', address = '$address1' ");
  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'UpdateBURS.php?id=$id';
      </SCRIPT>");
  }  else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured in Saving');
    </SCRIPT>");
 }
}
?>
<!DOCTYPE html>
<html>
<body>
 <div class="box box-default">
  <div class="box-header with-border">
      <?php if ($doc_type == 1): ?>
    <h1 align="">&nbspUPDATE ORS</h1>
    <?php else: ?>
    <h1 align="">&nbspUPDATE BURS</h1>
  <?php endif ?>
    <div class="box-header with-border">
    </div>
    <br>
  <?php $btn = $_GET['btn']; ?>
  <?php if ($btn == 'no'): ?>
    <?php else: ?>
      <?php if ($doc_type == 1): ?>
   <li class="btn btn-success btn-s"><a href="export_ors.php?id=<?php echo $id;?>" style="color:white;text-decoration: none;">Export</a></li>
    <?php else: ?>
       <li class="btn btn-success btn-s"><a href="export_burs.php?id=<?php echo $id;?>" style="color:white;text-decoration: none;">Export</a></li>
  <?php endif ?>
  <?php endif ?>

    <br>
    <br>
    <form method="POST" autocomplete="off" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label>Please Select : <small style="color:red;">*</small></label><br>
              <?php if ($doc_type == 1): ?>
                <input type="checkbox" class="checkbox1" name="burs" value="1" checked> ORS &nbsp&nbsp&nbsp
                <input type="checkbox" class="checkbox1" name="burs" value="2"> BURS
              <?php else: ?>
                <input type="checkbox" class="checkbox1" name="burs" value="1" > ORS &nbsp&nbsp&nbsp
                <input type="checkbox" class="checkbox1" name="burs" value="2" checked> BURS
              <?php endif ?>
             
            </div>
            <div class="form-group">
              <label>PO No. :  </label>
              <input value="<?php echo $po_no;?>" autocomplete = "false"  class="form-control" name="po_no" type="text" id="po_no">

            </div>
            <div class="form-group">
              <label>Payee/Supplier : <small style="color:red;">*</small></label>
              <input value="<?php echo $supplier;?>" required autocomplete = "false"  class="form-control" name="supplier" type="text" id="supplier">
            </div>

          </div>
          <div class="col-md-6">

           <div class="form-group">
            <label>Address :</label>
            <input value="<?php echo $address;?>" required autocomplete = "false"  class="form-control" name="address" type="text" id="address">
          </div>

          <div class="form-group">
            <label>Particular/Purpose : <small style="color:red;">*</small></label>
            <input value="<?php echo $purpose;?>" required autocomplete = "false"  class="form-control" name="purpose" type="text" id="purpose">
          </div>

          <div class="form-group">
            <label>Amount : <small style="color:red;">*</small></label>
            <input value="<?php echo $amount?>" onKeyPress='return dec(event)' required autocomplete = "false"  class="form-control" name="amount" type="text" id="amount">

          </div>

        </div>


      </div>
    </div>
  </div>
  <?php if ($btn=="no"): ?>
    <?php else: ?>
      <?php if ($status == 1 || $status == 2 || $status == 3|| $status == 4 || $status == 5): ?>
        
        <?php else: ?>
  <button class="btn btn-primary btn-s" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Update</button>
      <?php endif ?>
  <?php endif ?>
  <br>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>
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
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
