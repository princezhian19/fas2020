<?php 
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$division = $_GET['division'];
}
?>
<!DOCTYPE html>
<html>

<title>FAS | Processing Request</title>
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

</head>
<body class="hold-transition skin-red-light fixed sidebar-mini">
<div class="wrapper">
<?php 
  if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
      include('test1.php');
    }else{
      include('sidebar2.php');
    }
 ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Processing of ICT TA Request</li>
      </ol>
      <br>
      <br>
        <?php include('_tableTA.php');?>
    </section>
  </div>
  <footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communication Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
      
    </footer>
    <br>
 
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.j s"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- <script src="_includes/sweetalert.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="_includes/sweetalert.css"> -->
<script src="_includes/sweetalert.min.js"></script>
<script src="_includes/sweetalert2.min.js"></script>

<?php 
  if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
      ?>
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
        
                'scrollX'     : true,
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
                  "ajax": "DATATABLE/server_processing.php",
                  "order": [[ 0, "desc" ]],
                  "columnDefs": [ {
                      "targets": 11,
                      "render": function (data, type, row, meta ) {  

                      if(row[3] == 'Jan 01, 1970' || row[0] == '0000-00-00')
                      {
                        $dateFormat = '';
                        // return $dateFormat;
                      }
                      if(row[10] == '<span class="badge badge-pill" style = "background-color:red;">Submitted</span>')
                      {


                        if(<?php echo $division?> == 10)
                        {
                          action = '';  
                          action = '<a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';    

                        
                        }else{
                          action = '';
                          action = '<a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';    

                        }
                      }
                      else if (row[10] == '<span class="badge badge-pill" style = "background-color:orange;">Received</span>')
                      {
                        // action = 'ON GOING';
                        
                        action = '<a href = "processing.php?division=<?php echo $_SESSION['division'];?>&ticket_id=" class = "btn btn-info btn-xs"   style = "width:100%;">Assign</a><a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';          



                      }
                      else if(row[10] == '<span class="badge badge-pill" style = "background-color:blue;">For action</span>')
                      {
                     
                          action = '<a class = "btn btn-info btn-xs"  id = "view" style = "width:100%;" > <i class="fa" >&#xf06e;</i>&nbsp;View</a><a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';          


                        
                      
                      }
                      else if (row[10] == '<span class="badge badge-pill" style = "background-color:green;">Completed</span>')
                      { 
                        if(<?php echo $division?> == 10)
                        {
                          if(row[10] == '<span class="badge badge-pill" style = "background-color:red;">Submitted</span>')
                          {
                            action = '';
                          }else{
                        action = '<a class = "btn btn-info btn-xs"  id = "view" style = "width:100%;" > <i class="fa" >&#xf06e;</i>&nbsp;View</a><a class = "btn btn-success btn-xs"  id = "edit" style = "width:100%;"> <i class="fa info-circle"></i>Resolve</a><a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';    

                          }
                        }else{
                        action = '<a class = "btn btn-success btn-xs"  id = "sweet-15"> <i class="fa fa-star" aria-hidden="true"></i>&nbsp;Rate Service</a><a class = "btn btn-danger btn-xs"  id = "delete" style = "width:100%;"> <i class="fa fa-trash"></i>Delete</a>';          

                          // <i style = "font-size:20px;color:#2196F3;tex-align:center;" class="fa fa-print" id = "view" ></i>
                        }

                      }
                    
                    return action;
                  }
                  },
                  {
                      targets: 3,
                      "render": function ( data, type, row, meta ) { 
                    if(row[3] == '')
                      {
                        $action2 = '<a class = "btn btn-info btn-xs"   id = "sweet-14"> <i class="fa fa-check-circle"></i>Receive</a>';
                        return $action2;
                      
                    
                      }else{
                        return row[3];
                      }
                      return row[3];
          
                      }
                  } ] 

              } );
            
      


              $('#example tbody').on( 'click', '#edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="_editRequestTA.php?division=<?php echo $_GET['division'];?>&id="+data[0];
              } );

              $('#example tbody').on( 'click', '#delete', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var control_no = data[0];

                swal({
                  title: "Are you sure you want to delete this request?",
                  text: "You will not be able to recover this imaginary file!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes",
                  cancelButtonText: "Cancel",
                  closeOnConfirm: false,
                  closeOnCancel: false
                }).then(function (){
                  swal("Control Number "+control_no+" has been deleted.", "success");
                $.ajax({
                url:"deleteRequest.php",
                method:"POST",
                data:{
                control_no:control_no,
                },
                success:function(data)
                {
                setTimeout(function () {
                window.location = "monitoring.php?division=<?php echo $_GET['division'];?>";
                }, 1000);
                }
                });
                });


              });

              $('#example tbody').on( 'click', '#sweet-14', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var a = data[0];
                swal("Control No: "+data[0], "You already received this request", "success")
                  .then(function () {
                      $.ajax({
                        url:"_ticketReleased.php",
                        method:"POST",
                        data:{
                            id:data[0],
                            option:"released"
                        },
                        success:function(data)
                        {
                            setTimeout(function () {
                            swal("Record saved successfully!");
                            }, 3000);
                            window.location = "techassistance.php?division=<?php echo $_GET['division']?>&ticket_id="+a;
                        }
                      });
                  });
              });

              $('#example tbody').on( 'click', '#view', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="report/TA/pages/viewTA.php?id="+data[0];
              });
              
              $('#example tbody').on( 'click', '#sweet-15', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="rateService.php?division=<?php echo $_GET['division'];?>&id="+data[0];
              });

          });
      </script>

      <?php
    }else{
      ?>
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
                'scrollX'     : true,

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
                  "ajax": "DATATABLE/server_processing_enduser.php",
                  "order": [[ 0, "desc" ]],
                  "columnDefs": [ {
                      "targets": 11,
                      "render": function ( data, type, row, meta ) {  
                      if(row[3] == 'Jan 01, 1970' || row[0] == '0000-00-00')
                      {
                        $dateFormat = '';
                        // return $dateFormat;
                      }
                  
                      if(row[10] == '<span class="badge badge-pill" style = "background-color:red;">Submitted</span>')
                      {
                        
                        if(<?php echo $division?> == 10)
                        {
                          action = '';          
                        
                        }else{
                          action = '<a class = "btn btn-info btn-xs"  id = "view" style = "width:100%;" > <i class="fa" >&#xf06e;</i>&nbsp;View</a>';          

                          // action = '';
                        }
                      }
                      else if (row[10] == '<span class="badge badge-pill" style = "background-color:orange;">Received</span>')
                      {
                        // action = 'ON GOING';
                      }
                      else if(row[10] == '<span class="badge badge-pill" style = "background-color:blue;">For action</span>')
                      {
                        if(<?php echo $division?> == 10)
                        {
                          action = '<a class = "btn btn-primary btn-xs"  id = "edit" style = "width:100%;"> <i class="fa">&#xf044;</i> Edit</a>';          

                        }else{
                          action = '<a class = "btn btn-info btn-xs"  id = "view" style = "width:100%;" > <i class="fa" >&#xf06e;</i>&nbsp;View</a>';          


                        }
                      
                      }
                      else if (row[10] == '<span class="badge badge-pill" style = "background-color:green;">Completed</span>')
                      { 
                        if(<?php echo $division?> == 10 || <?php echo $division?> == 11 || <?php echo $division?> == 12 || <?php echo $division?> == 13 || <?php echo $division?> == 14 || <?php echo $division?> == 16 )
                        {
                        action = '<a class = "btn btn-success btn-xs"  id = "edit" style = "width:100%;"> <i class="fa info-circle"></i>Resolve</a>';          
                        }else{
                        action = '<a class = "btn btn-success btn-xs"  id = "sweet-15"> <i class="fa fa-star" aria-hidden="true"></i>&nbsp;Rate Service</a>';          

                          // <i style = "font-size:20px;color:#2196F3;tex-align:center;" class="fa fa-print" id = "view" ></i>
                        }

                      }
                      
                    return action;
                  }
                  },
                  {
                      targets: 3,
                      "render": function ( data, type, row, meta ) { 
                    if(row[3] == '')
                      {

                        if(<?php echo $division?> == 10)
                        {
                        $action2 = '<a class = "btn btn-info btn-xs"   id = "sweet-14"> <i class="fa fa-check-circle"></i>Receive</a>';
                        return $action2;
                        }else{
                          $action2 = '';
                        return $action2;
                        }
                      
                    
                      }else{
                        return row[3];
                      }
                      return row[3];
          
                      }
                  } ] 

              } );
            

              $('#example tbody').on( 'click', '#edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="_editRequestTA.php?division=<?php echo $_GET['division'];?>&id="+data[0];
              } );

              $('#example tbody').on( 'click', '#sweet-14', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var a = data[0];
                swal("Control No: "+data[0], "You already received this request", "success")
                  
                  .then(function () {
                      $.ajax({
                        url:"_ticketReleased.php",
                        method:"POST",
                        data:{
                            id:data[0],
                            option:"released"
                        },
                        success:function(data)
                        {
                            setTimeout(function () {
                            swal("Record saved successfully!");
                            }, 3000);
                            window.location = "techassistance.php?division=<?php echo $_GET['division']?>&ticket_id="+a;
                        }
                      });
                  });
              });

              $('#example tbody').on( 'click', '#view', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="report/TA/pages/viewTA.php?id="+data[0];
              });
              
              $('#example tbody').on( 'click', '#sweet-15', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location="rateService.php?division=<?php echo $_GET['division'];?>&id="+data[0];
              });

          });
      </script>
      <?php
    }
 ?>


</body>
</html>
