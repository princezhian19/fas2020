<?php 
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$date_loan = $_GET['date_loan'];

function province($connect)
{ 
  $output = '';
  $query = "SELECT LGU_M FROM `tbl_province`";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["LGU_M"].'">'.$row["LGU_M"].'</option>';
}
return $output;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Payroll System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewGeneratePayroll.php" style="color:white;text-decoration: none;">Back</a></li>
            <br>
            <br>
            <form>
              <div class="col-md-3">
                <select class="form-control select2" style="width: 100%;" name="station"  id="station">
                  <option>Select Station</option>
                  <?php echo province($connect);?>
              </select>
          </div>
          <a href="javascript:void(0);" class="btn btn-primary link" data-id="<?php echo $date_loan?>">Export Ledger</a> | <a href="javascript:void(0);" class="btn btn-success link2" data-id="<?php echo $date_loan?>">Export Payslip</a> | 
          <a href="export_summary.php?date_loan=<?php echo $date_loan?>" class="btn btn-info" >Export Summary of Deduction</a>
      </form>
      <br>
      <br>

      <table id="example1" class="table table-striped table-bordered " style="width:;background-color: white;">
        <thead>
            <tr style="background-color: white;color:blue;">
                <th width="100">Full Name</th>
                <th width="100">Position</th>
                <th width="50">Gross Salary</th>
                <th width="50">BIR Tax</th>
                <th width="50">Life Retirement</th>
                <th width="50">Philhealth</th>
                <th width="50">pagibig_premium</th>
                <th width="50">pagibig_mp2</th>
                <th width="50">Optional Premium</th>
                <th width="50">Consolidated Loan</th>
                <th width="50">Policy Regular Loan</th>
                <th width="50">Educational Assistance Loan</th>
                <th width="50">Emergency Calamity Loan</th>
                <th width="50">Multipurpose Loan</th>
                <th width="50">Pag-ibig Housing</th>
                <th width="50">Calamity Loan</th>
                <th width="50">AMSWLAI</th>
                <th width="50">National Home Mortgage Finance Corporation</th>
                <th width="50">Credit Cooperative Union Inc.</th>
                <th width="50">Provinces</th>
                <th width="50" hidden>Option</th>
            </tr>
        </thead>
        <?php 
        $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
        $view_query = mysqli_query($conn, "SELECT tds.id,te.emp_no,te.full_name,te.station,te.designation,td.monthly_salary,td.bir,td.rlip,td.philhealth,td.pera,td.rata,td.pagibig_premium,td.pagibig_mp2,tds.consolidated_loan,tds.optional_premium,tds.policy_regular_loan,tds.educational_assistance_loan,tds.emergency_calamity_loan,tds.multi_purpose_loan,tds.pag_ibig_housing,tds.calamity_loan,tds.amswlai,tds.credit_union,tds.national_home FROM tbl_deduction_loans_history tds LEFT JOIN tbl_employee te on te.emp_no = tds.emp_no LEFT JOIN tbl_deductions td on td.emp_no = tds.emp_no WHERE tds.date_loan = '$date_loan' ");



        while ($row = mysqli_fetch_assoc($view_query)) {
            $id = $row["id"];
            $full_name = $row["full_name"];  
            $designation = $row["designation"];
            $emp_no = $row["emp_no"];
            $pera = $row["pera"];
            $monthly_salary = $row["monthly_salary"];
            $bir = $row["bir"];
            $rlip = $row["rlip"];
            $philhealth = $row["philhealth"];
            $pagibig_premium = $row["pagibig_premium"];
            $pagibig_mp2 = $row["pagibig_mp2"];
            $optional_premium = $row["optional_premium"];
            $consolidated_loan = $row["consolidated_loan"];
            $policy_regular_loan = $row["policy_regular_loan"];
            $educational_assistance_loan = $row["educational_assistance_loan"];
            $emergency_calamity_loan = $row["emergency_calamity_loan"];
            $multi_purpose_loan = $row["multi_purpose_loan"];
            $pag_ibig_housing = $row["pag_ibig_housing"];
            $calamity_loan = $row["calamity_loan"];
            $amswlai = $row["amswlai"];
            $national_home = $row["national_home"];
            $credit_union = $row["credit_union"];
            $station = $row["station"];

            

            echo "<tr align = ''>
            <td>$full_name</td>
            <td>$designation</td>
            <td>$monthly_salary</td>
            <td>$bir</td>
            <td>$rlip</td>
            <td>$philhealth</td>
            <td>$pagibig_premium</td>
            <td>$pagibig_mp2</td>
            <td>$optional_premium</td>
            <td>$consolidated_loan</td>
            <td>$policy_regular_loan</td>
            <td>$educational_assistance_loan</td>
            <td>$emergency_calamity_loan</td>
            <td>$multi_purpose_loan</td>
            <td>$pag_ibig_housing</td>
            <td>$calamity_loan</td>
            <td>$amswlai</td>
            <td>$national_home</td>
            <td>$credit_union</td>
            <td>$station</td>
            <td ><a href='tcpdf/examples/payslip2.php?id=$id&date_loan=$date_loan' class='btn btn-info'>Generate Payslip</a></td>
            </tr>"; 
        }
        echo "</table>";
        ?>
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
<script>
  $(document).ready(function(){
    $('.link').click(function(){
      var f = $(this);
      var id = f.data('id');
      var station = $('#station').val();
      window.location = 
      'export_loan_ledger.php?date_loan='+id+'&station='+station;
  });
}) ;
</script>

<script>
  $(document).ready(function(){
    $('.link2').click(function(){
      var f = $(this);
      var id = f.data('id');
      var station = $('#station').val();
      window.location = 
      'pdf/examples/payslip.php?date_loan='+id+'&station='+station;
  });
}) ;
</script>


</div>
</div>
<div class="panel-footer"></div>
</div>
</div>
</body>
</html>



