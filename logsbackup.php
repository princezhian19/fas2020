<?php
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$u = mysqli_query($conn,"SELECT tblemployeeinfo.DIVISION_C,tblemployeeinfo.FIRST_M,tblemployeeinfo.PROFILE,tblemployeeinfo.MIDDLE_M,tblemployeeinfo.LAST_M,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M FROM tblemployeeinfo tblemployeeinfo LEFT JOIN tbldilgposition tbldilgposition on tbldilgposition.POSITION_ID = tblemployeeinfo.POSITION_C LEFT JOIN  tblpersonneldivision tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C WHERE tblemployeeinfo.UNAME = '$username' ");


$row = mysqli_fetch_array($u);
$FIRST_M1 = $row['FIRST_M'];
$FIRST_M = ucwords(strtolower($FIRST_M1));
$MIDDLE_M = $row['MIDDLE_M'];
$LAST_M1 = $row['LAST_M'];
$LAST_M = ucfirst(strtolower($LAST_M1));
$profile = $row['PROFILE'];
$DIVISION_C = $row['DIVISION_C'];
$DIVISION_M = $row['DIVISION_M'];
$POSITION_M = $row['POSITION_M'];
$words = explode(" ", $MIDDLE_M);
$acronym = "";


foreach ($words as $w) {
  $acronym .= $w[0];
}
          //asd
$name = $FIRST_M.' '.$acronym.'.'.' '.$LAST_M;


$sele = mysqli_query($conn,"SELECT ACCESSTYPE FROM tblemployeeinfo WHERE UNAME = '$username'");
$rowU = mysqli_fetch_array($sele);
$ACCESSTYPE = $rowU['ACCESSTYPE'];

$get_month = $_GET['month'];
$day = $_GET['day'];
if ($get_month != '') {
$date_now = '2020-'.$get_month.'-'.$day;
}else{
$date_now = date('Y-m-d');

}
echo $date_now;
$now_date = date('Y-m-d H:i:s');


$logs = mysqli_query($conn,"SELECT * FROM dtr WHERE UNAME = '$username' AND `date_today` LIKE '%$date_now%'");

// $logs = mysqli_query($conn,"SELECT * FROM dtr WHERE UNAME = '$username' AND `time_in` LIKE '%$date_now%' ");
$rowl = mysqli_fetch_array($logs);
$time_inL = $rowl['time_in'];
$lunch_inL = $rowl['lunch_in'];
$lunch_outL = $rowl['lunch_out'];
$time_outL = $rowl['time_out'];


date_default_timezone_set('Asia/Manila');
$time_now = (new DateTime('now'))->format('H:i');
//ito yung ireplace mo sa now()


$check1 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_in` IS NOT NULL ");
$check2 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_in` IS NOT NULL ");
$check3 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_out` IS NOT NULL ");
$check4 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_out` IS NOT NULL ");

$checkall = mysqli_query($conn,"SELECT * FROM dtr WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");


$month = date('m');
$year = date('Y');

$d1=cal_days_in_month(CAL_GREGORIAN,$month,$year);

if (isset($_POST['month'])) {
  $month = $_POST['month'];
  $day = $_POST['day'];
 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DtrMonitoring.php?month=$month&day=$day';
      </SCRIPT>");

}

if (isset($_POST['stamp1'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = '$time_now' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{

    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = '$time_now' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }
  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp2'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = '$time_now' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = '$time_now' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}


if (isset($_POST['stamp3'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = '$time_now' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = '$time_now' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp4'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = '$time_now' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }

    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = '$time_now' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}



?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border" align="left">
       <div class="pull-right">
        <?php 
        $extension = pathinfo($profile, PATHINFO_EXTENSION);
        ?>
        <img id="img"   style="overflow: hidden;width:300;height:250px;margin-left:50px;border:2px solid black;" 
        src="images/male-user.png"  title = "personnel_image" />
       </div>
       <h1>Daily Time Record</h1>
       <br>
       <font style="font-size: 20px;"><b>Office</b> : </font>&nbsp <font style="font-size: 20px;"><?php echo  $DIVISION_M?></font><br>
       <br>
       <!-- <font style="font-size: 20px;"><b>Month</b> :  -->
       <!-- </font>&nbsp <font style="font-size: 20px;"><?php echo date('F Y')?></font> -->
       <div >
      <form method="POST">
       <font style="font-size: 20px;"><b>Month</b> : 
        <select name="month" id="month" >
          <?php if ($get_month != ''): ?>
          <option value="<?php echo date('m',strtotime($this_month))?>"><?php echo date('F',strtotime($this_month))?></option>
            <?php else: ?>
          <option value="<?php echo date('m')?>"><?php echo date('F')?></option>
          <?php endif ?>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        <div hidden>
          <input type="text" name="username" id="username" value="<?php echo $username;?>">
        </div>
        <select  name="day" id="day" onchange="this.form.submit()">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        <select disabled name="year" id="year">
          <option value="2020">2020</option>
          <option value="2021">2021</option>
        </select>
      </div>
      </form>
      <br>
   

    </div>
    <div class="box-body table-responsive no-padding">
      <div class="box-body">
        <?php if ($ACCESSTYPE == 'admin'): ?>
         <a href="ViewEmployees.php?division=<?php echo $division?>&username=<?php echo $username?>" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
         <br>
         <br>
       <?php endif ?>
       <div style="float: right;padding:5px;" hidden>
        <a href="javascript:void(0);" class="btn btn-success link" data-id="<=$data['id']?>"><i class="fa fa-fw fa-download"></i>Export</a>

      </div>
      <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
        <thead>
          <tr style="background-color: white;color:blue;">
            <th width="100">UNAME</th>
            <th width="100">DATE</th>
            <th width="">AM ARRIVAL</th>
            <th width="">AM DEPARTURE</th>
            <th width="">PM ARRIVAL</th>
            <th width="">PM DEPARTURE</th>
            <th width="">UNDERTIME HOURS</th>
            <th width="">UNDERTIME MINUTES</th>
          </tr>
        </thead>
        <?php 

        $view_query = mysqli_query($conn, "SELECT CONCAT(te.FIRST_M,'',te.LAST_M) AS FNAME,dtr.id, dtr.UNAME,dtr.date_today,dtr.time_in, dtr.lunch_out,dtr.lunch_in,dtr.time_out,SUBTIME(dtr.time_out,'01:00:00') as time_out1 FROM dtr LEFT JOIN tblemployeeinfo te on te.UNAME = dtr.UNAME WHERE te.DIVISION_C = '$DIVISION_C' AND dtr.date_today LIKE '%$date_now%' ORDER BY te.LAST_M ASC");

        while ($row = mysqli_fetch_assoc($view_query)) {
          $id = $row["id"];
          $FNAME = $row["FNAME"];  
          $UNAME = $row["UNAME"];  
          $date_today = $row["date_today"];  
          $time_in = $row["time_in"];
          $lunch_in = $row["lunch_in"];
          $lunch_out= $row["lunch_out"];
          $time_out = $row["time_out"];

          $time_out1 = $row["time_out1"];

          ?>

          <tr>
            <td><?php echo $UNAME?></td>
            <td><?php 
            echo date('F d, Y',strtotime($date_today));


            ?></td>
            <td><?php 
            if ($time_in == NULL) {
              echo '&nbsp.';
            }else{
              echo date('h:i A',strtotime($time_in));
            }
            ?></td>
            <td><?php 
            if ($lunch_in == NULL) {
              echo '&nbsp.';
            }else{
              echo date('h:i A',strtotime($lunch_in));
            }
            ?></td>
            <td><?php 
            if ($lunch_out == NULL) {
              echo '&nbsp.';
            }else{
              echo date('h:i A',strtotime($lunch_out));
            }
            ?></td>
            <td><?php 
            if ($time_out == NULL) {
              echo '&nbsp.';
            }else{
              echo date('h:i A',strtotime($time_out));
            }
            ?></td>
            <td>
             <?php 
             if(date('D',strtotime($date_today)) == 'Mon'){ 
                  $lateD = date('h:i',strtotime($time_in)) < date('h:i',strtotime('08:00'));
                if($lateD){ 
                $datetime1 = new DateTime('08:00');
              }else{
                $datetime1 = new DateTime($time_in);
              }
                $datetime2 = new DateTime($time_out1);
                $datetime3 = new DateTime('16:00');
                if ($datetime2 > $datetime3) {
                  $datetime2 = new DateTime('16:00');
                }
                $finaldate = $datetime2->diff($datetime1); 
                $date333 = new DateTime("08:00");
                $date3333 = new DateTime($finaldate->format('%H'.':'.'%i'));
                $finalfinal = $date3333->diff($date333);
                if($time_out == NULL){

                 echo ''; 
               }
               else{

                echo $finalfinal->format('%H');  

              }

            }else{
              $lateD = date('H:i',strtotime($time_in)) < date('H:i',strtotime('07:00')); 
                if($lateD){
                $datetime1 = new DateTime('07:00');
              }else{
                $datetime1 = new DateTime($time_in);
              }
             $latePM = date('H:i',strtotime($time_out1)) > date('H:i',strtotime('17:00')); // pag 6 59 pbaba time ine
             if ($latePM) {
                $datetime2 = new DateTime('17:00');
             }else{
                $datetime2 = new DateTime($time_out1);

             }
           
                $finaldate = $datetime2->diff($datetime1); 
                $date333 = new DateTime("08:00"); 
                $date3333 = new DateTime($finaldate->format('%H'.':'.'%i'));
                $finalfinal = $date3333->diff($date333);


                if($time_out == NULL){

                 echo ''; 
               }
               else{
                  if ($finaldate->format('%H'.':'.'%i') > $date333->format('H:i')) {
                 echo ''; 
                }else{
                echo $finalfinal->format('%H');  
                }

              }




            }
            ?>

          </td>
          <td>
            <?php 

            
                  if($time_out == NULL){

                 echo ''; 
               }
               else{
                if ($finaldate->format('%H'.':'.'%i') > $date333->format('H:i')) {
                 echo ''; 
                }else{
                echo $finalfinal->format('%i');  
                }

              }

          ?>

        </td>

      </tr>
    <?php } ?>
  </table>
</div>
</div>
</div>
</div>




<div class="col-md-4">
  <div class="box box-success">
    <h1 class="text-center" style="color:blue;"><strong><?php echo date('F d, Y')?></strong></h1>
    <div class="text-center" style="color:red;">
      <strong><font style="font-size: 60px;" id="clock"></font><?php echo date('A')?></strong>

    </div>
  </div>
</div>

<div class="col-md-4" hidden>
  <div class="box box-success">
    <div class="box-header with-border pull-right" align="left">
      <!-- <h4><strong>Logs For Today : <?php echo date('F d, Y')?></strong></h4> -->
      <input type="checkbox" id="ck"><font style="color:blue;"><strong>PM Half-day</strong></font>
    </div>
    <div class="box-body table-responsive no-padding">
      <div class="box-body">
        <table id="example1" class="table table-striped " style="background-color: white;">
          <form method="POST">
            <tr>
              <th class="pull-left" >AM ARRIVAL</th>
              <?php if (mysqli_num_rows($check1)>0): ?>
                <td ><?php echo date('h:i A',strtotime($time_inL))?></td>


                <?php else: ?>
                  <td ><button class="btn btn-success " name="stamp1" id="" type="submit"><strong>Stamp</strong></button></td>
                <?php endif ?>
              </tr>
              <tr>
                <th class="pull-left" >AM DEPARTURE</th>
                <?php if (mysqli_num_rows($check2)>0): ?>
                  <td ><?php echo date('h:i A',strtotime($lunch_inL))?></td>
                  <?php else: ?>
                      <td ><button class="btn btn-success " name="stamp2" id="" type="submit"><strong>Stamp</strong></button></td>
                    <?php endif ?>
                  </tr>
                  <tr>
                    <th class="pull-left">PM ARRIVAL</th>
                    <?php if (mysqli_num_rows($check3)>0): ?>
                      <td ><?php echo date('h:i A',strtotime($lunch_outL))?></td>
                      <?php else: ?>
                        <td ><button  class="btn btn-success" name="stamp3" type="submit"><strong>Stamp</strong></button></td>
                      <?php endif ?>
                    </tr>

                    <tr>
                      <th class="pull-left" >PM DEPARTURE</th>
                      <?php if (mysqli_num_rows($check4)>0): ?>
                        <td ><?php echo date('h:i A',strtotime($time_outL))?></td>
                        <?php else: ?>
                          <td ><button class="btn btn-success" name="stamp4" type="submit"><strong>Stamp</strong></button></td>
                        <?php endif ?>
                      </tr>
                    </form>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
      <script>
        $(document).ready(function(){

          $('.link').click(function(){

            var f = $(this);
            var id = f.data('id');

            var month = $('#month').val();
            var year = $('#year').val();
            var username = $('#username').val();
            window.location = 
            'export_dtr.php?month='+month+'&year='+year+'&username='+username;
          });
        }) ;
      </script>
<script>
    $(document).ready(function(){
        $("#ck").click(function(){
            if($(this).prop("checked") == true){
                $('#s3').prop("disabled", false);
                $('#s2').prop("disabled", false);
            }
            else if($(this).prop("checked") == false){
                $('#s3').prop("disabled", true);
                $('#s2').prop("disabled", true);
            }
        });
    });
</script>
<script type="text/javascript">
        setInterval(displayclock, 1000);
        function displayclock(){
          var time = new Date();
          var hrs = time.getHours();
          var min = time.getMinutes();
          var sec = time.getSeconds();

          if (hrs > 12){
            hrs = hrs - 12;
          }

          if (hrs == 0) {
            hrs = 12;
          }
          if (min < 10) {
            min = '0' + min;
          }

          if (hrs < 10) {
            hrs = '0' + hrs;
          }

          if (sec < 10) {
            sec = '0' + sec;
          }

          document.getElementById('clock').innerHTML = hrs + ':' + min + ':' +sec;
        }
      </script>