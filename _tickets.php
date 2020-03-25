

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
  
  
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
        body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; } pre { margin: 20px 0; padding: 20px; background: #fafafa; } .round { border-radius: 50%;vertical-align: }
</style>
</head>
<?php
function filldataTable()
{
    $link = mysqli_connect('localhost','root','','db_dilg_pmis');
    $query = "SELECT * FROM tbltechnical_assistance 
    where `STATUS_REQUEST` = 'Submitted' 
    GROUP by tbltechnical_assistance.ID
    order by `REQ_DATE` DESC, `REQ_TIME` desc ";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result))
    {
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
                                                <div class="col-md-2" style = "background-color:#9FA8DA;height:112px;text-align:center;padding:1%;font-size:20px;height:115px;">
                                                <?php echo $row['CONTROL_NO'];?>
                                                
                                                    <div style = "background-color:#1A237E;margin-left:-9px;color:#fff;border-radius:3%;">
                                                    <span id = "sweet-14<?php echo $row['CONTROL_NO'];?>"><i class="fa fa-users" aria-hidden="true"></i>Assign </span>
                                                    </div>
                                                    <script>
                                                        $('#example1 tbody').on( 'click', '#sweet-14<?php echo $row['CONTROL_NO'];?>', function () 
                                                        {
                                                            var oTableApi = $('#example1').dataTable().api();
    
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
                                                                            control_no:'<?php echo $row['CONTROL_NO'];?>'
                                                                        },
                                                                        success:function()
                                                                        {
                                                                            alert(control_no);
                                                                        window.location = '_tickets.php?ticket_id=<?php echo $_GET['ticket_id']; ?>';
                                                                        }
                                                                        });
                                                                    });
                                                                
                                                                
                                                        });
                                                    </script>
                                                </div>
                                                <div class="col-md-10" style = "background-color:#CFD8DC;">
                                                    <div class="card-body">
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
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-44.8px;font-size:12px;">-</span>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
                                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Assignee</span>
                                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-44.8px;font-size:12px;">
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
    $link = mysqli_connect('localhost','root','','db_dilg_pmis');
    $query = "SELECT count(*) as 'count' FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' and ASSIST_BY = '$itstaff'";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo $row['count'];
    }
}

function submittedReq()
{
    $link = mysqli_connect('localhost','root','','db_dilg_pmis');
    $query = "SELECT * FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' order by `REQ_DATE` DESC, `REQ_TIME` LIMIT 1,3 ";
    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result))
    {
        ?>
        <div class = "col-md-3">
            <div class="card">
                <ul  class="list-group list-group-flush">
                    <li class="list-group-item">
                    <h2 style = "text-align:center;"><?PHP echo $row['CONTROL_NO'];?></h2>
                    <center>
                        <img style="text-align:center;vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
                        <span style="font-size:10px;vertical-align:top;line-height:10px;">Web Programmer</span>
                        <span style="font-size:10px;line-height:40px;50px;margin-left:-80.8px;font-size:12px;"><?php echo $row['ASSIST_BY'];?></span>
                    </center>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }

     
}

function currentServing($assignee)
{
    $link = mysqli_connect('localhost','root','','db_dilg_pmis');
    $query = "SELECT * FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' and `ASSIST_BY` like  '%$assignee%' order by `REQ_DATE` DESC, `REQ_TIME` LIMIT 1 ";
    $result = mysqli_query($link, $query);

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
        <!-- ==================== TICKETING STARTS HERE ============================-->
            <div class = "row">
            
                <div class = "col-md-9">
                    <div class = "col-sm-12 col-md-6 col-lg-12"> 
                        <?php echo currentServing('Mark Kim Sacluti');?>
                        <?php echo currentServing('Christian Paul Ferrer');?>


                        
                    </div>
                    <div class = "col-sm-12 col-md-6 col-lg-12"> 
                    <?php echo currentServing('Charles Adrian Odi');?>


                    <?php echo currentServing('Shiela Mei Olivar');?>


                        
                    </div>
                </div>

                <?php 
                    echo submittedReq();
                $link = mysqli_connect('localhost','root','','db_dilg_pmis');
                $query = "SELECT * FROM tbltechnical_assistance WHERE `STATUS_REQUEST` = 'For action' order by `REQ_DATE` DESC, `REQ_TIME` ";
                $result = mysqli_query($link, $query);
                    if(mysqli_num_rows($result) < 3) 
                        {
                            ?>
                            <div class = "col-md-3">
            <div class="card">
                <ul  class="list-group list-group-flush">
                    <li class="list-group-item" style = "height:127px;">
                    <h2 style = "text-align:center;"></h2>
                    <!-- <center>
                        <img style="text-align:center;vertical-align:top;"  class="round" width="30" height="30" avatar="DILG">
                        <span style="font-size:10px;vertical-align:top;line-height:10px;">Web Programmer</span>
                        <span style="font-size:10px;line-height:40px;50px;margin-left:-80.8px;font-size:12px;"></span>
                    </center> -->
                    </li>
                </ul>
            </div>
        </div>
                            <?php
                        }
                        else{
                        
                    }
                ?>
                

            <div class = "row">
            <div class = "col-md-3">
                <div class="card" style="width: 100%;margin-top:40px;">
                
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Mark Kim">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Web Programmer</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-80.8px;font-size:12px;">Mark Kim A. Saluti</span>
                            <button type="button" class="btn btn-sm btn-primary pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Mark Kim Sacluti');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Christian Paul">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Network Administrator</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-100.8px;font-size:12px;">Christian Paul Ferrer</span>
                            <button type="button" class="btn btn-sm btn-primary pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Christian Paul Ferrer');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Charles Adrian">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Database Administrator</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-108.8px;font-size:12px;">Charles Adrian Odi</span>
                            <button type="button" class="btn btn-sm btn-primary pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Charles Adrian Odi');?></span>
                            </button>
                        </li>
                        <li class="list-group-item">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Shiela Mei">
                            <span style="font-size:10px;vertical-align:top;line-height:10px;">Data Analyst</span>
                            <span style="font-size:10px;line-height:40px;50px;margin-left:-62.8px;font-size:12px;">Shiela Mei Olivar</span>
                            <button type="button" class="btn btn-sm btn-primary pull-right">
                                <span class="badge badge-light"><?php echo showICTload('Shiela Mei Olivar');?></span>
                            </button>
                        </li>
                    </ul>
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

<script src="_includes/sweetalert.min.js"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>





</body>
</html>
<script>
  $(function () {

    $('').DataTable()
    $('#example1').DataTable({
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