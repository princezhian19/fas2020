<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$OFFICE_STATION = $_SESSION['OFFICE_STATION'];

}

$query = "SELECT OFFICE_STATION   from tblemployeeinfo where UNAME = '".$_SESSION['username']."' ";

// PHP FUNCTIONS
function getOffice()
    {
        include 'connection.php';
        $query = "SELECT OFFICE_STATION   from tblemployeeinfo where UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            switch ($row['OFFICE_STATION']) {
                case '1':
                    ?>
                        <select required id="mySelect2" class="form-control" name="office" disabled>
                            <option selected disabled></option>
                            <option value="1" selected>Regional Office</option>
                            <option value="2">Provincial/HUC Office</option>
                            <option value="3">Cluster Office</option>
                            <option value="4">City/Municipal Office</option>
                        </select>
                    <?PHP
                    break;
                case '2':
                    ?>
                            <select required id="mySelect2" class="form-control" name="office" disabled>
                            <option selected disabled></option>
                            <option value="1" >Regional Office</option>
                            <option value="2" selected>Provincial/HUC Office</option>
                            <option value="3">Cluster Office</option>
                            <option value="4">City/Municipal Office</option>
                        </select>
                    <?PHP
                    break;
                case '3':
                    ?>
                            <select required id="mySelect2" class="form-control" name="office" disabled>
                            <option selected disabled></option>
                            <option value="1" >Regional Office</option>
                            <option value="2" >Provincial/HUC Office</option>
                            <option value="3" selected>Cluster Office</option>
                            <option value="4">City/Municipal Office</option>
                        </select>
                    <?PHP
                    break;
                case '4':
                    ?>
                            <select required id="mySelect2" class="form-control" name="office" disabled>
                            <option selected disabled></option>
                            <option value="1" >Regional Office</option>
                            <option value="2" >Provincial/HUC Office</option>
                            <option value="3" >Cluster Office</option>
                            <option value="4" selected>City/Municipal Office</option>
                        </select>
                    <?PHP
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
?>
<!DOCTYPE html>
<html>


<title>FAS | Process Request</title>
<head>
  

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
    <script src="bower_components/chart.js/Chart.js"></script>


  
  
<style>
        pre { margin: 20px 0; padding: 20px; background: #fafafa; } .round { border-radius: 50%;vertical-align: }

        .tdTitle{
          background-color: #B0BEC5;
          font-family: 'Cambria';
          font-weight: bold;
        }

      .table{
        border: 1px solid black;
      }
      .th, td{
        padding: 5px;

      }
</style>
</head>

<body class="hold-transition skin-red-light fixed sidebar-mini">
<div class="wrapper">
<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'sglee') { include('test1.php'); 
  }else{ 
  
       if ($OFFICE_STATION == 1) {
    include('sidebar2.php');
             
          }else{
    include('sidebar3.php');
           
          } 
  }
?>
<div class="content-wrapper">
  <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class = "active"><a href="#">Website Posting Request Form</a></li>
      </ol>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="panel panel-default">
                    <div class="box-body">      
                        <!-- <div> <h1>Website Posting Request</h1><br> </div> -->
                        <!-- Small boxes (Stat box) -->
                          <form method = "POST">
                         
                            <div class = "row">
                                <div class = "col-lg-12">
                                    <div class = "col-lg-8">
                                    <table border =1 style = "table-layout: fixed; width:100%;border-width:medium;border-style:solid black;" id = "table_name" >
                                    <tbody>
                                      <tr> 
                                        <td class = "box-title" colspan = 8 style = "color:black;font-size:20px;font-weight:bold;background-color:#90A4AE">A. REQUEST FOR WEBSITE POSTING (To be Accomplished by Requesting Office)</td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Requested Date:</td>
                                        <td></td>
                                        <td class = "tdTitle">Requested Time:</td>
                                        <td></td>
                                        <td class = "tdTitle" rowspan = 3 style = "text-align:center;">Category</td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Requested By:</td>
                                        <td></td>
                                        <td class = "tdTitle">Office:</td>
                                        <td></td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Position:</td>
                                        <td></td>
                                        <td class = "tdTitle">Mobile No:</td>
                                        <td></td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                        <td><input type="checkbox"> News</td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Purpose:</td>
                                        <td colspan = 3 class = "tdTitle"></td>
                                        <td class = "tdTitle" rowspan =2>Files/<BR>Attachments:</td>
                                        <td colspan = 3 rowspan = 2 class = "tdTitle"></td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Signature:</td>
                                        <td colspan = "3"></td>
                                      </tr>
                                      <tr>
                                        <td colspan = 8 style = "border:3px solid black;"></td>
                                      </tr>
                                      <tr>
                                        <td colspan = 4 style = "text-align:center;" class = "tdTitle">B. APPROVAL</td>
                                        <td colspan = 4 style = "text-align:center;" class = "tdTitle">C. WEBSITE POSTING<br> (To be Accomplished by RICTU)</td>
                                      </tr>
                                      <tr>
                                        <td colspan = 2>APPROVED</td>
                                        <td colspan = 2>DISAPPROVED</td>
                                        <td class = "tdTitle">Received Date:</td>
                                        <td></td>
                                        <td class = "tdTitle">Received Time:</td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td colspan = 4 rowspan=3 style = "font-weight:bold;text-align:center;font-family:Cambria">
                                        __________________________________________ <br>
                                        MARK KIM A. SACLUTI</td>
                                        <td class = "tdTitle">Posted Date:</td>
                                        <td></td>
                                        <td class = "tdTitle">Received Time:</td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Posted By:</td>
                                        <td></td>
                                        <td class = "tdTitle">Signature:</td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Remarks::</td>
                                        <td colspan = 3></td>
                                      </tr>
                                      <tr>
                                        <td colspan = 8 style = "border:3px solid black;"></td>
                                      </tr>
                                      <tr>
                                        <td colspan = 8 class = "tdTitle" style = "text-align:center;">D. CONFIRMATION OF REQUESTING OFFICE</td>
                                      </tr>
                                      <tr>
                                        <td class = "tdTitle">Confirmed Date:</td>
                                        <td></td>
                                        <td class = "tdTitle">Confirmed Time:</td>
                                        <td></td>
                                        <td class = "tdTitle">Confirmed By:</td>
                                        <td></td>
                                        <td class = "tdTitle">Signature:</td>
                                        <td></td>

                                      </tr>
                                     
                                     

                                  
                                       
                                     
                                      
                                    </tbody>
                                    </table>




                                 
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        
                
                
                               
                      
    </section>
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





<script src="_includes/sweetalert.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">
<link href="_includes/sweetalert2.min.css" rel="stylesheet"/>
<script src="_includes/sweetalert2.min.js" type="text/javascript"></script>


<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script type="text/javascript">
$('.sweet-14').click(function()
    {
        var ids=$(this).data('id');
        swal({
            title: 'Assign to:',
            input: 'select',
            inputOptions: {
            'Mark Kim A. Sacluti': 'Mark Kim A. Sacluti',
            'Jake Banalan': 'Jake Banalan',
            'Shiela Mei E. Olivar':'Shiela Mei E. Olivar',
            'Maybelline Monteiro':'Maybelline Monteiro',
            },
            inputPlaceholder: 'Select ICT Staff',
            showCancelButton: true,
            inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                if (value === 'Mark Kim A. Sacluti') {
                resolve()
                }else if(value == 'Jake Banalan')
                {
                resolve()
                }else if(value == 'Shiela Mei E. Olivar'){
                resolve()
                }
                else{
                resolve()
                }
            })
            }
        }).then(function (result) {
            swal({
            type: 'success',
            html: 'Successfully approved by:' + result,
            closeOnConfirm: false
            })
            $.ajax({
            url:"_approvedTA.php",
            method:"POST",
            data:{
                ict_staff:result,
                control_no:ids
            },
         success:function(data)
              {
                  setTimeout(function () {
                  swal("Ticket No.already assigned!");
                  }, 3000);
                  window.location = 'processing.php?division=<?php echo $_GET['division'];?>&ticket_id='+data[0];
              }
            });
        });
    });
// =====================================================================
// $('.sweet-15').click(function()
//     {
//         var ids = $(this).parent('div').attr('id');
//         swal({
//             title: "Are you sure you want to recieved this request?",
//             text: "Control No:"+ids,
//             type: "info",
//             showCancelButton: true,
//             showCancelButton: true,
//             confirmButtonText: 'Yes',
//             closeOnConfirm: false,
//             showLoaderOnConfirm: true
//         }).then(function () {
//             $.ajax({
//               url:"_ticketReleased.php",
//               method:"POST",
//               data:{
//                   id:ids,
//                   option:"released"
//               },
              
//               success:function(data)
//               {
//                   setTimeout(function () {
//                   swal("Record saved successfully!");
//                   }, 3000);
//                   window.location = "_tickets.php?division=<?php echo $_GET['division']?>&ticket_id=<?php echo $_GET['ticket_id']?>";
//               }
//             });
//         });
//     });
// =====================================================================
$(document).on('click','.sweet-17',function(e){
    e.preventDefault();
    var ids=$(this).data('id');
      swal("Control No: "+ids, "You already received this request", "success")
        // swal({
        //     title: "Are you sure you want to recieved this request?",
        //     text: "Control No:"+data[0],
        //     type: "info",
        //     showCancelButton: true,
        //     showCancelButton: true,
        //     confirmButtonText: 'Yes',
        //     closeOnConfirm: false,
        //     showLoaderOnConfirm: true
        // })
        .then(function () {
            $.ajax({
              url:"_ticketReleased.php",
              method:"POST",
              data:{
                  id:ids,
                  option:"released"
              },
              success:function(data)
              {
                  setTimeout(function () {
                  swal("Record saved successfully!");
                  }, 3000);
                  window.location = "processing.php?division=<?php echo $_GET['division'];?>&ticket_id=";
              }
            });
        });
    });
$(document).on('click','#sweet-16',function(e){
    e.preventDefault();
    var ids=$(this).data('id');
        swal({
            title: "Are you sure you already finished with this request?",
            text: "Control No:"+ids,
            type: "info",
            showCancelButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }).then(function () {
            $.ajax({
              url:"_ticketReleased.php",
              method:"POST",
              data:{
                  id:ids,
                  option:'complete'
              },
              
              success:function(data)
              {
                  setTimeout(function () {
                  swal("Service Completed!");
                  }, 3000);
                  window.location = "_editRequestTA.php?division=<?php echo $_GET['division']?>&id="+ids;
              }
            });
        });
    });
</script>







</body>
</html>
<script>
  $(function () {

    $('').DataTable()


    $('#example1').DataTable({
        <?php 
if($_GET['ticket_id'] == '')
{

}else{
  
    echo ' "search": {
        "search": "'.$_GET['ticket_id'].'"
      },';
}

?>
       
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [[3], [3]],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    })

    $('#example2').DataTable({
    "search": "",
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [[3], [3]],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    })

    $('#example3').DataTable({
    "search": "",
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [[3], [3]],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    })

    $('#example4').DataTable({
    "search": "",
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [[3], [3]],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    })

    $('#example5').DataTable({
    "search": "",
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "lengthMenu": [[3], [3]],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    })
  })
</script>
<script>
/*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
     (function(w, d){


function LetterAvatar (name, size) {

    name  = name || '';
    size  = size || 60;

    var colours = [
            "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", 
            "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
        ],

        nameSplit = String(name).toUpperCase().split(' '),
        initials, charIndex, colourIndex, canvas, context, dataURI;


    if (nameSplit.length == 1) {
        initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
    } else {
        initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
    }

    if (w.devicePixelRatio) {
        size = (size * w.devicePixelRatio);
    }
        
    charIndex     = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
    colourIndex   = charIndex % 20;
    canvas        = d.createElement('canvas');
    canvas.width  = size;
    canvas.height = size;
    context       = canvas.getContext("2d");
     
    context.fillStyle = colours[colourIndex - 1];
    context.fillRect (0, 0, canvas.width, canvas.height);
    context.font = Math.round(canvas.width/2)+"px Arial";
    context.textAlign = "center";
    context.fillStyle = "#FFF";
    context.fillText(initials, size / 2, size / 1.5);

    dataURI = canvas.toDataURL();
    canvas  = null;

    return dataURI;
}

LetterAvatar.transform = function() {

    Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function(img, name) {
        name = img.getAttribute('avatar');
        img.src = LetterAvatar(name, img.getAttribute('width'));
        img.removeAttribute('avatar');
        img.setAttribute('alt', name);
    });
};


// AMD support
if (typeof define === 'function' && define.amd) {
    
    define(function () { return LetterAvatar; });

// CommonJS and Node.js module support.
} else if (typeof exports !== 'undefined') {
    
    // Support Node.js specific `module.exports` (which can be a function)
    if (typeof module != 'undefined' && module.exports) {
        exports = module.exports = LetterAvatar;
    }

    // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
    exports.LetterAvatar = LetterAvatar;

} else {
    
    window.LetterAvatar = LetterAvatar;

    d.addEventListener('DOMContentLoaded', function(event) {
        LetterAvatar.transform();
    });
}

})(window, document);
</script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [645, 59, 80, 81, 56, 55, 40]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

   
  })
</script>