<?php
// error_reporting(0);
// ini_set('display_errors', 0);

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");




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

  $insert_rpci = mysqli_query($conn,"INSERT INTO rpci(article,description,stock_number,unit,amount,bpc,opc,shortage_Q,shortage_V,remarks,office,yrs,inventory_item_no,received_by) VALUES('$article','$description','$stock_number','$unit','$amount','$bpc','$opc','$shortage_Q','$shortage_V','$remarks','$office','$yrs','$inventory_item_no','$received_by')");

  if ($insert_rpci) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewRPCI.php';
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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <!-- <script src="//code.jquery.com/jquery-2.1.4.min.js"></script> -->
  <!-- <script type="text/javascript" src="typeahead.js"></script> -->
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate RPCI</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewRPCI.php" style="color:white;text-decoration: none;">Back</a></li>
    
      <br>
      <br>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Ariticle</label>
                  <input autocomplete = "false"  class="form-control" name="article" type="text" id="article">

                </div>
                <div class="form-group">
                  <label>Description</label>
                  <input autocomplete = "false"  class="form-control" name="description" type="text" id="description">
                </div>

                <div class="form-group">
                  <label>Stock Number</label>
                  <input autocomplete = "false"  class="form-control" name="stock_number" type="text" id="stock_number">
                </div>

                <div class="form-group">
                  <label>Inventory Item Number</label>
                  <input autocomplete = "false"  class="form-control" name="inventory_item_no" type="text" id="inventory_item_no">
                </div>

                <div class="form-group">
                  <label>Unit of Measure</label>
                  <input autocomplete = "false"  class="form-control" name="unit" type="number" id="unit">

                </div>
                <div class="form-group">
                  <label>Unit Value</label>
                  <input autocomplete = "false"  class="form-control" name="amount" type="text" id="amount">
                </div>
                 <div class="form-group">
                  <label>Estimated Years Life</label>
                  <input autocomplete = "false"  class="form-control" name="yrs" type="number" id="yrs">
                </div>
                 <div class="form-group">
                  <label>Received By : </label>
                  <input autocomplete = "false"  class="form-control" name="received_by" type="text" id="received_by">
                </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label>Office</label>
                <input autocomplete = "false"  class="form-control" name="office" type="text" id="office">
              </div>

              <div class="form-group">
                <label>Balance Per Card</label>
                <input autocomplete = "false"  class="form-control" name="bpc" type="text" id="bpc">
              </div>

              <div class="form-group">
                <label>On Hand Per Count</label>
                <input autocomplete = "false"  class="form-control" name="opc" type="text" id="opc">

              </div>
              <div class="form-group">
                <label>Shortage(Quantity)</label>
                <input autocomplete = "false"  class="form-control" name="shortage_Q" type="text" id="shortage_Q">
              </div>

              <div class="form-group">
                <label>Shortage(Value)</label>
                <input autocomplete = "false"  class="form-control" name="shortage_V" type="text" id="shortage_V">
              </div>

              <div class="form-group" >
                <label>Remarks</label>
                <textarea class="form-control" type="text" id="remarks" name="remarks"></textarea> 
              </div>

              <div class="form-group" hidden>
                <label>PR Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php if ($pr_date ==''): ?>
                    <input type="date" class="form-control pull-right" name="pr_date" id="pr_date" value="<?php echo isset($_POST['pr_date']) ? $_POST['pr_date'] : '' ?>">
                    <?php else: ?>
                      <input type="date" class="form-control pull-right" name="pr_date" id="pr_date" value="<?php echo $pr_date ?>">
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-success" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>
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


