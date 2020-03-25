<?php
// error_reporting(0);
// ini_set('display_errors', 0);

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$id = $_GET['id'];

$select = mysqli_query($conn,"SELECT * FROM rpcppe WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$article1 = $row['article'];
$date_aquireda = $row['date_acquired'];
$date_aquired1 = date('d-m-Y', strtotime($date_aquireda)); 
$description1 = $row['description'];
$property_number1 = $row['property_number'];
$unit1 = $row['unit'];
$amount1 = $row['amount'];
$property_card1 = $row['property_card'];
$physical_count1 = $row['physical_count'];
$shortage_Q1 = $row['shortage_Q'];
$shortage_V1 = $row['shortage_V'];
$remarks1 = $row['remarks'];
$status1 = $row['status'];

if (isset($_POST['submit'])) {
  $date_aquired = $_POST['date_aquired'];

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
  $status = $row['status'];

  
  $update = mysqli_query($conn,"UPDATE rpcppe SET article ='$article',description ='$description',property_number ='$property_number',unit ='$unit',amount ='$amount',property_card ='$property_card',physical_count ='$physical_count',shortage_Q ='$shortage_Q',shortage_V ='$shortage_V',remarks ='$remarks',date_acquired ='$date_aquired', status = '$status' WHERE property_number = '$property_number'");

  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Updated!')
      window.location.href = 'ViewPPE.php?id=$id';
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
      <h1 align="">&nbspUpdate PPE</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPPE.php?id=<?php echo $id?>" style="color:white;text-decoration: none;">Back</a></li>
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
                  <input autocomplete = "false" value="<?php echo $description1?>"  class="form-control" name="description" type="text" id="description">
                </div>

                <div class="form-group">
                  <label>Property Number</label>
                  <input autocomplete = "false" value="<?php echo $property_number1?>" class="form-control" name="property_number" type="text" id="property_number">
                </div>

                <div class="form-group" >
                <label>Date Aquired</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input type="date" value="<?php echo $date_aquireda?>" class="form-control pull-right" name="date_aquired" id="" >
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
                  <input autocomplete = "false"  value="<?php echo $unit1?>" class="form-control" name="unit" type="text" id="unit">

                </div>
                <div class="form-group">
                  <label>Unit Value</label>
                  <input autocomplete = "false" value="<?php echo $amount1?>" class="form-control" name="amount" type="text" id="amount">
                </div>

                <div class="form-group">
                      <label>Status</label>
                      <!-- <input autocomplete = "false"  class="form-control" name="office" type="text" id="office"> -->
                      <br>
                      <?php if ($status1 == "Servicable"): ?>
                      <select class="form-control">
                        <option class="form-control" value="Servicable">Servicable</option>
                        <option class="form-control" value="Unservicable">Unservicable</option>
                      </select>
                        <?php else: ?>
                      <select class="form-control">
                        <option class="form-control" value="Unservicable">Unservicable</option>
                        <option class="form-control" value="Servicable">Servicable</option>
                      </select>
                      <?php endif ?>

                     
                    </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label>Property Card</label>
                <input autocomplete = "false" value="<?php echo $property_card1?>" class="form-control" name="property_card" type="text" id="property_card">
              </div>

              <div class="form-group">
                <label>Physical Count</label>
                <input autocomplete = "false" value="<?php echo $physical_count1?>" class="form-control" name="physical_count" type="text" id="physical_count">

              </div>
              <div class="form-group">
                <label>Shortage(Quantity)</label>
                <input autocomplete = "false" value="<?php echo $shortage_Q1?>" class="form-control" name="shortage_Q" type="text" id="shortage_Q">
              </div>

              <div class="form-group">
                <label>Shortage(Value)</label>
                <input autocomplete = "false" value="<?php echo $shortage_V1?>" class="form-control" name="shortage_V" type="text" id="shortage_V">
              </div>

              <div class="form-group" >
                <label>Remarks</label>
                <textarea class="form-control" style="height: 100px;" type="text" id="remarks" name="remarks"><?php echo $remarks1?></textarea> 
              </div>

              
              </div>
            </div>
          </div>
          
          <button class="btn btn-primary" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to Update?');">Update</button>
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


