<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$id = $_GET['id'];
$username = $_SESSION['username'];
}
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
function employee($connect)
{ 
  $output = '';
  $query = "SELECT concat(FIRST_M,' ',MIDDLE_M,' ',LAST_M) AS NAME FROM tblemployeeinfo ORDER BY LAST_M ASC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["NAME"].'">'.$row["NAME"].'</option>';
  }
  return $output;
}
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$selectDetails = mysqli_query($conn,"SELECT EMP_N FROM par_assign WHERE ppe_id = $id ");
$rowD = mysqli_fetch_array($selectDetails);
$EMP_N = $rowD['EMP_N'];

$selectEmp = mysqli_query($conn,"SELECT concat(FIRST_M,' ',MIDDLE_M,' ',LAST_M) AS NAME FROM tblemployeeinfo WHERE EMP_N = $EMP_N");
$rowEmp = mysqli_fetch_array($selectEmp);
$name = $rowEmp['NAME'];

if (isset($_POST['submit'])) {
  $name1 = $_POST['name'];
  $position1 = $_POST['position'];
  $office1 = $_POST['office'];

  $select_curr = mysqli_query($conn,"SELECT * FROM par_assign WHERE ppe_id = '$id' ");
  $row = mysqli_fetch_array($select_curr);
  $name = $row['name'];
  $position = $row['position'];
  $office = $row['office'];
  $par_date = $row['par_date'];

  $insert_history = mysqli_query($conn,"INSERT INTO par_history(ppe_id,name,position,office,par_date) VALUES('$id','$EMP_N','$position','$office','$par_date')");

  $updateDate = mysqli_query($conn,"UPDATE rpcppe SET date_acquired = now(), office = '$office' where id = '$id' ");

  $delete_par = mysqli_query($conn,"DELETE FROM par_assign WHERE ppe_id = '$id' ");
  $insert_par = mysqli_query($conn,"INSERT INTO par_assign(ppe_id,EMP_No,ffice) VALUES ('$id','$name1',''$office1')");

  if ($insert_par AND $delete_par AND $insert_history) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
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
      <h1 align="">&nbspRe-assign Item</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPPE.php?id=<?php echo $id;?>" style="color:white;text-decoration: none;"><i class="fa fa-fw fa-arrow-left"></i>Back</a></li>
      <br>
      <br>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
              <div class="well">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <select  class="form-control select2" style="width: 100%;" autocomplete="off" name="name" >
                       <option value="<?php echo $EMP_N;?>"><?php echo $name;?></option>
                       <?php echo employee($connect); ?>
                     </select> 
                    </div>
                    <div class="form-group" hidden>
                      <label>Position</label>
                      <input autocomplete = "false"  class="form-control" name="position" type="text" id="position">
                    </div>
                  </div>
                  <div class="col-md-6" hidden>
                    <div class="form-group">
                      <label>Office</label>
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
              <button class="btn btn-primary" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to re-assign?');"><i class="fa fa-fw fa-user-md"></i>Assign</button>
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


