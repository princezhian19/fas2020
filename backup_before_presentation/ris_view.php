<!DOCTYPE html>
<html>
<title>AMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
a{
  font-family: Arial;
  font-weight: bold;
}

</style>
<body style="background: lightgray;" >








  <div class="w3-sidebar w3-bar-block  w3-card" style="width:230px;">

    <div>
      <p class="active" href="#home" style="text-align:right;padding-right:90px;padding-top:10px;padding-bottom:10px;background-color: #0072C7;color:white;font-size: 20px;">&nbsp&nbsp&nbspFAS</p>
    </div>
    &nbsp&nbsp&nbsp<img src="to.png" width="45" height="45">&nbsp <b style="font-size: 12px;">
    &nbsp&nbsp&nbspFinancial and Adminisrative System</b>
    <p> &nbsp</p>
    <p style="font-size: 10px;color:gray;">&nbsp&nbsp&nbsp&nbspMenus </p>
    <a  style="text-align: left;padding-left:40px;text-decoration:none;" href="/pmis/frontend/web/dashboard/index" class="w3-bar-item w3-button"><i style="font-size:24px" class="fa">&#xf0e4;</i>&nbspDashboard</a>
    <br>

   <!--  <a style="text-align: left;padding-left:40px;" href="/pmis/frontend/web/dashboard/index"class="w3-bar-item w3-button"><i class="fa">&#xf115;</i>&nbspProcurement</a> -->
    <div  class="w3-dropdown-click">
      <button style="text-align: left;padding-left:40px;font-weight: bold;" class="w3-button" onclick="myDropFunc()">
       <i class="fa">&#xf115;</i>
        Procurement  <i class="fa fa-caret-down"></i>
      </button>
      
      <div id="demoDrop1" class="w3-dropdown-content w3-bar-block w3-white w3-card">
        <div  class="w3-dropdown-click">
      <button style="text-align: left;padding-left:40px;font-weight: bold;" class="w3-button" onclick="myDropFuncAPP()">
       <i class="fa">&#xf115;</i>
        APP  <i class="fa fa-caret-down"></i>
      </button>
      
      <div id="demoDropAPP" class="w3-dropdown-content w3-bar-block w3-white w3-card">
        <a style="text-decoration: none;" href="/pmis/frontend/web/supplier-quote/list" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspAPP</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/abstract-of-quote/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspUAPP</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/purchase-order/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspCancelled Items</a>
      </div>
    </div>
     <div  class="w3-dropdown-click">
      <button style="text-align: left;padding-left:40px;font-weight: bold;" class="w3-button" onclick="myDropFuncRFQ()">
       <i class="fa">&#xf115;</i>
        Request for Quotations  <i class="fa fa-caret-down"></i>
      </button>
      
      <div id="demoDropRFQ" class="w3-dropdown-content w3-bar-block w3-white w3-card">
        <a style="text-decoration: none;" href="http://172.20.34.79:8080/pmis/frontend/web/rfq/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspDraft/For Posting RFQs</a>
        <a style="text-decoration: none;" href="http://172.20.34.79:8080/pmis/frontend/web/rfq/cancelled" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspCancelled RFQs</a>
      </div>
    </div>
        <a style="text-decoration: none;" href="/pmis/frontend/web/supplier-quote/list" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspSupplier Quotation</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/abstract-of-quote/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspAbstract of Quotation</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/purchase-order/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspPurchase Order</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/contract/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspContract & MOA</a>
        <a style="text-decoration: none;" href="/pmis/frontend/web/resolution/index" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspResolution</a>
      </div>
    </div>
    <br>
    <br>

    <div  class="w3-dropdown-click">
      <button style="text-align: left;padding-left:40px;font-weight: bold;" class="w3-button" onclick="myDropFunc2()">
       <i class="fa">&#xf115;</i>
        AMS  <i class="fa fa-caret-down"></i>
      </button>
      
      <div id="demoDrop" class="w3-dropdown-content w3-bar-block w3-white w3-card">
        <a style="text-decoration: none;" href="iar_view.php" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspIAR</a>
        <a style="text-decoration: none;" href="ris_view.php" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspRIS</a>
        <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspICS</a>
        <a style="text-decoration: none;" href="#" class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspPAR</a>
      </div>
    </div>
    <br>
    <br>

    <a  style="text-align: left;padding-left:40px;text-decoration: none;" href="/pmis/frontend/web/notification-doc/index"class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspDocu Template</a>
    <br>
    <a  style="text-align: left;padding-left:40px;text-decoration: none;" href="/pmis/frontend/web/iso-doc/index"class="w3-bar-item w3-button"><i class="fa">&#xf0f6;</i>&nbspISO Document</a>
    <br>
    <a  style="text-align: left;padding-left:40px;text-decoration: none;" href="/pmis/frontend/web/notes/index"class="w3-bar-item w3-button"><i class="fa">&#xf115;</i>&nbspRFQ Notes</a>
    <br>
    <a  style="text-align: left;padding-left:40px;text-decoration: none;" href="/pmis/frontend/web/checklist/index"class="w3-bar-item w3-button"><i class="fa">&#xf115;</i>&nbspDV Checklist</a>
    <br>
    <a  style="text-align: left;padding-left:40px;text-decoration: none;" href="/pmis/frontend/web/supplier/index"class="w3-bar-item w3-button"><i class="fa">&#xf115;</i>&nbspSuppliers</a>
  </div>
  <p style="width: 2000px;background-color: #0072C7;padding-bottom: 30px;">&nbsp</p>
<div style="text-align: right;text-decoration: none;padding-right:15px;font-size:11px; ">
<a style="color:black;font-weight: normal;" href="/pmis/AMS/ris_view.php">Home</a> &nbsp>&nbsp
<a style="color:gray;font-weight: normal;" href="#">Requisition and Issue Slip</a>
</div>
<p></p>

  <div class="w3-container" style="margin-left:230px">
    <?php include('ris_table.php');?>

    <script>
      function myDropFunc2() {
        var x = document.getElementById("demoDrop");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
          x.previousElementSibling.className += " w3-green";
        } else { 
          x.className = x.className.replace(" w3-show", "");
          x.previousElementSibling.className = 
          x.previousElementSibling.className.replace(" w3-green", "");
        }
      }

      function myDropFunc() {
        var x = document.getElementById("demoDrop1");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
          x.previousElementSibling.className += " w3-green";
        } else { 
          x.className = x.className.replace(" w3-show", "");
          x.previousElementSibling.className = 
          x.previousElementSibling.className.replace(" w3-green", "");
        }
      }

       function myDropFuncw() {
        var x = document.getElementById("demoDropw");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
          x.previousElementSibling.className += " w3-green";
        } else { 
          x.className = x.className.replace(" w3-show", "");
          x.previousElementSibling.className = 
          x.previousElementSibling.className.replace(" w3-green", "");
        }
      }

      function myDropFuncAPP() {
        var x = document.getElementById("demoDropAPP");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
          x.previousElementSibling.className += " w3-green";
        } else { 
          x.className = x.className.replace(" w3-show", "");
          x.previousElementSibling.className = 
          x.previousElementSibling.className.replace(" w3-green", "");
        }
      }
      function myDropFuncRFQ() {
        var x = document.getElementById("demoDropRFQ");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
          x.previousElementSibling.className += " w3-green";
        } else { 
          x.className = x.className.replace(" w3-show", "");
          x.previousElementSibling.className = 
          x.previousElementSibling.className.replace(" w3-green", "");
        }
      }
    </script>

  </body>
  </html>
