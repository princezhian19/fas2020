
<!DOCTYPE html>
<html>
<title>FAS | Add Issuances</title>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-wid, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
</head>
<!-- start -->

<?php 
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['complete_name'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .   $_SERVER['REQUEST_URI']; 



function getDivision()
{
  include 'connection.php';
  $sqlUsername = mysqli_query($conn,"SELECT * FROM tblpersonneldivision where DIVISION_N =".$_SESSION['division']."");
  $row = mysqli_fetch_array($sqlUsername);
  echo  $row['DIVISION_M']; 
}

function notification()
{
  include 'connection.php';

  $query = "SELECT count(*) as 'count' from tbltechnical_assistance where `STATUS_REQUEST` = 'Submitted'  ";
  $result = mysqli_query($conn, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
  {
   echo $row['count'];
  }
}
function showRequest()
{
  include 'connection.php';

  $query = "SELECT * from tbltechnical_assistance where `STATUS_REQUEST` = 'Submitted'  ";
  $result = mysqli_query($conn, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
  {
  ?>
  <li>
    <a href="processing.php?division=<?php echo $_GET['division']?>&ticket_id=<?php echo $row['CONTROL_NO'];?>">
      <div class="pull-left">
        <img src="images/male-user.png" class="img-circle" alt="User Image">
      </div>
        <h4>
        <?php echo $row['REQ_BY'];?>
      </h4>
      <p><?PHP echo $row['ISSUE_PROBLEM'];?></p>
    </a>
  </li>
  <?php
  }
}
function getImage()
{

                  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                  $slect = mysqli_query($conn,"SELECT PROFILE FROM tblemployeinfo WHERE UNAME = '$username'");
                  $rowP = mysqli_fetch_array($slect);
                  $profile                 = $rowP['PROFILE'];
                  $extension = pathinfo($profile, PATHINFO_EXTENSION);
            
          
            if(file_exists($profile))
            {
              switch($extension)
              {
                case 'jpg':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'JPG':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'jpeg':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'png':
                if($profile == '')
                {
                  echo'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                default:
                echo'images/male-user.png';
                break;
              }
              }else{
               echo'images/male-user.png';
             }
            
}
        ?>

    </style>
    <style>
  th{
    color:blue;
    text-align:center;
  }
  
  </style>
<body class=" hold-transition  skin-red-light sidebar-mini" >
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="home.php?division=<?php echo $_SESSION['division'];?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src = "images/logo2.png"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src = "images/logo1.png"/></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="label label-success"><?php echo notification();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo notification();?> technical assistance request</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  
                <?php echo showRequest();?>
                </ul>
              </li>
              <li class="footer"><a href="processing.php?division=<?php echo $_GET['division'];?>&ticket_id=">See All Request</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="<?php echo getImage();?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['complete_name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <?php 
                  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                  $slect = mysqli_query($conn,"SELECT PROFILE FROM tblemployeinfo WHERE UNAME = '$username'");
                  $rowP = mysqli_fetch_array($slect);
                  $profile                 = $rowP['PROFILE'];
                  $extension = pathinfo($profile, PATHINFO_EXTENSION);
              ?>
              <li class="user-header">
                <img  src="
            <?php 
            if(file_exists($profile))
            {
              switch($extension)
              {
                case 'jpg':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'JPG':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'jpeg':
                if($profile == '')
                {
                  echo 'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                case 'png':
                if($profile == '')
                {
                  echo'images/male-user.png';
                }
                else if ($profile == $profile)
                {
                  echo $profile;   
                }
                else
                {
                  echo'images/male-user.png';
                }
                break;
                default:
                echo'images/male-user.png';
                break;
              }
              }else{
               echo'images/male-user.png';
             }

             ?>" class="img-circle" alt="User Image">

                <p><b>
                <?php echo $_SESSION['complete_name'];?></b>
                  <small><?php echo getDivision();?></small>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="pull-left">
                  <a href="UpdateEmployee.php?id=<?php echo  $_SESSION['currentuser'];?>&username=<?php echo  $_SESSION['username'];?>" class="btn btn-default btn-flat"><i class = "fa fa-cogs"></i>Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat"><i class = "fa fa-sign-out"></i> Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"  style = "background-color:#f6cdd0;">
    <!-- sidebar: style can be found in sidebar.less -->
    
    <!-- /.sidebar -->
  </aside>
  
  <!-- end -->


  <div class="content-wrapper">
    
<br>

  <div class="col-lg-12">
          <div class="box box-default">
          
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>ERROR 404: This page not found</h4>
              </div>
            </div>
  </div>
</div>
</div>
  <footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
    </footer>
    <br>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


  
  
