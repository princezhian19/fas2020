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
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th>ARTICLE</th>
                        <th width = "200">DESCRIPTION</th>
                        <th width = "200">STOCK NO.</th>
                        <th width = "100">UNIT OF MEASURE</th>
                        <th>UNIT VALUE</th>
                        <th>BALANCE PER CARD</th>
                        <th>ON HAND PER COUNT</th>
                        <th width = "100">SHORTAGE(QUANTITY)</th>
                        <th width = "100">SHORTAGE(VALUE)</th>
                        <th>REMARKS</th>
                        <th>OFFICE</th>
                        <th width = "">ACTION</th>
                        <th width = ""></th>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM rpci ORDER BY office ASC");
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
                    $office = $row["office"];
                    ?>
                    <tr>
                        <td><?php echo $article;?></td>
                        <td><?php echo $description;?></td>
                        <td><?php echo $stock_number;?></td>
                        <td><?php echo $unit;?></td>
                        <td><?php echo number_format($amount,2);?></td>
                        <td><?php echo $bpc;?></td>
                        <td><?php echo $opc;?></td>
                        <td><?php echo $shortage_Q;?></td>
                        <td><?php echo $shortage_V;?></td>
                        <td><?php echo $remarks;?></td>
                        <td><?php echo $office;?></td>
                        <td>
                       <a  href='UpdateRPCI.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf06e;</i> Edit</a> 
                        </td>
                        <td>
                        <a  onclick="return confirm('Are you sure you want to Delete this item?');" class="btn btn-danger btn-xs" href='delete_rpci.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i  class='fa fa-trash-o' ></i> Delete</a>
                        </td>
                  

                    
                </tr>
            <?php } ?>
        </table>


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



