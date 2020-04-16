<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");




$pr_no = $_GET['pr_no'];
$pr_date = $_GET['pr_date'];
$pmo = $_GET['pmo'];
$purpose = $_GET['purpose'];

if (isset($_POST['submit'])) {
  $pr_date = $_POST['pr_date'];
  $purpose = $_POST['purpose'];
  $pmo = $_POST['pmo'];
  $unit = $_POST['unit'];

  
  $check = mysqli_query($conn,"SELECT pr_no FROM pr WHERE pr_no = '$pr_no' ");

  if (mysqli_num_rows($check)>0) {
    echo "<div style='background-color:lightblue;color:red;'> <p> <b>This PR_NO is already existing</b> <p> <div>";
  }else{


  $insert_pr = mysqli_query($conn,"INSERT INTO pr(pr_no,pmo,purpose,pr_date) VALUES('$pr_no','$pmo','$purpose','$pr_date')");

  for($count = 0; $count < count($_POST["app_id"]); $count++)
  {  
    if ($unit[$count] == "piece") {
    $unit[$count] = "1";
    }

    if ($unit[$count] == "box") {
    $unit[$count] = "2";
    }

    if ($unit[$count] == "ream") {
    $unit[$count] = "3";
    }

    if ($unit[$count] == "lot") {
    $unit[$count] = "4";
    }

     if ($unit[$count] == "unit") {
    $unit[$count] = "5";
    }

      if ($unit[$count] == "crtg") {
    $unit[$count] = "6";
    }

     if ($unit == "7") {
    $unit = "pack";
    }
      if ($unit[$count] == "tube") {
    $unit[$count] = "8";
    }

      if ($unit[$count] == "roll") {
    $unit[$count] = "9";
    }

    if ($unit[$count] == "can") {
    $unit[$count] = "10";
    }

    if ($unit[$count] == "bottle") {
    $unit[$count] = "11";
    }

    if ($unit[$count] == "set") {
    $unit[$count] = "12";
    }

    if ($unit[$count] == "jar") {
    $unit[$count] = "13";
    }

    if ($unit[$count] == "bundle") {
    $unit[$count] = "14";
    }

    if ($unit[$count] == "pad") {
    $unit[$count] = "15";
    }

    if ($unit[$count] == "book") {
    $unit[$count] = "16";
    }

    if ($unit[$count] == "pouch") {
    $unit[$count] = "17";
    }

    if ($unit[$count] == "dozen") {
    $unit[$count] = "18";
    }

    if ($unit[$count] == "pair") {
    $unit[$count] = "19";
    }

    if ($unit[$count] == "gallon") {
    $unit[$count] = "20";
    }

     if ($unit[$count] == "cart") {
    $unit[$count] = "21";
    }

     $insert_items = mysqli_query($conn,'INSERT INTO pr_items(pr_no,app_id,items,description,unit,qty,abc) 
    VALUES("'.$pr_no.'","'.$_POST['app_id'][$count].'","'.$_POST['items'][$count].'","'.$_POST['description'][$count].'","'.$unit[$count].'","'.$_POST['qty'][$count].'","'.$_POST['abc'][$count].'")');
   }
   $select_id = mysqli_query($conn,"SELECT * FROM pr WHERE pr_no = '$pr_no'");
   $rowW = mysqli_fetch_array($select_id);
   $id = $rowW['id'];
 echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Successfuly Saved!')
            window.location.href = 'ViewPRv.php?id=$id';
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
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPRv.php" style="color:white;text-decoration: none;">Back</a></li>

      &nbsp &nbsp &nbsp   <li class="btn btn-info"><?php echo '<a href="CreatePr.php?pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.' " style="color:white;text-decoration: none;">Add More Items</a>' ?></li>
      <br>
      <br>
      <form method="POST">
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>PR No.</label>
                  <input class="form-control" type="text"  name="pr" value="<?php echo $pr_no;?> " >
                </div>
                <div class="form-group">
                  <label>Office</label>

                  <input type="text" class="form-control"  name="pmo" value="<?php echo $pmo;?>" >
                </div>
              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>PR Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right"  name="pr_date" value="<?php echo $pr_date;?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label>Purpose</label>
                  <textarea class="form-control" type="text" name="purpose"><?php echo  $purpose; ?> </textarea> 
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-success" id="item_table">
           <div class="panel-heading">
            <i class="fa fa-list-alt"></i> Item(s) of PR No. <?php echo $pr_no;?>
            <!-- <label class="pull-right"><i class="fa fa-cart-plus"></i> Items</label> -->
            <div class="clearfix"></div>
          </div>
          <div class="panel-body container-items">
           <table style="background-color: white;border-width: medium;" class="table " id="item_table" >
            <tr>
             <th width="300">Items</th>
             <th width="100">Quantity</th>
             <th width="100">Unit </th>
             <th width="150">ABC per item </th>
             <th>Description </th>
             <th width="100">Option </th>
           </tr>
           <tr>
            <?php 
            $conn = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');
            $pr_no = $_GET['pr_no'];
            $sql_items = $conn->query("SELECT pa.id,qty,items,app_id,pr_no,description,unit,abc,a.procurement FROM pr_approved pa left join app a on a.id = pa.items  WHERE pa.pr_no = '$pr_no' ");
            while ($row = $sql_items->fetch()) {
              $id = $row['id'];
              $qty = $row['qty'];
              $items = $row['items'];
              $app_id = $row['app_id'];
              $description = $row['description'];
              $unit = $row['unit'];
              $abc = $row['abc'];
              $procurement = $row['procurement'];
              ?>

              <td hidden><?php echo $pr_no?> </td>
              <td hidden><?php echo $pmo?> </td>
              <td hidden><?php echo $pr_date?> </td>
              <td hidden><?php echo $purpose?> </td>
              <td hidden ><?php echo $existing_qty?> </td>
              <td hidden><input  type="text" name="app_id[]" value="<?php echo $app_id ?>"> </td>
              <td><input hidden type="text" name="items[]" value="<?php echo $items ?>"><?php echo $procurement?> </td>
              <td><input hidden type="text" name="qty[]" value="<?php echo $qty ?>"><?php echo $qty?></td>
              <td><input hidden type="text" name="unit[]" value="<?php echo $unit ?>"><?php echo $unit?></td>
              <td><input hidden type="text" name="abc[]" value="<?php echo $abc ?>"><?php echo $abc?></td>
              <td><input hidden type="text" name="description[]" value="<?php echo $description ?>"><?php echo $description?></td>
              <td>
               <?php echo '<a href="ViewEditPR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'  " ><i style="font-size:24px" class="fa">&#xf044;</i></a>' ?>

               <?php echo '<a href="deletePR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.' "><i style="font-size:24px" class="fa fa-trash-o"></i></a>'?>
             </td>
           </tr>
         <?php } ?>
       </table>
     </div>
   </div> 
   <button class="btn btn-primary" style="float: right;" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Submit</button>
   <br>
   <br>
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
