<?php
session_start();
if(!isset($_SESSION['username'])){
header('location:login.php');
}
?>


<!DOCTYPE html>
<html>

<title>FAS Dashboard</title>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar2.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Technical Assistance Request Form</li>
      </ol>
      <br>
      <br>
        <?php include('_tableTA.php');?>
    </section>
  </div>
 
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- <script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script> -->
<script>


$(document).ready (function() {
    $.ajax({
        url: '_ajax.php',
        success : function(response) 
        {
            var jsonObject = $.parseJSON(response); 
            var id = jsonObject[0].CONTROL_NO;
            var table = $('#example1').dataTable( {
                "data" : jsonObject,
                "serverSide": false,
                "processing": true,
                "autoWidth": false,
                "order": [[ 0, "desc" ]],
                "language": {
                    "searchPlaceholder": "Search records",
                 },
                 aLengthMenu: [
                  [5, 10, 20, -1],
                  [5, 10, 20, "All"]
                ],
                columns: 
                [
                        {"data" : "CONTROL_NO"},
                        {"data" : "REQ_DATE"}, 
                        {"data" : "REQ_TIME"},
                        {"data" : "REQ_BY"},
                        {"data" : "OFFICE"},
                        {"data" : "ISSUE_PROBLEM"},
                        {"data" : "TYPE_REQ_DESC"},
                        {"data" : null}      
                                  
                ],
                columnDefs: 
                [
                          {"className": "dt-center", "targets": "_all"},
                    {
                    targets: [-1], render: function (a, b, data, d) {
                      
            var id = jsonObject[0].CONTROL_NO;
                        return "<center><i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'edit'>&#xf044;</i><i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'view' >&#xf06e;</i> </a>";
                    }
                }],
            });
            $('#example1 tbody').on( 'click', '#edit', function () 
             {
                    var oTableApi = $('#example1').dataTable().api();
                    var tr = $(this).closest('tr');
                    td = tr.find("td:first")
                    var cell = oTableApi.cell(td);
                  window.location="_editTA.php?id="+cell.data();
            });

            $('#example1 tbody').on( 'click', '#view', function () 
             {
                    var oTableApi = $('#example1').dataTable().api();
                    var tr = $(this).closest('tr');
                    td = tr.find("td:first")
                    var cell = oTableApi.cell(td);
                  window.location="JASPER/sample/viewTA.php?id="+cell.data();
            });

        }

    });



});


</script>


</body>
</html>
