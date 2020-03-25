<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>


<!DOCTYPE html>
<html>
<head>
  <title>Asset Management System</title>


</head>
<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            <h1 align="">&nbspPurchase Request</h1>
    <div class="box-header with-border">
    </div>
    <br>

      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreatePR.php" style="color:white;text-decoration: none;">Create</a></li>
      <br>
      <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="0"></th>
                        <th>PR NUMBER</th>
                        <th>PMO</th>
                        <th>PURPOSE</th>
                        <th>PR DATE</th>
                        <th>&nbsp</th>
                        <th>&nbsp</th>
                        <th width="0"></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM pr order by id DESC  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];  
                    $pmo = $row["pmo"];
                    $purpose = $row["purpose"];
                    $pr_date = $row["pr_date"];
                    
                    echo "<tr align = ''>
                    <td></td>
                    <td>$pr_no</td>
                    <td>$pmo</td>
                    <td>$purpose</td>
                    <td>$pr_date</td>
                    <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=$id' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                    
                    </td>
                     <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                    </td>
                    <td></td>

                    
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



