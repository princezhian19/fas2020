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
        <?php include('suppliers_table.php');?>
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
<script>


$(document).ready(function() {
  $('.select2').on('change', function()
      {
        swal({
          title: "Are you sure you want to save?",
          text: "Control No:",
          type: "info",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        }, function () {
        
      });
    });
var action = '';
    
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
        "ajax": "DATATABLE/server_processing3.php",
        "order": [[ 1, "asc" ]],
        // "aoColumnDefs":[{
        //   "bVisible":false, 
        //   "aTargets":[0]
        // }],
        "columnDefs": [ {
          "data": "id",
            "targets": 4,
            "render": function ( data, type, row, meta ) {  
              return '<a href="UpdateSuppliers.php?id='+row[0]+'" class = "btn btn-primary btn-xs"> <i class="fa">&#xf044;</i> Edit</a>&nbsp;<a id="sweet-14" class = "btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete</a>';
  
            }
        } ] 

    } );
  

  

    $('#example tbody').on( 'click', '#sweet-14', function () {
      var data = table.row( $(this).parents('tr') ).data();
      var supp_id = data[0];
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
                  id:supp_id,
              },
              success:function(data)
              {
                  setTimeout(function () {
                  window.location = "ViewCalendar.php";

                  }, 2000);

              }
            });

});
  
  

    });

    $('#example tbody').on( 'click', '#view', function () {
      var data = table.row( $(this).parents('tr') ).data();
      window.location="JASPER/sample/viewTA.php?id="+data[0];
    });
    
    $('#example tbody').on( 'click', '#sweet-15', function () {
      var data = table.row( $(this).parents('tr') ).data();
      window.location="rateService.php?division=<?php echo $_GET['division'];?>&id="+data[0];
    });
    
});


</script>


</body>
</html>
