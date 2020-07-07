<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];

function fill_unit_select_box($connect)
{ 
  $output = '';
  $query = "SELECT salary_grade FROM tbl_salary_grade GROUP BY salary_grade ASC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["salary_grade"].'">'.$row["salary_grade"].'</option>';
  }
  return $output;
}

function province($connect)
{ 
  $output = '';
  $query = "SELECT LGU_M FROM `tbl_province`";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["LGU_M"].'">'.$row["LGU_M"].'</option>';
  }
  return $output;
}

function designation($connect)
{ 
  $output = '';
  $query = "SELECT DESIGNATION_M FROM `tbl_designation`";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["DESIGNATION_M"].'">'.$row["DESIGNATION_M"].'</option>';
  }
  return $output;
}

function position($connect)
{ 
  $output = '';
  $query = "SELECT POSITION_M FROM `tbl_dilgposition`";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["POSITION_M"].'">'.$row["POSITION_M"].'</option>';
  }
  return $output;
}


if (isset($_POST['submit'])) {
  $emp_no = $_POST["emp_no"];
  $m_name = $_POST["m_name"];
  $f_name = $_POST["f_name"];
  $l_name = $_POST["l_name"];
  $ext_name = $_POST["ext_name"];
  $mobile = $_POST["mobile"];
  $birthday = $_POST["birthday"];
  $gender = $_POST["gender"];
  $station = $_POST["station"];
  $division = $_POST["division"];
  $designation = $_POST["designation"];
  $email = $_POST["email"];
  $pagibig = $_POST["pagibig"];
  $pagibig_premium = $_POST["pagibig_premium"];
  $tin = $_POST["tin"];
  $bir = $_POST["bir"];
  $philhealth = $_POST["philhealth"];
  $gsis = $_POST["gsis"];
  $salary = $_POST["salary"];
  $step = $_POST["step"];
  $employment_date = $_POST["employment_date"];

  $full_name = $f_name . ' ' . $m_name . ' ' . $l_name;


  $updateS = mysqli_query($conn,"UPDATE tbl_employee SET station = '$station' WHERE id = '$id' ");

  $update_tbl_deductions = mysqli_query($conn,"UPDATE tbl_deductions SET emp_no = '$emp_no' WHERE emp_no = '$emp_no' ");
  $update_tbl_deduction_loans = mysqli_query($conn,"UPDATE tbl_deduction_loans SET emp_no = '$emp_no' WHERE emp_no = '$emp_no' ");

  $update_emp = mysqli_query($conn,"UPDATE tbl_employee SET emp_no = '$emp_no',full_name = '$full_name',m_name = '$m_name',f_name = '$f_name',l_name = '$l_name',ext_name = '$ext_name',mobile = '$mobile',birthday = '$birthday',gender = '$gender',station = '$station',division = '$division',designation = '$designation',email = '$email',pagibig = '$pagibig',pagibig_premium = '$pagibig_premium',tin = '$tin',bir = '$bir',philhealth = '$philhealth',gsis = '$gsis',salary = '$salary',step = '$step',employment_date = '$employment_date' WHERE id = '$id'");

  if ($update_emp) {

    $select = mysqli_query($conn,"SELECT $step FROM tbl_salary_grade WHERE salary_grade = '$salary' ");
  $row = mysqli_fetch_array($select);
  $salaryS = $row[$step];

  $save_salary = $salaryS *.09;

  if ($salaryS > 59999) {

    $phil = 900;
    $insert_deduct = mysqli_query($conn,"
      UPDATE tbl_deductions SET  monthly_salary ='$salaryS',rlip = '$save_salary',philhealth = '$phil' WHERE emp_no = '$emp_no'  ");
  }else{
    $phil = $salaryS *.03 / 2;
    $insert_deduct = mysqli_query($conn,"
      UPDATE tbl_deductions SET  monthly_salary ='$salaryS',rlip = '$save_salary',philhealth = '$phil' WHERE emp_no = '$emp_no'  ");
  }

    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success : Profile Successfuly Updated!');
      window.location.href='ViewEmpDetails.php?id=$id';
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
<?php 
$get_details = mysqli_query($conn,"SELECT * FROM tbl_employee WHERE id = '$id' ");
$rowEmp = mysqli_fetch_array($get_details);
$emp_no = $rowEmp['emp_no'];
$full_name = $rowEmp['full_name'];
$m_name = $rowEmp['m_name'];
$f_name = $rowEmp['f_name'];
$l_name = $rowEmp['l_name'];
$ext_name = $rowEmp['ext_name'];
$mobile = $rowEmp['mobile'];
$email = $rowEmp['email'];
$birthday = $rowEmp['birthday'];
$gender = $rowEmp['gender'];
$station = $rowEmp['station'];
$division = $rowEmp['division'];
$designation = $rowEmp['designation'];
$pagibig = $rowEmp['pagibig'];
$pagibig_premium = $rowEmp['pagibig_premium'];
$tin = $rowEmp['tin'];
$philhealth = $rowEmp['philhealth'];
$gsis = $rowEmp['gsis'];
$salary = $rowEmp['salary'];
$step = $rowEmp['step'];
$employment_date = $rowEmp['employment_date'];


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
      <h1 align="">&nbspCreate New Employee</h1>
      &nbsp &nbsp<li class="btn btn-success"><a href="ViewEmployee.php" style="color:white;text-decoration: none;">Back</a></li>
      &nbsp &nbsp<li class="btn btn-info"><a href="CreateNewEmployee.php" style="color:white;text-decoration: none;">New</a></li>
      <p></p>
      <form method="POST" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Employee Number &nbsp<b style="color:red;">*</b></label>
                  <input class="form-control" type="text" required name="emp_no" id="emp_no" autocomplete = "off" value="<?php echo $emp_no;?>">
                </div>

                <div class="form-group">
                  <label>Last Name &nbsp<b style="color:red;">*</b></label>
                  <input class="form-control" type="text" required name="l_name" id="l_name" autocomplete = "off" value="<?php echo $l_name;?>">
                </div>

                <div class="form-group">
                  <label>First Name &nbsp<b style="color:red;">*</b></label>
                  <input class="form-control" type="text" required name="f_name" id="f_name" autocomplete = "off" value="<?php echo $f_name; ?>">
                </div>

                <div class="form-group">
                  <label>Middle Name</label>
                  <input class="form-control" type="text" name="m_name" id="pr_no" autocomplete = "off" value="<?php echo $m_name; ?>">
                </div>

                <div class="form-group">
                  <label>Extension Name</label>
                  <input class="form-control" type="text" name="ext_name" id="ext_name" autocomplete = "off" value="<?php echo $ext_name;?>">
                </div>

                <div class="form-group">
                  <label>Birth Date</label>
                  <input class="form-control" type="date" name="birthday" id="birthday" autocomplete = "off" value="<?php echo $birthday;?>">
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Gender</label>
                  <?php if ($gender == "Male"): ?>
                   <select class="form-control select2" style="width: 100%;" name="gender" >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <?php else: ?>
                    <select class="form-control select2" style="width: 100%;" name="gender" >
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                    </select>
                  <?php endif ?>

                </div>
                <div class="form-group">
                  <label>Division</label>
                  <?php if ($station != "BATANGAS" && $station != "CAVITE" && $station != "LAGUNA" && $station != "QUEZON" && $station != "RIZAL"): ?>
                    <select class="form-control select2" style="width: 100%;" name="station"  >
                      <?php echo province($connect);?>
                    </select>
                    <?php else: ?>
                      <select class="form-control select2" style="width: 100%;" name="station"  >
                        <option><?php echo $station;?></option>
                        <?php echo province($connect);?>
                      </select>
                    <?php endif ?>

                  </div>

                  <div class="form-group">
                    <label>Designation</label>
                    <select class="form-control select2" style="width: 100%;" name="division"  >
                        <option value="<?php echo $division?>"><?php echo $division?></option>
                      <?php echo designation($connect);?>
                    </select>
                    <!-- <input class="form-control" type="text" name="division" id="division" autocomplete = "off" value="<?php echo $division?>"> -->
                  </div>

                  <div class="form-group">
                    <label>Position</label>
                    <select class="form-control select2" style="width: 100%;" name="designation"  >
                        <option value="<?php echo $designation?>"><?php echo $designation?></option>
                      <?php echo position($connect);?>
                    </select>
                    <!-- <input class="form-control" type="text" name="designation" id="designation" autocomplete = "off" value="<?php echo $designation ?>"> -->
                  </div>

                  <div class="form-group">
                    <label>Salary Grade &nbsp<b style="color:red;">*</b></label>
                    <select required class="form-control select2" style="width: 100%;" name="salary" id="salary" >
                      <option value="<?php echo $salary;?>"><?php echo $salary;?></option>
                      <?php echo fill_unit_select_box($connect);?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Step &nbsp<b style="color:red;">*</b></label>
                    <?php 
                    if ($step == "step_1") {
                      $stepp = "1";
                    }
                    if ($step == "step_2") {
                      $stepp = "2";
                    }
                    if ($step == "step_3") {
                      $stepp = "3";
                    }

                    if ($step == "step_4") {
                      $stepp = "4";
                    }

                    if ($step == "step_5") {
                      $stepp = "5";
                    }

                    if ($step == "step_6") {
                      $stepp = "6";
                    }

                    if ($step == "step_7") {
                      $stepp = "7";
                    }

                    if ($step == "step_8") {
                      $stepp = "8";
                    }

                    ?>

                    <select required class="form-control select2" style="width: 100%;" name="step" id="step" >
                      <option value="<?php echo $step;?>"><?php echo $stepp;?></option>
                      <option value="step_1">1</option>
                      <option value="step_2">2</option>
                      <option value="step_3">3</option>
                      <option value="step_4">4</option>
                      <option value="step_5">5</option>
                      <option value="step_6">6</option>
                      <option value="step_7">7</option>
                      <option value="step_8">8</option>
                    </select>
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input class="form-control" type="text" name="mobile" id="mobile" autocomplete = "off" value="<?php echo $mobile ?>">
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email" id="email" autocomplete = "off" value="<?php echo $email ?>">
                  </div>

                  <div class="form-group">
                    <label>TIN</label>
                    <input class="form-control" type="text" name="tin" id="tin" autocomplete = "off" value="<?php echo $tin ?>">
                  </div>

                  <div class="form-group">
                    <label>GSIS Number</label>
                    <input class="form-control" type="text" name="gsis" id="gsis" autocomplete = "off" value="<?php echo $gsis ?>">
                  </div>

                  <div class="form-group">
                    <label>Philhealth Number</label>
                    <input class="form-control" type="text" name="philhealth" id="philhealth" autocomplete = "off" value="<?php echo $philhealth ?>">
                  </div>

                  <div class="form-group">
                    <label>PAGIBIG Number</label>
                    <input class="form-control" type="text" name="pagibig" id="pagibig" autocomplete = "off" value="<?php echo $pagibig ?>">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>PAGIBIG Premium</label>
                    <input class="form-control" type="text" name="pagibig_premium" id="pagibig_premium" autocomplete = "off" value="<?php echo $pagibig_premium ?>">
                  </div>

                  <div class="form-group">
                    <label>BIR Tax</label>
                    <input class="form-control" type="text" name="bir" id="bir" autocomplete = "off" value="<?php echo $bir ?>">
                  </div>

                  <div class="form-group">
                    <label>Employment Date &nbsp<b style="color:red;">*</b></label>
                    <input required class="form-control" type="date" name="employment_date"  autocomplete = "off" value="<?php echo $employment_date ?>">
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary showMsg"   type="submit" name="submit" onclick="return confirm('Are you sure you want to update now?');">Update</button>
            <br>
            <br>
            <br>
          </form>
        </div>  
      </div>  
    </body>



