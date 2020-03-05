<?php 
session_start();
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
if (isset($_POST['submit'])) {
$username = $_POST['username'];
$password = $_POST['password'];
// for mam
$_SESSION['username'] = $username ;

if($_SESSION['username'] ='mmmonteiro')
{
  ($_SESSION['username'] = 'fad';
}else{
  $_SESSION['username'] = $username ;

}

$selectUser = mysqli_query($conn,"SELECT * FROM end_users WHERE username = '$username' AND password = '$password' ");


if ($row = mysqli_fetch_assoc($selectUser)) {

// $id = $row["pmo_id"];

// if($id==6){
//   echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Succesfully Login!')
//     window.location.href='homefms.php';
//     </SCRIPT>");
// }
// else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Login!')
    window.location.href='home1.php';
    </SCRIPT>");
// }


}

else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured in Login!');
    window.location.href='login.php';
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
    <b>DILG IV-A FAS
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

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
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
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
