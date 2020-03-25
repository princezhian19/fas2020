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
            <h1 align="">&nbspReport On The Physical Count Of Inventories</h1>

            <div class="box-header with-border">
            </div>
            <br>

            &nbsp<li class="btn btn-success"><a href="CreateRPCI.php" style="color:white;text-decoration: none;">Create</a></li>
            <br>
            <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="0"></th>
                        <th>Ariticle</th>
                        <th>Description</th>
                        <th>Stock No.</th>
                        <th>Unit of Measure</th>
                        <th>Unit Value</th>
                        <th>Balance Per Card</th>
                        <th>On Hand Per Count</th>
                        <th>Shortage(Quantity)</th>
                        <th>Shortage(Value)</th>
                        <th>Remarks</th>
                        <th width="0"></th>
                        <th width="0"></th>
                        <th width="0"></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM rpci ORDER BY id DESC");

                while ($row = mysqli_fetch_assoc($view_query)) {

                    $id = $row["id"];
                    $article = $row["article"];  
                    $description = $row["description"];
                    $stock_number = $row["stock_number"];
                    $unit = $row["unit"];
                    $amount = $row["amount"];
                    $bpc = $row["bpc"];
                    $opc = $row["opc"];
                    $shortage_Q = $row["shortage_Q"];
                    $shortage_V = $row["shortage_V"];
                    $remarks = $row["remarks"];

                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $article;?></td>
                        <td><?php echo $description;?></td>
                        <td><?php echo $stock_number;?></td>
                        <td><?php echo $unit;?></td>
                        <td><?php echo $amount;?></td>
                        <td><?php echo $bpc;?></td>
                        <td><?php echo $opc;?></td>
                        <td><?php echo $shortage_Q;?></td>
                        <td><?php echo $shortage_V;?></td>
                        <td><?php echo $remarks;?></td>
                        <td>
                         <!--  &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=<?php echo $id; ?>' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='UpdateRPCI.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>

                     </td>
                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
                <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_rpci.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>

                    </td>
                    <td></td>

                    
                </tr>
            <?php } ?>
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



