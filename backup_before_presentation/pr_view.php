<?php
$conn=mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$purpose = $row['purpose'];
$pr_date = $row['pr_date'];
?>

<html>
<head>
  <title>View PR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border" align="left">
                <div class="col-md-11">
                    <h1>Purchase Request No. &nbsp <?php echo $pr_no;?></h1>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                   <a href="ViewRFQdetails.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
                   <a href="export_pr.php?id=<?php echo $id; ?>" class="btn btn-success">Export</a>
                   <a href="ViewPR.php" class="btn btn-warning">Cancel</a>


                   <h4>Item(s)</h4>
                   <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Unit Cost</th>
                            <th>Cost Per Item</th>
                        </tr>
                    </thead>
                    <?php 
                    $view_query = mysqli_query($conn, "SELECT pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                        $id = $row["id"];
                        $items = $row["procurement"];  
                        $unit = $row["item_unit_title"];
                        $qty = $row["qty"];
                        $abc = $row["abc"];

                        $total_cost = $qty * $abc;
                        echo "<tr align = ''>
                        <td>$items</td>
                        <td>$qty</td>
                        <td>$unit</td>
                        <td>$abc</td>
                        <td>$total_cost</td>
                        </tr>"; 
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="col-md-4">


    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>PR Details</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                    <tr>
                        <th>PMO:</th>
                        <td><?php echo $pmo;?></td>
                    </tr>
                    <tr>
                        <th>PR Date:</th>
                        <td><?php echo $pr_date;?></td>
                    </tr>
                    <tr>
                        <th>Purpose:</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                     <tr>
                        <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                      while ($row = mysqli_fetch_assoc($view_query1)) {
                        $abc1 = $row["aa"];
                                }
                        ?>
                        <th>Total Cost:</th>
                        <td><?php echo number_format($abc1,2);?></td>
                    </tr>
                </table>


            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>


