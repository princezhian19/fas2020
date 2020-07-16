<?php
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
$location = $details->city;

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $posted_by = $_POST['posted_by'];
  $date = $_POST['date'];

  $get_dv = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$posted_by'");
  $rowdv = mysqli_fetch_array($get_dv);
  $rDIVISION_C = $rowdv['DIVISION_C'];

  $div = mysqli_query($conn,"SELECT DIVISION_M FROM tblpersonneldivision WHERE DIVISION_N = '$rDIVISION_C'");
  $rowdiv = mysqli_fetch_array($div);
  $rDIVISION_M = $rowdiv['DIVISION_M']; 


  $insert = mysqli_query($conn,"INSERT INTO announcementt(posted_by, division, title, content, date) VALUES('$posted_by','$rDIVISION_M','$title','$content','$date')");
  if ($insert) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'home.php?division=$division';
    </SCRIPT>");
 }

}

if (isset($_POST['update'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $posted_by = $_POST['posted_by'];
  $date = $_POST['date'];
  $idC = $_POST['idC'];

  $update = mysqli_query($conn,"UPDATE announcementt SET title = '$title' , content = '$content' WHERE id = $idC ");
  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Updated!')
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }

}

?>

<?php
$date_now = date('Y-m-d');
$now_date = date('Y-m-d H:i:s');
$logs = mysqli_query($conn,"SELECT * FROM dtr WHERE UNAME = '$username' AND `date_today` LIKE '%$date_now%'");
$rowl = mysqli_fetch_array($logs);
$time_inL = $rowl['time_in'];
$lunch_inL = $rowl['lunch_in'];
$lunch_outL = $rowl['lunch_out'];
$time_outL = $rowl['time_out'];
$t1 = $rowl['t1'];
$l1 = $rowl['l1'];
$l2 = $rowl['l2'];
$t2 = $rowl['t2'];
$t_o = $rowl['t_o'];
$o_b = $rowl['o_b'];
date_default_timezone_set('Asia/Manila');
$time_now = (new DateTime('now'))->format('H:i');
$newtime = date('Y-m-d H:i:s');

$check1 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_in` IS NOT NULL ");
$check2 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_in` IS NOT NULL ");
$check3 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_out` IS NOT NULL ");
$check4 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_out` IS NOT NULL ");
$checkall = mysqli_query($conn,"SELECT * FROM dtr WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
$month = date('m');
$year = date('Y');
$d1=cal_days_in_month(CAL_GREGORIAN,$month,$year);

if (isset($_POST['ob_to'])) {
  $t_o = $_POST['t_o'];
  $o_b = $_POST['o_b'];
  $remarksOBTO = $_POST['remarksOBTO'];
  $remarksOBTO1 = $_POST['remarksOBTO1'];
  if (!empty($t_o)) {
    $insert = mysqli_query($conn,"UPDATE dtr SET t_o = '$remarksOBTO1' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");

  }
  if (!empty($o_b)) {
    $insert = mysqli_query($conn,"UPDATE dtr SET o_b = '$remarksOBTO' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }
 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
}

if (isset($_POST['stamp1'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = '$time_now',t1 = '$location' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{

    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = '$time_now',t1 = '$location' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }
  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp2'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = '$time_now',l1 = '$location' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = '$time_now',l1 = '$location' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp3'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = '$time_now',l2 = '$location' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = '$time_now',l2 = '$location' WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp4'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = '$time_now',t2 = '$location' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }

    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = '$time_now',t2 = '$location' WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'home.php?division=$division';
      </SCRIPT>");
  }
}



?>

<div class="row">
  <div class="col-md-3">

    <div class="box">
      <div class="panel-heading bg-blue">
        <table class="">
          <tr>
            <td class="col-md-0">
              <img class="direct-chat-img" src="images/male-user.png" alt="message user image">    
            </td>
            <td class="col-md-12" >
             <div style="overflow-x:auto;"> 
              <h5>PHILIPPINES STANDARD TIME</h5>
            </div> 
          </td>
          <td class="col-md-0">
            <img class="direct-chat-img" src="images/ph.png" alt="message user image">
          </td>

        </tr>
      </table>
      <!-- <div class="clearfix"></div> -->
    </div>
    <div class="text-center">
     <p><strong><h1 style="color:red;"><font  id="clock">--:--:--</font> <?php echo date('A')?></h1></strong></p>
   </div>
   <div class="text-center"><?php echo date('F d, Y D')?></div>
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

</div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
  <?php 
  $select_event1 = mysqli_query($conn,"SELECT e.id,e.start,e.end,e.title,e.venue,tp.DIVISION_M FROM events e LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = e.office ORDER BY e.id DESC LIMIT 1");
  $rowE1 = mysqli_fetch_array($select_event1);
  $id = $rowE1['id'];
  $start = $rowE1['start'];
  $start = $rowE1['start'];
  $end = $rowE1['end'];
  $title = $rowE1['title'];
  $venue = $rowE1['venue'];
  $DIVISION_M = $rowE1['DIVISION_M'];
  ?>
  <div class="info-box bg-aqua">
    <span class="info-box-icon info-box-text"><?php echo '<h3>'.date('M',strtotime($start)).'<br>'.date('d',strtotime($start)).'</h3>';?></span>
    <div class="info-box-content">


      <span class="info-box-number"><?php $string = substr($title,0,10).'...'; echo $string;?> </span>

      <span class="info-box-number"></span>

      <div class="progress">
      </div>
      <span class="progress-description">
        <b>Venue : </b> <?php echo $venue?>
      </span>
      <b>Office : </b> <?php echo $DIVISION_M?>


    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- 2nd -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <?php 
  $select_event1 = mysqli_query($conn,"SELECT e.id,e.start,e.end,e.title,e.venue,tp.DIVISION_M FROM events e LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = e.office WHERE e.id != $id ORDER BY e.id DESC LIMIT 1");
  $rowE1 = mysqli_fetch_array($select_event1);
  $id2 = $rowE1['id'];
  $start = $rowE1['start'];
  $start = $rowE1['start'];
  $end = $rowE1['end'];
  $title = $rowE1['title'];
  $venue = $rowE1['venue'];
  $DIVISION_M = $rowE1['DIVISION_M'];
  ?>
  <div class="info-box bg-aqua">
    <span class="info-box-icon info-box-text "><?php echo '<h3>'.date('M',strtotime($start)).'<br>'.date('d',strtotime($start)).'</h3>';?></span>
    <div class="info-box-content">


      <span class="info-box-number"><?php $string = substr($title,0,10).'...'; echo $string;?> </span>

      <span class="info-box-number"></span>

      <div class="progress">
      </div>
      <span class="progress-description">
        <b>Venue : </b> <?php echo $venue?>
      </span>
      <b>Office : </b> <?php echo $DIVISION_M?>


    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- 3rd -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <?php 
  $select_event1 = mysqli_query($conn,"SELECT e.id,e.start,e.end,e.title,e.venue,tp.DIVISION_M FROM events e LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = e.office WHERE e.id != $id and e.id != $id2 ORDER BY e.id DESC LIMIT 1");
  $rowE1 = mysqli_fetch_array($select_event1);
  $id = $rowE1['id'];
  $start = $rowE1['start'];
  $start = $rowE1['start'];
  $end = $rowE1['end'];
  $title = $rowE1['title'];
  $venue = $rowE1['venue'];
  $DIVISION_M = $rowE1['DIVISION_M'];
  ?>
  <div class="info-box bg-aqua">
    <span class="info-box-icon info-box-text"><?php echo '<h3>'.date('M',strtotime($start)).'<br>'.date('d',strtotime($start)).'</h3>';?></span>
    <div class="info-box-content">


      <span class="info-box-number"><?php $string = substr($title,0,10).'...'; echo $string;?> </span>
      <span class="info-box-number"></span>

      <div class="progress">
      </div>
      <span class="progress-description">
        <b>Venue : </b> <?php echo $venue?>
      </span>
      <b>Office : </b> <?php echo $DIVISION_M?>


    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="box" >
      <div class="panel-heading">
        <strong><a href="DTR.php">ONLINE DTR</a></strong>
        <?php if ($username == 'charlesodi' || $username = 'mmmonteiro'): ?>
          
        <?php if ($t_o != NULL || $o_b != NULL): ?>

          <?php else: ?>
        &nbsp &nbsp &nbsp   <input type="checkbox" value="t_o" name="to" id="to" onclick='javascript:yesnoCheck();'> <strong>TO</strong>
        &nbsp &nbsp &nbsp   <input type="checkbox" value="o_b" name="ob" id="ob" onclick='javascript:yesnoCheck1();'> <strong>OB</strong>
        <?php endif ?>
        <?php else: ?>
        <?php endif ?>

        <div class="pull-right">
          <input type="checkbox" id="ck"><font style="color:blue;"><strong>PM Half-day</strong></font>
        </div>
      </div>
      <div class="">
        <?php if ($t_o != NULL): ?>
           <label> &nbsp&nbspRemarks (Travel Order)</label>
            <textarea class="form-control"><?php echo $t_o?></textarea>
        <?php endif ?>
        <?php if ($o_b != NULL): ?>
           <label> &nbsp&nbspRemarks (Official Business)</label>
            <textarea class="form-control"><?php echo $o_b?></textarea>
        <?php endif ?>
        <form method="POST">
          <div class="H2" hidden>
            <label> &nbsp&nbspRemarks</label>
            <textarea class="form-control" name="remarksOBTO1"></textarea>
            <br>
            <input type="text" name="t_o" id="t_o" value="t_o" hidden disabled>
            <button class="btn btn-primary" type="submit" name="ob_to" style="float: right;">Submit</button>
            <br><br><br>
          </div>
          <div class="H22" hidden>
            <label> &nbsp&nbspRemarks</label>
            <textarea class="form-control" name="remarksOBTO"></textarea>
            <br>
            <input type="text" name="o_b" id="o_b" value="o_b" hidden disabled>
            <button class="btn btn-primary" type="submit" name="ob_to" style="float: right;">Submit</button>
            <br><br><br>
          </div>
        </form>
        <?php if ($t_o != NULL || $o_b !=NULL): ?>
          
          <?php else: ?>

        <table id="example1" class="table table-striped H1" style="background-color: white;" >
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
                  <td ><?php echo date('h:i A',strtotime($lunch_inL))?>
                  <!-- <?php echo "<br>" ?> -->
                  <!-- <?php echo $l1 ?> -->
                </td>
                <?php else: ?>
                  <td ><button class="btn btn-success " name="stamp2" id="" type="submit"><strong>Stamp</strong></button></td>
                <?php endif ?>
              </tr>
              <tr>
                <th class="pull-left">PM ARRIVAL</th>
                <?php if (mysqli_num_rows($check3)>0): ?>
                  <td ><?php echo date('h:i A',strtotime($lunch_outL))?>
                  <!-- <?php echo "<br>" ?> -->
                  <!-- <?php echo $l2 ?> -->
                </td>
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
        <?php endif ?>
          </div>
        </div>
        <div class="col-lg-12">
        <button class = "btn btn-danger btn-lg btndisable" style = "width:100%;" id = "healthDec" value ="Don't forget to Accomplish the <br>ONLINE HEALTH DECLARATION FORM here">Don't forget to Accomplish the <br>ONLINE HEALTH DECLARATION FORM here.</button>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="row" >
          <div class="col-md-12" >
            <div class="box"  style="width: 530px;padding-right: 10px;padding-left: 10px;border-left: 5px solid black;">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-5">

                    <div style="padding-left: 10px;padding-right: 10px;">
                      <strong style="font-size: 25px;" >Regular</strong>
                      <strong style="font-size: 25px;" class="pull-right">COS</strong>
                    </div>
                    <br>
                    <?php 
                    $select_gender = mysqli_query($conn,"SELECT count(*) as female FROM tblemployeeinfo WHERE SEX_C = 'Female' AND ACTIVATED = 'Yes' ");
                    $rowG = mysqli_fetch_array($select_gender);
                    $female = $rowG['female'];

                    $select_genderB = mysqli_query($conn,"SELECT count(*) as male FROM tblemployeeinfo WHERE SEX_C = 'Male' AND ACTIVATED = 'Yes' ");
                    $rowGB = mysqli_fetch_array($select_genderB);
                    $male = $rowGB['male'];

                    $reg = $female + $male;

                    $select_gender2 = mysqli_query($conn,"SELECT count(*) as female FROM tblemployeeinfo WHERE SEX_C = 'Female' AND ACTIVATED = 'No' ");
                    $rowG2 = mysqli_fetch_array($select_gender2);
                    $female2 = $rowG2['female'];

                    $select_genderB2 = mysqli_query($conn,"SELECT count(*) as male FROM tblemployeeinfo WHERE SEX_C = 'Male' AND ACTIVATED = 'No' ");
                    $rowGB2 = mysqli_fetch_array($select_genderB2);
                    $male2 = $rowGB2['male'];

                    $reg2 = $female2 + $male2;
                    ?>
                    <div style="font-size: 25px;">
                      <i class="fa fa-fw fa-female"><?php echo $female?></i>
                      <i class="fa fa-fw fa-female" style="float: right;padding-right: 70px;"><?php echo $female2?></i><br>
                      <i class="fa fa-fw fa-male"><?php echo $male?></i>
                      <i class="fa fa-fw fa-male" style="float: right;padding-right: 70px;"><?php echo $male2?></i><br><br>
                      <i class="fa fa-fw fa-group"><?php echo $reg;?></i>
                      <i class="fa fa-fw fa-group" style="float: right;padding-right: 70px;"><?php echo $reg2;?></i><br>
                      <!-- /.chart-responsive -->
                    </div>
                  </div>
                  <!-- /.col -->
                  <?php 
                  $count_region = mysqli_query($conn,"SELECT count(*) as region FROM tblemployeeinfo WHERE OFFICE_STATION = 1");
                  $cregion = mysqli_fetch_array($count_region);
                  $region = $cregion['region'];
                  ?>
                  <?php 
                  $count_batangas = mysqli_query($conn,"SELECT count(*) as batangas FROM tblemployeeinfo WHERE DIVISION_C IN (19,28,29,30,44)");
                  $cbatangas = mysqli_fetch_array($count_batangas);
                  $batangas = $cbatangas['batangas'];
                  ?>
                  <?php 
                  $count_cavite = mysqli_query($conn,"SELECT count(*) as cavite FROM tblemployeeinfo WHERE DIVISION_C IN (20,34,35,36,45)");
                  $ccavite = mysqli_fetch_array($count_cavite);
                  $cavite = $ccavite['cavite'];
                  ?>
                  <?php 
                  $count_laguna = mysqli_query($conn,"SELECT count(*) as laguna FROM tblemployeeinfo WHERE DIVISION_C IN (21,40,41,42,47,51,52)");
                  $claguna = mysqli_fetch_array($count_laguna);
                  $laguna = $claguna['laguna'];
                  ?> 
                  <?php 
                  $count_rizal = mysqli_query($conn,"SELECT count(*) as rizal FROM tblemployeeinfo WHERE DIVISION_C IN (23,37,38,39,46,50,52)");
                  $crizal = mysqli_fetch_array($count_rizal);
                  $rizal = $crizal['rizal'];
                  ?> 
                  <?php 
                  $count_quezon = mysqli_query($conn,"SELECT count(*) as quezon FROM tblemployeeinfo WHERE DIVISION_C IN (22,31,32,33,48,49,53)");
                  $cquezon = mysqli_fetch_array($count_quezon);
                  $quezon = $cquezon['quezon'];
                  ?> 
                  <?php 
                  $count_lucena = mysqli_query($conn,"SELECT count(*) as lucena FROM tblemployeeinfo WHERE DIVISION_C IN (24)");
                  $clucena = mysqli_fetch_array($count_lucena);
                  $lucena = $clucena['lucena'];
                  ?> 
                  <?php  
                  $tots = $region + $batangas + $cavite + $laguna + $rizal + $quezon + $lucena;
                  $region_percent = ($region*100)/$tots;
                  $batangas_percent = ($batangas*100)/$tots;
                  $cavite_percent = ($cavite*100)/$tots;
                  $laguna_percent = ($laguna*100)/$tots;
                  $rizal_percent = ($rizal*100)/$tots;
                  $quezon_percent = ($quezon*100)/$tots;
                  $lucena_percent = ($lucena*100)/$tots;

                  ?>
                  <div class="col-md-7">
                   <div class="progress-group">
                    <span class="progress-text">Region</span>
                    <?php 
                    $count_region = mysqli_query($conn,"SELECT count(*) as region FROM tblemployeeinfo WHERE OFFICE_STATION = 1");
                    $cregion = mysqli_fetch_array($count_region);
                    $region = $cregion['region'];
                    ?>
                    <span class="progress-number"><b><?php echo $region?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $region_percent?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Batangas</span>
                    <?php 
                    $count_batangas = mysqli_query($conn,"SELECT count(*) as batangas FROM tblemployeeinfo WHERE DIVISION_C IN (19,28,29,30,44)");
                    $cbatangas = mysqli_fetch_array($count_batangas);
                    $batangas = $cbatangas['batangas'];
                    ?>
                    <span class="progress-number"><b><?php echo $batangas?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $batangas_percent?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Cavite</span>
                    <?php 
                    $count_cavite = mysqli_query($conn,"SELECT count(*) as cavite FROM tblemployeeinfo WHERE DIVISION_C IN (20,34,35,36,45)");
                    $ccavite = mysqli_fetch_array($count_cavite);
                    $cavite = $ccavite['cavite'];
                    ?>
                    <span class="progress-number"><b><?php echo $cavite?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $cavite_percent?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Laguna</span>
                    <?php 
                    $count_laguna = mysqli_query($conn,"SELECT count(*) as laguna FROM tblemployeeinfo WHERE DIVISION_C IN (21,40,41,42,47,51,52)");
                    $claguna = mysqli_fetch_array($count_laguna);
                    $laguna = $claguna['laguna'];
                    ?>                
                    <span class="progress-number"><b><?php echo $laguna?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $laguna_percent?>%"></div>
                    </div>
                  </div> 
                  <div class="progress-group">
                    <span class="progress-text">Rizal</span>
                    <?php 
                    $count_rizal = mysqli_query($conn,"SELECT count(*) as rizal FROM tblemployeeinfo WHERE DIVISION_C IN (23,37,38,39,46,50,52)");
                    $crizal = mysqli_fetch_array($count_rizal);
                    $rizal = $crizal['rizal'];
                    ?> 
                    <span class="progress-number"><b><?php echo $rizal?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $rizal_percent?>%"></div>
                    </div>
                  </div> 
                  <div class="progress-group">
                    <span class="progress-text">Quezon</span>
                    <?php 
                    $count_quezon = mysqli_query($conn,"SELECT count(*) as quezon FROM tblemployeeinfo WHERE DIVISION_C IN (22,31,32,33,48,49,53)");
                    $cquezon = mysqli_fetch_array($count_quezon);
                    $quezon = $cquezon['quezon'];
                    ?> 
                    <span class="progress-number"><b><?php echo $quezon?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $quezon_percent?>%"></div>
                    </div>
                  </div> 
                  <div class="progress-group">
                    <span class="progress-text">Lucena City</span>
                    <?php 
                    $count_lucena = mysqli_query($conn,"SELECT count(*) as lucena FROM tblemployeeinfo WHERE DIVISION_C IN (24)");
                    $clucena = mysqli_fetch_array($count_lucena);
                    $lucena = $clucena['lucena'];
                    ?> 
                    <span class="progress-number"><b><?php echo $lucena?></b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $lucena_percent?>%"></div>
                    </div>

                    <!-- <?php echo $region + $batangas + $cavite + $laguna + $rizal + $quezon + $lucena?> -->
                  </div> 
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="box" style="width: 400px;">
        <div class="panel-heading">
          <h3><strong>Quick Links</strong></h3>
          <div class="box-header with-border">
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="box-header">
          <img class="direct-chat-img" src="images/LOGO.png" alt="message user image">
          <b><a href="">&nbsp&nbsp&nbspDILG Official Website</a></b> <br>
          <font class="pull-left">&nbsp&nbsp&nbspVisit the official website of Department of Interior...</font>
          <br>
          <br>
          <br>
          <img class="direct-chat-img" src="images/cbms.png" alt="message user image">
          <b><a href="">&nbsp&nbsp&nbspCBMS Portal</a> </b> <br>
          <font class="pull-left">&nbsp&nbsp&nbspCBMS portal is an organized of collecting...</font>
          <br>
          <br>
          <br>




        </div>
      </div>

    </div>
    <div class="col-md-9">

      <div class="row"> 
        <div class="col-md-4" style="color:white;">

          <div class="box" style="background-image: url('images/purple.jpg');border-radius: 20px;">
           <div class="panel-heading">
            <i class="fa fa-birthday-cake"></i>&nbsp&nbsp&nbsp<strong>Birthday Celebrants</strong>
            <a href="" class="pull-right">View All</a>
            <div class="box-header with-border">
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="box-header" style="color:white;">
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $BDAY = mysqli_query($conn,"SELECT FIRST_M,MIDDLE_M,LAST_M,BIRTH_D,PROFILE FROM tblemployeeinfo WHERE MONTH(BIRTH_D) =MONTH(NOW()) LIMIT 5");
            while ($row = mysqli_fetch_assoc($BDAY)) {
              $FIRST_M1 = $row['FIRST_M'];
              $FIRST_M = ucwords(strtolower($FIRST_M1));
              $MIDDLE_M = $row['MIDDLE_M'];
              $LAST_M1 = $row['LAST_M'];
              $LAST_M = ucfirst(strtolower($LAST_M1));
              $words = explode(" ", $MIDDLE_M);
              $acronym = "";

              foreach ($words as $w) {
                $acronym .= $w[0];
              }
          //asd
              $name = $FIRST_M.' '.$acronym.'.'.' '.$LAST_M;
              $BIRTH_D = $row['BIRTH_D'];
              $PROFILE = $row['PROFILE'];
              $b_day = date('F d',strtotime($BIRTH_D));

              ?>  
              <img class="direct-chat-img" src="<?php echo $PROFILE; ?>" alt="message user image">
              <b style="font-size: 13px;"><?php echo $name;?></b>
              <font style="font-size: 10px;" class="pull-right"><?php echo $b_day?></font>
              <br>
              <br>
              <br>


            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-4" >
        <div class="row">
          <div class="col-md-12">
            <div class="box" >
              <div class="panel-heading" style="background-color:#964B00;">
               <font style="color:white;"> ANNOUNCEMENT </font> <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-warning btn-xs pull-right">Add</button><!-- Item(s) -->
               <form method="POST">
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Default Modal</h4>
                        </div>
                        <div class="modal-body">
                          <label style="padding-right: 20px;">Title <font style="color:red;">*</font>&nbsp&nbsp<i><font style="color:red;">should not exceed 50 characters</i></font></label><input maxlength="50"  required class="form-control" type="text" name="title"><br>
                          <label style="padding-right: 20px;">Content <font style="color:red;">*</font>&nbsp&nbsp<i><font style="color:red;">should not exceed 500 characters</font></i></label><textarea maxlength="500" required class="form-control" type="text" name="content"></textarea><br>
                          <label style="padding-right: 20px;">Posted By</label><input readonly class="form-control" type="text" name="posted_by" value="<?php echo $username?>"><br>
                          <label style="padding-right: 20px;">Posted Date</label><input readonly class="form-control" type="text" name="date" value="<?php echo date('Y-m-d')?>"><br>
                        </div>
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                          <button type="submit" class="btn btn-primary" name="submit">Save</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </form>
              </div>
              <div style="padding-left: 10px;padding-right: 10px;background:#ee5;" class="table-responsive">

               <table id="example15" class="table " style="background-color:#ee5;" >
                <thead >
                  <tr style="background-color:#ee5;" >
                    <th style="background-color:#ee5;"hidden></th>
                  </tr>
                </thead>
                <?php 
                $view_query = mysqli_query($conn,"SELECT te.PROFILE,a.date,a.id,a.posted_by,a.content,a.title,concat(te.FIRST_M,' ',te.MIDDLE_M,' ',te.LAST_M) as fname  FROM announcementt a LEFT JOIN tblemployeeinfo te on te.UNAME = a.posted_by  ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $fname = $row["fname"];  
                  $posted_by = $row["posted_by"];  
                  $intent = $row["content"];  
                  $title = $row["title"];  
                  $profile = $row["PROFILE"];  
                  $date1 = $row["date"];  
                  $date = date('Y-m-d',strtotime($date1));  
                  $extension = pathinfo($profile, PATHINFO_EXTENSION);
                  ?>
                  <tr>
                    <td width="300"><img class="direct-chat-img" src="
                      <?php 
                      if(file_exists($profile))
                      {
                        switch($extension)
                        {
                          case 'jpg':
                          if($profile == '')
                          {
                            echo 'images/male-user.png';
                          }
                          else if ($profile == $profile)
                          {
                            echo $profile;   
                          }
                          else
                          {
                            echo'images/male-user.png';
                          }
                          break;
                          case 'JPG':
                          if($profile == '')
                          {
                            echo 'images/male-user.png';
                          }
                          else if ($profile == $profile)
                          {
                            echo $profile;   
                          }
                          else
                          {
                            echo'images/male-user.png';
                          }
                          break;
                          case 'jpeg':
                          if($profile == '')
                          {
                            echo 'images/male-user.png';
                          }
                          else if ($profile == $profile)
                          {
                            echo $profile;   
                          }
                          else
                          {
                            echo'images/male-user.png';
                          }
                          break;
                          case 'png':
                          if($profile == '')
                          {
                            echo'images/male-user.png';
                          }
                          else if ($profile == $profile)
                          {
                            echo $profile;   
                          }
                          else
                          {
                            echo'images/male-user.png';
                          }
                          break;
                          default:
                          echo'images/male-user.png';
                          break;
                        }
                        }else{
                         echo'images/male-user.png';
                       }

                       ?>"  alt="message user image"><b style="font-size: 10px;"><?php echo $fname;?></b><br><font style="font-size: 10px;"><?php echo 'FAD';?></font><br><br><b><?php echo $title;?><br>
                        <?php if ($username == $posted_by): ?>
                          <a data-toggle="modal" data-target="#modal-info_<?php echo $row['id']; ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a> | <a href="delete_announcement.php?id=<?php echo $id?>&username=<?php echo $username?>" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> Delete</a>
                        <?php endif ?>
                      </b><br><?php echo $intent;?></td>
                    </tr>

                    <div class="modal modal-default fade" id="modal-info_<?php echo $row['id']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Edit Announcement</h4>
                            </div>
                            <div class="modal-body">
                              <form method="POST" >
                               <label style="padding-right: 20px;">Title <font style="color:red;">*</font></font>&nbsp&nbsp<i><font style="color:red;">should not exceed 50 characters</i></font></label><input value="<?php echo $title?>" class="form-control" type="text" name="title"><br>
                               <input type="text" name="idC" hidden  value="<?php echo $id?>">
                               <label style="padding-right: 20px;">Content <font style="color:red;">*</font>&nbsp&nbsp<i><font style="color:red;">should not exceed 500 characters</font></i></label><textarea  class="form-control" type="text" name="content"><?php echo $intent?></textarea><br>
                               <label style="padding-right: 20px;">Posted By</label><input readonly class="form-control" type="text" name="posted_by" value="<?php echo $posted_by?>"><br>
                               <label style="padding-right: 20px;">Posted Date</label><input readonly class="form-control" type="text" name="date" value="<?php echo $date?>"><br>
                             </div>
                             <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                              <button type="submit" class="btn btn-primary" name="update">Save changes</button>
                            </div>
                          </div>
                        </form>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  <?php } ?>
                </table>

             <!-- <img class="direct-chat-img" src="images/LOGO.png" alt="message user image"><a href="">Charles Adrian T. Odi</a>
             <p></p>

             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
             </p> -->

           </div>
         </div>
       </div>                  
     </div>
     <div class="row">
      <div class="col-md-12">
        <div class="box" >
          <div class="panel-heading" style="background-color: #013220;">
           <font style="color:white;"> ISSUANCES </font><!-- Item(s) -->
           <div class="clearfix"></div>
         </div>
         <div style="padding-left: 10px;padding-right: 10px;">
          <?php 
          $get_issuances = mysqli_query($conn,"SELECT id,issuance_no,subject FROM issuances ORDER BY id DESC LIMIT 3");
          while ($rowI = mysqli_fetch_array($get_issuances)) {
            $idI = $rowI['id'];
            $issuance_no = $rowI['issuance_no'];
            $subject = $rowI['subject'];
            ?>
            <b><a href="ViewIssuances.php?id=<?php echo $idI;?>"><?php echo $issuance_no;?></a></b>
            <p><?php echo $subject;?></p>
            <hr>
          <?php } ?>
        </div>
      </div>
    </div>   
  </div>
</div>

<div class="col-md-4">
  <div class="row">
    <div class="col-md-12 table-responsive">
      <div class="box">
        <div class="panel-heading bg-blue">
          Procurement <!-- Item(s) -->
          <a  class="pull-right btn btn-success btn-xs" href="MonitoringPr.php">View All</a>
          <div class="clearfix"></div>
        </div>
        <table id="" class="table table-striped table-bordered" style="width:;background-color: white;">
          <thead>
            <tr style="background-color: white;color:blue;">
              <th>PR NO</th>
              <th width="300">PURPOSE</th>
              <th>RFQ NO</th>
            </tr>
          </thead>
          <?php
          $user_id = ""; 
          $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $username = $_SESSION['username'];

                // echo "SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'";
          $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
          $rowdiv = mysqli_fetch_array($select_user);
          $DIVISION_C = $rowdiv['DIVISION_C'];


          if ($DIVISION_C == '10' || $DIVISION_C == '11' || $DIVISION_C == '12' || $DIVISION_C == '13' || $DIVISION_C == '14' || $DIVISION_C == '15' || $DIVISION_C == '16' ) {

            $user_id = 'FAD';


          }else if($DIVISION_C == '3' || $DIVISION_C == '5'){

            $user_id = 'ORD';

          }else if($DIVISION_C == '17'){

            $user_id = 'LGCDD';

          }
          else if($DIVISION_C == '9'){

            $user_id = 'LGMED-PDMU';

          }
          else if($DIVISION_C == '7'){

            $user_id = 'LGCDD-MBTRG';

          }
          else if($DIVISION_C == '18'){

            $user_id = 'LGMED';

          }
          $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $view_query = mysqli_query($conn,"SELECT * FROM pr where pmo='$user_id' order by id desc LIMIT 3  ");

          while ($row = mysqli_fetch_assoc($view_query)) {
            $id = $row["id"];
            $pr_no = $row["pr_no"];
            $pr_date = $row["pr_date"];

            $pr_date11 = date('F d, Y', strtotime($pr_date));
            $pmo = $row["pmo"];
            $purpose = $row["purpose"];

            $target_date = $row["target_date"];
            $target_date11 = date('F d, Y', strtotime($target_date));


            ?>
            <tr>
             <td><a href="ViewPRv.php?id=<?php echo $id ?>"><?php echo $pr_no;?></a></td>
             <td><?php echo $purpose;?></td>
             <td><?php 

             $RFQ = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
             $rowID = mysqli_fetch_array($RFQ);
             $rfq_id = $rowID['id'];
             $rfq_no = $rowID['rfq_no'];
             $rfq_date = $rowID['rfq_date'];
             $rfq_date11 = date('F d, Y', strtotime($rfq_date));
             if (mysqli_num_rows($RFQ)>0) {
              echo "<p style='color:green'><b>$rfq_no</b></p>";
            }else{ 
              echo " ";
            }
            ?></td>

          </tr>
        <?php } ?>
      </table>
    </div>
  </div>                  
</div>                  
<div class="row">
  <div class="col-md-12">
    <div class="box table-responsive" >
      <div class="panel-heading bg-blue">
        Obligation <!-- Item(s) -->
        <a href="MonitoringOrs.php" class="pull-right btn btn-success btn-xs">View All </a>
        <div class="clearfix"></div>
      </div>
      <table id="" class="table table-striped table-bordered" style="width:;background-color: white;">
        <thead>
          <tr style="background-color: white;color:blue;">

            <th width="50">ORS NUMBER</th>
            <th width="50">PARTICULAR</th>
            <th width="50">STATUS</th>
          </tr>
        </thead>
        <?php
        $view_query = mysqli_query($conn, "SELECT * FROM saroob where status = 'Obligated' order by date desc LIMIT 3");
        while ($row = mysqli_fetch_assoc($view_query)) {
          $id = $row["id"];  

          $datereceived = $row["datereceived"];
          if ($datereceived == '0000-00-00') {
            $datereceived11 = '';
          }else{
            $datereceived11 = date('F d, Y', strtotime($datereceived));
          }

          $datereprocessed = $row["datereprocessed"];
          if ($datereprocessed == '0000-00-00') {
            $datereprocessed11 = '';
          }else{
            $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

          }
          $datereleased = $row["datereleased"];
          if ($datereleased == '0000-00-00') {
            $datereleased11 = '';
          }else{
            $datereleased11 = date('F d, Y', strtotime($datereleased));
          }
          $ors = $row["ors"];
          $ponum = $row["ponum"];
          $payee = $row["payee"];
          $particular = $row["particular"];
          $saronumber = $row["saronumber"];
          $ppa = $row["ppa"];
          $uacs = $row["uacs"];
          $amount1 = $row["amount"];
          $amount = number_format( $amount1,2);
          $date = $row["date"];
          $remarks = $row["remarks"];
          $sarogroup = $row["sarogroup"];
          $status = $row["status"];
          ?>
          <tr>
           <td><?php echo $ors;?></td>
           <td><?php echo $particular;?></td>
           <?php if ($status =='Pending'): ?>
            <td style='background-color:red'><b>Pending</b></td>
            <?php else: ?>
              <?php if ($status == 'Obligated'): ?>
                <td style='background-color:green'><b>Obligated</b></td>
                <?php else: ?>
                  <td></td>
                <?php endif ?>
              <?php endif ?>
            </tr> 
          <?php } ?>
        </table>     
      </div>   
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box table-responsive" >
       <div class="panel-heading bg-blue">
        Disbursement <!-- Item(s) -->
        <a href="MonitoringDv.php" class="pull-right btn btn-success btn-xs">View All </a>
        <div class="clearfix"></div>
      </div>
      <table id="" class="table table-striped table-bordered" style="background-color: white;">
        <thead>
          <tr style="background-color: white; color:blue;">
            <th width="200">DV NO</th>
            <th width="500">PARTICULAR</th>
            <th width="200">STATUS</th>
          </tr>
        </thead>
        <?php
        $view_query = mysqli_query($conn, "SELECT * FROM disbursement where status = 'Disbursed' order by datereleased desc LIMIT 3");
        while ($row = mysqli_fetch_assoc($view_query)) {
          $id = $row["id"];  
          $datereceived = $row["datereceived"];
          if ($datereceived == '0000-00-00') {
            $datereceived11 = '';
          }else{
            $datereceived11 = date('F d, Y', strtotime($datereceived));
          }
          $datereprocessed = $row["date_proccess"];
          if ($datereprocessed == '0000-00-00') {
            $datereprocessed11 = '';
          }else{
            $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));
          }
          $datereturned = $row["datereturned"];
          if ($datereturned == '0000-00-00') {
            $datereturned11 = '';
          }else{
            $datereturned11 = date('F d, Y', strtotime($datereturned));
          }
          $datereleased = $row["datereleased"];
          if ($datereleased == '0000-00-00') {
            $datereleased11 = '';
          }else{
            $datereleased11 = date('F d, Y', strtotime($datereleased));
          }
          $dv = $row["dv"];
          $ponum = $row["ponum"];
          $payee = $row["payee"];
          $particular = $row["particular"];
          $saronumber = $row["saronumber"];
          $ppa = $row["ppa"];
          $uacs = $row["uacs"];
          $amount1 = $row["amount"];
          $amount = number_format( $amount1,2);
          $date = $row["date"];
          $remarks = $row["remarks"];
          $sarogroup = $row["sarogroup"];
          $status = $row["status"];
          ?>
          <tr>

           <td><?php echo $dv;?></td>
           <td><?php 
           $str = wordwrap($particular, 50);
           $str = explode("\n", $str);
           $str = $str[0] . '...';
           echo $str;


           ?></td>
           <?php if ($status =='Pending'): ?>
            <td style='background-color:red'><b>Pending</b></td>
            <?php else: ?>
              <?php if ($status == 'Disbursed'): ?>
                <td style='background-color:green'><b>Disbursed</b></td>
                <?php else: ?>
                  <td></td>
                <?php endif ?>
              <?php endif ?>
            </tr> 
          <?php } ?>
        </table>
      </div>   
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box table-responsive" >
        <div class="panel-heading bg-blue">
          Payment <!-- Item(s) -->
          <a href="MonitoringPayment.php" class="pull-right btn btn-success btn-xs">View All </a>
          <div class="clearfix"></div>
        </div>
        <table id="" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
          <thead>
            <tr style="background-color: white;color:blue;">
              <th style="text-align:center" width="200">DV NO</th>
              <th style="text-align:center" width="500">PARTICULAR</th>
              <th style="text-align:center" width="200">STATUS</th>
            </tr>
          </thead>

          <?php
          $view_query = mysqli_query($conn, "SELECT * FROM ntaob where status ='Paid' order by id desc LIMIT 3");
          while ($row = mysqli_fetch_assoc($view_query)) {
            $id = $row["id"]; 
            $accountno = $row["accountno"];
            $date1 = $row["date"];
            $date = date('F d, Y', strtotime($date1));
            $payee = $row["payee"];
            $particular = $row["particular"];
            $dvno = $row["dvno"];
            $lddap = $row["lddap"];
            $orsno = $row["orsno"];
            $ppa = $row["ppa"];
            $uacs = $row["uacs"];
            $gross1 = $row["gross"];
            $gross = number_format( $gross1,2);
            $totaldeduc = $row["totaldeduc"];
            $totaldeduc = number_format( $totaldeduc,2);
            $net1 = $row["net"];
            $net = number_format( $net1,2);
            $remarks = $row["remarks"];
            $status = $row["status"];
            ?>
            <tr>
              <td style="text-align:center" ><?php echo $dvno?></td>
              <td style="text-align:center" ><?php echo $particular?></td>
              <?php if ($status =='Unpaid'): ?>
                <td style='background-color:red'><b>Unpaid</b></td>
                <?php else: ?>
                  <?php if ($status == 'Paid'): ?>
                    <td style='background-color:green'><b>Paid</b></td>
                    <?php else: ?>
                      <td></td>
                    <?php endif ?>
                  <?php endif ?>
                </tr>
              <?php }?>
            </table>
          </div>   
        </div>
      </div>

    </div>
  </div>
</div>  
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
<script>
  document.getElementById('to').onchange = function() {
    document.getElementById('t_o').disabled = !this.checked;
  };
  function yesnoCheck() {
    $(".H1").hide();
    $(".H2").show();
    if ($('#to').is(':checked')) {

    }else{
      $(".H1").show();
      $(".H2").hide();
    }
  }

  document.getElementById('ob').onchange = function() {
    document.getElementById('o_b').disabled = !this.checked;
  };
  function yesnoCheck1() {
    $(".H1").hide();
    $(".H22").show();
    if ($('#ob').is(':checked')) {
    }else{
      $(".H1").show();
      $(".H22").hide();
    }
  }

</script>