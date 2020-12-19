<?php session_start();

include 'connection.php';
class UnsafeCrypto
{
    const METHOD = 'aes-256-ctr';
    
    /**
     * Encrypts (but does not authenticate) a message
     * 
     * @param string $message - plaintext message
     * @param string $key - encryption key (raw binary expected)
     * @param boolean $encode - set to TRUE to return a base64-encoded 
     * @return string (raw binary)
     */
    public static function encrypt($message, $key, $encode = false)
    {
        $nonceSize = openssl_cipher_iv_length(self::METHOD);
        $nonce = openssl_random_pseudo_bytes($nonceSize);
        
        $ciphertext = openssl_encrypt(
            $message,
            self::METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );
        
        // Now let's pack the IV and the ciphertext together
        // Naively, we can just concatenate
        if ($encode) {
            return base64_encode($nonce.$ciphertext);
        }
        return $nonce.$ciphertext;
    }
    
   
}

$encrypted_name = '';
$key = hex2bin('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');

$encrypted = UnsafeCrypto::encrypt($encrypted_name, $key, true);



error_reporting(0);
if(!isset($_SESSION['username'])){
// header('location:index.php');
}else{

  //  E N C R Y P T I O N
 





















  
$username = $_SESSION['username'];
$pas1 = $_SESSION['pass'];
    $sqlUsername = mysqli_query($conn,"SELECT CODE,EMP_N,isPlanningOfficer FROM tblemployeeinfo WHERE md5(UNAME) = '".md5($username)."' LIMIT 1");
  $row = mysqli_fetch_array($sqlUsername);
  $salt       = $row['CODE'];
  $_SESSION['currentuser'] = $row['EMP_N']; 
  $_SESSION['planningofficer'] = $row['isPlanningOfficer']; 

  // ===============================================
  $query = "SELECT * FROM tblemployeeinfo WHERE UNAME = '".$username."' AND PSWORD = '".$pas1."' AND BLOCK = 'N' LIMIT 1 ";
  $result = mysqli_query($conn, $query);
  $val = array();
  // $numrows= mysqli_num_rows($query);
  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
  {
    $OFFICE_STATION =$row['OFFICE_STATION'];
    $_SESSION['OFFICE_STATION'] = $OFFICE_STATION;
    $division =$row['DIVISION_C'];
    $TIN_N =$row['TIN_N'];
    $_SESSION['TIN_N'] = $TIN_N;
    $ORD =$row['ORD'];
    $_SESSION['ORD'] = $ORD;
    $DEPT_ID =$row['DEPT_ID'];
    $_SESSION['DEPT_ID'] = $DEPT_ID;
    $division2 = $row['DIVISION_C'];
    $_SESSION['division'] = $division;
    $middle = $row['MIDDLE_M'];
    $_SESSION['complete_name'] = ucwords(strtolower($row['FIRST_M'])).' '.$middle[0].'. '.ucwords(strtolower($row['LAST_M']));
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];
    $_SESSION['isPersonnel'] = $row['isPersonnel'];

      // if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
      if ($username == 'itdummy1' || 
          $username == 'mmmonteiro' || 
          $username == 'jamonteiro' || 
          $username == 'masacluti' || 
          $username == 'cvferrer' || 
          $username == 'seolivar' || 
          $username == 'magonzales') {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home.php?division=".$division."&username=".$username."';
        </SCRIPT>");
      }else{
        if ($OFFICE_STATION == 1) {
           echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home1.php?division=".$division."&username=".$username."';
        </SCRIPT>");
        }else{
           echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home2.php?division=".$division."&username=".$username."';
        </SCRIPT>");
        }
      
       } 
}

}

}

if (isset($_POST['submit'])) {
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $_SESSION['username'] = $username ;
  $username = $_SESSION['username'];
  $sqlUsername = mysqli_query($conn,"SELECT CODE,EMP_N,isPlanningOfficer FROM tblemployeeinfo WHERE md5(UNAME) = '".md5($_POST['username'])."' LIMIT 1");
  
  $row = mysqli_fetch_array($sqlUsername);
  $salt       = $row['CODE'];
  $_SESSION['currentuser'] = $row['EMP_N']; 
  $_SESSION['planningofficer'] = $row['isPlanningOfficer']; 

  $password  = crypt($_POST['password'], '$2a$10$'.$salt.'$');
  $_SESSION['pass'] = $password;

  // ===============================================
  $query = "SELECT * FROM tblemployeeinfo WHERE md5(UNAME) = '".md5($_POST['username'])."' AND PSWORD = '".$password."' AND  BLOCK = 'N' LIMIT 1 ";
  $result = mysqli_query($conn, $query);
  $val = array();
  // $numrows= mysqli_num_rows($query);
  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
  {
    $OFFICE_STATION =$row['OFFICE_STATION'];
    $_SESSION['OFFICE_STATION'] = $OFFICE_STATION;
    $division =$row['DIVISION_C'];
    $TIN_N =$row['TIN_N'];
    $_SESSION['TIN_N'] = $TIN_N;  
    $ORD =$row['ORD'];
    $_SESSION['ORD'] = $ORD;
    $DEPT_ID =$row['DEPT_ID'];
    $_SESSION['DEPT_ID'] = $DEPT_ID;
    $division2 = $row['DIVISION_C'];
    $_SESSION['division'] = $division;
    $middle = $row['MIDDLE_M'];
    $_SESSION['complete_name'] = $row['FIRST_M'].' '.$middle[0].'. '.$row['LAST_M'];
    $encrypted_name = $row['FIRST_M'].' '.$middle[0].'. '.$row['LAST_M'];
    $_SESSION['complete_name2'] = $row['FIRST_M'].' '.$row['LAST_M'];
    $_SESSION['complete_name3'] = $row['FIRST_M'].' '.$middle.' '.$row['LAST_M'];

      // if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
             if ($username == 'itdummy1' 
             || $username == 'mmmonteiro' 
             || $username == 'jamonteiro' 
             || $username == 'masacluti' 
             || $username == 'cvferrer' 
             || $username == 'seolivar' 
             || $username == 'magonzales') {
        
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home.php?division=".$division."&username=".$username."';
        </SCRIPT>");
      }else{
        
        if ($OFFICE_STATION == 1) {
           echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home1.php?division=".$division."&username=".$username."&complete_name=".$encrypted."';
        </SCRIPT>");
        }else{
           echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='home2.php?division=".$division."&username=".$username."';
        </SCRIPT>");
        }
       }  
  }
}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Wrong username or password!');
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
        <p ><img src="images/logoin.jpg" style="width: 100%; height: auto;"></p>

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
                <label hidden>
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
