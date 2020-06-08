<?php
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$u = mysqli_query($conn,"SELECT emp.FIRST_M,emp.MIDDLE_M,emp.LAST_M,pos.POSITION_M FROM tblemployeeinfo emp LEFT JOIN tbldilgposition pos on pos.POSITION_ID = emp.POSITION_C WHERE emp.UNAME = '$username' ");
$row = mysqli_fetch_array($u);
$FIRST_M1 = $row['FIRST_M'];
$FIRST_M = ucwords(strtolower($FIRST_M1));
$MIDDLE_M = $row['MIDDLE_M'];
$LAST_M1 = $row['LAST_M'];
$LAST_M = ucfirst(strtolower($LAST_M1));
$POSITION_M = $row['POSITION_M'];
$words = explode(" ", $MIDDLE_M);
$acronym = "";

foreach ($words as $w) {
  $acronym .= $w[0];
}
          //asd
$name = $FIRST_M.' '.$acronym.'.'.' '.$LAST_M;


$sele = mysqli_query($conn,"SELECT ACCESSTYPE FROM tblemployee WHERE UNAME = '$username'");
$rowU = mysqli_fetch_array($sele);
$ACCESSTYPE = $rowU['ACCESSTYPE'];

$date_now = date('Y-m-d');
$now_date = date('Y-m-d H:i:s');

$logs = mysqli_query($conn,"SELECT * FROM dtr WHERE UNAME = '$username' AND `date_today` LIKE '%$date_now%'");

// $logs = mysqli_query($conn,"SELECT * FROM dtr WHERE UNAME = '$username' AND `time_in` LIKE '%$date_now%' ");
$rowl = mysqli_fetch_array($logs);
$time_inL = $rowl['time_in'];
$lunch_inL = $rowl['lunch_in'];
$lunch_outL = $rowl['lunch_out'];
$time_outL = $rowl['time_out'];

echo date('F d, Y H:i A');
echo "<br>";
echo date('F d, Y h:i a');



$check1 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_in` IS NOT NULL ");
$check2 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_in` IS NOT NULL ");
$check3 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `lunch_out` IS NOT NULL ");
$check4 =mysqli_query($conn,"SELECT *  FROM `dtr` WHERE `UNAME` = '$username' AND date_today LIKE '%$date_now%' AND `time_out` IS NOT NULL ");

$checkall = mysqli_query($conn,"SELECT * FROM dtr WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");


$month = date('m');
$year = date('Y');

$d1=cal_days_in_month(CAL_GREGORIAN,$month,$year);

if (isset($_POST['stamp1'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = now() WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{

    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET time_in = now() WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }
  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp2'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = now() WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_in = now() WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp3'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = now() WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }
    $insert = mysqli_query($conn,"UPDATE dtr SET lunch_out = now() WHERE `date_today` LIKE '%$date_now%' AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}

if (isset($_POST['stamp4'])) {
  if (mysqli_num_rows($checkall)>0) {
    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = now() WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }else{
    for($d = 1; $d <=$d1; $d++)
    {
      $date_in_month = $year.'-'.$month.'-'.$d;
      $insert = mysqli_query($conn,"INSERT INTO dtr(UNAME,date_today) VALUES('$username','$date_in_month')");

    }

    $insert = mysqli_query($conn,"UPDATE dtr SET time_out = now() WHERE `date_today` LIKE '%$date_now%'  AND `UNAME` = '$username'");
  }

  if ($insert) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Success!')
      window.location.href = 'DTR.php';
      </SCRIPT>");
  }
}



?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border" align="left">
        <h1>Daily Time Record</h1>
        <br>
        <font style="font-size: 20px;"><b>Name</b> : </font>&nbsp <font style="font-size: 20px;"><?php echo  $name;?></font>
        <br>
        <font style="font-size: 20px;"><b>Position</b> : </font>&nbsp <font style="font-size: 20px;"><?php echo  $POSITION_M?></font>
        <br>
        <font style="font-size: 20px;"><b>Month</b> : 
          <select name="month" id="month">
            <option value="<?php echo date('m')?>"><?php echo date('F')?></option>
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
          <select name="year" id="year">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
          </select>
          <!-- </font>&nbsp <font style="font-size: 20px;"><?php echo date('F d, Y')?></font> -->
          <br>

        </div>
        <div class="box-body table-responsive no-padding">
          <div class="box-body">
            <?php if ($ACCESSTYPE == 'admin'): ?>
             <a href="ViewEmployees.php?division=<?php echo $division?>&username=<?php echo $username?>" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
           <?php endif ?>
           <div style="float: right;padding:5px;">
            <a href="javascript:void(0);" class="btn btn-success link" data-id="<=$data['id']?>"><i class="fa fa-fw fa-download"></i>Export</a>

          </div>
          <br>
          <br>
          <br>
          <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th width="">Date</th>
                <th width="">Time In</th>
                <th width="">Lunch In</th>
                <th width="">Lunch Out</th>
                <th width="">Time Out</th>
                <th width="">Minutes</th>
                <th width="">Hrs</th>
              </tr>
            </thead>
            <?php 

            $view_query = mysqli_query($conn, "SELECT id, UNAME,date_today,time_in, lunch_out,lunch_in,time_out,SUBTIME(time_out,'01:00:00') as time_out1 FROM dtr WHERE UNAME ='$username' ORDER BY id ASC");

            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $UNAME = $row["UNAME"];  
              $date_today = $row["date_today"];  
              $time_in = $row["time_in"];
              $lunch_in = $row["lunch_in"];
              $lunch_out= $row["lunch_out"];
              $time_out = $row["time_out"];

              $time_out1 = $row["time_out1"];

              ?>

              <tr>
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
               
          </td>
          <td>
           

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
    <div class="box-header with-border" align="left">
      <h4><strong>Logs For Today : <?php echo date('F d, Y')?></strong></h4>
    </div>
    <div class="box-body table-responsive no-padding">
      <div class="box-body">
        <table id="example1" class="table table-striped " style="background-color: white;">
          <form method="POST">
            <tr>
              <th class="pull-left" >Time In</th>
              <?php if (mysqli_num_rows($check1)>0): ?>
                <td width="250"><?php echo date('h:i A',strtotime($time_inL))?></td>

                <?php else: ?>
                  <td width="250"><button class="btn btn-success" name="stamp1" type="submit"><strong>Stamp</strong></button></td>
                <?php endif ?>
              </tr>
              <tr>
                <th class="pull-left" >Lunch In</th>
                <?php if (mysqli_num_rows($check2)>0): ?>
                  <td width="250"><?php echo date('h:i A',strtotime($lunch_inL))?></td>
                  <?php else: ?>
                    <?php if (mysqli_num_rows($check1)>0): ?>
                      <td width="250"><button class="btn btn-success" name="stamp2" type="submit"><strong>Stamp</strong></button></td>
                      <?php else: ?>
                        <td width="250"><button disabled class="btn btn-success" name="stamp2" type="submit"><strong>Stamp</strong></button></td>
                      <?php endif ?>
                    <?php endif ?>
                  </tr>
                  <tr>
                    <th class="pull-left">Lunch Out</th>
                    <?php if (mysqli_num_rows($check3)>0): ?>
                      <td width="250"><?php echo date('h:i A',strtotime($lunch_outL))?></td>
                      <?php else: ?>
                        <?php if (mysqli_num_rows($check1)>0 && mysqli_num_rows($check2)>0): ?>
                        <td width="250"><button  class="btn btn-success" name="stamp3" type="submit"><strong>Stamp</strong></button></td>
                        <?php else: ?>
                          <td width="250"><button disabled class="btn btn-success" name="stamp3" type="submit"><strong>Stamp</strong></button></td>
                        <?php endif ?>
                      <?php endif ?>
                    </tr>

                    <tr>
                      <th class="pull-left" >Time Out</th>
                      <?php if (mysqli_num_rows($check4)>0): ?>
                        <td width="250"><?php echo date('h:i A',strtotime($time_outL))?></td>
                        <?php else: ?>
                          <?php if (mysqli_num_rows($check1)>0 && mysqli_num_rows($check2)>0 && mysqli_num_rows($check3)>0): ?>
                          <td width="250"><button class="btn btn-success" name="stamp4" type="submit"><strong>Stamp</strong></button></td>
                          <?php else: ?>
                            <td width="250"><button disabled class="btn btn-success" name="stamp4" type="submit"><strong>Stamp</strong></button></td>
                          <?php endif ?>
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
        </html>

