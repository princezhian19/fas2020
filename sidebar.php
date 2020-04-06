<?php 
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];

}
?>

<header class="main-header" >
  <a href="" class="logo" style="text-decoration: none; background-color: #3c8dbc;">
    <span class="logo-lg" style="color:white;">FAS</span>
      </a>
        <nav class="navbar navbar-static-top" style="text-decoration: none; background-color: #0072C7;">
          </header>

<?php if ($username == 'charlesodi' || $username == 'mmmonteiro' ||  $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar'): ?>
  <aside class="main-sidebar">
    <section class="sidebar"  style="background-color: white;height: 1000px;">
      <div class="user-panel">

        <div class="pull-left image">
          <img src="images/plog.png" class="img-circle" alt="User Image">
            </div>

        <div class="pull-left info">
          <p style="color:black;font-size: 10px;">Financial and Administrative</p>
            <p align="center" style="color:black;font-size: 10px;">System</p>
            </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">MENUS</li>
          <li><a style="color:black;text-decoration: none;" href="home.php?division=<?php echo $_SESSION['division'];?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
            <li class="treeview" tyle="background-color: lightgray;">
              <a href="" style="color:black;text-decoration: none;">
                <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
                <span style="color:black;text-decoration: none;">PROCUREMENT</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
          <ul class="treeview-menu" >
            <li class="treeview">
        </li>
        <li><a href="ViewApp.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>APP</a></li>
   
        <li><a href="ViewPR.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> PURCHASE REQUEST</a></li>
       
            <li><a href="ViewRFQ.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> REQUEST FOR QUOTATION</a></li>
        <li><a style="color:black;text-decoration: none;" href="ViewSuppliers.php"><i class="fa">&#xf0f6;</i><span>SUPPLIER</span></a></li>
          </ul>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">ASSET MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
           <!-- <li><a href="items.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ITEMS</a></li> -->
           <li><a href="stocks.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> STOCK CARD</a></li>
           <li><a href="@stockledger.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> SUPPLIES LEDGER CARD</a></li>
           <li><a href="ViewIAR.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> IAR</a></li>
            <li><a href="ViewRIS.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>RIS</a></li>
            <li><a href="ViewRPCI.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ICS</a></li>
            <li><a href="ViewRPCPPE.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAR</a></li>
          </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">FINANCIAL MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
        <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">BUDGET</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="saro.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> SARO/SUB-ARO</a></li>
            <li><a href="obligation.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> ORS/BURS</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">ACCOUNTING</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="nta.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>NTA/NCA</a></li>
            <li><a href="disbursement.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>DISBURSEMENT</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">CASH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ntaobligation.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAYMENT</a></li>
          </ul>
        </li>
          </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">OTHERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="/pmis/frontend/web/notification-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DOCUMENT TEMPLATE</a></li>
            <li><a href="/pmis/frontend/web/iso-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ISO DOCUMENT</a></li>
            <li><a href="/pmis/frontend/web/notes/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> RFQ NOTES</a></li>
            <li><a href="/pmis/frontend/web/checklist/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DV CHECKLIST</a></li>
          </ul>
        </li>
        
        <!-- ===================================================== -->
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">ICT TECHNICAL ASSISTANCE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
          <li><a href="requestForm.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>CREATE REQUEST</a>
            <li><a href="allTickets.php?division=<?php echo $_SESSION['division'];?>&ticket_id=" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ON-GOING<span class="badge badge-light" style = "background-color:skyblue;color:blue;" id = "on_going"><b>0</b></span></a></li>
            <li><a href="techassistance.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>SUBMITTED<span class="badge badge-light" style = "background-color:skyblue;color:blue;" id = "ta_request"><b>0</b></span></a>

          </ul>
        </li>
        <!-- ====================================================== -->
        <!-- EVENTS MANAGEMENT SYSTEM -->
       <!-- ===================================================== -->
       <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">EVENTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ViewCalendar.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>My Calendar</a></li>

          </ul>
        </li>
        <!-- ====================================================== -->
        <!-- END OF CODE -->
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">USER MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a style="color:black;text-decoration: none;" href="Accounts.php"><i class = "fa fa-fw fa-user-md"></i>Users</li>
        <li><a style="color:black;text-decoration: none;" href="Approval.php"><i class = "fa fa-fw fa-check-square-o"></i>For Approval</li>
          </ul>
        </li>
        <li><a style="color:black;text-decoration: none;" href="index.php"><i class = "fa fa-sign-out"></i>LOGOUT</li>
    </section>
  </aside>
<?php else: ?>
  <?php if ($username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'rdmiranda' ): ?>
<aside class="main-sidebar">
    <section class="sidebar"  style="background-color: white;height: 1000px;">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="plog.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="color:black;font-size: 10px;">Financial and Administrative</p>
          <p align="center" style="color:black;font-size: 10px;">System</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">MENUS</li>
        <li><a style="color:black;text-decoration: none;" href="home.php?division=<?php echo $_SESSION['division'];?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">PROCUREMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="treeview">
        </li>
        <li><a href="ViewApp.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> APP</a></li>
   
        <li><a href="ViewPR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> PURCHASE REQUEST</a></li>
       
            <li><a href="ViewRFQ.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> REQUEST FOR QUOTATION</a></li>
        <li><a style="color:black;text-decoration: none;" href="ViewSuppliers.php"><i class="fa fa-folder-o"></i> <span>SUPPLIER</span></a></li>
          </ul>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">ASSET MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
           <li><a href="items.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ITEMS</a></li>
           <li><a href="@stocks.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> STOCK CARD</a></li>
           <li><a href="@stockledger.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> SUPPLIES LEDGER CARD</a></li>
           <li><a href="ViewIAR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> IAR</a></li>
            <li><a href="ViewRIS.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>RIS</a></li>
            <li><a href="ViewRPCI.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ICS</a></li>
            <li><a href="ViewRPCPPE.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAR</a></li>
          </ul>
        </li>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">OTHERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="/pmis/frontend/web/notification-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DOCUMENT TEMPLATE</a></li>
            <li><a href="/pmis/frontend/web/iso-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ISO DOCUMENT</a></li>
            <li><a href="/pmis/frontend/web/notes/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> RFQ NOTES</a></li>
            <li><a href="/pmis/frontend/web/checklist/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DV CHECKLIST</a></li>
          </ul>
        </li> 
        <li><a style="color:black;text-decoration: none;" href="index.php"><i class = "fa fa-sign-out"></i>LOGOUT</li>
     
       
           
    </section>
  </aside>

    <?php else: ?>
<aside class="main-sidebar">
    <section class="sidebar"  style="background-color: white;height: 1000px;">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="plog.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="color:black;font-size: 10px;">Financial and Administrative</p>
          <p align="center" style="color:black;font-size: 10px;">System</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">MENUS</li>
        <li><a style="color:black;text-decoration: none;" href="home1.php"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">PROCUREMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="treeview">
        </li>
        <li><a href="ViewPR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> PURCHASE REQUEST</a></li>
          </ul>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">FINANCIAL MANAGEMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
        <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">BUDGET</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ViewBURS.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> ORS/BURS</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">ACCOUNTING</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ViewDv.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>DISBURSEMENT</a></li>
          </ul>
        </li>
         <li class="treeview" hidden>
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">CASH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ntaobligation.php?division=<?php echo $_SESSION['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAYMENT</a></li>
          </ul>
        </li>
          </ul>
        </li>
        <li><a style="color:black;text-decoration: none;" href="index.php"><i class = "fa fa-sign-out"></i>LOGOUT</li>
    </section>
  </aside>
  <?php endif ?>
<script src="dist/js/jquery.min.js"></script>

  <?php endif ?>

  <script>
  setInterval(function(){
$('#ta_request').load('_countTA.php');
$('#on_going').load('_countOngoing.php');
}, 100); /* time in milliseconds (ie 2 se  conds)*/
  </script>