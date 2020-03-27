<?php

session_start();
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
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
<title>FAS Dashboard</title>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Encode PR</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="_includes/sweetalert.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php

if($_GET['division'] == 11 || $_GET['division'] == 12 || $_GET['division'] == 13 || $_GET['division'] == 14 || $_GET['division'] == 16)
{
  include('sidebar.php');
}else{
  include('sidebar2.php');
}
?>

  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Technical Assistance Request Form</li>
      </ol>
      <br>
      <br>
        <?php include('_test.php');?>

    </section>
  </div>
 
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="_includes/sweetalert.min.js"></script>
<!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script> -->
<!-- <script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script> -->
<script>
  $(function () {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>

</body>
</html>
