<?php 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT * FROM app WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$procurement = $row['procurement'];
$app_id = $row['id'];
?>
<html>
<head>
  <title>View PR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border" align="left">
                <div class="col-md-11">
                    <h1>APP ITEM : <?php echo $procurement;?></h1>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                   <a class="btn btn-success" href="ViewApp.php">Back</a>


                   <h4>Item(s)</h4>
                   <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th>PR No.</th>
                            <th>PO No.</th>
                            <th>PO Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <?php 
                    $view_query = mysqli_query($conn, "SELECT DISTINCT pr.items,po.po_no,po.po_date,pr.abc,pr.pr_no FROM app 
                        LEFT JOIN pr_items pr on pr.items = app.id 
                        LEFT JOIN rfq on rfq.pr_no = pr.pr_no
                        LEFT JOIN selected_quote sq on sq.rfq_id = rfq.id
                        LEFT JOIN po on po.id = sq.po_id
                        WHERE pr.items = $app_id ");

                    while ($row = mysqli_fetch_assoc($view_query)) {
                        // $id = $row["id"];
                        $pr_no = $row["pr_no"];
                        $po_no = $row["po_no"];
                        $po_date = $row["po_date"];
                        $abc = $row["abc"];

                        echo "<tr align = ''>
                        <td>$pr_no</td>
                        <td>$po_no</td>
                        <td>$po_date</td>
                        <td>$abc</td>
                        </tr>"; 
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>




</body>
</html>


