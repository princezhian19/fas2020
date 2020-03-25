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
            <h1 align="">&nbspStocks</h1>
    <div class="box-header with-border">
    </div>
    <br>

      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreateStocks.php" style="color:white;text-decoration: none;">Update Stocks</a></li>
      <br>
      <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <!-- <th width="0"></th>
                        
                        <th width="800">NO.</th>
                        <th width="800">ITEMS</th>
                        <th width="800">UNIT</th>
                        <th width="800">BALANCE BEFORE</th>
                        <th width="800">DELIVERY</th>
                        <th width="800">AVAILABLE BALANCE</th>
                        <th width="800">ISSUE MONTH</th>
                        <th width="800">BALANCE AFTER</th>
                        <th width="800">CURRENT PRICE</th> -->
                        <th width="100"></th>
                        <th width="800">STOCK NO.</th>
                        <th width="800">ITEMS</th>
                        <th width="800">UNIT OF MEASUREMENT</th>
                        <th width="800">BALANCE BEFORE</th>
                        <th width="800">DELIVERY</th>
                        <th width="800">AVAILABLE BALANCE</th>
                        <th width="800">ISSUE MONTH</th>
                        <th width="800">BALANCE AFTER</th>
                        <th width="800">CURRENT PRICE</th>


                        <th>&nbsp</th>
                        <!-- <th width="0"></th> -->
                        <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='UpdateStocks.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                    </td> -->
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM old_stock group by sn order by id asc  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $code = $row["code"];
                  $items = $row["items"];
                  $sn = $row["sn"];
                  $unit = $row["unit"];
                  $balanceone = $row["one"];
                  $one = $row["one"];
                  $delivery = $row["delivery"];
                  $avail_balance = $row["avail_balance"];
                  $issue_month = $row["issue_month"];
                  $balancetwo = $row["two"];
                  $two = $row["two"];
                  $current_price = $row["current_price"];
                

                
                    
                    echo "<tr align = ''>
                    <td></td>
                    <td>$sn</td>
                    <td>$items</td>
                    <td>$unit</td>
                    <td>$balanceone</td>
                    <td>$delivery</td>
                    <td>$avail_balance</td>
                    <td>$issue_month</td>
                    <td>$balancetwo</td>
                    <td>$current_price</td>
                    
                     
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
<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



