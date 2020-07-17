  <?php 
  include "config.php";
  include "dbaseCon.php";
  $DBConn = dbConnect();
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
  $division = $_GET['division'];
  $username = $_GET['username'];
  function tblpersonnel($connect)
  { 
    $output = '';
    $query = "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision` WHERE DIVISION_N = 1 || DIVISION_N = 10 || DIVISION_N = 18 || DIVISION_N = 17 || DIVISION_N = 9 || DIVISION_N = 7 || DIVISION_N = 19 || DIVISION_N = 20 || DIVISION_N = 21 || DIVISION_N = 22 || DIVISION_N = 23 || DIVISION_N = 24 AND DIVISION_M IS NOT NULL ORDER BY DIVISION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DIVISION_N"].'">'.$row["DIVISION_M"].'</option>';
    }
    return $output;
  }

  function tbldilgposition($connect)
  { 
    $output = '';
    $query = "SELECT POSITION_ID,POSITION_M FROM `tbldilgposition` ORDER BY POSITION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["POSITION_ID"].'">'.$row["POSITION_M"].'</option>';
    }
    return $output;
  }

  function tbldesignation($connect)
  { 
    $output = '';
    $query = "SELECT DESIGNATION_ID,DESIGNATION_M FROM `tbldesignation` ORDER BY DESIGNATION_M ASC ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DESIGNATION_ID"].'">'.$row["DESIGNATION_M"].'</option>';
    }
    return $output;
  }

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

  $sqltable   = "tblemployeeinfo";

  $checkQuery = "SELECT * FROM $sqltable a LEFT JOIN tblpersonneldivision b on b.DIVISION_N = a.DIVISION_C LEFT JOIN tbldesignation c on c.DESIGNATION_ID = a.DESIGNATION LEFT JOIN tbldilgposition d on d.POSITION_ID = a.POSITION_C WHERE a.EMP_N = '".$_GET['id']."' LIMIT 1";

  $checkQuery1 = mysqli_query($conn,"SELECT c.province_id,c.province_title FROM $sqltable a LEFT JOIN tblprovinse c on c.province_id = a.PROVINCE_C WHERE a.EMP_N = '".$_GET['id']."' LIMIT 1");
  $row1 = mysqli_fetch_array($checkQuery1);
  $province11               = $row1["province_title"];
  
  if (ifRecordExist($checkQuery))
  {
    $queryRs = $DBConn->query( $checkQuery );
    if ($queryRs->num_rows)
    {
      $row  = $queryRs->fetch_assoc();
      $EMP_NUMBER1             = $row["EMP_NUMBER"];
      $region1                 = $row["REGION_C"];
      $province1               = $row["PROVINCE_C"];
      $municipality1           = $row["CITYMUN_C"];
      $lname1                  = utf8_encode($row["LAST_M"]);
      $fname1                  = utf8_encode($row["FIRST_M"]);
      $mname1                  = utf8_encode($row["MIDDLE_M"]);
      $gender1                 = $row["SEX_C"];
      $designation1            = $row["DESIGNATION_M"];
      $designation11           = $row["DESIGNATION"];
      $position1               = $row["POSITION_M"];
      $position11              = $row["POSITION_C"];
      $birthdate1              = $row["BIRTH_D"];
      $bday1                   = date('m/d/Y',strtotime($birthdate1));
      $email1                  = $row["EMAIL"];
      $contact1                = $row["LANDPHONE"];
      $cellphone1              = $row["MOBILEPHONE"];
      $username1               = $row["UNAME"];
      $division1               = $row["DIVISION_C"];
      $division11              = $row["DIVISION_M"];
      $office1                 = $row["OFFICE_STATION"];
      $profile                 = $row['PROFILE'];
    }
  }
  
  $checkQuery1 = mysqli_query($conn,"SELECT b.city_id,b.city_title FROM $sqltable a LEFT JOIN tblmunicipality b on b.city_id = a.CITYMUN_C WHERE b.province = $province1 AND a.EMP_N = '".$_GET['id']."' LIMIT 1");
  $row1 = mysqli_fetch_array($checkQuery1);
  $municipality11           = $row1["city_title"];

  if (isset($_POST['submit'])) {
    $region          = '04';
    $province        = $_POST["province"];
    $municipality    = $_POST["municipality"];
    $employeeid      = "";
    $employee_number = $_POST["employee_number"];
    $fname           = strtoupper($_POST["fname"]);
    $mname           = strtoupper($_POST["mname"]);
    $lname           = strtoupper($_POST["lname"]);
    $gender          = $_POST["gender"];  
    $designation     = $_POST["designation"];
    $position        = $_POST["position"];
    $division        = $_POST["division"];
    $office          = $_POST["office"];
    $birthdate1      = $_POST["birthdate"];               
    $birthdate       = date('Y-m-j H:i:s',strtotime($birthdate1));               
    $email           = $_POST["email"]; 
    $alter_email     = $_POST["alter_email"];       
    $suffix          = $_POST["suffix"];       
    $status          = $_POST["status"];       
    $contact         = $_POST["contact"]; 
    $username        = $_POST["username"];  
    $password        = $_POST["password"];  
    $office_address  = $_POST["office_address"];  
    $office_contact  = $_POST["office_contact"];  
    $office_landline  = $_POST["office_landline"];  
    $repassword      = $_POST["repassword"];  
    $e_stats         = $_POST["e_stats"];  
    $cluster         = "";       
    $access          = "";       
    $cellphone       = $_POST["cellphone"];
    $target_dir      = "images/profile/";
    $target_file     = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk        = 1;
    $imageFileType   = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $pagibig         = $_POST["pagibig"];
    $pagibig_premium = $_POST["pagibig_premium"];
    $tin             = $_POST["tin"];
    $bir             = $_POST["bir"];
    $philhealth      = $_POST["philhealth"];
    $gsis            = $_POST["gsis"];
    $salary          = $_POST["salary"];
    $step            = $_POST["step"];
    $employment_date11= $_POST["employment_date"];
    $employment_date = date('Y-m-d',strtotime($employment_date11));
    $permanent_address = $_POST["permanent_address"];    
    $current_address = $_POST["current_address"];    

    $select = mysqli_query($conn,"SELECT $step FROM tbl_salary_grade WHERE salary_grade = '$salary' ");
    $rowES = mysqli_fetch_array($select);
    $salaryS = $rowES[$step];

    $sqlUsername =  "SELECT * FROM tblemployeeinfo WHERE md5(UNAME) = '".md5($username)."' LIMIT 1";    
    $sqlEMP_N =  "SELECT EMP_NUMBER FROM tblemployeeinfo WHERE EMP_NUMBER = '".$employee_number."' LIMIT 1";    
    if (!ifRecordExist($sqlEMP_N)){
      $sql_insert_query     = mysqli_query($conn,"INSERT INTO tblemployeeinfo (EMP_NUMBER,LAST_M, FIRST_M,MIDDLE_M, BIRTH_D, SEX_C,REGION_C, PROVINCE_C, CITYMUN_C,POSITION_C,DESIGNATION,MOBILEPHONE, EMAIL, ALTER_EMAIL,UNAME, DATE_CREATED,LANDPHONE, OFFICE_STATION, DIVISION_C, PROFILE,SUFFIX,CIVIL_STATUS,ACTIVATED,REMARKS_M,CURRENT_ADDRESS,PERMANENT_ADDRESS,STATUS_OF_APP)
        VALUES ('$employee_number','$lname', '$fname', '$mname', '$birthdate', '$gender', '$region', '$province', '$municipality', '$position', '$designation', '$cellphone', '$email', '$alter_email','$username', '$date_created', '$office_contact', '$office', '$division','$target_file','$suffix','$status','$e_stats','$office_address','$current_address','$permanent_address', '$office_landline')");

      if ($e_stats == 'Yes') {
        if ($province == '') {
          $province = 77;
        }
        $selectProvince = mysqli_query($conn, "SELECT LGU_M FROM tbl_province WHERE PROVINCE_C = '$province");
        $rowP = mysqli_fetch_array($selectProvince);
        $station = $rowP['LGU_M'];
        # code...
        $insertqwe = mysqli_query($conn,"INSERT INTO tbl_employee(emp_no,pagibig,l_name,f_name,m_name,pagibig_premium,tin,bir,philhealth,gsis,salary,step,employment_date,station) 
          VALUES('$employee_number','$pagibig','$lname','$fname','$mname','$pagibig_premium','$tin','$bir','$philhealth','$gsis','$salary','$step','$employment_date','$station')");

        if ($insertqwe) {
          $save_salary = $salaryS *.09;
          if ($salaryS > 59999) {
            $phil = 900;
            $insert_deduct = mysqli_query($conn,"INSERT INTO tbl_deductions(emp_no,monthly_salary,rlip,pera,philhealth) VALUES('$employee_number','$salaryS','$save_salary',2000,'$phil')");
          }else{
            $phil = $salaryS *0.03 / 2;
            $insert_deduct = mysqli_query($conn,"INSERT INTO tbl_deductions(emp_no,monthly_salary,rlip,pera,philhealth) VALUES('$employee_number','$salaryS','$save_salary',2000,'$phil')");
          }
        }
      }

      if ($sql_insert_query) 
      { 


        if(!empty(basename($_FILES["image"]["name"])))
        {
          if(!empty($_FILES["image"]["name"]))
          {
            // Check if file already exists
            if (file_exists($target_file)) 
            {
                // echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 9000000)
            {
                // echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
                // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) 
            {
            // if everything is ok, try to upload file
            } 
            else 
            {
             if(!empty($_FILES["image"]["tmp_name"]))
             {
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
              {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
              } else 
              {
                echo "Sorry, there was an error uploading your file.";
              }
            }
          }

        }
      }

      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfuly Added')
        window.location.href = 'ViewEmployees.php?division=".$_GET['division']."&username=".$_GET['username']."';
        </SCRIPT>");

    }else{
     echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured Uppon Saving!');
      </SCRIPT>");
   }


 }else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Employee Number Already Exist!');
    </SCRIPT>");
 }
}

?>


<script src="jquery-1.12.0.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("#sel_depart").change(function(){
      var deptid = $(this).val();

      $.ajax({
        url: 'getUsers.php',
        type: 'post',
        data: {depart:deptid},
        dataType: 'json',
        success:function(response){

          var len = response.length;

          $("#sel_user").empty();
          for( var i = 0; i<len; i++){
            var id = response[i]['citymun_c'];
            var name = response[i]['citymun_m'];

            $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

          }
        }
      });
    });

  });
</script>

<div class="box box-success">
  <div class="box-header with-border">
   <h1 align="" style="font-family: Cambria;">Profile</h1>
   <?php 
   $extension = pathinfo($profile, PATHINFO_EXTENSION);
   ?>
   <form method="POST" enctype="multipart/form-data"  >
    <div class="" style="background-image: url(images/LOGO.png);background-repeat: no-repeat;background-position: center;">
      <div class="box-header with-border">
        <div class="pull-left" >
          <div class = "center">
            <img id="img"   style="overflow: hidden;width:300;height:250px;margin-left:50px;border:2px solid black;" 
            src="images/male-user.png"  title = "personnel_image" />
            <input type ="hidden" name = "dddd" value="" />
          </div>
          <input name = "image" class="pull-right" type="file" id="image"  onchange="readURL(this)" />
        </div>
      </div>
    </div>
    <div class="box-body">
      <div class="well">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
             <label>Employee No. <font style="color:red;">*</font></label>
             <input value="<?php echo $EMP_NUMBER1;?>" type="text" class="form-control" placeholder="Employee No." name="employee_number" id="employee_number">
           </div>

           <div class="form-group">
             <label>Last Name<font style="color:red;">*</font></label>
             <input required type="text" value="<?php echo $lname1;?>" name="lname" class="form-control" placeholder="Last Name">
           </div>

           <div class="form-group">
            <label>First Name<font style="color:red;">*</font></label>
            <input required value="<?php echo $fname1;?>" type="text" name="fname" class="form-control" placeholder="First Name">
          </div>

          <div class="form-group">
            <label>Middle Name<font style="color:red;">*</font></label>
            <input required value="<?php echo $mname1;?>" type="text" name="mname" class="form-control" placeholder="Middle Name">
          </div>

          <div class="form-group">
            <label>Extension Name<font style="color:red;"></font></label>
            <input  value="<?php echo $suffix;?>" type="text" name="suffix" class="form-control" placeholder="Extension Name">
          </div>

          <div class="form-group">
            <label>Sex<font style="color:red;">*</font></label>
            <select class="form-control select2" name="gender">
              <option disabled selected></option>
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
          </div>

          <div class="form-group">
            <label>Civil Status<font style="color:red;">*</font></label>
            <select class="form-control select2" name="status">
              <option disabled selected></option>
              <option value="Single">Single</option>
              <option value="Maried">Married</option>
            </select>
          </div>

          <div class="form-group">
           <label>Birth Date<font style="color:red;">*</font></label>
           <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input autocomplete="new-password" required type="text" value="<?php echo $bday1;?>" name="birthdate" class="form-control pull-right" id="datepicker" placeholder="Birth Date">
          </div>
        </div>

        

        


      </div>

      <div class="col-md-3">

        <div class="form-group">
          <label>Office Station<font style="color:red;">*</font></label>
          <select required id="mySelect2" class="form-control mySelect2" name="office">
            <option disabled selected></option>
            <option value="1">Regional Office</option>
            <option value="2">Provincial/HUC Office</option>
            <option value="3">Cluster Office</option>
            <option value="4">City/Municipal Office</option>
          </select>
        </div>

        <div class="form-group">
         <label>Province</label>
         <input type="text" name="province" hidden>
         <select  disabled  class="form-control select2" style="width: 100%;" name="province" id="sel_depart" >
          <option value="<?php echo $province1;?>"><?php echo $province11;?></option>
          <option value="10">Batangas</option>
          <option value="21">Cavite</option>
          <option value="34">Laguna</option>
          <option value="56">Quezon</option>
          <option value="58">Rizal</option>
        </select>
      </div>

      <div class="form-group">
       <label>City/Municipality</label>
       <input type="text" name="municipality" hidden>
       <select  disabled id="sel_user" name="municipality" class="form-control select2">
        <option value="<?php echo $municipality11;?>"><?php echo $municipality11;?></option>
        <option value="0"></option>
      </select>
    </div>

    <div class="form-group">
      <label>Office/Division<font style="color:red;">*</font></label>
      <select required class="form-control select2" style="width: 100%;" name="division" id="" >
        <option value="<?php echo $division1;?>" selected><?php echo $division11;?></option>
        <?php echo tblpersonnel($connect)?>
      </select>
    </div>

    <div class="form-group">
     <label>Position<font style="color:red;">*</font></label>
     <select required class="form-control select2" style="width: 100%;" name="position" id="" >
      <option value="<?php echo $position11;?>" selected><?php echo $position1;?></option>
      <?php echo tbldilgposition($connect)?>
    </select>
  </div>

  <div class="form-group">
    <label>Designation<font style="color:red;">*</font></label>
    <select required class="form-control select2" style="width: 100%;" name="designation" id="" >
      <option value="<?php echo $designation1;?>" selected><?php echo $designation1;?></option>
      <?php echo tbldesignation($connect)?>
    </select>
  </div>
  <div class="form-group">
    <label>Employment Status<font style="color:red;">*</font></label>
    <select class="form-control select2" name="e_stats">
      <option disabled selected></option>
      <option value="Yes">Regular</option>
      <option value="No">COS</option>
    </select>
  </div>

  <div class="form-group">
    <label>Employment Date &nbsp<b style="color:red;">*</b></label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input autocomplete="new-password" required type="text"  name="employment_date" class="form-control pull-right" id="datepicker2" placeholder="Employment Date">
    </div>
  </div>

  

</div>

<div class="col-md-3">
  <div class="form-group">
    <label>Mobile <font style="color:red;">*</font></label>
    <input  value="<?php echo $cellphone1;?>" type="text" name="cellphone" class="form-control cp" placeholder="ex. 0995-264-4344">
  </div>

  <div class="form-group">
    <label>Personal Email Address <font style="color:red;">*</font></label>
    <input  value="<?php echo $cellphone1;?>" type="text" name="email" class="form-control" placeholder="">
  </div>

  <div class="form-group">
    <label>Permanent Residential Address <font style="color:red;">*</font></label>
    <input   type="text" name="permanent_address" class="form-control" placeholder="">
  </div>

  <div class="form-group">
    <label>Current Residential Address <font style="color:red;">*</font></label>
    <input   type="text" name="current_address" class="form-control" placeholder="">
  </div>

  <div class="form-group">
    <label>Office Landline</label>
    <input value="<?php echo $office_landline;?>" type="text" name="office_landline" class="form-control cp" placeholder="">
  </div>

  <div class="form-group">
    <label>Office Mobile</label>
    <input value="<?php echo $office_mobile;?>" type="text" name="office_contact" class="form-control cp" placeholder="">
  </div>



  <div class="form-group">
    <label>Office Email Address <font style="color:red;">*</font></label>
    <input  value="<?php echo $alter_email;?>" type="text" name="alter_email" class="form-control" >
  </div>

  <div class="form-group">
    <label>Office Address</label>
    <input value="<?php echo $office_address;?>" type="text" name="office_address" class="form-control" >
  </div>
  
</div>

<div class="col-md-3">
  <div class="form-group">

    <label>Salary Grade<b style="color:red;">*</b></label>
    <select required class="form-control select2" style="width: 100%;" name="salary" id="salary" >
      <option selected disabled ></option>
      <?php echo fill_unit_select_box($connect);?>
    </select>

  </div>
  <div class="form-group">
    <label>Step<b style="color:red;">*</b></label>

    <select required class="form-control select2" style="width: 100%;" name="step" id="step" >
      <option selected disabled></option>
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

  <div class="form-group">
    <label>PAGIBIG Premium</label>
    <input class="form-control" type="text" name="pagibig_premium" id="pagibig_premium" autocomplete = "off" value="<?php echo isset($_POST['pagibig_premium']) ? $_POST['pagibig_premium'] : '' ?>">
  </div>

  <div class="form-group">
    <label>BIR Tax</label>
    <input class="form-control" type="text" name="bir" id="bir" autocomplete = "off" value="<?php echo isset($_POST['bir']) ? $_POST['bir'] : '' ?>">
  </div>




</div>

</div>
</div>
<!-- username and pw -->
</div>
<div class="well" hidden>
  <div class="box-header with-border">
    <h3 class="box-title">Username and Password</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Username<font style="color:red;">*</font> </label>
          <input autocomplete="new-password" value="<?php echo $username1;?>" type="text" name="username" id="username" class="form-control" placeholder="Username">

        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Password<font style="color:red;">*</font> </label>
          <input autocomplete="new-password" type="password" name="password" class="form-control" placeholder="Password">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Re-type Password<font style="color:red;">*</font></label>
          <input autocomplete="new-password" type="password" name="repassword" class="form-control" placeholder="Re-type Password">
        </div>
      </div>

    </div>
  </div>
</div>  
<div class="row">
  <div class="col-xs-2" align="center" >
    <button class="btn btn-block btn-primary" name="submit" type="submit" id="submit"><font size="">Save</font></button>
  </div>
</div>
</div>
</form>

<script>
  $('#mySelect2').on('change', function() {
    var value = $(this).val();
    if (value == '1') {
      $('#sel_depart').find('option').remove().end().append('<option disabled selected></option><option value="10">Batangas</option><option value="21">Cavite</option><option value="34">Laguna</option><option value="56">Quezon</option>  <option value="58">Rizal</option>') ;
      $('#sel_user').find('option').remove().end().append('<option disabled selected></option>') ;
      document.getElementById("sel_depart").disabled=true;
      document.getElementById("sel_user").disabled=true;
    }
    if (value == '2' || value == '3') {
      $('#sel_depart').find('option').remove().end().append('<option disabled selected></option><option value="10">Batangas</option><option value="21">Cavite</option><option value="34">Laguna</option><option value="56">Quezon</option>  <option value="58">Rizal</option>') ;
      $('#sel_user').find('option').remove().end().append('<option disabled selected></option>') ;
      document.getElementById("sel_depart").disabled=false;
      document.getElementById("sel_user").disabled=true;
    }
    if (value == '4') {
     $('#sel_depart').find('option').remove().end().append('<option disabled selected></option><option value="10">Batangas</option><option value="21">Cavite</option><option value="34">Laguna</option><option value="56">Quezon</option>  <option value="58">Rizal</option>') ;
     $('#sel_user').find('option').remove().end().append('<option disabled selected></option>') ;
     document.getElementById("sel_depart").disabled=false;
     document.getElementById("sel_user").disabled=false;
   }
 });

  $(window).load(function()
  {
   var phones = [{ "mask": "####-###-####"}, { "mask": "####-###-####"}];
   $('.cp').inputmask({ 
    mask: phones, 
    greedy: false, 
    definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
 });


</script>
<script>
  function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
     $('#img').attr('src', 'images/male-user.png');
   }
 }

 function checkAvailability() {
  $("#loaderIcon").show();
  jQuery.ajax({
    url: "ch1.php",
    data:'employee_number='+$("#employee_number").val(),
    type: "POST",
    success:function(data){
      $("#user-email-availability-status").html(data);
      $("#loaderIcon").hide();
    },
    error:function (){}
  });
}

function checkUsernameAvailability() {
  $("#loaderIcon").show();
  jQuery.ajax({
    url: "ch1.php",
    data:'username='+$("#username").val(),
    type: "POST",
    success:function(data){
      $("#user-username-availability-status").html(data);
      $("#loaderIcon").hide();
    },
    error:function (){}
  });
}
</script>


