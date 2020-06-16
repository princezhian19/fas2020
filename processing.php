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

  
  
<style>
pre { margin: 20px 0; padding: 20px; background: #fafafa; } .round { border-radius: 50%;vertical-align: }
</style>
</head>
<?php


function filldataTable()
{
    include 'connection.php';
    $query = "SELECT * FROM tbltechnical_assistance 
    where `STATUS_REQUEST` != '' 
    GROUP by tbltechnical_assistance.ID
    order by `CONTROL_NO` DESC ";

    // -- order by `REQ_DATE` DESC, `REQ_TIME` desc ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $data[] = $row['CONTROL_NO'];
        ?>
        <tr>
            <td style = "width:2%;">
                <br> <br>
                <?php if($row['ASSIST_BY'] =='' || $row['ASSIST_BY'] ==null) { echo '-'; }else{ ?> <img style="vertical-align:top;"  class="round" width="50" height="50" avatar="<?php echo $row['ASSIST_BY'];?>"> <?php } ?>
            </td>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body"> 
                                <div class = "col-md-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12" >
                                            <div class="info-box bg-gray" style = "height:auto;" >
                                                <a href = "report/TA/pages/viewTA.php?id=<?php echo $row['CONTROL_NO']; ?>" style = "color:black;" title = "View ICT TA Form" >
                                                    <span class="info-box-icon info-box-text " style = "background-color:#90A4AE;height:auto;"  >
                                                        <?php echo '
                                                                <b>'.$row['CONTROL_NO'].'</b>
                                                        ';?>
                                                        <p style = "color:red;margin-top:-75%;font-weight:bold;"><?php echo $row['STATUS_REQUEST']; ?></p>





                                                        </span>
                                                        </a>
                                                                                                

                                                <div class="info-box-content" >
                                                    <span class="info-box-number"><i style = "font-size:16px;font-weight:bold;">Issue/Problem/Error Details</i>
                                                    </span>
                                                    <span  style ="font-size:15px;">
                                                    <?php 
                                                    echo $row['ISSUE_PROBLEM'];?>
                                                    </span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div><br>
                                                <div class = "col-lg-3" style = "margin-left:-15px;">
                                                    <span class="progress-description">
                                                    <b><i style = "font-size:13px;" title=  "<?php echo $row['TYPE_REQ'];?>">Category</i></b>
                                                    </span>
                                                    <span class="progress-description"  title=  "<?php echo $row['TYPE_REQ'];?>">
                                                    <?php echo $row['TYPE_REQ'];?>

                                                    </span>
                                                </div>
                                                <div class = "col-lg-3" style = "margin-left:-15px;">
                                                    <span class="progress-description">
                                                    <b><i style = "font-size:13px;">Office</i></b>
                                                    </span>
                                                    <span class="progress-description">
                                                    <?php echo $row['OFFICE'];?>

                                                    </span>
                                                </div>
                                               
                                                <div class = "col-lg-3">
                                                    <span class="progress-description">
                                                    <i style = "font-size:13px;"><b>Requested by</b></i>
                                                    </span>
                                                    <span class="progress-description">

                                                    <?php
                                                            $uname  = $row['REQ_BY'];
                                                            $uname = trim($uname);
                                                            
                                                            if(strpos($uname, " ") !== false){
                                                            
                                                                $u = explode(" ", $uname);
                                                                echo ucfirst(strtolower($u[0])); // piece1
                                                            
                                                            }
                                                            ?>
                                                    </span>
                                                </div>
                                                <div class = "col-lg-3">
                                                    <span class="progress-description">
                                                        <b><i style = "font-size:13px;">Requested Date</i></b>
                                                    </span>
                                                    <span class="progress-description">
                                                        <?php  
                                                    
                                                        echo date('F d, Y', strtotime($row['REQ_DATE']));?>
                                                    </span>
                                                </div>
                                               <br>
                                               <br>
                                               
                                                
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
            <td style = "width:10%;">
                    <?php
                    // Received
                  
                        if($row['START_DATE'] == '0000-00-00' || $row['START_DATE'] == null   )
                        {
                        echo ' <button  data-id = '.$row['CONTROL_NO'].' class = "sweet-17 btn btn-md btn-primary col-lg-12">Receive</button>';

                   

                        
                    }else{
                        if($row['START_DATE'] != '0000-00-00' || $row['START_DATE'] != 'January 01, 1970')
                        {

                            echo '
                            <button disabled title = "Received Date"  data-id = '.$row['CONTROL_NO'].' class = "sweet-17 btn btn-md btn-primary col-lg-12 " >
                            Received Date<br>    
                            <b>'.date('F d, Y',strtotime($row['START_DATE'])).'</b>
                            </button>';
                            echo '<br>';
                        }
                    }









                    echo '<br>';
                      // Assign
             
               

                
                if($_SESSION['complete_name'] == $row['ASSIST_BY'])
                    {
                        ?><br>
                        <button  data-id ="<?php echo $row['CONTROL_NO'];?>" class = " col-lg-12 pull-right sweet-14  btn btn-danger" style = "background-color:orange;">
                        <?php 
                        if($row['ASSIGN_DATE'] == null || $row['ASSIGN_DATE'] == '')
                        {
                        echo 'Assign';?></button>
                        <?php
                        }else{
                       echo  'Assigned Date<br>';  
                        echo '<b>'.date('F d, Y',strtotime($row['ASSIGN_DATE'])).'</b>';?></button>
                        <?php
                        }
                ?>
                        <?php
                    }else{
                        ?><br>
                        <button  data-id ="<?php echo $row['CONTROL_NO'];?>" class = "col-lg-12 pull-right sweet-14 btn btn-danger" style = "background-color:orange;">
                        <?php 
                        if($row['ASSIGN_DATE'] == null || $row['ASSIGN_DATE'] == '')
                        {
                        echo 'Assign';?></button>
                        <?php
                        }else{
                       echo  'Assigned Date<br>';  
                        echo '<b>'.date('F d, Y',strtotime($row['ASSIGN_DATE'])).'</b>';?></button><br>
                        <?php
                        }
                        

                
                    }

                
                    
                      echo '<br><br>';                                      
                    
                    // Complete
                    if($row['STATUS_REQUEST'] == 'Submitted')
                    {
                        echo '<button disabled id ="sweet-16" data-id = '.$row['CONTROL_NO'].' class = "col-lg-12 btn btn-md btn-success">Complete</button>';
                    }else{
                        if($row['COMPLETED_DATE'] == '0000-00-00' || $row['COMPLETED_DATE'] == NULL || $row['COMPLETED_DATE'] == 'January 01, 1970')
                    {
                        if($_SESSION['complete_name'] == $row['ASSIST_BY'])
                        {
                            echo '<button id ="sweet-16" data-id = '.$row['CONTROL_NO'].' class = "col-lg-12 btn btn-md btn-success">Complete</button>';
                        }else{
                            echo '<button id ="sweet-16"  data-id = '.$row['CONTROL_NO'].' class = "col-lg-12 btn btn-md btn-success">Complete</button>';
                        }   
                    }else{

                        echo '<button title = "Completed Date"  id ="update_complete" data-id = '.$row['CONTROL_NO'].' class = "col-lg-12 btn btn-md btn-success">
                        Completed Date<br> 
                        '.date('F d, Y',strtotime($row['COMPLETED_DATE'])).'
                        </button>';
                        echo '<br>';
                    }
                    }
                    
              ?>
              <br>
              <br>


            <?php 
             if($row['COMPLETED_DATE'] == '')
             {
                 ?>
                <button    disabled class = "btn btn-danger btn-md col-lg-12 ">
                                Rate Service
                        </button>
                 <?php
             }else{

             
                if($row['STATUS_REQUEST'] == 'Completed')
                {
                    if ($row['DATE_RATED'] != '' || $row['DATE_RATED'] != NULL){
                    ?>
                        <button    class = "btn btn-danger btn-md col-lg-12 ">
                            <a href = "rateService.php?division=<?php echo $_GET['division'];?>&id=<?php echo $row['CONTROL_NO'];?>" style = "decoration:none;color:#fff;" >
                                Rate Service
                            </a>
                        </button>
                    <?php
                    }
                    else{
                    ?>
                        <button   class = "btn btn-danger btn-md col-lg-12 ">
                            <a href = "rateService.php?division=<?php echo $_GET['division'];?>&id=<?php echo $row['CONTROL_NO'];?>" style = "decoration:none;color:#fff;" >
                                Rate Service
                            </a>
                        </button>
                    <?php
                    }
                }else if($row['STATUS_REQUEST'] == 'Rated'){
                    ?>
                        <button    class = "btn btn-danger btn-md col-lg-12 ">
                            <a href = "rateService.php?division=<?php echo $_GET['division'];?>&id=<?php echo $row['CONTROL_NO'];?>" style = "decoration:none;color:#fff;" >
                                Rated Date<br><?php echo date('F d, Y', strtotime($row['DATE_RATED']));?></a></button>
                            <?php
                }else{
                    ?>
                    <button    class = "btn btn-danger btn-md col-lg-12 ">
                        <a href = "rateService.php?division=<?php echo $_GET['division'];?>&id=<?php echo $row['CONTROL_NO'];?>" style = "decoration:none;color:#fff;" >
                            Rate Service
                        </a>
                    </button>
                    <?php
                }
            }
?>
                    
            </td>
           
        </tr>
        <?php
    }

}
function showICTload($itstaff)
{
    include 'connection.php';;
    $query = "SELECT count(*) as 'count' FROM tbltechnical_assistance WHERE ASSIST_BY  LIKE '%$itstaff%'";
    
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
        $query1 = 'SELECT CONCAT(`FIRST_M`," ",`LAST_M`)AS NAME ,`UNAME` FROM `tblemployeeinfo`  WHERE CONCAT(`FIRST_M`," ",`LAST_M`) = "'.$row['ASSIST_BY'].'"';       
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
                            Complete
                            </button>
                        </li>
                <?php
            }else{
                ?>
                <li class="list-group-item" id = "<?php echo $row['CONTROL_NO'];?>">
                            <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY']?>">
                            <?php echo $row['CONTROL_NO'];?>
                            <button  type="button" class="sweet-16 btn btn-success pull-right">
                            Complete
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
                                    <button class = "btn btn-success btn-lg" style = "text-align:center;">Complete</button>

                                    <p class = "pull-right">Assigned ICT Staff:<img   class="round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
                                </div>
                            </div>
                        </div>
        <?php
    }
}

function showWorkload($ICT)
{
    include 'connection.php';
 
    $query = "SELECT * FROM `tbltechnical_assistance` WHERE `ASSIST_BY` LIKE '%$ICT%' order by `CONTROL_NO` DESC ";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        ?>
         <tr>
            <td>
            <ul class="timeline timeline-inverse" >
                        <!-- timeline time label -->
                        <li class="time-label">
                        <?php 
                             if($row['STATUS_REQUEST'] == 'Complete')
                             {
                                 ?>
                                <span class="bg-green">
                                Request Complete
                            </span>
                                 <?php
                             }else{
                                ?>
                                <span class="bg-red">
                                Work Load
                            </span>
                                <?php
                             }
                        ?>
                            
                        </li>
                        <li>
         
             <img style="vertical-align:top;"  class=" fa round" width="30" height="30" avatar="<?php echo $row['ASSIST_BY'];?>">
            <div class="timeline-item" >
                <span class="time"><i class="fa fa-clock-o"></i>&nbsp;<?PHP echo date('g:m A',strtotime($row['REQ_TIME']));?></span>
                <h3 class="timeline-header"><a href="#"><?php echo $row['REQ_BY'];?></a> sent you a request</h3>
                    <div class="timeline-body">
                    <div class = "pull-right" style = "width:25%;text-align:center;padding:2px;border:4px solid red;color:red;font-size:50px;font-weight:bold;"> <?php echo $row['STATUS_REQUEST'];?>  </div>

                    <?php echo $row['TYPE_REQ'];?>
                    <P><?php echo $row['ISSUE_PROBLEM'];?></P>
                    </div>
                    <div class="timeline-footer">
                    <?php 
                    if($row['STATUS_REQUEST'] == 'Completed')
                    {
                        ?>
                        <a class="btn btn-success btn-md" href = "report/TA/pages/viewTA.php?id=<?php echo $row['CONTROL_NO'];?>">
                        <i class = "fa fa-eye"></i>&nbsp;View
                         </a>
                         <a class="btn btn-primary btn-md" href = "_editRequestTA.php?division=<?php echo $_GET['division'];?>&id=<?php echo $row['CONTROL_NO'];?>">
                         <i class = "fa fa-edit"></i>&nbsp;Edit
                         </a>
                        <?php
                    }else{
                        ?>
        <a class="btn btn-primary btn-md" href = "_editRequestTA.php?division=<?php echo $_GET['division']?>&id=<?php echo $row['CONTROL_NO'];?>">
        <i class = "fa fa-eye"></i>&nbsp;View

                    </a>
                        <?php
                    }
                    ?>
                
                    <!-- <a class="btn btn-danger btn-xs">Delete</a> -->
                    </div>
            </div><br><br>
        <?PHP
    } 
    }else{
        ?>
    <div class="timeline-item">
        <span class="time"></span>
        <h3 class="timeline-header">There is no request on your list.</h3>
            <div class="timeline-body">
            
            </div>
            
    </div><br><br>
                         
                         </li>
                     </ul>
             </td>
             </tr>
    <?PHP
    }
}
function countSubmitted()
{
  include 'connection.php';
  $query = "SELECT count(*) as 'count_sub' FROM tbltechnical_assistance 
  where `STATUS_REQUEST` = 'Submitted'  ";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['count_sub'];
  }
}
function countReceived()
{
  include 'connection.php';
  $query = "SELECT * FROM `ta_monitoring` WHERE `STATUS_REQUEST` LIKE '%RECEIVED%' ";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['COUNT'];
  }
}
function countForAction()
{
  include 'connection.php';
  $query = "SELECT count(*) as 'count_fa' FROM tbltechnical_assistance 
  where `STATUS_REQUEST` = 'For action'  ";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['count_fa'];
  }
}
function countComplete()
{
  include 'connection.php';
  $a = ucwords(strtoupper($_SESSION['complete_name3']));
  $query = "SELECT * FROM `ta_monitoring` WHERE `STATUS_REQUEST` LIKE '%COMPLETED%' ";

  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['COUNT'];
  }
}
function countRated()
{
  include 'connection.php';
  $a = ucwords(strtoupper($_SESSION['complete_name3']));
  $query = "SELECT * FROM `ta_monitoring` WHERE `STATUS_REQUEST` LIKE '%RATED%' ";

  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['COUNT'];
  }
}
function countAssigned()
{
  include 'connection.php';
  $a = ucwords(strtoupper($_SESSION['complete_name3']));
  $query = "SELECT count(*) as 'count_com' FROM tbltechnical_assistance 
  where `ASSIST_BY` != '' ";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo $row['count_com'];
  }
}
?>
<body class="hold-transition skin-red-light fixed sidebar-mini">
<div class="wrapper">
<?php include('test1.php'); ?>
  <div class="content-wrapper">
  <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Online ICT Technical Assistance System</a></li>
        <li class="active">Processing of ICT Technical Assistance</li>
      </ol>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="panel panel-default">
                    <div class="box-body">      
                    <div> <h1>Processing of ICT Technical Assistance</h1><br> </div>
                   <!-- Small boxes (Stat box) -->
      <div class="row">
       <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo countReceived();?></h3>

              <p>RECEIVED</p>
            </div>
            <div class="icon">
              <!-- <i class="ion ion-pie-graph"></i> -->
            </div>
            <a href="#" class="small-box-footer">
            &nbsp;
            </a>
          </div>
        </div>
        <!-- ./col -->
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo countAssigned();?></h3>

              <p>ASSIGNED</p>
            </div>
            <div class="icon">
              <!-- <i class="ion ion-person-add"></i> -->
            </div>
            <a href="#" class="small-box-footer">
            &nbsp;
            </a>
          </div>
        </div>
 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo countComplete();?></h3>

              <p>COMPLETED</p>
            </div>
            <div class="icon">
              <!-- <i class="fa fa-shopping-cart"></i> -->
            </div>
            <a href="#" class="small-box-footer">
              &nbsp;
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo countRated();?></h3>

              <p>RATED</p>
            </div>
            <div class="icon">
              <!-- <i class="ion ion-stats-bars"></i> -->
            </div>
            <a href="#" class="small-box-footer">
            &nbsp;
            </a>
          </div>
        </div>
       
        </div>
      <!-- /.row -->
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                          <button class="btn btn-success"><a style = "color:#fff;decoration:none;" href="requestForm.php?division=<?php echo $_GET['division'];?>"><i class = "fa fa-plus"></i>&nbsp;Create Request</a></button>
                         <a class = "btn btn-md btn-success" style="color:white;text-decoration: none;"  href = "monitoring.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Monitoring</a>
                        </div>

               
                    </div>
                  </div>

                    </div>
             
               
  <section class="content">

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary" style = "background-color:#ECEFF1;">
            <div class="box-body box-profile">

                <h3 class="profile-username text-center">ICT Staff Work Load</h3>

                <p class="text-muted text-center">FAD-RICTU</p>
             
                <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Mark Kim">
                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Web Programmer</span>
                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-73.8px;font-size:12px;">Mark Kim A. Saluti</span>
                                    <button onclick="$('#second_tab').trigger('click')" type="button" class="btn btn-sm btn-danger pull-right">
                                        <span class="badge badge-light" ><?php echo showICTload('Mark');?></span>
                                    </button>
                                    
                                </li>
                                <li class="list-group-item">
                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Christian Paul">
                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Network Administrator</span>
                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-94.8px;font-size:12px;">Christian Paul Ferrer</span>
                                    <button onclick="$('#third_tab').trigger('click')" type="button" class="btn btn-sm btn-danger pull-right">
                                        <span class="badge badge-light"><?php echo showICTload('Christian');?></span>
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Charles Adrian">
                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Database Administrator</span>
                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-100.8px;font-size:12px;">Charles Adrian Odi</span>
                                    <button onclick="$('#fourth_tab').trigger('click')" type="button" class="btn btn-sm btn-danger pull-right" >
                                  
                                        <span class="badge badge-light"><?php echo showICTload('Charles');?></span>

                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Shiela Mei">
                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Data Analyst</span>
                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-55.8px;font-size:12px;">Shiela Mei Olivar</span>
                                    <button  onclick="$('#fifth_tab').trigger('click')" type="button" class="btn btn-sm btn-danger pull-right">
                                        <span class="badge badge-light"><?php echo showICTload('Shiela');?></span>
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <img style="vertical-align:top;"  class="round" width="30" height="30" avatar="Maybelline">
                                    <span style="font-size:10px;vertical-align:top;line-height:10px;">Information Technology Officer I</span>
                                    <span style="font-size:10px;line-height:40px;50px;margin-left:-135.8px;font-size:12px;">Maybelline Monteiro</span>
                                    <button  onclick="$('#six_tab').trigger('click')" type="button" class="btn btn-sm btn-danger pull-right">
                                        <span class="badge badge-light"><?php echo showICTload('Maybelline');?></span>
                                    </button>
                                </li>
                </ul>

            </div>
        </div>
    </div>
    <div class="col-md-9" >
        <div class="nav-tabs-custom" style = "background:#CFD8DC;color:#fff;" >
            <ul class="nav nav-tabs" style="text-align: left;">
                <li class="active"><a href="#first" data-toggle="tab" id="first_tab">Processing</a></li>
                <li><a href="#second" data-toggle="tab" id="second_tab">Mark Kim A. Sacluti</a></li>
                <li><a href="#third" data-toggle="tab" id="third_tab">Christian Paul Ferrer</a></li>
                <li><a href="#fourth" data-toggle="tab" id="fourth_tab">Charles Adrian Odi</a></li>
                <li><a href="#fifth" data-toggle="tab" id="fifth_tab">Shiela Mei Olivar</a></li>
                <li><a href="#six" data-toggle="tab" id="six_tab">Maybelline Monteiro</a></li>
            </ul>

            <div class="tab-content" style = "background-color:#ECEFF1;padding:10px;">
                <div class="active tab-pane" id="first">
                    <div class="post">
                        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                        <thead>
                            <th>Assisted by</th>
                            <th>Particular</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php echo filldataTable();?>
                        </tbody>
                        </table>
                    </div>
                </div>





                <div class="tab-pane" id="second" >
                    
                    <table id="example2" class="table table-striped table-bordered" >
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php echo showWorkload('Mark');?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="third">
                <table id="example3" class="table table-striped table-bordered" >
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php echo showWorkload('Christian');?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="fourth">
                <table id="example4" class="table table-striped table-bordered" >
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php echo showWorkload('Charles');?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="fifth">
                <table id="example5" class="table table-striped table-bordered" >
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php echo showWorkload('Shiela');?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="six">
                <table id="example5" class="table table-striped table-bordered" >
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php echo showWorkload('Maybelline');?>
                        </tbody>
                    </table>
                </div>

            </div>
        <!-- /.tab-content -->
        </div>
    </div>
</div>
</section>
<section class="content-header">
  
   
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
            'Charles Adrian T. Odi': 'Charles Adrian T. Odi',
            'Christian Paul V.  Ferrer': 'Christian Paul V. Ferrer',
            'Shiela Mei E. Olivar':'Shiela Mei E. Olivar',
            'Maybelline Monteiro':'Maybelline Monteiro',
            },
            inputPlaceholder: 'Select ICT Staff',
            showCancelButton: true,
            inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value === 'Mark Kim A. Sacluti') {
                resolve()
                }else if(value == 'Charles Adrian T. Odi')
                {
                resolve()
                } else if(value == 'Christian Paul V. Ferrer'){
                resolve()
                } else if(value == 'Shiela Mei E. Olivar'){
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
                  swal("Service Complete!");
                  }, 3000);
                  window.location = "_editRequestTA.php?division=<?php echo $_GET['division']?>&id="+ids;
              }
            });
        });
    });
$(document).on('click','#update_complete',function(e){
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
                  option:'test'
              },
              
              success:function(data)
              {
                  setTimeout(function () {
                  swal("Service Complete!");
                  }, 3000);
                  window.location = "completeRequest.php?&division=<?php echo $_GET['division']?>&id="+ids;
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