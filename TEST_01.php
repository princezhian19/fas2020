<?php session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$_SESSION['unique_id'] = 1;
$DEPT_ID = $_SESSION['DEPT_ID'];
$OFFICE_STATION = $_SESSION['OFFICE_STATION'];

}
?>
<!DOCTYPE html>
<html>
<title>FAS | Create Travel Claim</title>
<head>

  <link rel="stylesheet" href="_includes/sweetalert.css">
  <link href="_includes/sweetalert2.min.css" rel="stylesheet"/>

 



  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <script src="_includes/sweetalert.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="_includes/sweetalert.css">
    <link rel="stylesheet" href="travelclaim.css">

</head>
<script>
// Global var to store active tab index
var activeTabIndex = 1;
var numberOfTabs;

window.onload=function() {
  // get tab container
  var container = document.getElementById("tabContainer");
  // this adds click event to tabs
  var tabs = container.getElementsByTagName("li");
  // dynamic calculation of number of tab
  numberOfTabs = tabs.length;
  // attache on each tab header click event
  tabs[0].onclick=displayPage1;
  tabs[1].onclick=displayPage2;
  tabs[2].onclick=displayPage3;
  // active first tab by default
  goToTabByIndex(1);
};
	

// Tab 1 on-click
function displayPage1(event) {
  goToTabByIndex(1);
}

// Tab 2 on-click
function displayPage2(event) {
  goToTabByIndex(2);
}

// Tab 3 on-click
function displayPage3(event) {
  goToTabByIndex(3);
} 
 
/**
 * Use to display a particular tab
 */ 
function displayTab(tabIndex) {
  document.getElementById("tabHeader_" + tabIndex).setAttribute("class","tabActiveHeader");
  document.getElementById("tabpage_" + tabIndex).setAttribute("style", "display: block");
}
 
/**
 * Use to hide a particular tab
 */ 
function hideTab(tabIndex) {
  document.getElementById("tabHeader_" + tabIndex).removeAttribute("class","tabActiveHeader");
  document.getElementById("tabpage_" + tabIndex).setAttribute("style", "display: none");
}
 
/**
 * Use by previous / next button
 */
function goToTabByDelta(deltaIndex) {
  // Get previous/next tab 
  activeTabIndex = activeTabIndex + deltaIndex;
  if (activeTabIndex > numberOfTabs) { activeTabIndex = 1; }
  if (activeTabIndex < 1) { activeTabIndex = numberOfTabs ; }
  // Loop over every tab 
  for (var i=1; i<=numberOfTabs; i++) {
    if (i == activeTabIndex) {
      displayTab(i);
    } else {
      hideTab(i); 
    }
  }
}

/**
 * Use by tab on-click
 */
function goToTabByIndex(newActiveTabIndex) {
  activeTabIndex = newActiveTabIndex
  // Loop over every tab 
  for (var i=1; i<=numberOfTabs; i++) {
    if (i == newActiveTabIndex) {
      displayTab(i);
    } else {
      hideTab(i); 
    }
  }
}
</script>
<style>
body {
	font-family: arial;
}
.tabContainer  {
 
	padding:15px;
	-moz-border-radius: 4px;
	border-radius: 4px; 
}
.tabs{
	overflow:hidden;
}
.tabs > ul{
	font: 1em;
	list-style:none;
}
.tabs > ul > li {
	margin:0 2px 0 0;
	padding:7px 10px;
	display:block;
	float:left;
	color:#333;
	-webkit-user-select: none;
	-moz-user-select: none;
	user-select: none;
	-moz-border-radius-topleft: 4px;
	-moz-border-radius-topright: 4px;
	-moz-border-radius-bottomright: 0px;
	-moz-border-radius-bottomleft: 0px;
	border-top-left-radius:4px;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 0px;
	border-bottom-left-radius: 0px; 
	
	background: #FFFFFF; /* old browsers */
	background: -moz-linear-gradient(top, #FFFFFF 0%, #F3F3F3 10%, #F3F3F3 50%, #FFFFFF 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(10%,#F3F3F3), color-stop(50%,#F3F3F3), color-stop(100%,#FFFFFF)); /* webkit */
	cursor:pointer;
	border: 1px #ccc solid;
}
.tabs > ul > li:hover {
	color:#ccc;
	background: #C9C9C9; /* old browsers */
	background: -moz-linear-gradient(top, #0C91EC 0%, #257AB6 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0C91EC), color-stop(100%,#257AB6)); /* webkit */
}
.tabs > ul > li.tabActiveHeader {
	color:#FFF;
	color: #333background: #C9C9C9; /* old browsers */
	background: -moz-linear-gradient(top, #0C91EC 0%, #257AB6 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0C91EC), color-stop(100%,#257AB6)); /* webkit */
}
.tabscontent {
	-moz-border-radius-topleft: 0px;
	-moz-border-radius-topright: 4px;
	-moz-border-radius-bottomright: 4px;
	-moz-border-radius-bottomleft: 4px;
	border-top-left-radius: 0px;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
	border-bottom-left-radius: 4px; 
	padding:10px 10px 25px;
	background: #FFFFFF; /* old browsers */
	background: -moz-linear-gradient(top, #FFFFFF 0%, #FFFFFF 90%, #e4e9ed 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFFFFF), color-stop(90%,#FFFFFF), color-stop(100%,#e4e9ed)); /* webkit */
	margin:0;
	color:#333;
	border: 1px #ccc solid;
}
.gototab {
	cursor: pointer;
	background: green;
	color: #fff;
	padding: 10px;
	height: 30px;
	line-height: 30px;
	width: 100px;
	text-align: center;
	float: left;
	margin: 10px;
}

</style>
<div id="tabContainer" class="tabContainer">
    <div class="tabs" id="tabs">
	<ul class="nav nav-tabs">
        <li id="tabHeader_1">Page 1</li>
        <li id="tabHeader_2">Page 2</li>
        <li id="tabHeader_3">Page 3</li>
      </ul>
    </div>
    <div id="tabscontent" class="tab-content">
      <div class="tabpage" id="tabpage_1">
        <h2>Page 1</h2>
        <p>Lorem Ipsum is simply dummy text </p>
		
      </div>
      <div class="tabpage" id="tabpage_2" style="display:none;">
        <h2>Page 2</h2>
        <p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
		</p>
      </div>
      <div class="tabpage" id="tabpage_3" style="display:none;">
        <h2>Page 3</h2>
        <p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
		</p>
		<p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
		</p>
      </div>
    </div>
	</div>
	
	<div class="gototab" onclick="goToTabByDelta(-1)">Previous</div> 
	<div class="gototab" onclick="goToTabByDelta(+1)">Next</div>
	
	<div style="clear:both;">&nbsp;<div>
	
	<p style="margin-top: 150px;"></p>