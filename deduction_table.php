
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
            <h1 align="">&nbspManage Allowances, Tax and Personal Shares</h1>
            <div class="box-header with-border">
            </div>
            <br>
            <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="100">Name</th>
                        <th width="100">Emp. No.</th>
                        <th width="100">BIR Tax</th>
                        <th width="50">RLIP</th>
                        <th width="100">PAGIBIG Premium</th>
                        <th width="100">PAGIBIG MP2 Savings</th>
                        <th width="100">Philhealth</th>
                        <th width="100">PERA</th>
                        <th width="100">RATA</th>
                    </tr>
                </thead>
                <?php 
                $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT td.id,te.LAST_M,te.FIRST_M,te.MIDDLE_M,te.SUFFIX,te.EMP_NUMBER,td.bir,td.rlip,td.pagibig_premium,td.pagibig_mp2,td.philhealth,td.pera,td.rata FROM tblemployeeinfo te LEFT JOIN tbl_deductions td on td.emp_no = te.EMP_NUMBER WHERE te.EMP_NUMBER != '' ORDER BY te.LAST_M ASC  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $emp_no = $row["EMP_NUMBER"];
                    $l_name = $row["LAST_M"];  
                    $f_name = $row["FIRST_M"];
                    $m_name = $row["MIDDLE_M"];
                    $ext_name = $row["SUFFIX"];
                    $bir = $row["bir"];
                    $birA = number_format($bir,2);
                    $rlip = $row["rlip"];
                    $rlipA = number_format($rlip,2);
                    $pagibig_premium = $row["pagibig_premium"];
                    $pagibig_premiumA = number_format($pagibig_premium,2);
                    $pagibig_mp2 = $row["pagibig_mp2"];
                    $pagibig_mp2A = number_format($pagibig_mp2,2);
                    $philhealth = $row["philhealth"];
                    $philhealthA = number_format($philhealth,2);
                    $pera = $row["pera"];
                    $peraA =number_format($pera,2);
                    $rata = $row["rata"];
                    $rataA = number_format($rata,2);

                    $full_name = $f_name . ' ' . $m_name . ' ' . $l_name. ' ' .$ext_name;

                    echo "<tr align = ''>
                    <td><a href='ViewEditAllowance.php?id=$id ' style='text-decoration: underline;'>$full_name</a></td>
                    <td>$emp_no</td>
                    <td>$birA</td>
                    <td>$rlipA</td>
                    <td>$pagibig_premiumA</td>
                    <td>$pagibig_mp2A</td>
                    <td>$philhealthA</td>
                    <td>$peraA</td>
                    <td>$rataA</td>

                    
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

    <!-- <div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
</div> -->

<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



