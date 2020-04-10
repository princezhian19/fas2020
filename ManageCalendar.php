<?php 
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$division = $_SESSION['division'];
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
  <link rel="stylesheet" href="_includes/sweetalert.css">
  <link href="_includes/sweetalert2.min.css" rel="stylesheet"/>
  <link href="_includes/fontawesome.css" rel="stylesheet"/>
 

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
  include('sidebar.php'); 
?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Technical Assistance Request Form</li>
      </ol>
      <br>
      <br>
      <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                                <thead>
                                <th>NO.</th>
                                <th>OFFICE</th>
                                <th>TITLE</th>
                                <th>START DATE</th>
                                <th>END TIME</th>
                                <th>VENUE</th>
                                <th>POSTED BY</th>
                                <th style = "text-align:center;width:16%;">ACTION</th>
                                </thead>
                                </table>
    </section>
  </div>
 
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.j s"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="_includes/sweetalert.min.js"></script>
<script src="_includes/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
    var table = $('#example').DataTable( {
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "processing": true,
        "serverSide": false,
        "ajax": "DATATABLE/server_processing2.php",
        "order": [[ 0, "asc" ]],
        "columnDefs": [ {
            "targets": 7,
            "render": function ( data, type, row, meta ) {  
            if(<?php echo $_SESSION['planningofficer'];?> == 1)
            {
                $action = '<button class = "btn btn-success btn-md">View</button>&nbsp;<button class = "btn btn-primary btn-md">Edit</button>&nbsp;<button class = "btn btn-danger btn-md">Delete</button>';
              return $action;
            }
        }
        }]
       

    } );
  
});
</script>
</body>
</html>
