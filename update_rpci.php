<?php
// error_reporting(0);
// ini_set('display_errors', 0);

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];

$select = mysqli_query($conn,"SELECT * FROM rpci WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$article1 = $row['article'];
$description1 = $row['description'];
$stock_number1 = $row['stock_number'];
$inventory_item_no = $row['inventory_item_no'];
$unit1 = $row['unit'];
$amount1 = $row['amount'];
$bpc1 = $row['bpc'];
$opc1 = $row['opc'];
$shortage_Q1 = $row['shortage_Q'];
$shortage_V1 = $row['shortage_V'];
$remarks1 = $row['remarks'];
$office1 = $row['office'];
  $received_by = $row['received_by'];
  $position = $row['position'];
$yrs1 = $row['yrs'];
  $ics_no = $row['ics_no'];
  $date_from = $row['date_from'];
  $d1 = date('Y-m-d', strtotime($date_from));
  $date_to = $row['date_to'];
  $d2 = date('Y-m-d', strtotime($date_to));


if (isset($_POST['submit'])) {
  $article = $_POST['article'];
  $description = $_POST['description'];
  $stock_number = $_POST['stock_number'];
  $inventory_item_no = $_POST['inventory_item_no'];
  $unit = $_POST['unit'];
  $amount = $_POST['amount'];
  $bpc = $_POST['bpc'];
  $opc = $_POST['opc'];
  $shortage_Q = $_POST['shortage_Q'];
  $shortage_V = $_POST['shortage_V'];
  $remarks = $_POST['remarks'];
  $office = $_POST['office'];
  $received_by = $_POST['received_by'];
  $yrs = $_POST['yrs'];
  $position = $_POST['position'];
  $ics_no = $_POST['ics_no'];
  $date_from = $_POST['date_from'];
  $d1 = date('Y-m-d', strtotime($date_from));
  $date_to = $_POST['date_to'];
  $d2 = date('Y-m-d', strtotime($date_to));
  $insert_rpci = mysqli_query($conn,"UPDATE `rpci` SET `date_from`='$d1',`date_to`='$d2',`position`='$position',`ics_no`='$ics_no',`article`='$article',`description`='$description',`stock_number`='$stock_number',`unit`='$unit',`amount`='$amount',`yrs`='$yrs',`bpc`='$bpc',`opc`='$opc',`shortage_Q`='$shortage_Q',`shortage_V`='$shortage_V',`remarks`='$remarks',`office`='$office',`inventory_item_no`='$inventory_item_no',`received_by`='$received_by' WHERE id = $id");

  if ($insert_rpci) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'UpdateRPCI.php?id=$id';
      </SCRIPT>");

  }  else{
     echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured in Saving');
      </SCRIPT>");
  }


}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspReport On The Physical Count Of Inventories</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewRPCI.php" style="color:white;text-decoration: none;">Back</a></li>
            &nbsp &nbsp &nbsp   <li class="btn btn-info"><i class="fa fa-fw fa-download"></i><a href="report/BARCODE/pages/singleBarcode.php?id=<?php echo $id?>" style="color:white;text-decoration: none;">ICS Sticker</a></li>
            &nbsp &nbsp &nbsp   <li class="btn btn-success"><i class="fa fa-fw fa-download"></i><a href="export_ics.php?id=<?php echo $id?>" style="color:white;text-decoration: none;">Export ICS</a></li>

      <br>
      <br>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Ariticle</label>
                  <input value="<?php echo $article1?>"  class="form-control" name="article" type="text" id="article">

                </div>
                <div class="form-group">
                  <label>Description</label>
                  <input value="<?php echo $description1?>"  class="form-control" name="description" type="text" id="description">
                </div>

                  <div class="form-group">
                  <label>ICS Number</label>
                  <input value="<?php echo $ics_no?>"  autocomplete = "false"  class="form-control" name="ics_no" type="text" id="ics_no">
                </div>

                <div class="form-group">
                  <label>Stock Number</label>
                  <input value="<?php echo $stock_number1?>"  class="form-control" name="stock_number" type="text" id="stock_number">
                </div>

                 <div class="form-group">
                  <label>Inventory Item Number</label>
                  <input value="<?php echo $inventory_item_no?>"  class="form-control" name="inventory_item_no" type="text" id="inventory_item_no">
                </div>

                <div class="form-group">
                  <label>Unit of Measure</label>
                  <input value="<?php echo $unit1?>"  class="form-control" name="unit" type="text" id="unit">

                </div>
                <div class="form-group">
                  <label>Unit Value</label>
                  <input value="<?php echo $amount1?>"  class="form-control" name="amount" type="text" id="amount">
                </div>
                <div class="form-group">
                  <label>Estimated Years Life</label>
                  <input value="<?php echo $yrs1?>"  class="form-control" name="yrs" type="number" id="amount">
                </div>
                 <div class="form-group">
                  <label>Received by : </label>
                  <input value="<?php echo $received_by?>"  class="form-control" name="received_by" type="text" id="received_by">
                </div>

                <div class="form-group">
                        <label>Received Date <label style="color: Red;" >*</label></label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                            <input type="text" class="form-control pull-right" value="<?php echo $d1; ?>" name="date_from" id="datepicker2" placeholder="mm/dd/yyyy">
                          </div>
                        </div>

                <div class="form-group">
                  <label>Position/Office</label>
                  <input value="<?php echo $position?>"  class="form-control" name="position" type="text" id="position">
                </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label>Balance Per Card</label>
                <input value="<?php echo $office1?>"  class="form-control" name="office" type="text" id="office">
              </div>

              <div class="form-group">
                <label>Balance Per Card</label>
                <input value="<?php echo $bpc1?>"  class="form-control" name="bpc" type="text" id="bpc">
              </div>

              <div class="form-group">
                <label>On Hand Per Count</label>
                <input value="<?php echo $opc1?>"  class="form-control" name="opc" type="text" id="opc">

              </div>
              <div class="form-group">
                <label>Shortage(Quantity)</label>
                <input value="<?php echo $shortage_Q1?>"  class="form-control" name="shortage_Q" type="text" id="shortage_Q">
              </div>

              <div class="form-group">
                <label>Shortage(Value)</label>
                <input value="<?php echo $shortage_V1?>"  class="form-control" name="shortage_V" type="text" id="shortage_V">
              </div>

              <div class="form-group" >
                <label>Remarks</label>
                <textarea class="form-control" type="text" id="remarks" name="remarks"> <?php echo $remarks1?></textarea> 
              </div>

               <div class="form-group">
                  <label>Received From : </label>
                  <input autocomplete = "false"  class="form-control" disabled value="BEZALEEL O. SOLTURA" type="text" id="received_by">
                </div>

              <div class="form-group">
                        <label>Received Date <label style="color: Red;" >*</label></label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                            <input type="text" class="form-control pull-right" value="<?php echo $d2; ?>" name="date_to" id="datepicker1" placeholder="mm/dd/yyyy">
                          </div>
                        </div>
              </div>
            </div>
          </div>
          <button class="btn btn-primary" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Update</button>
          <br>
        </form>
      </div>  
    </div>  
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>  
    <br>
  </body>


