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
  $sqlUsername = mysqli_query($conn,"SELECT * FROM  tblemployeeinfo INNER JOIN tblpersonneldivision ON tblemployeeinfo.DIVISION_C = tblpersonneldivision.DIVISION_N where  UNAME ='".$_SESSION['username']."'");
  $row = mysqli_fetch_array($sqlUsername);
  echo  $row['DIVISION_M']; 
}
$cn = $_SESSION['complete_name3'];

function notification()
{
  include 'connection.php';
$cn = $_SESSION['complete_name3'];
  $query = "SELECT count(*) as 'count' from tbltechnical_assistance where REQ_BY ='$cn' and `STATUS_REQUEST` = 'Completed' and STATUS != '' ";
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
  $cn = $_SESSION['complete_name3'];

  $query = "SELECT * from tbltechnical_assistance where REQ_BY ='$cn' AND `STATUS_REQUEST` = 'Completed' and STATUS != '' ";
  $result = mysqli_query($conn, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
  {
  ?>
  <li>
    <a href="techassistance.php?division=<?php echo $_GET['division']?>&ticket_id=<?php echo $row['CONTROL_NO'];?>">
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
?>
</style>
<style>
  th{
    color:blue;
  }
  
</style>
<body class=" hold-transition skin-red-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="home2.php?division=<?php echo $_SESSION['division'];?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src = "images/logo2.png"/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><img src = "images/logo1.png"/></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
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
              <li class="header">You have <?php echo notification();?> technical assistance request completed</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  
                <?php echo showRequest();?>
                </ul>
              </li>
              <li class="footer"><a href="processing.php?division=<?php echo $_GET['division'];?>&ticket_id=">See All Request</a></li>
            </ul>
          </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <img src="dilg.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['complete_name'];?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <?php 
                $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $slect = mysqli_query($conn,"SELECT PROFILE FROM tblemployeeinfo WHERE UNAME = '$username'");
                $rowP = mysqli_fetch_array($slect);
                $profile                 = $rowP['PROFILE'];
                $extension = pathinfo($profile, PATHINFO_EXTENSION);
                ?>
                <li class="user-header">
                  <img src="
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
                    <a href="UpdateEmployee.php?id=<?php echo  $_SESSION['currentuser'];?>&username=<?php echo  $_SESSION['username'];?>&3d=<?php echo '3';?>" class="btn btn-default btn-flat"><i class = "fa fa-cogs"></i>Profile</a>
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
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dilg.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['username'];?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/home2.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>>
            <a href="home2.php?division=<?php echo $_GET['division']; ?>" >
              <i class="fa fa-dashboard" style = "color:#black;"></i> <span style = "color:#black;font-weight:normal;">Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
</li>
   <li  class = "treeview <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/databank.php?division='.$_SESSION['division'].''||$link == 'http://fas.calabarzon.dilg.gov.ph/issuances.php?division='.$_SESSION['division'].''){ echo 'active"';}?>">
            <a  href="#" >
              <i class="fa fa-users" style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Personnel</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="DTR.php?division=<?php echo $_SESSION['division'];?>&username=<?php echo $username;?>"  style = "color:#black;font-weight:normal;"><i class="fa fa-user" style = "color:#black;"></i>DTR</a></li>
              <?php if ($username == 'gltumamac' || $username == 'mmmonteiro' || $username == 'pmmendoza' || $username == 'hpsolis' || $username == 'magonzales' || $username == 'jtbeltran' || $username == 'cscruz' || $username == 'rbnanez' || $username == 'assangel' || $username == 'jvnadal' || $username == 'aasalvatus' ): ?>
                <li><a href="DtrMonitoring.php?division=<?php echo $_SESSION['division'];?>&username=<?php echo $username;?>"  style = "color:#black;font-weight:normal;"><i class="fa fa-user" style = "color:#black;"></i>DTR Monitoring</a></li>
              <?php endif ?>
              <li><a href="ViewEmployees.php?division=<?php echo $_SESSION['division'];?>&username=<?php echo $username;?>"  style = "color:#black;font-weight:normal;"><i class="fa fa-user" style = "color:#black;"></i>Employees Directory</a></li>
            </ul>
          </li>
<li>
  <a href="logout.php">
    <i class="fa fa-sign-out " style = "color:#black;"></i> 
    <span  style = "color:#black;font-weight:normal;">Log out</span>
  </a>
</li> 
</ul>
</section>
<!-- /.sidebar -->
</aside>
