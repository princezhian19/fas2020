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
    <a href="home.php?division=<?php echo $_SESSION['division'];?>" class="logo">
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
                  <a href="UpdateAccount.php?id=<?php echo  $_SESSION['currentuser'];?>&username=<?php echo  $_SESSION['username'];?>" class="btn btn-default btn-flat"><i class = "fa fa-cogs"></i>Profile</a>
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
        <li <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/home.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>>
          <a href="home1.php?division=<?php echo $_GET['division']; ?>" >
            <i class="fa fa-dashboard" style = "color:#black;"></i> <span style = "color:#black;font-weight:normal;">Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
       
      </li>
      <li <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/ViewCalendar.php?division='.$_GET['division'].'' || $link == 'http://fas.calabarzon.dilg.gov.ph/ManageCalendar.php?division='.$_GET['division'].''){ echo 'class = "active"';}else{echo 'class = ""';}?>>
          <a href="ViewCalendar.php?division=<?php echo $_SESSION['division'];?>">
            <i class="fa fa-calendar" style = "color:#black;"></i>
            <span  style = "color:#black;font-weight:normal;">Calendar</span>
            
          </a>
         
        </li>
      
        <li  <?php 
              if( $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPR1.php'.$_GET['division'].'' )
                {
                   echo 'active';
                }
              ?>
              ">
              <a  href="ViewPR1.php?division=<?php echo $_SESSION['division'];?>">
              <i class="fa fa-cart-arrow-down " style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">Procurement</span>
                <span class="pull-right-container"></span>
              </a>
        </li>
     
        <li class="treeview">
          <a href="#" 
          <?php
           if($link == 'http://fas.calabarzon.dilg.gov.ph/ViewDV.php' || 
          $link == 'http://fas.calabarzon.dilg.gov.ph/ViewBURS.php?division='.$_GET['division'].'')
          { echo 'class = "active"';}?> 
           >
          <i class="fa fa-money"></i>
          <span  style = "color:#black;font-weight:normal;">Financial</span>

            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
          <li><a href="ViewBURS.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ORS/BURS</a></li>
        <li><a href="ViewDV.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DV</a></li>
          </ul>
        </li>
        



        
          
    <!-- Pesonnel -->
    <li  class = "treeview <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/databank.php?division='.$_SESSION['division'].''||$link == 'http://fas.calabarzon.dilg.gov.ph/issuances.php?division='.$_SESSION['division'].''){ echo 'active"';}?>">
            <a  href="#" >
              <i class="fa fa-users" style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Personnel</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="ViewEmployees.php?division=<?php echo $_SESSION['division'];?>&username=<?php echo $username;?>"  style = "color:#black;font-weight:normal;"><i class="fa fa-user" style = "color:#black;"></i>Employees Directory</a></li>
              <li><a href="ob.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;"><i class="fa fa-user" style = "color:#black;"></i>Official Business</a></li>
              <li><a href="TravelOrder.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;" ><i class="fa fa-archive" style = "color:#black;"></i>Travel Order</a></li>
            </ul>
        </li>
         <!-- Pesonnel -->

            <!-- Records -->

           
        <li  class = "treeview <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/databank.php?division='.$_SESSION['division'].''||$link == 'http://fas.calabarzon.dilg.gov.ph/issuances.php?division='.$_SESSION['division'].''){ echo 'active"';}?>">
            <a  href="#" >
              <i class="fa fa-folder" style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Records</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>

            <ul class="treeview-menu" >
           <li>
                <a href="issuances.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;"><i class="fa" style = "color:#black;">&#xf0f6;
              
              </i>Issuances
              
            
              <span href="ViewIssuancesTag.php"  class="label  bg-blue" style = "background-color:skyblue;color:blue;" id = "">
              <b> 
                
                <?php
                  
                  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                  $username = $_SESSION['username'];

                  //echo $username;
                  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                  $rowdiv = mysqli_fetch_array($select_user);
                  $DIVISION_C = $rowdiv['DIVISION_C'];

                  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                  $rowdiv1 = mysqli_fetch_array($select_office);
                  $DIVISION_M = $rowdiv1['DIVISION_M'];

                  $countissuances = mysqli_query($conn, "SELECT count(id) as a from issuances_office_responsible where office_responsible = '$DIVISION_M'");
                  $rowc = mysqli_fetch_array($countissuances);
                  $countissuancesspan = $rowc['a'];
                  
                ?>
                
                <?php echo $countissuancesspan  ;?>
                  
                  
                  </b>
              
              </span>
                
            
            
            </a>
          
          </li>




        </li>

        
        
          <li><a href="databank.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;" ><i class="fa fa-archive" style = "color:#black;"></i>Databank<span class="label  bg-blue" style = "background-color:skyblue;color:blue;" id = ""><b>0</b></span></a></li>
              <li><a href="Directory.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;" ><i class="fa fa-archive" style = "color:#black;"></i>Phone Directory</a></li>

            </ul>
        </li>



        <!-- Records -->

        <li class="
        <?PHP 
        if(
          $link == 'http://fas.calabarzon.dilg.gov.ph/requestForm.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/techassistance.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/allTickets.php?division='.$_GET['division'].'&ticket_id=' 
        ){
          echo 'active';
        }
        ?>"
        >

        
            <a href="techassistance.php?division=<?php echo $_GET['division'];?>" >
                <i class="fa fa-users" style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">ICT Technical Assistance</span>
            </a>
           
        </li>
      
     
        <li>
            <a href="logout.php">
              <i class="fa fa-sign-out " style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Log out</span>
            </a>
        </li>        
        
       

    </section>
    <!-- /.sidebar -->
  </aside>
  