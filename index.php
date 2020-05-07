<?php session_start();
include 'connection.php';
if(!isset($_SESSION['username'])){
// header('location:index.php');
}else{
$username = $_SESSION['username'];
    $sqlUsername = mysqli_query($conn,"SELECT CODE,EMP_N,isPlanningOfficer FROM tblemployee WHERE md5(UNAME) = '".md5($username)."' LIMIT 1");
  $row = mysqli_fetch_array($sqlUsername);
  $salt       = $row['CODE'];
  $_SESSION['currentuser'] = $row['EMP_N']; 
  $_SESSION['planningofficer'] = $row['isPlanningOfficer']; 


  // ===============================================
  $query = "SELECT * FROM tblemployee WHERE md5(UNAME) = '".md5($username)."' LIMIT 1 ";
  $result = mysqli_query($conn, $query);
  $val = array();
  // $numrows= mysqli_num_rows($query);
  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
  {
    $division =$row['DIVISION_C'];
    $division2 = $row['DIVISION_C'];
    $_SESSION['division'] = $division;
    $middle = $row['MIDDLE_M'];
    $_SESSION['complete_name'] = ucwords(strtolower($row['FIRST_M'])).' '.$middle[0].'. '.ucwords(strtolower($row['LAST_M']));
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];

      // if ($division == 14 || $division == 16 || $division == 11 || $division == 12 || $division == 13) {
      if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') {
        
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home.php?division=".$division."';
        </SCRIPT>");
      }else{
        
       echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home1.php?division=".$division."';
        </SCRIPT>");
       } 
}

}

}

$_SESSION['username'] = '';
if (isset($_POST['submit'])) {
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $_SESSION['username'] = $username ;
  $username = $_SESSION['username'];
  $sqlUsername = mysqli_query($conn,"SELECT CODE,EMP_N,isPlanningOfficer FROM tblemployee WHERE md5(UNAME) = '".md5($_POST['username'])."' LIMIT 1");
  
  $row = mysqli_fetch_array($sqlUsername);
  $salt       = $row['CODE'];
  $_SESSION['currentuser'] = $row['EMP_N']; 
  $_SESSION['planningofficer'] = $row['isPlanningOfficer']; 

  $password  = crypt($_POST['password'], '$2a$10$'.$salt.'$');

  // ===============================================
  $query = "SELECT * FROM tblemployee WHERE md5(UNAME) = '".md5($_POST['username'])."' AND PSWORD = '".$password."' AND ACTIVATED = 'Yes' AND BLOCK = 'N' LIMIT 1 ";
  $result = mysqli_query($conn, $query);
  $val = array();
  // $numrows= mysqli_num_rows($query);
  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
  {
    $division =$row['DIVISION_C'];
    $division2 = $row['DIVISION_C'];
    $_SESSION['division'] = $division;
    $middle = $row['MIDDLE_M'];
    $_SESSION['complete_name'] = $row['FIRST_M'].' '.$middle[0].'. '.$row['LAST_M'];
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];

      if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
        
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Succesfully Login!')
        window.location.href='home.php?division=".$division."&username=".$username."';
        </SCRIPT>");
      }else{
        
       echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Succesfully Login!')
        window.location.href='home1.php?division=".$division."&username=".$username."';
        </SCRIPT>");
       }  
  }
}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Wrong Password Or Username!');
  window.location.href='index.php';
  </SCRIPT>");
}
 

}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FAS System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="dilg.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <!-- <b>DILG IV-A FAS -->
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p ><img src="images/login.png" style="width: 100%; height: auto;"></p>

        <form method="POST">
          <div class="form-group has-feedback">
            <input requried type="text" class="form-control" name="username" placeholder="Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input requried type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <a href="Registration.php" class="btn btn-success btn-xs">Not yet Registered?</a>
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>
      </div>
        
    </div>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });
      });
    </script>
  </body>
  </html>
