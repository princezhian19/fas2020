
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
            <h1 align="">&nbspUpdate Employee Number According to FAS Emp No. </h1>
            <div class="box-header with-border">
            </div>
            <br>
            <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="100">Name</th>
                        <th width="100">Emp. No.</th>
                    </tr>
                </thead>
                <?php 
                $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM tblemployeeinfo  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $emp_no = $row["EMP_NUMBER"];
                    $l_name = $row["LAST_M"];  
                    $f_name = $row["FIRST_M"];
                    $m_name = $row["MIDDLE_M"];
                    $full_name = $f_name . ' ' . $m_name . ' ' . $l_name. ' ' .$ext_name;
                    

                    echo "<tr align = ''>
                    <td><a href='UpdatePayrollEmp.php?id=$id ' style='text-decoration: underline;'>$full_name</a></td>
                    <td>$emp_no</td>
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



