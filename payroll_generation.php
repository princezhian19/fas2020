<?php 
error_reporting(0);
ini_set('display_errors', 0);
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

if (isset($_POST['generate'])) {

    $date_generate = $_POST['date_generate'];
    $date_formated = date("M Y", strtotime($date_generate));

    $validate = mysqli_query($conn,"SELECT emp_no FROM tbl_deduction_loans_history WHERE date_loan = '$date_formated' ");

    if (mysqli_num_rows($validate) > 0 ) {
     echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Already Have Existing Ledger! </p> </div></div>  ';
 }else{

    $insert_loan_history = mysqli_query($conn,"INSERT INTO tbl_loan_history(emp_no,loan_name,loan_balance,monthly_payment,date_history) SELECT emp_no,loan_name,loan_balance,monthly_payment,'$date_formated' FROM tbl_loan WHERE remaining_payment_count > 0");

    $update_computations = mysqli_query($conn,"UPDATE tbl_loan tl lEFT JOIN tbl_employee te on te.emp_no = tl.emp_no SET tl.initial_payment_count = tl.initial_payment_count + 1 WHERE tl.remaining_payment_count > 0  AND te.status = 0");
    $update_computations2 = mysqli_query($conn,"UPDATE tbl_loan tl lEFT JOIN tbl_employee te on te.emp_no = tl.emp_no SET tl.loan_balance = tl.payable_loan - (tl.monthly_payment * tl.initial_payment_count) WHERE tl.remaining_payment_count > 0 AND te.status = 0");
    $update_computations3 = mysqli_query($conn,"UPDATE tbl_loan tl lEFT JOIN tbl_employee te on te.emp_no = tl.emp_no  SET  tl.remaining_payment_count = tl.remaining_payment_count -1  WHERE tl.remaining_payment_count > 0  AND te.status = 0");

    $history_loans = mysqli_query($conn,"INSERT INTO tbl_deduction_loans_history (emp_no,consolidated_loan,optional_premium,policy_regular_loan,optional_policy_loan,educational_assistance_loan,rel,emergency_calamity_loan,multi_purpose_loan,pag_ibig_housing,calamity_loan,amswlai,credit_union,national_home,date_loan,station) SELECT emp_no,consolidated_loan,optional_premium,policy_regular_loan,optional_policy_loan,educational_assistance_loan,rel,emergency_calamity_loan,multi_purpose_loan,pag_ibig_housing,calamity_loan,amswlai,credit_union,national_home,'$date_formated',station FROM tbl_deduction_loans ");

    $select = mysqli_query($conn,"SELECT emp_no FROM tbl_deduction_loans_history WHERE date_loan = '$date_formated' ");

    while ($row = mysqli_fetch_assoc($select)) {

        $emp_no1 = $row['emp_no'];
        $update2 = mysqli_query($conn,"UPDATE tbl_employee SET date_generated = '$date_formated' WHERE emp_no = '$emp_no1'  ");

    }


    $no_loan = mysqli_query($conn,"INSERT INTO tbl_deduction_loans_history (emp_no,date_loan,station) SELECT emp_no,'$date_formated',station FROM tbl_employee WHERE date_generated IS NULL");

    $udpate_station = mysqli_query($conn,"UPDATE tbl_deduction_loans_history tdl LEFT JOIN tbl_employee te on te.emp_no = tdl.emp_no SET tdl.station = te.station WHERE tdl.emp_no = te.emp_no");

    $loan_ledger = mysqli_query($conn,"INSERT INTO tbl_loan_ledger(date_loan) VALUES('$date_formated')");

    echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Payroll Generation Success! </p> </div></div>  ';

    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Payroll Generation Success!');
      window.location.href='ViewGeneratePayroll.php';
      </SCRIPT>");
}

}

// if (isset($_POST['revert'])) {

//     $date_generate = $_POST['date_generate'];
//     $date_formated = date("M Y", strtotime($date_generate));

//     $validate = mysqli_query($conn,"SELECT emp_no FROM tbl_deduction_loans_history WHERE date_loan = '$date_formated' ");
    
//     if (mysqli_num_rows($validate) > 0 ) {
     
//         $unset_date = mysqli_query($conn,"UPDATE tbl_employee SET date_generated = NULL WHERE date_generated = '$date_formated' ");
        
//         $update_computations = mysqli_query($conn,"UPDATE tbl_loan SET initial_payment_count = initial_payment_count - 1 WHERE remaining_payment_count > 0 ");

//         $update_computations2 = mysqli_query($conn,"UPDATE tbl_loan SET loan_balance = payable_loan + (monthly_payment * initial_payment_count) WHERE remaining_payment_count > 0");
//         $update_computations3 = mysqli_query($conn,"UPDATE tbl_loan  SET  remaining_payment_count = remaining_payment_count + 1  WHERE remaining_payment_count > 0 ");

//         $delete_data = mysqli_query($conn,"DELETE FROM tbl_loan_history WHERE date_history = '$date_formated' ");

//         $delete_history = mysqli_query($conn,"DELETE FROM tbl_deduction_loans_history WHERE date_loan = '$date_formated' ");

//         $delete_ledger = mysqli_query($conn,"DELETE FROM tbl_loan_ledger WHERE date_loan = '$date_formated' ");

//     // echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Payroll Generation Deleted!  '; 
//         echo $date_formated;
//         echo '</p> </div></div> ';
//         echo ("<SCRIPT LANGUAGE='JavaScript'>
//           window.alert('Success : Payroll Generation Success!');
//           window.location.href='ViewGeneratePayroll.php';
//           </SCRIPT>");
//     }else{
//         echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> There is no Data For this Month!  '; 


//     }
// }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Payroll System</title>
</head>
<body>

    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="table-responsive">
            <br>
            <h1 align="">&nbspLoans Table</h1>
            <div class="box-header with-border ">
            </div>
            &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewEmployee.php" style="color:white;text-decoration: none;">Back</a></li>
            <br>
            <br>
            <form method="POST">
                <input type="date" class="form-control" style="width:170px; float: left;" name="date_generate">
                &nbsp &nbsp &nbsp<button class="btn btn-primary " onclick="return confirm('Are you sure you want to generate now?');"   type="submit" name="generate">Generate Payroll</button>
                <!-- &nbsp &nbsp &nbsp<button class="btn btn-info " onclick="return confirm('Are you sure you want to revert?');"   type="submit" name="revert">Revert Generate Payroll</button> -->
            </form>
            <br>
            <br>
            <table id="example1" class="table table-striped table-bordered " style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;" >
                        <th >Details</th>
                        <th>Option</th>

                    </tr>
                </thead>
               <?php 
                $view_query = mysqli_query($conn, "SELECT * FROM tbl_loan_ledger");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $date_loan = $row["date_loan"];  
                    ?>
                    <tr>
                    <td>Loan Ledger For this Month and Year : <?php echo $date_loan?></td>
                    <td><a href='ViewLoanLedger.php?date_loan=<?php echo $date_loan?>' class='btn btn-primary'>View Ledger</a>
                    <a onclick="return confirm('Are you sure you want to revert?');"  href='revert.php?date_loan=<?php echo $date_loan?>' class='btn btn-info'>Revert Ledger</a></td>
                </tr>
            <?php } ?>
            </table>
            <div style="padding: 18px;">
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
</body>
</html>



