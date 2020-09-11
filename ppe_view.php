<?php 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$select_rcppe = mysqli_query($conn,"SELECT * FROM rpcppe WHERE id = '$id' ");
$row_ppe = mysqli_fetch_array($select_rcppe);
$property_number1 = $row_ppe['property_number'];
$select = mysqli_query($conn,"SELECT * FROM par_assign WHERE ppe_id = '$id' ");
$select2 = mysqli_query($conn,"SELECT concat(te.FIRST_M,' ',te.MIDDLE_M,' ',te.LAST_M) AS name,tp2.DIVISION_M,tp.POSITION_M,ph.par_date FROM par_history ph LEFT JOIN tblemployeeinfo te on te.EMP_N = ph.name LEFT JOIN tbldilgposition tp on tp.POSITION_ID = te.POSITION_C LEFT JOIN tblpersonneldivision tp2 on tp2.DIVISION_N = te.DIVISION_C WHERE ph.ppe_id = '$id' ORDER BY ph.id DESC ");
$row = mysqli_fetch_array($select);
$EMP_N = $row['EMP_N'];

$selectEmp = mysqli_query($conn,"SELECT concat(te.FIRST_M,' ',te.MIDDLE_M,' ',te.LAST_M) AS FNAME,tp2.DIVISION_M,tp.POSITION_M FROM tblemployeeinfo te LEFT JOIN tbldilgposition tp on tp.POSITION_ID = te.POSITION_C LEFT JOIN tblpersonneldivision tp2 on tp2.DIVISION_N = te.DIVISION_C WHERE te.EMP_N = $EMP_N ");
$rowE = mysqli_fetch_array($selectEmp);
$FNAME = $rowE['FNAME'];
$DIVISION_M = $rowE['DIVISION_M'];
$POSITION_M = $rowE['POSITION_M'];
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
                    <a href="UpdateRPCPPE.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class='fa'>&#xf044;</i>Update</a>
                   <?php if (empty($EMP_N)): ?>
                       <a href="Assign_PAR.php?id=<?php echo $id; ?>" class="btn btn-success"><i class="fa fa-fw fa-user-md"></i>Assign Par</a>
                       <?php else: ?>
                           <a href="Reassign_PAR.php?id=<?php echo $id; ?>" class="btn btn-success">Re-Assign Par</a>
                       <?php endif ?>
                       <a href="export_par_receipt.php?id=<?php echo $id;?>" class="btn btn-warning"><i class="fa fa-fw fa-download"></i>Par Receipt</a>
                       <a href="barcode2.php?id=<?php echo $id;?>" class="btn btn-info"><i class="fa fa-fw fa-download"></i>Par Sticker</a>
                       <a href="export_pc.php?id=<?php echo $id;?>" class="btn btn-success"><i class="fa fa-fw fa-download"></i>Export PC</a>


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
                            $acquired_dateE = date('F d, Y',strtotime($row["par_date"]));
                            $positionN = $row["POSITION_M"];
                            $officeE = $row["DIVISION_M"];

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
                            <td><?php echo $FNAME;?></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td><?php echo $POSITION_M;?></td>
                        </tr>
                        <tr>
                            <th>Office:</th>
                            <td><?php echo $DIVISION_M;?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


