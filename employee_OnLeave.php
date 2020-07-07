<?php 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if (isset($_POST['retire'])) {
    $id = $_POST['id'];
    foreach ($id as $ids) { 
        $update = mysqli_query($conn,"UPDATE tbl_employee SET status = 1 WHERE id = '$ids' ");
        echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Success : Profile Successfuly Retire!');
          window.location.href='ViewOnLeaveEmployee.php';
          </SCRIPT>");
    }
}

if (isset($_POST['resign'])) {
    $id = $_POST['id'];
    foreach ($id as $ids) { 
        $update = mysqli_query($conn,"UPDATE tbl_employee SET status = 2 WHERE id = '$ids' ");
          echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Success : Profile Successfuly Resign!');
          window.location.href='ViewOnLeaveEmployee.php';
          </SCRIPT>");
    }
}

if (isset($_POST['leave'])) {
    $id = $_POST['id'];
    foreach ($id as $ids) { 
        $update = mysqli_query($conn,"UPDATE tbl_employee SET status = 0 WHERE id = '$ids' ");
          echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Success : Profile Successfuly Retire!');
          window.location.href='ViewOnLeaveEmployee.php';
          </SCRIPT>");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    foreach ($id as $ids) { 
        // $update = mysqli_query($conn,"UPDATE tbl_employee SET status = 3 WHERE id = '$ids' ");
        $select = mysqli_query($conn,"SELECT emp_no FROM tbl_employee WHERE id = '$ids' ");
        $row = mysqli_fetch_array($select);
        $emp_no = $row['emp_no'];
        $delete2 = mysqli_query($conn,"DELETE FROM tbl_deductions WHERE emp_no = '$emp_no' ");
        $delete2 = mysqli_query($conn,"DELETE FROM tbl_deduction_loans WHERE emp_no = '$emp_no' ");
        $delete = mysqli_query($conn,"DELETE FROM tbl_employee WHERE id = '$ids' ");
          echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Success : Profile Successfuly Deleted!');
          window.location.href='ViewOnLeaveEmployee.php';
          </SCRIPT>");
    }
}

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
            <h1 align="">&nbspOn Leave Employee List</h1>
            <div class="box-header with-border">
            </div>
            <br>
            <!-- &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreateNewEmployee.php" style="color:white;text-decoration: none;">New Employee</a></li> -->
            <!-- <br> -->
            <!-- <br> -->
            <form method="POST">
                <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="50"></th>
                            <th width="100">Last Name</th>
                            <th width="100">First Name</th>
                            <th width="100">Middle Name</th>
                            <th width="50">Suffix</th>
                            <th width="100">Position</th>
                            <th width="100">Years in Service</th>
                            <th width="100">BIR Tax</th>
                            <th width="100">Life Retirement</th>
                            <th width="100">Philhealth</th>
                            <th width="100">Pagibig Premium</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <?php 
                    $view_query = mysqli_query($conn, "SELECT te.id,te.l_name,te.f_name,te.m_name,te.ext_name,te.designation,te.employment_date,td.bir,td.rlip,td.philhealth,td.pagibig_premium FROM tbl_employee te LEFT JOIN tbl_deductions td on te.emp_no = td.emp_no WHERE te.status = 3 order by te.l_name ASC ");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                        $id = $row["id"];
                        $l_name = $row["l_name"];  
                        $f_name = $row["f_name"];
                        $m_name = $row["m_name"];
                        $ext_name = $row["ext_name"];
                        $designation = $row["designation"];
                        $employement_date = $row["employment_date"];
                        $rlip = $row["rlip"];
                        $rlipA = number_format($rlip,2);
                        $bir = $row["bir"];
                        $birA = number_format($bir);
                        $philhealth = $row["philhealth"];
                        $philhealthA = number_format($philhealth,2);
                        $pagibig_premium = $row["pagibig_premium"];
                        $pagibig_premiumA = number_format($pagibig_premium,2);

                        $emp_date = date('Y-m-d', strtotime($employement_date));
                        $date_now = date('Y-m-d');
                        $years_rendered = $date_now - $emp_date;


                        echo "<tr align = ''>
                        <td align='center'><input type='checkbox' name='id[]' value='$id'></input></td>
                        <td>$l_name</td>
                        <td>$f_name</td>
                        <td>$m_name</td>
                        <td>$ext_name</td>
                        <td>$designation</td>
                        <td>$years_rendered Years</td>
                        <td>$birA</td>
                        <td>$rlipA</td>
                        <td>$philhealthA</td>
                        <td>$pagibig_premium</td>
                        <td><a href= 'ViewEmpLoan.php?id=$id' class='btn btn-info'>View Loans </a></td>


                        </tr>"; 
                    }
                    echo "</table>";

                    ?>
                <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=$id' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                    
                    </td>
                     <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
            </table>
            <!-- <input class="btn btn-danger" type="submit" name="delete" >Delete</input> -->
            <div style="padding: 18px;" >
             <button class="btn btn-danger "   type="submit" name="delete">Delete</button> Or  <button class="btn btn-primary "   type="submit" name="retire">Retire</button> Or  <button class="btn btn-warning "   type="submit" name="resign">Resign</button> Or <button class="btn btn-info "   type="submit" name="resign">Revert to Employee</button> 
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

    <!-- <div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
</div> -->

<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



