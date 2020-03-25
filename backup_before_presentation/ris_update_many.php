<?php 
ob_start();
?>

<html>
<head>
  <title>Asset Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body style="background: lightgray;">
  <div class="">
    <div class="panel panel-default">
      <br>
      
            <h1 align="">&nbspUpdate Requisition and Issue Slip</h1>
             <div class="box-header with-border">
    </div>
    <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewRIS.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <form method="POST" id="">
        <div  class="col-xs-3">
          <label>Division : </label>
          <?php
          $conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
          $sq = mysqli_query($conn,"SELECT dept from ris_stock_issuetomany where id ='".$_GET['id']."' ");
          while ($row = mysqli_fetch_assoc($sq)) {
            echo '<input  type="text" class="form-control" style="height: 40px;"  placeholder="" name="dept" id="sup" value="'.$row['dept'].'" />';   
          }
          ?>
        </div>
        <form method="POST" id="">
          <div  class="col-xs-3">
            <label>RIS No. : </label>
            <?php
            $conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
            $sq = mysqli_query($conn,"SELECT ris_no from ris_stock_issuetomany where id ='".$_GET['id']."' ");
            while ($row = mysqli_fetch_assoc($sq)) {
              echo '<input  type="text" class="form-control" style="height: 40px;"  placeholder="" name="ris_no" id="sup" value="'.$row['ris_no'].'" />';   
            }
            ?>
          </div>
            <div class="col-xs-3">
              <label>Requested By : </label>
              <?php
              $conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
              $sq = mysqli_query($conn,"SELECT request_by from ris_stock_issuetomany where id ='".$_GET['id']."' ");
              while ($row = mysqli_fetch_assoc($sq)) {
                $request_by = $row['request_by'];
                if ($request_by == 1) {
                  echo ' <select name="request_by" class="form-control">
                  <option value="1">ELOISA G. ROZUL</option>
                  <option value="2">JOHN M. CEREZO</option>
                  <option value="3">DR. CARINA S. CRUZ</option>
                  </select>';   
                }

                if ($request_by == 2) {
                  echo '<select name="request_by" class="form-control">
                  <option value="2">JOHN M. CEREZO</option>
                  <option value="1">ELOISA G. ROZUL</option>
                  <option value="3">DR. CARINA S. CRUZ</option>
                  </select>';   
                }

                if ($request_by == 3) {
                  echo '<select name="request_by" class="form-control">
                  <option value="3">DR. CARINA S. CRUZ</option>
                  <option value="2">JOHN M. CEREZO</option>
                  <option value="1">ELOISA G. ROZUL</option>
                  </select>';   
                }

              }
              ?>
            </div>
            <div class="col-xs-3">
              <label>Recieved by : </label>
              <?php
              $conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
              $sq = mysqli_query($conn,"SELECT recieved_by from ris_stock_issuetomany where id ='".$_GET['id']."' ");
              while ($row = mysqli_fetch_assoc($sq)) {
                echo '<input type="text" class="form-control" style="height: 40px;"  placeholder="" name="recieved_by" id="sup" value="'.$row['recieved_by'].'" />';   
              }
              ?>
            </div>
            <p>&nbsp</p>
            <p>&nbsp</p>
            <div class="col-xs-3">
              <label>Purpose : </label>
              <?php
              $conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
              $sq = mysqli_query($conn,"SELECT purpose from ris_stock_issuetomany where id ='".$_GET['id']."' ");
              while ($row = mysqli_fetch_assoc($sq)) {
                echo '<textarea type="text" class="form-control" style="width: 1000px;height: 100px;"  name="purpose" id="sup"  >'.$row['purpose'].'</textarea> ';   
              }
              ?>
            </div>

            
      <!-- <div class="col-xs-3">
        <label>Select Officer:</label>
          <select name="officer" class="form-control">
            <option value="1">Michiko R. Escalante</option>
            <option value="2">Joel B. Gaona</option>
            <option value="3">Medel A. Saturno</option>
          </select>
        </div> -->
        <br><br><br><br>
        <br><br><br><br>
        <button type="submit" name="submit" style="width: 100%;" class="btn btn-primary">UPDATE</button>
      </form>
    </div>
  </div>
</body>
</html>
<?php
$conn = mysqli_connect("localhost", "fascalab_2020", "", "fascalab_2020");
if (isset($_POST['submit'])) 
{
  $dept = $_POST['dept'];
  $ris_no = $_POST['ris_no'];
  $request_by = $_POST['request_by'];
  $recieved_by = $_POST['recieved_by'];
  $purpose = $_POST['purpose'];
  $id = $_GET['id'];


  $update = mysqli_query($conn,"UPDATE `ris_stock_issuetomany` SET `dept`='$dept',`ris_no`='$ris_no',`request_by`='$request_by',`recieved_by`='$recieved_by',`purpose`='$purpose' WHERE id = '$id'");
  
  if (!empty($update))
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('RIS Updated!')
      window.location.href='ViewRISmany.php';
      </SCRIPT>");
    header("Refresh:0");
  } else {
   echo "Error: " ;
 }
}
ob_end_flush();

?>


