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

?>

    </style>
<body class=" hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>AS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>FAS</b></span>
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
              <li class="user-header">
                <img src="dilg.png" class="img-circle" alt="User Image">

                <p>
                <?php echo $_SESSION['complete_name'];?>
                  <small>Position</small>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="pull-left">
                  <a href="UpdateAccount.php?id=<?php echo  $_SESSION['currentuser'];?>&username=<?php echo  $_SESSION['username'];?>" class="btn btn-default btn-flat"><i class = "fa fa-cogs"></i>Profile</a>
                </div>
                <div class="pull-right">
                  <a href="index.php" class="btn btn-default btn-flat"><i class = "fa fa-sign-out"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"  style = "background-color:#f5bfc3;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dilg.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['complete_name'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li <?php if($link == 'http://localhost/fas/home.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>>
          <a href="home.php?division=<?php echo $_SESSION['division']; ?>" >
            <i class="fa fa-dashboard" style = "color:#be2732;"></i> <span ">Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
       
        </li>
        <li <?php if($link == 'http://localhost/fas/ViewCalendar.php' || $link == 'http://localhost/fas/ManageCalendar.php'){ echo 'class = "treeview active"';}else{echo 'class = "treeview"';}?>>
          <a href="#">
            <i class="fa fa-calendar" style = "color:#be2732;"></i>
            <span >Calendar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="ViewCalendar.php" style = "color:black;" ><i class="fa fa-circle-o" style = "color:#be2732;"></i>Calendar of Activities</a></li>
            <li><a href="ManageCalendar.php" style = "color:#74393e;"><i class="fa fa-circle-o" style = "color:#be2732;"></i>Manage Calendar</a></li>
      
          </ul>
        </li>
        <li>
            <a href="#">
              <i class="fa fa-sitemap " style = "color:#be2732;"></i> 
              <span>Directory</span>
            </a>
        </li>
        <li  class="treeview" <?php if($link == 'http://localhost/fas/issuances.php?division='.$_SESSION['division'].''){ echo 'class = "active"';}?>>
            <a  href="#" >
              <i class="fa fa-folder" style = "color:#be2732;"></i> 
              <span >Records</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="issuances.php?division=<?php echo $_SESSION['division'];?>"><i class="fa" style = "color:#be2732;">&#xf0f6;</i>Issuances</a></li>
              <li><a href="#" ><i class="fa fa-archive" style = "color:#be2732;"></i>Databank</a></li>
            </ul>
        </li>
        <li class="treeview" <?php 
              if($link == 'http://localhost/fas/ViewApp.php?division='.$_SESSION['division'].'' || 
                $link == 'http://localhost/fas/ViewPR.php?division='.$_SESSION['division'].'' || 
                $link == 'http://localhost/fas/ViewRFQ.php?division='.$_SESSION['division'].'' ||
                $link == 'http://localhost/fas/ViewSuppliers.php' )
                {
                   echo 'class = "active"';
                }
              ?>>
              <a 
              
              
              href="" >
                <i class="fa fa-cart-arrow-down " style = "color:#be2732;"></i>
                <span >Procurement</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right" style = "color:#be2732;"></i></span>
              </a>
            <ul class="treeview-menu" >
              <li><a href="ViewApp.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>App</a></li>
              <li><a href="ViewPR.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i> Purchase Request</a></li>
              <li><a href="ViewRFQ.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i> Request for Quotation</a></li>
              <li><a href="ViewSuppliers.php"><i class="fa" style = "color:#be2732;">&#xf0f6;</i><span>Supplier</span></a></li>
            </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
            <a href="" >
              <i class="fa fa-briefcase " style = "color:#be2732;"></i>
              <span >Asset Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="stocks.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i> Stock Card</a></li>
              <li><a href="@stockledger.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>Supplies Ledger Card</a></li>
              <li><a href="ViewIAR.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i> IAR</a></li>
              <li><a href="ViewRIS.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>RIS</a></li>
              <li><a href="ViewRPCI.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>ICS</a></li>
              <li><a href="ViewRPCPPE.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>PAR</a></li>
            </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
            <a href="" >
              <i class="fa fa-money" style = "color:#be2732;"></i>
              <span >Financial Management</span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li class="treeview">
                <a href="#" >
                  <i class="fa fa-folder-open-o" style = "color:#be2732;"></i>
                  <span >Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" >
                  <li><a href="saro.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa fa-copy" style = "color:#be2732;"></i> SARO/SUB-ARO </a></li>
                  <li><a href="obligation.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa fa-copy" style = "color:#be2732;"></i> ORS/BURS</a></li>
                 </ul>
            </li>
          </li>
          <li class="treeview">
            <a href="#" >
              <i class="fa fa-folder-open-o" style = "color:#be2732;"></i>
              <span >ACCOUNTING</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="nta.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>NTA/NCA</a></li>
              <li><a href="disbursement.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>DISBURSEMENT</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#" >
              <i class="fa fa-folder-open-o" style = "color:#be2732;"></i>
              <span >CASH</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="ntaobligation.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>PAYMENT</a></li>
            </ul>
          </li>
          </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
            <a href="" >
                <i class="fa fa-users" style = "color:#be2732;"></i>
                <span >ICT Technical Assistance</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="requestForm.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>Create Request</a>
              <li><a href="allTickets.php?division=<?php echo $_SESSION['division'];?>&ticket_id=" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>Processing<span class="badge badge-light pull-right" style = "background-color:skyblue;color:blue;" id = "on_going"><b>0</b></span></a></li>
              <li><a href="techassistance.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#be2732;">&#xf0f6;</i>Monitoring<span class="badge badge-light pull-right" style = "background-color:skyblue;color:blue;" id = "ta_request"><b>0</b></span></a>
            </ul>
        </li>
      
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" >
            <i class="fa fa-cogs" style = "color:#be2732;"></i>
            <span >Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a  href="Accounts.php"><i class = "fa fa-fw fa-user-md" style = "color:#be2732;"></i>User Management</li>
            <li><a  href="Approval.php"><i class = "fa fa-fw fa-check-square-o" style = "color:#be2732;"></i>For Approval</li>

          </ul>
      
        </li>
        <li>
            <a href="index.php">
              <i class="fa fa-sign-out " style = "color:#be2732;"></i> 
              <span>Logout</span>
            </a>
        </li>        
        
       

    </section>
    <!-- /.sidebar -->
  </aside>