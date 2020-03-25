<?php
// error_reporting(0);
// ini_set('display_errors', 0);
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
$ppe = $_GET['id'];

if (isset($_POST['submit'])) {
  $office = $_POST['office'];
  $name = $_POST['name'];
  $position = $_POST['position'];

  $insert_par = mysqli_query($conn,"INSERT INTO par_assign(ppe_id,name,position,office) VALUES('$ppe','$name','$position','$office')");
  $updateDate = mysqli_query($conn,"UPDATE rpcppe SET date_acquired = now(), office = '$office' where id = '$ppe' ");

  if ($insert_par) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewPPE.php?id=$ppe';
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
      <h1 align="">&nbspAssign Item</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPPE.php?id=<?php echo $ppe?>" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
              <div class="well">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input autocomplete = "false"  class="form-control" name="name" type="text" id="name">
                    </div>
                    <div class="form-group">
                      <label>Position</label>
                      <input autocomplete = "false"  class="form-control" name="position" type="text" id="position">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Office</label>
                      <!-- <input autocomplete = "false"  class="form-control" name="office" type="text" id="office"> -->
                      <select class="form-control select2" name="office">
                        <option value="">Select</option>
                        <option value="Regional Office">Regional Office</option>
                        <option value="Provincial Office">Provincial Office</option>
                        <option value="City/Municipality Office">City/Municipality Office</option>
                        <option value="Clust Office">Clust Office</option>
                      </select>

                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-success" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to assign now?');">Assign</button>
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


