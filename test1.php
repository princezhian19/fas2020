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
      <span class="logo-mini"><img src = "images/logo.png"/></span>
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
              <li class="user-header">
                <img src="dilg.png" class="img-circle" alt="User Image">

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
                  <a href="index.php" class="btn btn-default btn-flat"><i class = "fa fa-sign-out"></i> Log out</a>
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
          <a href="home.php?division=<?php echo $_SESSION['division']; ?>" >
            <i class="fa fa-dashboard" style = "color:#black;"></i> <span style = "color:#black;font-weight:normal;">Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
       
        </li>
        <li <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/ViewCalendar.php?division='.$_GET['division'].'' || $link == 'http://fas.calabarzon.dilg.gov.ph/ManageCalendar.php?division='.$_GET['division'].''){ echo 'class = "active"';}else{echo 'class = ""';}?>>
          <a href="ViewCalendar.php?divsion=<?php echo $_SESSION['division'];?>">
            <i class="fa fa-calendar" style = "color:#black;"></i>
            <span  style = "color:#black;font-weight:normal;">Calendar</span>
            
          </a>
         
        </li>
        <li>
            <a href="#">
              <i class="fa fa-sitemap " style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Directory</span>
            </a>
        </li>
        <li  class = "treeview <?php if($link == 'http://fas.calabarzon.dilg.gov.ph/databank.php?division='.$_SESSION['division'].''||$link == 'http://fas.calabarzon.dilg.gov.ph/issuances.php?division='.$_SESSION['division'].''){ echo 'active"';}?>">
            <a  href="#" >
              <i class="fa fa-folder" style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Records</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="issuances.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;"><i class="fa" style = "color:#black;">&#xf0f6;</i>Issuances</a></li>
              <li><a href="databank.php?division=<?php echo $_SESSION['division'];?>"  style = "color:#black;font-weight:normal;" ><i class="fa fa-archive" style = "color:#black;"></i>Databank</a></li>
            </ul>
        </li>
        <li  class = "treeview <?php 
              if(
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewApp.php' || 
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPR.php' || 
                $link == 'http://fas.calabarzon.dilg.gov.ph/CreatePR.php' || 
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewApp.php?division='.$_SESSION['division'].'' || 
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPR.php?division='.$_SESSION['division'].'' || 
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewRFQ.php?division='.$_SESSION['division'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewSuppliers.php'  ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateAPP.php?id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewApp_History.php?id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPRv.php?id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewRFQdetails.php?id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPRv.php?id='.$_GET['id'].'&username='.$_SESSION['username'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/ViewUpdateRFQ.php?id2='.$_GET['id2'].'&id='.$_GET['id'].'&id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateSuppliers.php?id='.$_GET['id'].'' ||
                $link == 'http://fas.calabarzon.dilg.gov.ph/CreateUpdatePR.php?pr_no='.$_GET['pr_no'].'&id='.$_GET['id'].'&pmo='.$_GET['pmo'].'&pr_date='.$_GET['pr_date'].'&purpose='.$_GET['purpose'].''
                )
                {
                   echo 'active';
                }
              ?>
              ">
              <a  href="" >
                <i class="fa fa-cart-arrow-down " style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">Procurement</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right" style = "color:#black;"></i></span>
              </a>
            <ul class="treeview-menu" >
              <li><a href="ViewApp.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>App</a></li>
              <li><a href="ViewPR.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i> Purchase Request</a></li>
              <li><a href="ViewRFQ.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i> Request for Quotation</a></li>
              <li><a href="ViewSuppliers.php"><i class="fa" style = "color:#black;">&#xf0f6;</i><span>Supplier</span></a></li>
            </ul>
        </li>
        <li class="treeview
         <?php 
               if(
                 $link == 'http://fas.calabarzon.dilg.gov.ph/stocks.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/@stockledger.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/ViewIAR.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/ViewRIS.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/ViewRPCPPE.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/ViewRPCI.php?division='.$_GET['division'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateIAR.php?id='.$_GET['id'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateRIS.php?id='.$_GET['id'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/ViewPPE.php?id='.$_GET['id'].'' ||
                 $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateRPCI.php?id='.$_GET['id'].'' 
                 ) 
                
                { echo 'active';}
            
         ?>">
            <a href="" >
              <i class="fa fa-briefcase " style = "color:#black;"></i>
              <span style = "color:#black;font-weight:normal;" >Asset Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="stocks.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i> Stock Card</a></li>
              <li><a href="@stockledger.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Supplies Ledger Card</a></li>
              <li><a href="ViewIAR.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i> IAR</a></li>
              <li><a href="ViewRIS.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>RIS</a></li>
              <li><a href="ViewRPCI.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>ICS</a></li>
              <li><a href="ViewRPCPPE.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>PAR</a></li>
            </ul>
        </li>
        <li class="treeview 
        <?php 
        if(
          $link == 'http://fas.calabarzon.dilg.gov.ph/saro.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/disbursement.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/ntatableViewMain.php?getntano='.$_GET['getntano'].'&getparticular='.$_GET['getparticular'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/obligation.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/nta.php?division='.$_GET['division'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/obligation.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/saroupdate.php?getid='.$_GET['getid'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/obupdate.php?getid='.$_GET['getid'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/sarocreate.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/obtableViewMain.php?getsaroID='.$_GET['getsaroID'].'&getuacs='.$_GET['getuacs'].'' 
        ){
          echo 'active';
        }
        ?>" 
        >
            <a href="" >
              <i class="fa fa-money" style = "color:#black;"></i>
              <span  style = "color:#black;font-weight:normal;">Financial Management</span>
              <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li class="treeview">
                <a href="#" >
                  <i class="fa fa-folder-open-o" style = "color:#black;"></i>
                  <span >Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" >
                  <li><a href="saro.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa fa-copy" style = "color:#black;"></i> SARO/SUB-ARO </a></li>
                  <li><a href="obligation.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa fa-copy" style = "color:#black;"></i> ORS/BURS</a></li>
                 </ul>
            </li>
          </li>
          <li class="treeview">
            <a href="#" >
              <i class="fa fa-folder-open-o" style = "color:#black;"></i>
              <span >Accounting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="nta.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>NTA/NCA</a></li>
              <li><a href="disbursement.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>DISBURSEMENT</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#" >
              <i class="fa fa-folder-open-o" style = "color:#black;"></i>
              <span >Cash</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="ntaobligation.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>PAYMENT</a></li>
            </ul>
          </li>
          </ul>
        </li>
        <li class="treeview
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
            <a href="" >
                <i class="fa fa-users" style = "color:#black;"></i>
                <span  style = "color:#black;font-weight:normal;">ICT Technical Assistance</span>
                <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
            </a>
            <ul class="treeview-menu" >
              <li><a href="requestForm.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Create Request</a>
              <li><a href="allTickets.php?division=<?php echo $_SESSION['division'];?>&ticket_id=" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Processing<span>
              <small class="label  bg-blue" id = "on_going"></small>
            </span></a></li>
              <li>
              <a href="techassistance.php?division=<?php echo $_SESSION['division'];?>" ><i class="fa" style = "color:#black;">&#xf0f6;</i>Monitoring 
              <span>
              <small class="label  bg-blue" id = "ta_request"></small>
            </span></a>
            </ul>
        </li>
      
        <li class="treeview <?PHP 
        if(
          $link == 'http://fas.calabarzon.dilg.gov.ph/Accounts.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/_editRequestTA.php?division='.$_GET['division'].'&id='.$_GET['id'].'' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/Approval.php' ||
          $link == 'http://fas.calabarzon.dilg.gov.ph/UpdateAccount.php?id='.$_GET['id'].'&username='.$_SESSION['username'].'' 
          
        ){
          echo 'active';
        }
        ?>" tyle="background-color: lightgray;">
          <a href="" >
            <i class="fa fa-cogs" style = "color:#black;"></i>
            <span  style = "color:#black;font-weight:normal;">Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a  href="Accounts.php"><i class = "fa fa-fw fa-user-md" style = "color:#black;"></i>User Management</li>
            <li><a  href="Approval.php"><i class = "fa fa-fw fa-check-square-o" style = "color:#black;"></i>For Approval</li>

          </ul>
      
        </li>
        <li>
            <a href="index.php">
              <i class="fa fa-sign-out " style = "color:#black;"></i> 
              <span  style = "color:#black;font-weight:normal;">Log out</span>
            </a>
        </li>        
        
       

    </section>
    <!-- /.sidebar -->
  </aside>
  
<script>
  setInterval(function(){
$('#ta_request').load('_countTA.php');
$('#on_going').load('_countOngoing.php');
}, 1000); /* time in milliseconds (ie 2 se  conds)*/
  </script>