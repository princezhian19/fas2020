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
<div class="box">
  <div class="box-body">
        <div class=""> 
          <div class="">
           
            <h1 align="">Report On The Physical Count Of Inventories</h1>

            <div class="box-header">
            </div>
        

            <li class="btn btn-success"><a href="CreateRPCI.php" style="color:white;text-decoration: none;">Create</a></li>
            <br>
            <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                     
                        <th>ARTICLE</th>
                        <th width = "200">DESCRIPTION</th>
                        <th width = "200">STOCK NO.</th>
                        <th width = "200">UNIT OF MEASURE</th>
                        <th>UNIT VALUE</th>
                        <th>BALANCE PER CARD</th>
                        <th>ON HAND PER COUNT</th>
                        <th width = "200">SHORTAGE(QUANTITY)</th>
                        <th width = "200">SHORTAGE(VALUE)</th>
                        <th>REMARKS</th>
                        <th width = "200">ACTION</th>
                       
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
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

                       <a  href='UpdateRPCI.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>

                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
              
                   <a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_rpci.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>

                    </td>
                  

                    
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



