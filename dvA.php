<?php
ini_set('display_errors', 0);
error_reporting(0);
// require_once('functions.php'); 
// session_start();  
// $UNAME = $_SESSION['username'];

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



// $query = mysqli_query($conn,"SELECT pmo_id FROM end_users WHERE username = '$UNAME'");
// $row = mysqli_fetch_array($query);
// $pmo_id = $row['pmo_id'];

$pmo_id = 5;
$rfq_id = $_GET['rfq_id'];
$po_no = $_GET['po_no'];
$supplier_titleD = $_GET['supplier_titleD'];
$supplier_address = $_GET['supplier_address'];
$po_amount = $_GET['po_amount'];

$select_purp = mysqli_query($conn,"SELECT pr.purpose FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no WHERE rfq.id = $rfq_id");
$purp = mysqli_fetch_array($select_purp);
$purpose = $purp['purpose'];



if (isset($_POST['submit'])) {
  $po_no = $_POST['po_no'];
  $supplier = $_POST['supplier'];
  $purpose = $_POST['purpose'];
  $amount = $_POST['amount'];
  $address = $_POST['address'];

  $insert = mysqli_query($conn,"INSERT INTO dv(po_no,supplier,purpose,amount,address,office) VALUES('$po_no','$supplier','$purpose','$amount','$address','$pmo_id')");

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewDV.php';
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
    <h1 align="">&nbspCreate DV</h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success btn-s"><a href="ViewDV.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
    <form method="POST" autocomplete="off" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group" hidden="">
              <label>Please Select : <small style="color:red;">*</small></label><br>
              <select name="burs_dv" class="form-control select2">
                <!-- <option></option> -->
                <option value="1">DV</option>
              </select>
            </div>
            <div class="form-group">
              <label>PO No. :  </label>
              <input autocomplete = "false"  class="form-control" name="po_no" type="text" id="po_no" value="<?php echo $po_no;?>">

            </div>
            <div class="form-group">
              <label>Payee/Supplier : <small style="color:red;">*</small></label>
              <input required autocomplete = "false"  class="form-control" name="supplier" type="text" id="supplier" value="<?php echo $supplier_titleD;?>">
            </div>

          </div>
          <div class="col-md-6">

           <div class="form-group">
            <label>Address :</label>
            <input required autocomplete = "false"  class="form-control" name="address" type="text" id="address" value="<?php echo $supplier_address;?>">
          </div>

          <div class="form-group">
            <label>Particular/Purpose : <small style="color:red;">*</small></label>
            <input required autocomplete = "false"  class="form-control" name="purpose" type="text" id="purpose" value="<?php echo $purpose;?>">
          </div>

          <div class="form-group">
            <label>Amount : <small style="color:red;">*</small></label>
            <input required autocomplete = "false"  class="form-control" name="amount" type="text" id="amount" value="<?php echo $po_amount;?>">
          </div>

        </div>


      </div>
    </div>
  </div>
  <button class="btn btn-primary btn-s" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Save</button>
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
