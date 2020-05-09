<div class="row">
  <div class="col-md-3">
    <div class="box">
      <div class="panel-heading bg-blue">
       <img class="direct-chat-img" src="images/LOGO.png" alt="message user image">
       PHILIPPINES STANDARD TIME <!-- Item(s) -->
       <img class="direct-chat-img pull-right" src="images/ph.png" alt="message user image">
       <div class="clearfix"></div>
     </div>

     <p><h3><div class="text-center" id="clock">--:--:--</div></h3></p>
     <div class="text-center"><?php echo date('F d, Y D')?></div>
     <script type="text/javascript">
      setInterval(displayclock, 500);
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
<div class="col-md-3">
  <div class="box">
    <div class="info-box">
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
      <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-calendar-check-o"></i></span>
      <div class="info-box-content">
        <span class=""><?php echo $title;?> on <?php echo date('F d, Y',strtotime($start));?></span><br><br>
        <div style="font-size: 10px">
          <p><b>Venue : </b> <?php echo $venue?></p>
          <p><b>Office : </b> <?php echo $DIVISION_M;?></p>
          <!-- <p><b>Date : </b> <?php echo date('F d, Y',strtotime($start));?></p> -->
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>


  </div>
</div>
<div class="col-md-3">
  <div class="box">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-calendar-check-o"></i></span>
      <?php 
      $select_event2 = mysqli_query($conn,"SELECT e.id,e.start,e.end,e.title,e.venue,tp.DIVISION_M FROM events e LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = e.office WHERE e.id != $id ORDER BY e.id DESC LIMIT 1");
      $rowE2 = mysqli_fetch_array($select_event2);
      $id2 = $rowE2['id'];
      $start2 = $rowE2['start'];
      $start2 = $rowE2['start'];
      $end2 = $rowE2['end'];
      $title2 = $rowE2['title'];
      $venue2 = $rowE2['venue'];
      $DIVISION_M2 = $rowE2['DIVISION_M'];
      ?>
      <div class="info-box-content">
        <span class=""><?php echo $title2;?> on <?php echo date('F d, Y',strtotime($start2));?></span><br><br>
        <div style="font-size: 10px">
          <p><b>Venue : </b> <?php echo $venue2?></p>
          <p><b>Office : </b> <?php echo $DIVISION_M2;?></p>
          <!-- <p><b>Date : </b> <?php echo date('F d, Y',strtotime($start));?></p> -->
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>


  </div>
</div>
<div class="col-md-3">
  <div class="box">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-calendar-check-o"></i></span>
      <?php 
      $select_event2 = mysqli_query($conn,"SELECT e.id,e.start,e.end,e.title,e.venue,tp.DIVISION_M FROM events e LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = e.office WHERE e.id != $id and e.id != $id2 ORDER BY e.id DESC LIMIT 1");
      $rowE2 = mysqli_fetch_array($select_event2);
      $id2 = $rowE2['id'];
      $start2 = $rowE2['start'];
      $start2 = $rowE2['start'];
      $end2 = $rowE2['end'];
      $title2 = $rowE2['title'];
      $venue2 = $rowE2['venue'];
      $DIVISION_M2 = $rowE2['DIVISION_M'];
      ?>
      <div class="info-box-content">
        <span class=""><?php echo $title2;?> on <?php echo date('F d, Y',strtotime($start2));?></span><br><br>
        <div style="font-size: 10px">
          <p><b>Venue : </b> <?php echo $venue2?></p>
          <p><b>Office : </b> <?php echo $DIVISION_M2;?></p>
          <!-- <p><b>Date : </b> <?php echo date('F d, Y',strtotime($start));?></p> -->
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>


  </div>
</div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="box" style="outline: lightgray solid 10px;">
      <div class="panel-heading">
        <i class="fa fa-list-alt"></i>&nbsp&nbsp&nbspBirthday
        <a href="" class="pull-right">View All</a>
        <div class="box-header with-border">
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="box-header">
        <?php 
        $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
        $BDAY = mysqli_query($conn,"SELECT concat(FIRST_M,' ',MIDDLE_M,' ',LAST_M) as name,BIRTH_D,PROFILE FROM tblemployee WHERE MONTH(BIRTH_D) =MONTH(NOW()) LIMIT 5");
        while ($row = mysqli_fetch_assoc($BDAY)) {
          $name = $row['name'];
          $BIRTH_D = $row['BIRTH_D'];
          $PROFILE = $row['PROFILE'];
          $b_day = date('F d',strtotime($BIRTH_D));

          ?>  
          <img class="direct-chat-img" src="<?php echo $PROFILE; ?>" alt="message user image">
          <b><?php echo $name;?></b> <br>
          <font><?php echo $b_day?></font>
          <br>
          <br>
          <br>


        <?php } ?>
      </div>
    </div>
    <div class="row" >
      <div class="col-md-12" >
        <div class="box"  style="width: 700px;padding-right: 10px;padding-left: 10px;border-left: 5px solid black;">
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
    <div class="col-md-5">

      <div class="box" style="background-image: url('images/purple.jpg');border-radius: 20px;">
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="box" >
            <div class="panel-heading" style="background-color:#964B00;">
             <font style="color:white;"> ANNOUNCEMENT </font><!-- Item(s) -->
             <div class="clearfix"></div>
           </div>
           <div style="padding-left: 10px;padding-right: 10px;background:#ee5;">
             <img class="direct-chat-img" src="images/LOGO.png" alt="message user image"><a href="">Charles Adrian T. Odi</a>
             <p></p>

             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
             </p>

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

                // echo "SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'";
          $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
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
           <td><?php echo $particular;?></td>
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