<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
<title>FAS | Databank</title>
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
    <style>
  th{
    color:#a9242d;
    text-align:center;
  }
  td{
    /* text-align:center; */
  }
  </style>
</head>
<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'rdmiranda') { include('test1.php'); }else{ include('sidebar2.php'); }
 ?>

<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Records</li>
        <li class="active">Databank</li>
      </ol>
      <br>
      <br>
     </section>
     <?php include('@databanktable.php');?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
  </div>
  <footer class="main-footer">
  <br>
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
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
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>






<!-- <script>
$(function () {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      
    })
  })
  
</script> -->

</body>
</html>
<script>
  $(document).ready(function() {

    $('#example1').DataTable( {

              'paging'      : true,
              'lengthChange': false,
              'searching'   : true,
              'ordering'    : false,
              'info'        : false,
              'autoWidth'   : false,

              initComplete: function () {
            this.api().columns(0).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

            this.api().columns(1).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );


            this.api().columns(2).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

            //   //Search By Dropdown and Input
            //   this.api().columns(2).every( function () {
            //     var column = this;
            //     var select = $(' <input type="text" style="width:100%" class="form-control" placeholder="" />')
            //         .appendTo( $(column.header()) )
            //         .on( 'keyup change clear', function () {
            //             var val = $.fn.dataTable.util.escapeRegex(
            //                 $(this).val()
            //             );
 
            //             if ( column.search() !== this.value ) {
            //               column
            //                 .search( this.value )
            //                 .draw();
            //         }
                   
 
             
            //     } );
            // } );
           
            this.api().columns(3).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

            this.api().columns(4).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width:100%"><option value=""></option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

           

           

           


        }
        

    } );

  
} );


</script>