<?php
// require_once('functions.php'); 
error_reporting(0);
ini_set('display_errors', 0);
session_start();

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$select_user = mysqli_query($conn,"SELECT * FROM tbl_employee WHERE id = '$id'");
$rowdiv = mysqli_fetch_array($select_user);
$emp_no = $rowdiv["emp_no"];
$l_name = $rowdiv["l_name"];  
$f_name = $rowdiv["f_name"];
$m_name = $rowdiv["m_name"];

if (isset($_POST['submit'])) {
$emp_no1 = $_POST['emp_no'];
$l_name1 = $_POST['l_name'];
$f_name1 = $_POST['f_name'];
$m_name1 = $_POST['m_name'];

$updateEmp = mysqli_query($conn,"UPDATE tbl_employee SET  emp_no = '$emp_no1' WHERE id = '$id' ");

$updateBir = mysqli_query($conn,"UPDATE bir SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateMp2 = mysqli_query($conn,"UPDATE mp2 SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updatePrem = mysqli_query($conn,"UPDATE pagibig_premium SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateDeduc = mysqli_query($conn,"UPDATE tbl_deductions SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateLoan = mysqli_query($conn,"UPDATE tbl_deduction_loans SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateHistory = mysqli_query($conn,"UPDATE   tbl_deduction_loans_history SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateLoan = mysqli_query($conn,"UPDATE tbl_loan SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");

$updateLoanHistory = mysqli_query($conn,"UPDATE   tbl_loan_history SET emp_no = '$emp_no1' WHERE emp_no = '$emp_no' ");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href = 'PayrollEmployee.php?';
            </SCRIPT>");
}
?>

<!DOCTYPE html>
<html>
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspUpdate Payroll Employee</h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success btn-s"><a href="PayrollEmployee.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
    <form method="POST" autocomplete="off" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>EMPLOYEE NUMBER : <small style="color:red;">*</small></label>
                <input required autocomplete = "false"  class="form-control" name="emp_no" type="text" value="<?php echo $emp_no?>">
              </div>

            </div>
            <div class="col-md-6">

             <div class="form-group">
              <label>FIRST NAME :</label>
              <input required autocomplete = "false"  class="form-control" name="f_name" type="text" value="<?php echo $f_name?>">
            </div>

            <div class="form-group">
              <label>MIDDLE NAME: <small style="color:red;">*</small></label>
              <input required autocomplete = "false"  class="form-control" name="m_name" type="text" value="<?php echo $m_name?>">
            </div>

            <div class="form-group">
              <label>LAST NAME : <small style="color:red;">*</small></label>
              <input onKeyPress='return dec(event)' required autocomplete = "false"  class="form-control" name="l_name" type="text" value="<?php echo $l_name?>">

            </div>

          </div>


        </div>
      </div>
    </div>
    <button class="btn btn-primary btn-s" style="float: right;" id="finalizeButton" type="submit" name="submit" >Save</button>
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
<script>
  $(document).ready(function(){
    $("#result").click(function(){
      $("#main").hide();
    });
  });
</script>
<script>
  function myFunction() {
    document.getElementById("supplier").readOnly = true;
    document.getElementById("address").readOnly = true;
    document.getElementById("purpose").readOnly = true;
    document.getElementById("amount").readOnly = true;
  }
</script>

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
