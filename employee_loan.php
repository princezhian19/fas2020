<?php 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if (isset($_POST['stop'])) {
    $id = $_POST['id'];

        $update = mysqli_query($conn,"UPDATE tbl_loan SET status = 1 WHERE id = '$id' ");
        // $trans = mysqli_query($conn,"INSERT INTO tbl_loan_stop (emp_no,loan_name,loan_amount,created_date) SELECT emp_no,loan_name,loan_amount,from_date FROM tbl_loan WHERE id = '$id' AND status = 1 ");
        $select = mysqli_query($conn,"SELECT emp_no,loan_name FROM tbl_loan  WHERE id = '$id' ");
        $row1 = mysqli_fetch_array($select);
        $emp_no1 = $row1['emp_no'];
        $loan_name1 = $row1['loan_name'];
        $update_deductions = mysqli_query($conn,"UPDATE tbl_deduction_loans SET $loan_name1 = 0 WHERE emp_no = '$emp_no1' ");


echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Loan Successfuly Stop! </p> </div></div>  ';

}

                    $id = $_GET['id'];
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
          <div class="">
            <br>
            <h1 align="">&nbspLoans Table</h1>
            <div class="box-header with-border">
            </div>
            <br>
            &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewEmployee.php" style="color:white;text-decoration: none;">Back</a></li>
            &nbsp &nbsp<li class="btn btn-default"><?php echo '<a href="CreateLoans.php?id='.$id.'" style="color:black;text-decoration: none;">Create Loans</a>'?></li>

            <br>
            <br>
            <form method="POST">
                <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="50"></th>
                            <th width="100">Full Name</th>
                            <th width="100">Loan Name</th>
                            <th width="100">Start Date</th>
                            <th width="100">End Date</th>
                            <th width="100">Monthly_payment</th>
                            <th width="100">Loan Amount</th>
                            <th width="100">Payable Loan Amount</th>
                            <th width="100">Loan Balance</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <?php 
                    $sel = mysqli_query($conn,"SELECT emp_no FROM tbl_employee WHERE id = '$id'");
                    $rowsel = mysqli_fetch_array($sel);
                    $emp_no = $rowsel['emp_no'];
                    $view_query = mysqli_query($conn, "SELECT tl.id,te.full_name,tl.emp_no,tl.loan_name,tl.from_date,tl.to_date,tl.payable_loan,tl.monthly_payment,tl.loan_amount,tl.loan_balance FROM tbl_employee te LEFT JOIN tbl_loan tl   on te.emp_no = tl.emp_no WHERE tl.emp_no = '$emp_no' and tl.status = 0");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                        $idd = $row["id"];
                        $full_name = $row["full_name"];  
                        $loan_name = $row["loan_name"];
                        $from_date = $row["from_date"];
                        $to_date = $row["to_date"];
                        $payable_loan = $row["payable_loan"];
                        $monthly_payment = $row["monthly_payment"];
                        $loan_amount = $row["loan_amount"];
                        $loan_balance = $row["loan_balance"];

                        echo "<tr align = ''>
                        <td align='center'><input type='checkbox' name='id' value='$idd'></input></td>
                        <td>$full_name</td>
                        <td>$loan_name</td>
                        <td>$from_date</td>
                        <td>$to_date</td>
                        <td>$payable_loan</td>
                        <td>$monthly_payment</td>
                        <td>$loan_amount</td>
                        <td>$loan_balance</td>
                        <td><a href='ViewEmpLoan2.php?id=$idd&id2=$id' class='btn btn-info'>View Loan </a></td>
                        </tr>"; 
                    }
                    echo "</table>";

                    ?>
            </table>
            <div style="padding: 18px;">
                <button class="btn btn-danger "   type="submit" name="stop" onclick="return confirm('Are you sure you want to Stop Loan?');" >Stop Loan</button>
            </div>
        </form>
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



