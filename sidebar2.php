<?php 
// session_start();
$username = $_SESSION['username'];


function showDivision()
{
  $username = $_SESSION['username'];
  $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  
  $query = "SELECT * FROM `tblemployee` WHERE md5(UNAME) = '".md5($username)."' ";
  
  $result = mysqli_query($link, $query);
  while($row = mysqli_fetch_array($result))
    {
      
      if (
        $username == 'charlesodi' || 
        $username == 'mmmonteiro' || 
        $username == 'jamonteiro' || 
        $username == 'cvferrer' || 
        $username == 'masacluti' || 
        $username == 'seolivar' 
        ) 
      {
        echo '<span class="badge badge-light" style = "background-color:skyblue;color:blue;" id = "ta_request"><b>0</b></span></a>';

      }else{
      }
     
    }
}
?>
<header class="main-header" >
    <a href="" class="logo" style="text-decoration: none; background-color: #3c8dbc;">
      <span class="logo-lg" style="color:white;">FAS</span>
    </a>
    <nav class="navbar navbar-static-top" style="text-decoration: none; background-color: #0072C7;">
  </header>
<aside class="main-sidebar">
    <section class="sidebar"  style="background-color: white;height: 1000px;">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="plog.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <!-- <p style="color:black;">Asset Management</p> -->
          <p style="color:black;font-size: 10px;">Financial and Administrative</p>
          <p align="center" style="color:black;font-size: 10px;">System</p>

          <!-- <a href="#" style="color:black;"><i class="fa fa-circle text-success"></i> Online</a> -->

        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">MENUS</li>


        <li><a style="color:black;text-decoration: none;" href="home1.php?division=<?php echo $_GET['division'];?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
        <li><a href="ViewPr1.php?division=<?php echo $_GET['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PROCUREMENT</a></li>
        <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">FINANCIAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
        <li><a href="ViewBURS.php?division=<?php echo $_GET['division'];?>" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ORS/BURS</a></li>
        <li><a href="ViewDV.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> DV</a></li>
          </ul>
        </li>
        <li><a style="color:black;text-decoration: none;" href="_techassistance.php?division=<?php echo $_GET['division'];?>"><i class="fa">&#xf0f6;</i>ICT TECHNICAL ASSISTANCE 
        
        <?php 
       echo showDivision();
        ?>
  <span class="sr-only">unread messages</span></span></a></li>
        <li><a style="color:black;text-decoration: none;" href="index.php"><i class = "fa fa-sign-out"></i>LOGOUT</li>


<div hidden>
        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">Procurement</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">APP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="/pmis/frontend/web/app/index" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> APP</a></li>
            <li><a href="/pmis/frontend/web/uapp/index" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> UPP</a></li>
            <li><a href="/pmis/frontend/web/app/cancelled" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Cancelled Items<d/></li>
          </ul>
        </li>
        <li><a href="ViewPR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Request</a></li>
        <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">Request For Quotation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <!-- <li><a href="/pmis/frontend/web/rfq/index" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Draft/For Posting RFQs</a></li> -->
            <li><a href="ViewRFQ.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Draft/For Posting RFQs</a></li>
            <li><a href="/pmis/frontend/web/rfq/cancelled" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Cancelled RFQs</a></li>
          </ul>
        </li>
            <li><a href="/pmis/frontend/web/supplier-quote/list" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Supplier Quotation</a></li>
            <li><a href="/pmis/frontend/web/abstract-of-quote/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Abstract of Quotations</a></li>
            <li><a href="/pmis/frontend/web/purchase-order/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Order</a></li>
            <li><a href="/pmis/frontend/web/contract/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Contract & MOA</a></li>
            <li><a href="/pmis/frontend/web/resolution/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Resolution </a></li>
            <li><a href="/pmis/frontend/web/supplier/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Supplier </a></li>
        <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/supplier/index"><i class="fa fa-folder-o"></i> <span>Supplier</span></a></li> -->
          </ul>
        </li>

        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">Asset Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
           <li><a href="@items.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Items</a></li>
           <!-- <li><a href="ViewStocks.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Stocks</a></li> -->
           <li><a href="@stocks.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Stock Card</a></li>
           <li><a href="@stockledger.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Supplies Ledger Card</a></li>

           <li><a href="ViewIAR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> IAR</a></li>
            <!-- <li><a href="ViewRIS.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Requisition and Issue Slip</a></li> -->
            <!-- <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">Requisition and Issue Slip</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="ViewRIS.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Issue to All</a></li>
            <li><a href="ViewRISmany.php" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Issue to Many</a></li>
          </ul>
        </li> -->
            <li><a href="ViewRIS.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>RIS</a></li>
            <li><a href="ViewRPCI.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>RPCI</a></li>
            <li><a href="ViewRPCPPE.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>RPCPPE</a></li>
          </ul>
        </li>

        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">Financial Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="@saro.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Saro</a></li>
            <!-- <li><a href="@ors.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ORS</a></li> -->
            <li><a href="@obligation.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Obligation</a></li>
            <!-- <li><a href="@sof.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Status Of Funds</a></li> -->
            <!-- <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Order</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Contract & MOA</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Resolution </a></li> -->
          </ul>
        </li>

        <li class="treeview" tyle="background-color: lightgray;">
          <a href="" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"style="color:black;text-decoration: none;"></i>
            <span style="color:black;text-decoration: none;">Others</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="/pmis/frontend/web/notification-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Document Template</a></li>
            <li><a href="/pmis/frontend/web/iso-doc/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> ISO Document</a></li>
            <li><a href="/pmis/frontend/web/notes/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> RFQ Notes</a></li>
            <li><a href="/pmis/frontend/web/checklist/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Dv Checklist</a></li>
            <!-- <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Order</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Contract & MOA</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Resolution </a></li> -->
          </ul>
        </li>

      </div>

        <!-- <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/notification-doc/index"><i class="fa fa-folder-o"></i> <span>Document Template</span></a></li> --> 

        <!-- <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/iso-doc/index"><i class="fa fa-folder-o"></i> <span>ISO Document</span></a></li> --> 

        <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/notes/index"><i class="fa fa-folder-o"></i> <span>RFQ Notes</span></a></li> -->

        <!-- <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/checklist/index"><i class="fa fa-folder-o"></i> <span>Dv Checklist</span></a></li> --> 

        <!-- <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/supplier/index"><i class="fa fa-folder-o"></i> <span>Supplier</span></a></li> -->



    </section>
  </aside>
  <script src="dist/js/jquery.min.js"></script>
  <script>
  setInterval(function(){
$('#ta_request').load('_countCompletedTA.php');
}, 100); /* time in milliseconds (ie 2 se  conds)*/


  </script>