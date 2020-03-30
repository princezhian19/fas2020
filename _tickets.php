

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
  <link rel="stylesheet" href="_includes/fontawesome.css">


  
  
<style>
        pre { margin: 20px 0; padding: 20px; background: #fafafa; } .round { border-radius: 50%;vertical-align: }
</style>
</head>
<?php


function filldataTable()
{
    include 'connection.php';
    $query = "SELECT * FROM tbltechnical_assistance 
    where `STATUS_REQUEST` = 'Submitted' or  `STATUS_REQUEST` = 'Received' or `STATUS_REQUEST` = 'For action' 
    GROUP by tbltechnical_assistance.ID
    order by `REQ_DATE` DESC, `REQ_TIME` ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $data[] = $row['CONTROL_NO'];

        ?>
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body"> 
                                <div class = "col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row no-gutters">
                                                <div class="col-md-2" style = "background-color:#9FA8DA;height:112px;text-align:center;padding-top:3%;font-size:20px;height:115px;">
                                                <?php echo '<b>'.$row['CONTROL_NO'].'</b>';?>
                                                <?php echo '<label style = "color:blue;">'.$row['STATUS_REQUEST'].'</label>';?>
                                                    
                                                </div>
                                                <div class="col-md-10" style = "background-color:#CFD8DC;">
                                                    <div class="card-body" id="<?php echo $row['CONTROL_NO']; ?>">
                                                    <?php
                                                    if($row['STATUS_REQUEST'] == 'For action')
                                                    {
                                                    }else{
                                                        ?>
                                                        <button class = "pull-right sweet-14 btn btn-primary">Assign</button>

                                                        <?php
                                                    }
                                                    ?>
                                                        <!-- if($row['STATUS_REQUEST'] == 'Received' || $row['STATUS_REQUEST'] == 'For action')
                                                        {

                                                        }else{
                                                            ?>
                                                        <button class = "pull-right btn btn-primary sweet-15" style = "padding-left:10px;">Recieved</button>

                                                        } -->


                                                        <h5 class="card-title">Issue/Problem</h5>
                                                        <p class="card-text"><?php echo $row['ISSUE_PROBLEM'];?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 bg-success"  style = "padding-top:10px;">
                                                <?php
                                                if($row['ASSIST_BY'] == '' || $row['ASSIST_BY'] == null)
                                                {
                                                    ?>
                                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="FAD">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Assignee</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-59.8px;font-size:12px;">-</span>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Assignee</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-40.8px;font-size:12px;">
                                                    <?php 
                                                    $uname  = $row['ASSIST_BY'];
                                                    $uname = trim($uname);
                                                    if(strpos($uname, " ") !== false){
                                                        $u = explode(" ", $uname);
                                                        echo $u[0].' '.$u[1]; // piece1
                                                    }
                                                    ?></span>
                                                    <?php
                                                }
                                                ?>
                        
                                                    
                                                </div> 
                                                <div class="col-md-3 bg-success"  style = "padding-top:10px;">
                                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['REQ_BY'];?>">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Request by</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-44.8px;font-size:12px;">
                                                    <?php
                                                $uname  = $row['REQ_BY'];
                                                $uname = trim($uname);
                                                
                                                if(strpos($uname, " ") !== false){
                                                
                                                    $u = explode(" ", $uname);
                                                    echo $u[0]; // piece1
                                                
                                                }
                                                ?>
                                                    </span>
                                                </div>                                                
                                                
                                                
                                                <div class="col-md-3 bg-success"  style = "padding-top:10px;">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Category</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-42.8px;font-size:12px;"><?php echo $row['TYPE_REQ'];?></span>
                                                </div> 
                                                <div class="col-md-2 bg-success"  style = "padding-top:10px;">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Request Date</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-61.8px;font-size:12px;"><?PHP echo date('F d, Y',strtotime($row['REQ_DATE']));?></span>
                                                </div>   
                                                
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php
    }

}
function showICTload($itstaff)
{
    include 'connection.php';;
    $query = "SELECT count(*) as 'count' FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' and ASSIST_BY = '$itstaff'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo $row['count'];
    }
}

function submittedReq()
{
    include 'connection.php';
    $username = $_SESSION['username'];
    $query = "SELECT * FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' order by `REQ_DATE` DESC, `REQ_TIME` LIMIT 4 ";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {

    echo '<ul class="list-group list-group-flush">';

    while($row = mysqli_fetch_array($result))
    {
        $query1 = 'SELECT CONCAT(`FIRST_M`," ",`LAST_M`)AS NAME ,`UNAME` FROM `tblemployee`  WHERE CONCAT(`FIRST_M`," ",`LAST_M`) = "'.$row['ASSIST_BY'].'"';       
        $result1 = mysqli_query($conn, $query1);
        while($row1 = mysqli_fetch_array($result1))
        {
            if($row1['UNAME'] == $username)
            {
                ?>
                    <li class="list-group-item" id = "<?php echo $row['CONTROL_NO'];?>">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY']?>">
                            <?php echo $row['CONTROL_NO'];?>
                            <button  type="button" class="sweet-16 btn btn-success pull-right">
                            Completed
                            </button>
                        </li>
                <?php
            }else{
                ?>
                <li class="list-group-item" id = "<?php echo $row['CONTROL_NO'];?>">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY']?>">
                            <?php echo $row['CONTROL_NO'];?>
                            <button disabled type="button" class="sweet-16 btn btn-success pull-right">
                            Completed
                            </button>
                        </li>
                <?php
            }
        }
        ?>
        
                        
                        
                   
        <?php
    }
    echo '</ul>';
    }else{
        ?>
    <li class="list-group-item" id = "<?php echo $row['CONTROL_NO'];?>">
    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar=DILG>
    </li>
            <?php
        }
     
}

function currentServing($assignee)
{
    include 'connection.php';
    $query = "SELECT * FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' and `ASSIST_BY` like  '%$assignee%' order by `REQ_DATE` DESC, `REQ_TIME` LIMIT 1 ";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result))
    {
        ?>
        <div class = "col-md-6 list-group-item" style = "line-height:54px;">
                            <div class="card">
                                <div class="card-body">
                                    <h3 style = "text-align:center;">CONTROL NUMBER:</h3>
                                    <p style = "text-align:center;font-size:30px;color:#1565C0;font-weight:bold;"><?php echo $row['CONTROL_NO']?></p>
                                    <button class = "btn btn-success btn-lg" style = "text-align:center;">Completed</button>

                                    <p class = "pull-right">Assigned ICT Staff:<img   class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
                                </div>
                            </div>
                        </div>
        <?php
    }
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php 

    include('sidebar.php');

?>
<?php 
$username = $_SESSION['username'];
if(isset($_GET['ticket_id']))
{

}else{
    $_GET['ticket_id'] == '';
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
        <!-- ====== TICKETING STARTS HERE -->
           

            <div class = "row">
            <div class = "col-md-3">
                <div class="card" style="width: 100%;margin-top:40px;">
                <p class="font-weight-bold"><h3>ICT Staff work load</h3></p>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Mark Kim">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Web Programmer</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-73.8px;font-size:12px;">Mark Kim A. Saluti</span>
                            <button type="button" class="btn btn-sm btn-danger pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Mark Kim Sacluti');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Christian Paul">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Network Administrator</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-94.8px;font-size:12px;">Christian Paul Ferrer</span>
                            <button type="button" class="btn btn-sm btn-danger pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Christian Paul Ferrer');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Charles Adrian">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Database Administrator</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-100.8px;font-size:12px;">Charles Adrian Odi</span>
                            <button type="button" class="btn btn-sm btn-danger pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Charles Adrian Odi');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Shiela Mei">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Data Analyst</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-55.8px;font-size:12px;">Shiela Mei Olivar</span>
                            <button type="button" class="btn btn-sm btn-danger pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Shiela Mei Olivar');?></span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card" style="width: 100%;margin-top:40px;">
                <p class="font-weight-bold"><h3></h3></p>
                    <h3>On-going</h3>
                    <?php echo submittedReq();?>
                </div>
            </div>
            <div class = "col-md-9">
                <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">

                    <thead>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php echo filldataTable();?>
                    </tbody>
                </table>
            </div>
            </div>
       <!-- END OF TICKETING -->
    </section>
  </div>
 
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script src="_includes/sweetalert.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">
<link href="_includes/sweetalert2.min.css" rel="stylesheet"/>

<script src="_includes/sweetalert2.min.js" type="text/javascript"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script type="text/javascript">
$('.sweet-14').click(function()
    {
        var ids = $(this).parent('div').attr('id');
        swal({
            title: 'Assign to:',
            input: 'select',
            inputOptions: {
            'Mark Kim Sacluti': 'Mark Kim Sacluti',
            'Charles Adrian Odi': 'Charles Adrian Odi',
            'Christian Paul Ferrer': 'Christian Paul Ferrer',
            'Shiela Mei Olivar':'Shiela Mei Olivar',
            },
            inputPlaceholder: 'Select ICT Staff',
            showCancelButton: true,
            inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value === 'Mark Kim Sacluti') {
                resolve()
                }else if(value == 'Charles Adrian Odi')
                {
                resolve()
                } else if(value == 'Christian Paul Ferrer'){
                resolve()
                }else{
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
            success:function()
            {
                
            window.location = '_tickets.php?division=<?php echo $_GET['division'];?>&ticket_id=<?php echo $_GET['ticket_id']; ?>';
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
$('.sweet-16').click(function()
    {
        var ids = $(this).parent('li').attr('id');
        swal({
            title: "Are you sure you want to recieved this request?",
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
                  window.location = "_editRequestTA.php?division=<?php echo $_GET['division']?>&id=<?php echo $_GET['ticket_id']?>";
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
//         "search": {
//     "search": "<?php echo $_GET['ticket_id'];?>"
//   },
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