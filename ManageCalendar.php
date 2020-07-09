<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$division = $_GET['division'];
$DEPT_ID = $_SESSION['DEPT_ID'];
$OFFICE_STATION = $_SESSION['OFFICE_STATION'];
}
$id = '';
function viewEvents()
{
        ?>
            <form method = "POST" action = "calendar/add-event.php">
                <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "titletxtbox" id = "titletxtbox" value = "<?php echo $id;?>" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input disabled type="text" class = "form-control datepicker1" name = "startdatetxtbox" id="datepicker1" value = "" placeholder="mm/dd/yyyy"  disabled autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">End Date</td>
                            <td class="col-md-5">
                                <input disabled type = "text"  class = "form-control datepicker2" id = "datepicker2" name = "enddatetxtbox"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Description</td>
                            <td class="col-md-5"><input disabled  type = "text" class = "form-control" name = "descriptiontxtbox" id = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "venuetxtbox" id= "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "number" min = "0" name = "enptxtbox" id= "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input disabled type = "text" class = "form-control" name = "remarks" id= "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control" id= "postedby"  value="<?php echo $_SESSION['username'];?>"/>
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control datepicker3" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>

            </form>
        <?php
    
}
// edit  function
function viewEvents2()
{
  ?>

    <form method = "POST" action = "calendar/edit-event.php" id = "edit_act">
    <input  type = "hidden" name = "eventid" id = "eventid2">
    <input  type = "hidden" name = "flag" value="1">

    <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "title" id = "edit" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control start" name = "start" id = "start" value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">End Date</td>
                            <td class="col-md-5">
                                <input autocomplete ="off"  type = "text"  class = "form-control end" name = "end"  id="end" value = "" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Description</td>
                            <td class="col-md-5"><input   type = "text" class = "form-control" name = "desc" id = "desc" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venue" id = "venue" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enp" id = "enp" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "remarks2" id = "remarks2" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control"  id = "posted"/>
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted Date</td>
                            <td class="col-md-5"><input readonly required type = "text" class = "form-control" placeholder = "Posted Date" id="dateposted" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>
  <?php


?>

              
               <?php 
                
             
                  echo ' <input id = "save"  type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save Changes"> ';
                

               ?>

            </form>
  <?php
}

?>
  
  <!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FAS | Monitoring Events</title>
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
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
    <script src="calendar/fullcalendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <style>
  
  #calendar {
      width: 100%;
      padding:10px;
      margin: 0 auto;
      background-color:#fff;
      border:1px solid skyblue;
  }
  
  .response {
      height: 60px;
  }
  
  .success {
      background: #cdf3cd;
      padding: 10px 60px;
      border: #c3e6c3 1px solid;
  }
    </style>
  </head>
<body >
<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'seolivar' ) { include('test1.php'); 
}else{ 

     if ($OFFICE_STATION == 1) {
  include('sidebar2.php');
           
        }else{
  include('sidebar3.php');
         
        } 
}
 ?>
  <?php include('connection.php');?>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb"> <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li> <li class="active">Calendar</li> <li class="active">Manage All Activities</li> </ol>
                <div class="response"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="panel panel-defasult">
                                    <div class="box-body"> 
                                        <div>
                                        <h1>Manage All Activities</h1><br>
                                    </div>
                                <div>
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                                <thead>
                                <th style = "text-align:center;">OFFICE</th>
                                <th style = "text-align:center;">ACTIVITY TITLE</th>
                                <th style = "text-align:center;width:10%;">START DATE</th>
                                <th style = "text-align:center;width:10%;">END DATE</th>
                                <th style = "text-align:center;">VENUE</th>
                                <th style = "text-align:center;width:15%;">NO. OF PAX</th>
                                <th style = "text-align:center;">TARGET PAX</th>
                                <th style = "text-align:center;width:10%;">POSTED BY</th>
                                <th style = "text-align:center;width:10%;">POSTED DATE</th>
                                <?php if (
                                    $username = 'lasabanal' || 
                                    $username == 'mmmonteiro' ||$username == 'charlesodi' || $username == 'masacluti' || $username == 'seolivar' || $username == 'rggutierrez' || $username == 'cvferrer'): ?>
                                    <th style = "text-align:center;width:18%;">ACTION</th>

                <?php else: ?>
                <?php endif ?>
         
                                </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </section>
    </div>
    <footer class="main-footer"><br>
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong> 
  </footer>
  <br>
</div>
<!-- View -->
<div class="modal fade" id="orderModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
    <?php echo viewEvents();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
<!-- Edit -->

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
    <?php echo viewEvents2();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>


<script src="_includes/sweetalert.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">
<!-- <link href="_includes/sweetalert2.min.css" rel="stylesheet"/> -->
<!-- <script src="_includes/sweetalert2.min.js" type="text/javascript"></script> -->


<script>



$(document).on('click','#modalbtn',function(e){
  var id =$(this).attr("data-id");
  $(function() {
  $.ajax({ 
    url: 'fetchActivities.php', 
    data:{id: id},
    dataType: 'JSON',

    type:"post",
    success: function (data) 
    {
      var len = data.length;

      for(var i=0; i<len; i++){
      $("#titletxtbox").val(data[i].title); 
      $("#datepicker1").val(data[i].start); 
      $("#datepicker2").val(data[i].end); 
      $("#descriptiontxtbox").val(data[i].description); 
      $("#venuetxtbox").val(data[i].venue); 
      $("#enptxtbox").val(data[i].enp); 
      $("#remarks").val(data[i].remarks); 
      $("#postedby").val(data[i].postedby); 
      $("#datepicker3").val(data[i].posteddate); 
      }
    }
  });
});
});

// edit
$(document).on('click','#editbtn',function(e){

  var id =$(this).attr("data-id");

  $(function() {
  $.ajax({ 
    url: 'fetchActivities.php', 
    data:{id: id},
    dataType: 'JSON',

    type:"post",
    success: function (data) 
    {
 
      $('#eventid2').val(id);

      var len = data.length;
      for(var i=0; i<len; i++){

      $("#edit").val(data[i].title); 
      $("#start").val(data[i].start); 
      $("#end").val(data[i].end); 
      $("#desc").val(data[i].description); 
      $("#venue").val(data[i].venue); 
      $("#enp").val(data[i].enp); 
      $("#remarks2").val(data[i].remarks); 
      $("#posted").val(data[i].postedby); 
      $("#dateposted").val(data[i].posteddate); 
      }
    }
  });
});
});


     $(document).ready(function(){
            var dataTable=$('#example').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "order": [[ 2, "desc" ]],
            aLengthMenu: [ [10, 20, -1], [ 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "processing": true,
            "serverSide":true,
            "ajax":{
                url:"DATATABLE3/test/fetchCalendar.php?PO=<?php echo $_SESSION['planningofficer'];?>&currentuser=<?PHP echo $_SESSION['username'];?>&division=<?php echo $_SESSION['division'];?>",
                type:"post"
                
            }
            });
            $(".start").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$("#start").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$("#end").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$(".end").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});




     });
    $(document).on('click','#sweet-14',function(e){
    e.preventDefault();
    var oTableApi = $('#example').dataTable().api();
            var tr = $(this).closest('tr');
            td = tr.find("td:eq(1)");

            var cell = oTableApi.cell(td);
            var per_id = cell.data();
        swal({
        title: "Are you sure?",
        text: "Your will not be able to recover this activity!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        },
        function(){
        swal("Deleted!", "Your activity has been deleted.", "success");
            $.ajax({
                url:"calendar/delete-event.php",
                method:"POST",
                data:{
                title:per_id,
            },
            success:function(data)
            {
         
                  setTimeout(function () {
                  window.location = "ManageCalendar.php";
                  }, 1000);

              
            }
            });

        });

    });
</script>

</body>
</html>
