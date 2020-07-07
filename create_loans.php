<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$id = $_GET['id'];

function province($connect)
{ 
  $output = '';
  $query = "SELECT full_name,emp_no FROM `tbl_employee` ORDER BY l_name ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["emp_no"].'">'.$row["full_name"].'</option>';
  }
  return $output;
}
if (isset($_POST['submit'])) {
  $employee_name = $_POST["employee_name"];
  $loan_name = $_POST["loan_name"];
  $from_date = $_POST["from_date"];
  $to_date = $_POST["to_date"];
  $loan_amount = $_POST["loan_amount"];
  $payable_loan = $_POST["payable_loan"];
  $monthly_payment = $_POST["monthly_payment"];
  $monthsDiff = $_POST["monthsDiff"];
  $showhidecheckbox = $_POST["showhidecheckbox"];


  $select_station = mysqli_query($conn,"SELECT station FROM tbl_employee WHERE emp_no = '$employee_name' ");
  $rowS = mysqli_fetch_array($select_station);
  $stationN = $rowS['station'];

  $select_salary = mysqli_query($conn,"SELECT monthly_salary FROM tbl_deductions WHERE emp_no = '$employee_name' ");
  $rowSal = mysqli_fetch_array($select_salary);
  $monthly_salary = $rowSal['monthly_salary'];

  $selectEmpNo = mysqli_query($conn,"SELECT * FROM tbl_deduction_loans WHERE emp_no = '$employee_name' ");

      if ($loan_name == "Select Loan Name") {
      echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;">Please Select Loan Name! </p> </div></div>  ';
    }else{

  if(!empty($_POST['showhidecheckbox'])) {

    $insert = mysqli_query($conn,"INSERT INTO tbl_loan (emp_no,loan_name,from_date,to_date,loan_amount,loan_balance,payable_loan,months_to_pay,remaining_payment_count,monthly_payment,monthly_salary) 
      VALUES('$employee_name','$loan_name','$from_date','$to_date','$loan_amount','$loan_amount','$payable_loan','$monthsDiff','$monthsDiff','$monthly_payment','$monthly_salary')");




    if(mysqli_num_rows($selectEmpNo) > 0){

 
     
      if ($loan_name == "Consolidated Loan") {
       $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET consolidated_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
     }
     if ($loan_name == "Optional Premium") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET optional_premium = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Policy Regular Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET policy_regular_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Educational Assistance Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET educational_assistance_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Emergency Calamity Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET   emergency_calamity_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Multipurpose Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET multi_purpose_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Pag-ibig Housing") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET pag_ibig_housing = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Calamity Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET calamity_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "AMSWLAI") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET amswlai = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Credit Cooperative Union Inc.") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET credit_union = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "National Home Mortgage Finance Corporation") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET national_home = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

      if ($loan_name == "Real Estate Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET rel = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

    if ($loan_name == "Optional Policy Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET optional_policy_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

        if ($update_user_loans) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Loan Details Successfuly Saved!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }else{
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Warning : Error in Saving Loan Details!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }

  }else{

    if ($loan_name == "Consolidated Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,consolidated_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Optional Premium") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,optional_premium,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Policy Regular Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,policy_regular_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Educational Assistance Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,educational_assistance_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Emergency Calamity Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,emergency_calamity_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Multipurpose Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,multi_purpose_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Pag-ibig Housing") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,pag_ibig_housing,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Calamity Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,calamity_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "AMSWLAI") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,amswlai,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Credit Cooperative Union Inc.") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,credit_union,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "National Home Mortgage Finance Corporation") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,national_home,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }

      if ($loan_name == "Real Estate Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,rel,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }

    if ($loan_name == "Optional Policy Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,optional_policy_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }

       if ($insert_user_loans) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Loan Details Successfuly Saved!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }else{
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Warning : Error in Saving Loan Details!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }
    

  }

}

else{

  $insert = mysqli_query($conn,"INSERT INTO tbl_loan (emp_no,loan_name,from_date,payable_loan,loan_amount,loan_balance,monthly_payment,monthly_salary) 
    VALUES('$employee_name','$loan_name',now(),'$monthly_payment','$monthly_payment','$monthly_payment','$monthly_payment','$monthly_salary')");

    
    if(mysqli_num_rows($selectEmpNo) > 0){
     
      if ($loan_name == "Consolidated Loan") {
       $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET consolidated_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
     }
     if ($loan_name == "Optional Premium") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET optional_premium = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Policy Regular Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET policy_regular_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Educational Assistance Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET educational_assistance_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Emergency Calamity Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET   emergency_calamity_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Multipurpose Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET multi_purpose_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Pag-ibig Housing") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET pag_ibig_housing = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Calamity Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET calamity_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "AMSWLAI") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET amswlai = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "Credit Cooperative Union Inc.") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET credit_union = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }
    if ($loan_name == "National Home Mortgage Finance Corporation") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET national_home = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

      if ($loan_name == "Real Estate Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET rel = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

    if ($loan_name == "Optional Policy Loan") {
      $update_user_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET optional_policy_loan = '$monthly_payment' WHERE emp_no = '$employee_name' "); 
    }

        if ($update_user_loans) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Loan Details Successfuly Saved!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }else{
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Warning : Error in Saving Loan Details!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }

  }else{

    if ($loan_name == "Consolidated Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,consolidated_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Optional Premium") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,optional_premium,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Policy Regular Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,policy_regular_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Educational Assistance Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,educational_assistance_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Emergency Calamity Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,emergency_calamity_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Multipurpose Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,multi_purpose_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Pag-ibig Housing") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,pag_ibig_housing,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Calamity Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,calamity_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "AMSWLAI") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,amswlai,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "Credit Cooperative Union Inc.") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,credit_union,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }
    if ($loan_name == "National Home Mortgage Finance Corporation") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,national_home,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }

      if ($loan_name == "Real Estate Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,rel,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }

    if ($loan_name == "Optional Policy Loan") {
      $insert_user_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans(emp_no,optional_policy_loan,station) VALUES('$employee_name','$monthly_payment','$stationN') ");
    }


       if ($insert_user_loans) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Loan Details Successfuly Saved!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }else{
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Warning : Error in Saving Loan Details!');
      window.location.href='CreateLoans.php';
      </SCRIPT>");
    }
    

  }

}
}
    // echo '<p style = "background-color:red;color:white;padding:10px;"> WARNING : You Entered Invalid Quantity </p>   ';
    // echo ("<SCRIPT LANGUAGE='JavaScript'>
    //   window.alert('WARNING : Invalid Quantity')
    //   window.location.href='CreatePr.php';
    //   </SCRIPT>");
   // header('location: CreatePr.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');
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
<style type="text/css">
  .showthis {
    display: none;
  }
</style>
<body>
<!-- <script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}
</script>

<a href="javascript:confirmDelete('delete.page?id=1')">Delete</a>
-->
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspCreate New Loan</h1>
    &nbsp &nbsp<li class="btn btn-success"><?php echo '<a href="ViewEmpLoan.php?id='.$id.'" style="color:white;text-decoration: none;">Back</a>'?></li>

    <p></p>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-5">
             <div class="form-group">
              <label>Employee Name</label>
              <select class="form-control select2" style="width: 100%;" name="employee_name"  >
                  <option>Select Employee Name</option>
                <?php echo province($connect);?>
              </select>
            </div>

            <div class="form-group">
              <label>Loan Name</label>
              <select class="form-control select2" style="width: 100%;" name="loan_name"  >
                <option>Select Loan Name</option>
                <optgroup label="GSIS">
                  <option value="Consolidated Loan">Consolidated Loan</option>
                  <option value="Optional Premium">Optional Premium</option>
                  <option value="Policy Regular Loan">Regular Policy Loan</option>
                  <option value="Optional Policy Loan">Optional Policy Loan</option>
                  <option value="Educational Assistance Loan">Educational Assistance Loan</option>
                  <option value="Emergency Calamity Loan">Emergency Calamity Loan</option>
                  <option value="Real Estate Loan">Real Estate Loan</option>
                </optgroup>
                <optgroup label="PAGIBIG">
                  <option value="Multipurpose Loan">Multipurpose Loan</option>
                  <option value="Pag-ibig Housing">Pag-ibig Housing</option>
                  <option value="Calamity Loan">Calamity Loan</option>
                </optgroup>
                <optgroup label="Others">
                  <option value="AMSWLAI">AMSWLAI</option>
                  <option value="Credit Cooperative Union Inc.">Credit Cooperative Union Inc.</option>
                  <option value="National Home Mortgage Finance Corporation">National Home Mortgage Finance Corporation</option>
                </optgroup>
              </select>
            </div>

            <label>With Payment Terms?</label><input type="checkbox" class="trigger" style="height: 1.2em;width: 1.2em;" name="showhidecheckbox">
            <div class="showthis">

              <h4><b>Payment Terms</b></h4>

              <div class="row">
                <div class="col-xs-6">
                  <label>From<b style="color:red;">*</b></label>
                  <input type="date" id="from_date" name="from_date" class="form-control" placeholder=".col-xs-6">
                  <br>
                  <input type = "hidden" class="form-control" id = "monthsDiff" name="monthsDiff">
                </div>
                <label>&nbsp&nbsp&nbsp&nbspTo<b style="color:red;">*</b></label>
                <div class="col-xs-6">
                  <input type="date" id="to_date" name="to_date" class="form-control" placeholder=".col-xs-6">
                </div>

              </div>
              <br>
              <div class="form-group">
                <label>Loan Amount<b style="color:red;">*</b></label>
                <input class="form-control" type="text" name="loan_amount" id="loan_amount" autocomplete = "off" >
              </div>


              <div class="form-group">
                <label>Payable Loan Amount (with charges & interests) <b style="color:red;">*</b></label>
                <input class="form-control" type="text" name="payable_loan" id="payable_loan" autocomplete = "off" onchange="compute()">
              </div>

            </div>
            <br>
            <br>

            <div class="form-group">
              <label>Monthly Payment <b style="color:red;">*</b></label>
              <input class="form-control" type="text"  name="monthly_payment" id="monthly_payment" autocomplete = "off" >
            </div>
          </div>



        </div>
      </div>

      <button class="btn btn-success showMsg"   type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>

      <br>
      <br>
      <br>
    </form>
  </div>  
</div>  
<script type="text/javascript">
  $(function() {
    $('.trigger').change(function() {
      $(this).next('.showthis').toggle(this.checked);
    })
  });
  // month = "";
  // $("#from_date").on("change",function(){

  //   var date1 = new Date($('#from_date').val());

  //   day = date1.getDate();
  //   month = date1.getMonth() + 1;
  //   year = date1.getFullYear();
  //   time1 = date1.getTime();
  // });

  $("#to_date").on("change",function(){

    // var date2 = new Date($('#to_date').val());
    // day2 = date2.getDate();
    // month2 = date2.getMonth() + 1;
    // year2 = date2.getFullYear();
    // time2 = date2.getTime();
    // result = month2-month;
    // var ans = Math.trunc(result/2592000000);
    // $('#monthsDiff').val(result);

    var date1 = new Date($('#from_date').val());
    var date2 = new Date($('#to_date').val());
    var diffYears = date2.getFullYear()-date1.getFullYear();
    var diffMonths = date2.getMonth()-date1.getMonth();
    var diffDays = date2.getDate()-date1.getDate();

    var months = Math.trunc(diffYears*12 + diffMonths);
    if(diffDays>0) {
      months += '.'+diffDays;
    } else if(diffDays<0) {
      months--;
      months += '.'+(new Date(date2.getFullYear(),date2.getMonth(),0).getDate()+diffDays);
    }

    $('#monthsDiff').val(months);


  });

  function compute()
  {
    total_loan= $('#payable_loan').val() / $('#monthsDiff').val();
    $('#monthly_payment').val(total_loan);
  }



</script>



