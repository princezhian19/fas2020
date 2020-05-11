<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?><!DOCTYPE html>
<html>
<title>FAS | Suppliers</title>
<head>
 
<meta charset="utf-8">
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
    <link rel="stylesheet" href="_includes/sweetalert.css">

</head>                                          
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  <?php include('test1.php');?>
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Request</li>
      </ol>
      <br>
      <br>
      <?php include('suppliers_table.php');?>

    </section>
  </div>
    
    <footer class="main-footer">
  <br>

      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong> All rights
      reserved.
    </footer>
  <br>

</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="_includes/sweetalert.min.js"></script>

<script>
  $(document).ready(function(){
            var dataTable=$('#example1').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order": [[ 1, "asc" ]],
            aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "processing": true,
            "serverSide":true,
            "ajax":{
                url:"DATATABLE3/test/fetch.php",
                type:"post"
            }
            });
            
            $('#example1 tbody').on( 'click', '#sweet-14', function () {
            var oTableApi = $('#example1').dataTable().api();
            var tr = $(this).closest('tr');
            td = tr.find("td:first")
            var cell = oTableApi.cell(td);

            swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
            },
            function(){
            swal("Deleted!", "Your event has been deleted.", "success");

            $.ajax({
            url:"delSupplier.php",
            method:"POST",
            data:{
            id:cell.data(),
            },
            success:function(data)
            {
            setTimeout(function () {
            // window.location = "ViewSuppliers.php";

            }, 2000);

            }
            });

            });



            });
        });
 
//   $(document).ready(function() {
//         $.ajax({
//             url: "server_processing.php",
//             method: 'POST',
//             dataType: 'json',
//             success: function(data) {
//               console.log(data);

//                 $('#example1').dataTable({
//                     data: data,
//                      processing: true,
//                     serverside: false,       
//                     columns: 
//                     [
//                       {"data":"id"},
//                       {"data":"supplier_title"},
//                       {"data":"supplier_address"},
//                       {"data":"contact_details"}
//                     ],
//                     "order": [[ 1, "asc" ]],
//                     'paging'      : true,
//                     'lengthChange': true,
//                     'searching'   : true,
//                     'ordering'    : false,
//                     'info'        : true,
//                     'autoWidth'   : true,   aLengthMenu: [ [10, 20, -1], [10, 20, "All"] ],
//                     "bPaginate": false,
//                     "bLengthChange": false,
//                     "bFilter": true,
//                     "bInfo": false,
//                     "bAutoWidth": false,
//                     "columnDefs": 
//                     [
//                       {
//                         "targets": 4,
//                         "data": "id",
//                         "render": function ( data, type, row, meta ) 
//                         {  
//                           return '<center><a href="UpdateSuppliers.php?id='+data+'" class = "btn btn-primary btn-xs"> <i class="fa">&#xf044;</i> Edit</a>&nbsp;<a id = "sweet-14" class = "btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete</a></center>';
//                         }
//                       }
//                     ]



//                 });
//             }
//         });
 
   
   

    // });






</script>
</body>
</html>

