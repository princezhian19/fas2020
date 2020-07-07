<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=payrollodi", "root", "");
$conn = mysqli_connect("localhost","root","","payrollodi");

$id = $_GET['id'];
$id2 = $_GET['id2'];
$select = mysqli_query($conn,"SELECT * FROM tbl_loan WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$emp_no = $row['emp_no'];

$select2 = mysqli_query($conn,"SELECT te.full_name,tl.loan_name,tl.from_date,tl.to_date,tl.loan_amount,tl.payable_loan,tl.monthly_payment,tl.loan_balance FROM tbl_loan tl LEFT JOIN tbl_employee te on te.emp_no = tl.emp_no WHERE tl.id = '$id' ");
$row2 = mysqli_fetch_array($select2);
$full_name = $row2['full_name'];
$loan_name = $row2['loan_name'];
$from_date = $row2['from_date'];
$to_date = $row2['to_date'];
$loan_amount = $row2['loan_amount'];
$payable_loan = $row2['payable_loan'];
$monthly_payment = $row2['monthly_payment'];
$loan_balance = $row2['loan_balance'];

if (isset($_POST['submit'])) {
$loan_amount1 = $_POST['loan_amount'];
$payable_loan1 = $_POST['payable_loan'];
$monthly_payment1 = $_POST['monthly_payment'];
$loan_balance1 = $_POST['loan_balance'];

$update = mysqli_query($conn,"UPDATE tbl_loan SET loan_amount = '$loan_amount1', payable_loan = '$payable_loan1', monthly_payment = '$monthly_payment1', loan_balance = '$loan_balance1' WHERE id = '$id' ");
if ($update) {
echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Loan Successfuly Updated! </p> </div></div>  ';
}else{
echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Error Occured! </p> </div></div>  ';


}



}

?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspCreate New Loan</h1>
    &nbsp &nbsp<li class="btn btn-success"><?php echo '<a href="ViewEmpLoan.php?id='.$id2.'" style="color:white;text-decoration: none;">Back</a>'?></li>
    <p></p>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-5">
             <div class="form-group">
              <label>Employee Name</label>
              <input type="text" class="form-control" readonly name="employee_name"  value="<?php echo $full_name?>">
            </div>
            <div class="form-group">
              <label>Loan Name</label>
             <input type="text" class="form-control" readonly name="loan_name" value="<?php echo $loan_name?>">
            </div>
              <h4><b>Payment Terms</b></h4>
              <div class="row">
                <div class="col-xs-6">
                  <label>From</label>
                  <input type="date" id="from_date" readonly name="from_date" class="form-control" placeholder=".col-xs-6" value="<?php echo $from_date?>">
                </div>
                <label>&nbsp&nbsp&nbsp&nbspTo</label>
                <div class="col-xs-6">
                  <input type="date" id="to_date" readonly name="to_date" class="form-control" placeholder=".col-xs-6" value="<?php echo $to_date?>">
                </div>
              </div>
              <br>
              <?php if ($to_date == NULL): ?>
                <div class="form-group">
                <label>Loan Amount</label>
                <input class="form-control" type="number"  name="loan_amount" id="loan_amount" autocomplete = "off" value="<?php echo $loan_amount?>">
              </div>
              <div class="form-group">
                <label>Payable Loan Amount (with charges & interests) </label>
                <input class="form-control" type="number"  name="payable_loan" id="payable_loan" autocomplete = "off" value="<?php echo $payable_loan?>">
              </div>
            <div class="form-group">
              <label>Monthly Payment </label>
              <input class="form-control" type="text"   name="monthly_payment" id="monthly_payment" autocomplete = "off" value="<?php echo $monthly_payment?>"> 
            </div>
            <div class="form-group">
              <label>Loan Balance </label>
              <input class="form-control" type="text"   name="loan_balance" id="loan_balance" autocomplete = "off" value="<?php echo $loan_balance?>"> 
            </div>
            <?php else: ?>

              <div class="form-group">
                <label>Loan Amount</label>
                <input class="form-control" type="number" readonly name="loan_amount" id="loan_amount" autocomplete = "off" value="<?php echo $loan_amount?>">
              </div>
              <div class="form-group">
                <label>Payable Loan Amount (with charges & interests) </label>
                <input class="form-control" type="number" readonly name="payable_loan" id="payable_loan" autocomplete = "off" value="<?php echo $payable_loan?>">
              </div>
            <div class="form-group">
              <label>Monthly Payment </label>
              <input class="form-control" type="text"  readonly name="monthly_payment" id="monthly_payment" autocomplete = "off" value="<?php echo $monthly_payment?>"> 
            </div>
            <div class="form-group">
              <label>Loan Balance </label>
              <input class="form-control" type="text"  readonly name="loan_balance" id="loan_balance" autocomplete = "off" value="<?php echo $loan_balance?>"> 
            </div>
              <?php endif ?>
              
          </div>
        </div>
      </div>
      <?php if ($to_date == NULL): ?>
      <button class="btn btn-primary showMsg"   type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Update</button>
        <?php else: ?>
        
      <?php endif ?>
      <br>
      <br>
      <br>
    </form>
  </div>  
</div>  




