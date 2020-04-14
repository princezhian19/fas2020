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
<title>Suppliers</title>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="dilg.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="_includes/sweetalert.css">

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Suppliers</li>
      </ol>
      <br>
      <br>
        <?php include('suppliers_table.php');?>
    </section>
  </div>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="_includes/sweetalert.min.js"></script>

<script>
  $(document).ready(function(){
            var dataTable=$('#example1').DataTable({
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : true,
              aLengthMenu: [ [3, 10, 20, -1], [3, 10, 20, "All"] ],
              "bPaginate": true,
              "bLengthChange": false,
              // "bFilter": true,
              // "bInfo": false,
              // "bAutoWidth": false,
                "processing": false,
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
                  window.location = "ViewSuppliers.php";

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
