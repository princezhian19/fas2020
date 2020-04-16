<?php 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$select_rcppe = mysqli_query($conn,"SELECT * FROM rpcppe WHERE id = '$id' ");
$row_ppe = mysqli_fetch_array($select_rcppe);
$property_number1 = $row_ppe['property_number'];
$select = mysqli_query($conn,"SELECT * FROM par_assign WHERE ppe_id = '$id' ");
$select2 = mysqli_query($conn,"SELECT * FROM par_history WHERE ppe_id = '$id' ORDER BY id DESC ");
$row = mysqli_fetch_array($select);
$name = $row['name'];
$position = $row['position'];
$office = $row['office'];
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
                    <h1>Property No. &nbsp <?php echo $property_number1;?></h1>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                    <a href="UpdateRPCPPE.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
                   <?php if (empty($name)): ?>
                       <a href="Assign_PAR.php?id=<?php echo $id; ?>" class="btn btn-success">Assign Par</a>
                       <?php else: ?>
                           <a href="Reassign_PAR.php?id=<?php echo $id; ?>" class="btn btn-success">Re-Assign Par</a>
                       <?php endif ?>
                       <a href="export_par_receipt.php?id=<?php echo $id;?>" class="btn btn-warning">Par Receipt</a>
                       <a href="tcpdf/examples/par_sticker.php?id=<?php echo $id;?>" class="btn btn-info">Par Sticker</a>
                       <a href="export_pc.php?id=<?php echo $id;?>" class="btn btn-success">Export PC</a>


                       <h4>Item(s)</h4>
                       <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                        <thead>
                            <tr style="background-color: white;color:blue;">
                                <th>End User(s)</th>
                                <th>Acquired Date</th>
                                <th>Position</th>
                                <th>Office</th>
                            </tr>
                        </thead>
                        <?php 
                        while ($row = mysqli_fetch_assoc($select2)) {
                            $nameE = $row["name"];  
                            $acquired_dateE = $row["par_date"];
                            $positionN = $row["position"];
                            $officeE = $row["office"];

                            echo "<tr align = ''>
                            <td>$nameE</td>
                            <td>$acquired_dateE</td>
                            <td>$positionN</td>
                            <td>$officeE</td>
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
                <h4>PPE Details</h4>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                    <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                        <tr>
                            <th>Current User:</th>
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td><?php echo $position;?></td>
                        </tr>
                        <tr>
                            <th>Office:</th>
                            <td><?php echo $office;?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


