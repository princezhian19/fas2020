<?php
error_reporting(0);
ini_set('display_errors', 0);
$conn = mysqli_connect("localhost","root","","payrollodi");

$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT te.EMP_NUMBER,te.FIRST_M,te.LAST_M,te.MIDDLE_M,td.pera,td.rata,td.bir,td.pagibig_premium,td.pagibig_mp2,td.philhealth FROM tblemployeeinfo te LEFT JOIN tbl_deductions td on te.emp_no = td.emp_no WHERE td.id = '$id' ");
  $row = mysqli_fetch_array($select);
  $emp_noA = $row['EMP_NUMBER'];
  $f_nameA = $row['FIRST_M'];
  $m_nameA = $row['LAST_M'];
  $l_nameA = $row['MIDDLE_M'];
  $peraA = $row['pera'];
  $rataA = $row['rata'];
  $birA = $row['bir'];
  $pagibig_premiumA = $row['pagibig_premium'];
  $pagibig_mp2A = $row['pagibig_mp2'];
  $philhealthA = $row['philhealth'];


if (isset($_POST['submit'])) {
  $emp_no = $_POST["emp_no"];
  $m_name = $_POST["m_name"];
  $f_name = $_POST["f_name"];
  $l_name = $_POST["l_name"];
  $pera = $_POST["pera"];
  $rata = $_POST["rata"];
  $bir = $_POST["bir"];
  $pagibig_premium = $_POST["pagibig_premium"];
  $pagibig_mp2 = $_POST["pagibig_mp2"];
  $philhealth = $_POST["philhealth"];

  


  $update = mysqli_query($conn,"UPDATE tbl_deductions SET pera = '$pera', rata = '$rata', bir = '$bir', pagibig_premium = '$pagibig_premium', pagibig_mp2 = '$pagibig_mp2', philhealth = '$philhealth' WHERE id = '$id' ");

  if ($update) {

    // header("Refresh:0");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('MESSAGE : Successfuly Updated!')
      window.location.href='ViewEditAllowance.php?id=$id';
      </SCRIPT>");

  }
  else{
    echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Error in saving! </p> </div></div>  ';
  }

    // echo '<p style = "background-color:red;color:white;padding:10px;"> WARNING : You Entered Invalid Quantity </p>   ';
    // echo ("<SCRIPT LANGUAGE='JavaScript'>
    //   window.alert('WARNING : Invalid Quantity')
    //   window.location.href='CreatePr.php';
    //   </SCRIPT>");
   // header('location: CreatePr.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');
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
<!-- <script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}
</script>

<a href="javascript:confirmDelete('delete.page?id=1')">Delete</a>
-->
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspCreate New Employee</h1>
    &nbsp &nbsp<li class="btn btn-success"><a href="ViewDeduction.php" style="color:white;text-decoration: none;">Back</a></li>
    <p></p>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">

                <label>Employee Number &nbsp<b style="color:red;">*</b></label>
                <input class="form-control" type="text" readonly name="emp_no" id="emp_no" autocomplete = "off" value="<?php echo $emp_noA;?>">
              </div>

              <div class="form-group">
                <label>First Name  &nbsp<b style="color:red;">*</b></label>
                <input class="form-control" type="text" readonly name="f_name" id="pr_no" autocomplete = "off" value="<?php echo $f_nameA;?>">
              </div>

              <div class="form-group">
                <label>Last Name &nbsp<b style="color:red;">*</b></label>
                <input class="form-control" type="text" readonly name="l_name" id="l_name" autocomplete = "off" value="<?php echo $l_nameA;?>">
              </div>

              

            </div>
            <div class="col-md-3">

              

              <div class="form-group">
                <label>Middle Name</label>
                <input class="form-control" type="text" readonly name="m_name" id="m_name" autocomplete = "off" value="<?php echo $m_nameA;?>">
              </div>

              <div class="form-group">
                <label>PERA</label>
                <input class="form-control" type="text" name="pera" id="pera" autocomplete = "off" value="<?php echo $peraA;?>">
              </div>

              <div class="form-group">
                <label>RATA</label>
                <input class="form-control" type="text" name="rata" id="rata" autocomplete = "off" value="<?php echo $rataA?>">
              </div>
            </div>

            <div class="col-md-3">

              <div class="form-group">
                <label>BIR Tax</label>
                <input class="form-control" type="text" name="bir" id="bir" autocomplete = "off" value="<?php echo $birA ?>">
              </div>

              <div class="form-group">
                <label>PAGIBIG Premium</label>
                <input class="form-control" type="text" name="pagibig_premium" id="pagibig_premium" autocomplete = "off" value="<?php echo $pagibig_premiumA ?>">
              </div>

              <div class="form-group">
                <label>PAGIBIG MP2 Savings</label>
                <input class="form-control" type="text" name="pagibig_mp2" id="pagibig_mp2" autocomplete = "off" value="<?php echo $pagibig_mp2A ?>">
              </div>
            </div>

            <div class="col-md-3">

              <div class="form-group">
                <label>PHIL HEALTH </label>
                <input class="form-control" type="text" name="philhealth" id="philhealth" autocomplete = "off" value="<?php echo $philhealthA ?>">
              </div>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>

        <button class="btn btn-primary showMsg"   type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Update</button>

        <br>
        <br>
        <br>
      </form>
    </div>  
  </div>  
  
</body>



