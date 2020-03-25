<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "");
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];

function supplier($connect)
{ 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$SELECT_rfq = mysqli_query($conn,"SELECT * FROM rfq_items WHERE rfq_id = $rfq_id");
$rowR = mysqli_fetch_array($SELECT_rfq);
$rid = $rowR['id'];

  $output = '';
  $query = "SELECT sq.supplier_id,rq.rfq_id,sq.id,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on s.id = sq.supplier_id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["supplier_id"].'">'.$row["supplier_title"].'</option>';
}
return $output;
}
$select = mysqli_query($conn,"SELECT rfq.rfq_date,rfq.rfq_no,rfq.purpose,pr.pmo,rfq.pr_no,rfq.pr_received_date FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no WHERE rfq.id = '$rfq_id' ");
$row = mysqli_fetch_array($select);
$rfq_no = $row['rfq_no'];
$rfq_date = $row['rfq_date'];
$purpose = $row['purpose'];
$pmo = $row['pmo'];
$pr_no = $row['pr_no'];
$pr_date = $row['pr_received_date'];

// $select_abs_latest = mysqli_query($conn,"SELECT ")

$idGet='';
$getDate = date('Y');
$m = date('m');
$auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM abstract_of_quote order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {
  $idGet = $row["a"];
}
$autoNo = $getDate.'-'.$m.'-'.'0'.$idGet;
?>
<?php
if (isset($_POST['submit'])) {
$abstract_no = $_POST['abstract_no'];
$supplier_id = $_POST['supplier_id'];
$date_opened = $_POST['date_opened'];
$remarks = $_POST['remarks'];



$INSERT_aoq = mysqli_query($conn,"INSERT INTO aoq_data(aoq_no,action_officer,datetime_created,date,remarks) VALUES('$abstract_no',14,'$date_opened','$date_opened','$remarks')");

$selectT = mysqli_query($conn,"SELECT id FROM aoq_data ORDER BY id DESC LIMIT 1 ");
$rowT = mysqli_fetch_array($selectT);
$aoq_id = $rowT['id'];

$UPDATE = mysqli_query($conn,"UPDATE abstract_of_quote SET abstract_no = '$aoq_id' WHERE rfq_id = $rfq_id AND supplier_id = $supplier_id");

$select_rid = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while ($rowRID = mysqli_fetch_assoc($select_rid)){
    $ritemsid = $rowRID['id'];

    $selectsq = mysqli_query($conn,"SELECT id FROM supplier_quote WHERE rfq_item_id = $ritemsid AND supplier_id = $supplier_id");
    $rowsqq = mysqli_fetch_array($selectsq);
    $supplier_quote_id = $rowsqq['id'];

   $INSERT_selected = mysqli_query($conn,"INSERT INTO selected_quote(rfq_id,supplier_quote_id,aoq_id) VALUES('$rfq_id','$supplier_quote_id','$aoq_id')");

}

$selectabsid = mysqli_query($conn,"SELECT id FROM abstract_of_quote ORDER BY id DESC");
$rowabsid = mysqli_fetch_array($selectabsid);
$abstract_id = $rowabsid['id'];

echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfuly Created!')
        window.location.href='UpdateAoq.php?rfq_id=$rfq_id&abstract_id=$abstract_id';
        </SCRIPT>");

// fixxxxx


// save to selected quote rfq id, supplier_quote_id,aoq_id,
// save to aoq_data aoq_no,action officer,remarks,date

}
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
                    <h1>RFQ No. &nbsp <?php echo $rfq_no;?></h1>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">

                  <!--  <a href="export_rfq.php?id=<?php echo $id; ?>" class="btn btn-success">Export</a> -->
                  <!-- <a href="ViewRFQ.php" class="btn btn-warning">Back</a> -->
                  <h4>Item(s)</h4>
                  <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="500">Item</th>
                            <th width="500">Quantity</th>
                            <th width="500">Unit</th>
                            <th width="500">Unit Cost</th>
                            <th width="500">Total Cost</th>
                        </tr>
                    </thead>
                    <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                    while ($row = mysqli_fetch_assoc($view_query1)) {
                        $abc111 = $row["aa"];
                    }
                    $view_query = mysqli_query($conn, "SELECT pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");
                    while ($row = mysqli_fetch_assoc($view_query)) {
                        $id = $row["id"];
                        $items = $row["procurement"];  
                        $unit = $row["item_unit_title"];
                        $qty = $row["qty"];
                        $abc1 = $row["abc"];
                        $abc11 = number_format($abc1,2);
                        $total_cost = $qty * $abc1;
                        $total_cost11 = number_format($total_cost,2);
                        echo "<tr align = ''>
                        <td>$items</td>
                        <td>$qty</td>
                        <td>$unit</td>
                        <td>$abc11</td>
                        <td>$total_cost11</td>
                        </tr>"; 
                    }
                    ?>
                </table>
                <br>
                <table id="example1" class="" style="background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="500"></th>
                            <th width="500"></th>
                            <th width="500"></th>
                            <th width="500"></th>
                            <th width="500"></th>
                        </tr>
                    </thead>
                    <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                    $row = mysqli_fetch_array($view_query1);
                    $abc12 = $row["aa"];
                    $tot = number_format($abc12,2);
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>RFQ Details</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                    <tr>
                        <th width="100">RFQ Date</th>
                        <td><?php echo $rfq_date;?></td>
                    </tr>
                    <tr>
                        <th>Purpose</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                    <tr>
                        <th>Office</th>
                        <td><?php echo $pmo;?></td>
                    </tr>

                    <tr>
                        <th>PR No.</th>
                        <td><?php echo $pr_no;?></td>
                    </tr>
                    <tr>
                        <th width="150" >PR Date Received</th>
                        <td><?php echo $pr_date;?></td>
                    </tr>
                     <!-- <tr>
                        <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                      while ($row = mysqli_fetch_assoc($view_query1)) {
                        $abc1 = $row["aa"];
                                }
                        ?>
                        <th>ABC:</th>
                        <td><?php echo number_format($abc1,2);?></td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8" >
    <div class="box box-primary">
        <div class="box-header with-border" align="left">
            <h4>Abstract of Quotations</h4>
            <!-- <a href="export_rfq.php?id=<?php echo $id; ?>" class="btn btn-success">Export</a> -->
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <form method="POST">
                    <div class="col-md-10" >
                       <div class="form-group">
                        <label>Select Supplier</label>
                        <select required class="form-control " style="width: 100%;" autocomplete="off" id="supplier_id" name="supplier_id" >
                           <option value="" disabled selected>Select your Supplier</option>
                           <?php echo supplier($connect); ?>
                       </select> 
                   </div>
               </div>
               <div class="col-md-6" >
                <div class="form-group">
                    <label>Abstract No.</label>
                    <input required type="text" name="abstract_no" class="form-control" value="<?php echo $autoNo;?>">
                </div>

                <div class="form-group">
                    <label>Date Opened</label>
                    <input required type="datetime-local" name="date_opened" class="form-control">
                </div>
                <label>Remarks</label>
                <textarea class="form-control" name="remarks" style="width: 510px;"></textarea>
                <br>
                <button class="btn btn-success" name="submit" style="width: 100px;">Save</button>


            </div>


        </form>
    </div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-5">
    </div>
</div>
</body>
</html>


