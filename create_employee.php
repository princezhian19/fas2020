<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

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

  $selectEMP = mysqli_query($conn,"SELECT * FROM tbl_employee WHERE emp_no = '$emp_no' ");

  if (mysqli_num_rows($selectEMP)>0) {

    echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Employee Number is Already Exist! </p> </div></div>  ';

  }else{

    if ($gender == "NULL") {
      echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Gender! </p> </div></div>  ';
      
    }else{
      if ($division == "NULL") {
        echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Division! </p> </div></div>  ';
      }else{
        if ($designation == "NULL") {
          echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Position! </p> </div></div>  ';
        }else{
          if ($station == "NULL") {
            echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Designation! </p> </div></div>  ';
          }else{
            if ($salary == "NULL") {
              echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Salary! </p> </div></div>  ';
            }else{
              if ($step == "NULL") {
                echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Select Step! </p> </div></div>  ';
              }else{
                $select = mysqli_query($conn,"SELECT $step FROM tbl_salary_grade WHERE salary_grade = '$salary' ");
                $row = mysqli_fetch_array($select);
                $salaryS = $row[$step];


                $insert = mysqli_query($conn,"INSERT INTO tbl_employee(emp_no,full_name,m_name,f_name,l_name,ext_name,mobile,birthday,gender,station,division,designation,email,pagibig,pagibig_premium,tin,bir,philhealth,gsis,salary,step,employment_date) VALUES('$emp_no','$full_name','$m_name','$f_name','$l_name','$ext_name','$mobile','$birthday','$gender','$station','$division','$designation','$email','$pagibig','$pagibig_premium','$tin','$bir','$philhealth','$gsis','$salary','$step','$employment_date')");
                if ($insert) {
                  $save_salary = $salaryS *.09;
                  if ($salaryS > 59999) {
                    $phil = 900;
                    $insert_deduct = mysqli_query($conn,"INSERT INTO tbl_deductions(emp_no,monthly_salary,rlip,pera,philhealth) VALUES('$emp_no','$salaryS','$save_salary',2000,'$phil')");
                  }else{
                    $phil = $salaryS *.03 / 2;
                    $insert_deduct = mysqli_query($conn,"INSERT INTO tbl_deductions(emp_no,monthly_salary,rlip,pera,philhealth) VALUES('$emp_no','$salaryS','$save_salary',2000,'$phil')");
                  }


                  echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;">Profile Successfuly Saved! &nbsp'. $full_name ;
                  echo '</p> </div></div>';
                  header("Refresh:0");
                }
                else{
                  echo '<div  class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Error in saving! </p> </div></div>  ';
                }
              }
            }
          }
        }

      }

    }



    


    





    // echo '<p style = "background-color:red;color:white;padding:10px;"> WARNING : You Entered Invalid Quantity </p>   ';
    // echo ("<SCRIPT LANGUAGE='JavaScript'>
    //   window.alert('WARNING : Invalid Quantity')
    //   window.location.href='CreatePr.php';
    //   </SCRIPT>");
   // header('location: CreatePr.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');
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
                  <input class="form-control" type="text" required name="emp_no" id="emp_no" autocomplete = "off" value="<?php echo isset($_POST['emp_no']) ? $_POST['emp_no'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Last Name &nbsp<b style="color:red;">*</b></label>
                  <input class="form-control" type="text" required name="l_name" id="l_name" autocomplete = "off" value="<?php echo isset($_POST['l_name']) ? $_POST['l_name'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>First Name &nbsp<b style="color:red;">*</b></label>
                  <input class="form-control" type="text" required name="f_name" id="f_name" autocomplete = "off" value="<?php echo isset($_POST['f_name']) ? $_POST['f_name'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Middle Name</label>
                  <input class="form-control" type="text" name="m_name" id="pr_no" autocomplete = "off" value="<?php echo isset($_POST['m_name']) ? $_POST['m_name'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Extension Name</label>
                  <input class="form-control" type="text" name="ext_name" id="ext_name" autocomplete = "off" value="<?php echo isset($_POST['ext_name']) ? $_POST['ext_name'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Birth Date</label>
                  <input class="form-control" type="date" name="birthday" id="birthday" autocomplete = "off" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : '' ?>">
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control select2" style="width: 100%;" name="gender"  >
                    <option value="NULL">--------------------</option>

                    <option <?php if (isset($gender) && $gender=="Male") echo "Male";?>>Male</option>
                    <option <?php if (isset($gender) && $gender=="Female") echo "Female";?>>Female</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Division</label>
                  <select class="form-control select2" style="width: 100%;" name="station"  >
                    <option value="NULL">--------------------</option>
                    <?php echo province($connect);?>
                  </select>
                  <!-- <input class="form-control" type="text" name="station" id="station" autocomplete = "off" value="QUEZON"> -->
                  <!-- <input class="form-control" type="text" name="station" id="station" autocomplete = "off" value="<?php echo isset($_POST['station']) ? $_POST['station'] : '' ?>"> -->
                </div>

                <div class="form-group">
                  <label>Designation</label>
                  <select class="form-control select2" style="width: 100%;" name="division"  >
                    <option value="NULL">--------------------</option>
                    <?php echo designation($connect);?>
                  </select>
                  <!-- <input class="form-control" type="text" name="division" id="division" autocomplete = "off" value="<?php echo isset($_POST['division']) ? $_POST['division'] : '' ?>"> -->
                </div>

                <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2" style="width: 100%;" name="designation"  >
                    <option value="NULL">--------------------</option>
                    <?php echo position($connect);?>
                  </select>
                  <!-- <input class="form-control" type="text" name="designation" id="designation" autocomplete = "off" value="<?php echo isset($_POST['designation']) ? $_POST['designation'] : '' ?>"> -->
                </div>

                <div class="form-group">
                  <label>Salary Grade &nbsp<b style="color:red;">*</b></label>
                  <select required class="form-control select2" style="width: 100%;" name="salary" id="salary" >
                    <option value="NULL">--------------------</option>
                    <?php echo fill_unit_select_box($connect);?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Step &nbsp<b style="color:red;">*</b></label>

                  <select required class="form-control select2" style="width: 100%;" name="step" id="step" >
                    <option value="NULL">--------------------</option>
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
                  <input class="form-control" type="text" name="mobile" id="mobile" autocomplete = "off" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" type="text" name="email" id="email" autocomplete = "off" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>TIN</label>
                  <input class="form-control" type="text" name="tin" id="tin" autocomplete = "off" value="<?php echo isset($_POST['tin']) ? $_POST['tin'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>GSIS Number</label>
                  <input class="form-control" type="text" name="gsis" id="gsis" autocomplete = "off" value="<?php echo isset($_POST['gsis']) ? $_POST['gsis'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Philhealth Number</label>
                  <input class="form-control" type="text" name="philhealth" id="philhealth" autocomplete = "off" value="<?php echo isset($_POST['philhealth']) ? $_POST['philhealth'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>PAGIBIG Number</label>
                  <input class="form-control" type="text" name="pagibig" id="pagibig" autocomplete = "off" value="<?php echo isset($_POST['pagibig']) ? $_POST['pagibig'] : '' ?>">
                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">
                  <label>PAGIBIG Premium</label>
                  <input class="form-control" type="text" name="pagibig_premium" id="pagibig_premium" autocomplete = "off" value="<?php echo isset($_POST['pagibig_premium']) ? $_POST['pagibig_premium'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>BIR Tax</label>
                  <input class="form-control" type="text" name="bir" id="bir" autocomplete = "off" value="<?php echo isset($_POST['bir']) ? $_POST['bir'] : '' ?>">
                </div>

                <div class="form-group">
                  <label>Employment Date &nbsp<b style="color:red;">*</b></label>
                  <input  class="form-control" type="date" name="employment_date"  autocomplete = "off" value="<?php echo isset($_POST['employment_date']) ? $_POST['employment_date'] : '' ?>">
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-success showMsg"   type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>
          <br>
          <br>
          <br>
        </form>
      </div>  
    </div>  
  </body>



