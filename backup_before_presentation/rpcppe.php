<?php
// error_reporting(0);
// ini_set('display_errors', 0);
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

if (isset($_POST['submit'])) {
  $date_acquired = $_POST['date_acquired'];
  // $dateAq = date('Y-m-d', strtotime($date_aquired)); 
  $article = $_POST['article'];
  $description = $_POST['description'];
  $property_number = $_POST['property_number'];
  $unit = $_POST['unit'];
  $amount = $_POST['amount'];
  $property_card = $_POST['property_card'];
  $physical_count = $_POST['physical_count'];
  $shortage_Q = $_POST['shortage_Q'];
  $shortage_V = $_POST['shortage_V'];
  $remarks = $_POST['remarks'];
  $status = $_POST['status'];
  $category = $_POST['category'];



  $insert_rpcppe = mysqli_query($conn,"INSERT INTO rpcppe(article,description,property_number,date_acquired,unit,amount,property_card,physical_count,shortage_Q,shortage_V,remarks,status,category) VALUES('$article','$description','$property_number','$date_acquired','$unit','$amount','$property_card','$physical_count','$shortage_Q','$shortage_V','$remarks','$status','$category')");

  if ($insert_rpcppe) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewRPCPPE.php';
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="typeahead.js"></script>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate PPE</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewRPCPPE.php" style="color:white;text-decoration: none;">Back</a></li>
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
                  <label>Property Number</label>
                  <input autocomplete = "false"  class="form-control" name="property_number" type="text" id="property_number">
                </div>

                <div class="form-group" >
                  <label>Date Aquired</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="date_acquired" id="" >
                  </div>
                </div>


    <!--     <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="datereceived">
                      </div> -->
                      <div class="form-group">
                        <label>Unit of Measure</label>
                        <input autocomplete = "false"  class="form-control" name="amount" type="text" id="unit">

                      </div>
                      <div class="form-group">
                        <label>Unit Value</label>
                        <input autocomplete = "false"  class="form-control" name="unit" type="text" id="unit">
                      </div>

                      <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option class="form-control" value="Servicable">Servicable</option>
                        <option class="form-control" value="Unservicable">Unservicable</option>
                      </select>
                      </div>
                        <div class="form-group" >
                          <br>
                        <label>Category</label>
                          <input autocomplete = "false"  class="form-control" name="category" type="text" id="category">
                        </div>

                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                      <label>Property Card</label>
                      <input autocomplete = "false"  class="form-control" name="property_card" type="text" id="property_card">
                    </div>

                    <div class="form-group">
                      <label>Physical Count</label>
                      <input autocomplete = "false"  class="form-control" name="physical_count" type="text" id="physical_count">

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
                      <textarea class="form-control" style="height: 100px;" type="text" id="remarks" name="remarks"></textarea> 
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


