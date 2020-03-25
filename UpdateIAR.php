<?php session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?><!DOCTYPE html>
<html>
<!-- <style>
  a:hover {
  color: blue;
}
  .p:hover {
  color: blue;
}
  span:hover {
  color: blue;
}
</style> -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- try for bg-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
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
          <p style="color:black;font-size: 10px;">Financial and Adminisrative System</p>
          <a href="#" style="color:black;"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree" s>
        <li class="header" style="background-color: white;">Menus</li>


        <li><a style="color:black;text-decoration: none;" href=""><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>


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
        <li class="treeview">
          <a href="#" style="color:black;text-decoration: none;">
            <i class="fa fa-folder-open-o"></i>
            <span style="color:black;text-decoration: none;">Request For Quotation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="/pmis/frontend/web/rfq/index" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Draft/For Posting RFQs</a></li>
            <li><a href="/pmis/frontend/web/rfq/cancelled" style="color:black;text-decoration: none;"><i class="fa fa-copy"></i> Cancelled RFQs</a></li>
          </ul>
        </li>
            <li><a href="/pmis/frontend/web/supplier-quote/list" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Supplier Quotation</a></li>
            <li><a href="/pmis/frontend/web/abstract-of-quote/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Abstract of Quotations</a></li>
            <li><a href="/pmis/frontend/web/purchase-order/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Order</a></li>
            <li><a href="/pmis/frontend/web/contract/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Contract & MOA</a></li>
            <li><a href="/pmis/frontend/web/resolution/index" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Resolution </a></li>
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
           <li><a href="ViewIAR.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Inspection Acceptance Report</a></li>
            <!-- <li><a href="ViewRIS.php" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Requisition and Issue Slip</a></li> -->
            <li class="treeview">
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
        </li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>ICS</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>PAR</a></li>
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
        <!--   <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Supplier Quotation</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Abstract of Quotations</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Purchase Order</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i> Contract & MOA</a></li>
            <li><a href="" style="color:black;text-decoration: none;"><i class="fa">&#xf0f6;</i>Resolution </a></li> -->
          </ul>
        </li>

        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/notification-doc/index"><i class="fa fa-folder-o"></i> <span>Document Template</span></a></li>

        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/iso-doc/index"><i class="fa fa-folder-o"></i> <span>ISO Document</span></a></li>

        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/notes/index"><i class="fa fa-folder-o"></i> <span>RFQ Notes</span></a></li>

        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/checklist/index"><i class="fa fa-folder-o"></i> <span>Dv Checklist</span></a></li>

        <li><a style="color:black;text-decoration: none;" href="/pmis/frontend/web/supplier/index"><i class="fa fa-folder-o"></i> <span>Supplier</span></a></li>



    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="ViewIAR.php"><i class=""></i> Home</a></li>
        <li class="active">Update IAR</li>
      </ol>
      <br>
      <br>
        <?php include('iar_update.php');?>

    </section>
  </div>
 
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
