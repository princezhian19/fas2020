<?php 
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$username = $_SESSION['username'];
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
          <img src="plog.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="color:black;font-size: 10px;">Financial and Administrative</p>
          <p align="center" style="color:black;font-size: 10px;">System</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">MENUS</li>
        <li><a style="color:black;text-decoration: none;" href="home.php"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
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
        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/supplier/index"><i class="fa fa-folder-o"></i> <span>SUPPLIER</span></a></li>
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
           <li><a href="@items.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ITEMS</a></li>
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
            <li><a href="saro.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> SARO/SUB-ARO</a></li>
            <li><a href="obligation.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> ORS/BURS</a></li>
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
            <li><a href="nta.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>NTA/NCA</a></li>
            <li><a href="disbursement.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>DISBURSEMENT</a></li>
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
            <li><a href="ntaobligation.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAYMENT</a></li>
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
        <li><a style="color:black;text-decoration: none;" href="home.php"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
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
        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/supplier/index"><i class="fa fa-folder-o"></i> <span>SUPPLIER</span></a></li>
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
           <li><a href="@items.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ITEMS</a></li>
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
        <li><a href="index.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> LOGOUT</a></li>
     
       
           
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
        <li><a style="color:black;text-decoration: none;" href="home.php"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
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
            <li><a href="saro.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> SARO/SUB-ARO</a></li>
            <li><a href="obligation.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> ORS/BURS</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">ACCOUNTINGasasassa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="nta.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>NTA/NCA</a></li>
            <li><a href="disbursement.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>DISBURSEMENT</a></li>
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
            <li><a href="ntaobligation.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAYMENT</a></li>
          </ul>
        </li>
          </ul>
        </li>
    </section>
  </aside>
  <?php endif ?>
  <?php endif ?>
