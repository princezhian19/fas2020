<?php 
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c

$id = $_GET['id'];
$id2 = $_GET['id2'];
$ris_no = $_GET['ris_no'];


if (isset($_POST['submit'])) {

$qty = $_POST['qty'];
$update = mysqli_query($conn,"UPDATE ris_stock SET qty = '$qty' WHERE id = '$id' ");

// header('location: ViewRIS.php ');
 echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Successfuly Saved!')
            </SCRIPT>");
}




?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspUpdate RIS <?php echo $ris_no;?></h1>
      <div class="box-header with-border">
      </div>
      <br>

      &nbsp &nbsp &nbsp   <li class="btn btn-success"><?php  echo '<a href="UpdateRIS.php?id='.$id2.'" style="color:white;text-decoration: none;">Back</a>'; ?></li>
      <br>
      <br>
      <form method="post" id ="f">
        <div  class="col-xs-3">
          <label>Quantity</label>
          <?php
              $conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
              $sq = mysqli_query($conn,"SELECT qty from ris_stock where id ='".$_GET['id']."' ");
              while ($row = mysqli_fetch_assoc($sq)) {
                echo '<input type="text" class="form-control" style="height: 40px;"  placeholder="" name="qty" id="qty" value="'.$row['qty'].'" />';   
              }
              ?>
        </div>
</div>
          <br>
          <br>

        <div align="" style="padding-left: 30px;">
          <input type="submit" name="submit" class="btn btn-primary" value="Update" />
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
</form>
</body>

</html>
