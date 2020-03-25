

<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
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
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
if($_GET['division'] == 16)
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

<script src="_includes/sweetalert.min.js"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
<!-- <script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script> -->
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




  // =====
  
    $.ajax({
        url: '_ajax.php',
        success : function(response) 
        {
          
          // =
            var jsonObject = $.parseJSON(response); 
           
            var id = jsonObject[0].CONTROL_NO;
            var table = $('#example1').dataTable( {
                "data" : jsonObject,
                "serverSide": false,
                "processing": true,
                "autoWidth": false,
                "order": [[ 10, "desc" ]],
                "language": {
                    "searchPlaceholder": "Search records",
                 },
                 aLengthMenu: [
                  [10, 10, 20, -1],
                  [10, 10, 20, "All"]
                ],
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                columns: 
                [
                        {"data" : "CONTROL_NO"},
                        {"data" : "START_DATE"},
                        {"data" : "START_TIME"},
                        {"data" : "REQ_DATE"}, 
                        {"data" : "REQ_TIME"},
                        {"data" : "REQ_BY"},
                        {"data" : "OFFICE"},
                        {"data" : "ISSUE_PROBLEM"},
                        {"data" : "TYPE_REQ_DESC"},
                        {"data" : "ASSIGNED_PERSON"},
                        {"data" : 'STATUS_REQUEST'},
                        {"data" : "BUTTON"}      
                ],
            //     columnDefs:   
            //     [
            //               {"className": "dt-center", "targets": "_all"},
            //         {
            //         targets: [-1], render: function (a, b, data, d) {
                      
            // var id = jsonObject[0].CONTROL_NO;
            // if(<?php echo  "'".$username."'";?> == 'fad' || <?php echo  "'".$username."'";?> == 'FAD')
            // {
            //   return "<center><i id = 'sweet-14' style = 'font-size:20px;color:#2196F3;tex-align:center;' class=' fa fa-check-circle' aria-hidden='true'></i>&nbsp;<i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'edit'>&#xf044;</i><i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'view' >&#xf06e;</i>";
                
            // }else{
            //   return "<center><i id = 'sweet-14' style = 'font-size:20px;color:#2196F3;tex-align:center;' class=' fa fa-check-circle' aria-hidden='true'></i>&nbsp;<i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'edit'>&#xf044;</i><i style = 'font-size:20px;color:#2196F3;tex-align:center;' class='fa' id = 'view' >&#xf06e;</i>";

            // }
            //         }
            //     }],
            });
          $
            $('#example1 tbody').on( 'click', '#sweet-14', function () 
             {
                    
              var oTableApi = $('#example1').dataTable().api();
                    var tr = $(this).closest('tr');
                    td = tr.find("td:eq(0)")
                    var cell = oTableApi.cell(td);
                    <?php 
                    if($_GET['division'] == 16)
                    {
                      ?>
                      window.location="_tickets.php?division=<?php echo $_GET['division'];?>&ticket_id="+cell.data();
                      <?php
                    }
                    else{
                      ?>
                       window.location="_tickets.php?ticket_id="+cell.data();

                      <?php
                    }
                    ?>
// ======
                    // if(cell.data() == '<span class="badge badge-pill" style = "background-color:red;">Submitted</span>')
                    // {
                    //   var oTableApi = $('#example1').dataTable().api();
                    //   var tr = $(this).closest('tr');
                    //   td = tr.find("td:first")
                    //   var cn = oTableApi.cell(td);
                    //   swal({
                    //         title: 'Approved by:',
                    //         input: 'select',
                    //         inputOptions: {
                    //           'Mark Kim Sacluti': 'Mark Kim Sacluti',
                    //           'Charles Adrian Odi': 'Charles Adrian Odi',
                    //           'Christian Paul Ferrer': 'Christian Paul Ferrer',
                    //           'Shiela Mei Olivar':'Shiela Mei Olivar',
                    //         },
                    //         inputPlaceholder: 'Select ICT Staff',
                    //         showCancelButton: true,
                    //         inputValidator: function (value) {
                    //           return new Promise(function (resolve, reject) {
                    //             if (value === 'Mark Kim Sacluti') {
                    //               resolve()
                    //             }else if(value == 'Charles Adrian Odi')
                    //             {
                    //               resolve()
                    //             } else if(value == 'Christian Paul Ferrer'){
                    //               resolve()
                    //             }else{
                    //               resolve()
                    //             }
                    //           })
                    //         }
                    //       }).then(function (result) {
                    //         swal({
                    //           type: 'success',
                    //           html: 'Successfully approved by:' + result,
                    //           closeOnConfirm: false
                    //         })
                    //         $.ajax({
                    //           url:"_approvedTA.php",
                    //           method:"POST",
                    //           data:{
                    //             ict_staff:result,
                    //             control_no:cn.data()
                    //           },
                    //           success:function()
                    //           {
                    //           window.location = '_techassistance.php';
                    //           }
                    //         });
                    //       });
                    // }else if(cell.data() == '<span class="badge badge-pill" style = "background-color:blue;">For action</span>')
                    // {
                    //   var oTableApi = $('#example1').dataTable().api();
                    //   var tr = $(this).closest('tr');
                    //   td = tr.find("td:first")
                    //   var cn = oTableApi.cell(td);
                    //   swal({
                    //         title: 'Approved by:',
                    //         input: 'select',
                    //         inputOptions: {
                    //           'Mark Kim Sacluti': 'Mark Kim Sacluti',
                    //           'Charles Adrian Odi': 'Charles Adrian Odi',
                    //           'Christian Paul Ferrer': 'Christian Paul Ferrer',
                    //           'Shiela Mei Olivar':'Shiela Mei Olivar',
                    //         },
                    //         inputPlaceholder: 'Select ICT Staff',
                    //         showCancelButton: true,
                    //         inputValidator: function (value) {
                    //           return new Promise(function (resolve, reject) {
                    //             if (value === 'Mark Kim Sacluti') {
                    //               resolve()
                    //             }else if(value == 'Charles Adrian Odi')
                    //             {
                    //               resolve()
                    //             } else if(value == 'Christian Paul Ferrer'){
                    //               resolve()
                    //             }else{
                    //               resolve();
                    //             }
                    //           })
                    //         }
                    //       }).then(function (result) {
                    //         swal({
                    //           type: 'success',
                    //           html: 'Successfully approved by:' + result,
                    //           closeOnConfirm: false
                    //         })
                    //         $.ajax({
                    //           url:"_approvedTA.php",
                    //           method:"POST",
                    //           data:{
                    //             ict_staff:result,
                    //             control_no:cn.data()
                    //           },
                    //           success:function()
                    //           {
                    //           window.location = '_techassistance.php';
                    //           console.log(ict_staff);
                    //           }
                    //         });
                    //       });
                    // }else if(cell.data() == '<span class="badge badge-pill" style = "background-color:green;">Completed</span>')
                    // {
                    // }
             });
            // $('#example1 tbody').on( 'click', '#sweet-14', function () 
            //  {
            //   var oTableApi = $('#example1').dataTable().api();
            //         var tr = $(this).closest('tr');
            //         td = tr.find("td:first")
            //         var cell = oTableApi.cell(td);
            
            // });
            // 
            $('#example1 tbody').on( 'click', '#edit', function () 
             {
                    var oTableApi = $('#example1').dataTable().api();
                    var tr = $(this).closest('tr');
                    td = tr.find("td:first")
                    var cell = oTableApi.cell(td);
                  // window.location="_editTA.php?id="+cell.data();
                  window.location="_editRequestTA.php?id="+cell.data();

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
