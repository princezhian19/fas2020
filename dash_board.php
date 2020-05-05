<div class="row">
    <div class="col-md-3">
        <div class="box">
            <div class="panel-heading bg-blue">
               <img class="direct-chat-img" src="images/logo.png" alt="message user image">
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
            <span class="info-box-icon bg-aqua">4</span>

            <div class="info-box-content">
              <span class="">Meeting with Client</span><br><br>
              <div style="font-size: 10px">
                  <p><b>Email : </b> email@yahoo.com</p>
                  <p><b>Address : </b> email@yahoo.com</p>
              </div>
          </div>
          <!-- /.info-box-content -->
      </div>


  </div>
</div>
<div class="col-md-3">
    <div class="box">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="">Meeting with Client</span><br><br>
              <div style="font-size: 10px">
                  <p><b>Email : </b> email@yahoo.com</p>
                  <p><b>Address : </b> email@yahoo.com</p>
              </div>
          </div>
          <!-- /.info-box-content -->
      </div>


  </div>
</div>
<div class="col-md-3">
    <div class="box">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="">Meeting with Client</span><br><br>
              <div style="font-size: 10px">
                  <p><b>Email : </b> email@yahoo.com</p>
                  <p><b>Address : </b> email@yahoo.com</p>
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
            $select_gender = mysqli_query($conn,"SELECT count(*) as female FROM tblemployeeinfo WHERE SEX_C = 'Female' AND STATUS = 0 ");
            $rowG = mysqli_fetch_array($select_gender);
            $female = $rowG['female'];

            $select_genderB = mysqli_query($conn,"SELECT count(*) as male FROM tblemployeeinfo WHERE SEX_C = 'Male' AND STATUS = 0 ");
            $rowGB = mysqli_fetch_array($select_genderB);
            $male = $rowGB['male'];

            $reg = $female + $male;
            ?>
            <div style="font-size: 25px;">
            <i class="fa fa-fw fa-female"><?php echo $female?></i>
            <i class="fa fa-fw fa-female" style="float: right;padding-right: 70px;">0</i><br>
            <i class="fa fa-fw fa-male"><?php echo $male?></i>
            <i class="fa fa-fw fa-male" style="float: right;padding-right: 70px;">0</i><br><br>
            <i class="fa fa-fw fa-group"><?php echo $reg;?></i>
            <i class="fa fa-fw fa-group" style="float: right;padding-right: 70px;">0</i><br>
            <!-- /.chart-responsive -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-7">
         <div class="progress-group">
            <span class="progress-text">Region</span>
            <span class="progress-number"><b>160</b></span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-green" style="width: 50%"></div>
          </div>
      </div>
      <!-- /.progress-group -->
      <div class="progress-group">
        <span class="progress-text">Batangas</span>
        <span class="progress-number"><b>310</b></span>

        <div class="progress sm">
          <div class="progress-bar progress-bar-green" style="width: 80%"></div>
      </div>
  </div>
  <!-- /.progress-group -->
  <div class="progress-group">
    <span class="progress-text">Cavite</span>
    <span class="progress-number"><b>480</b></span>

    <div class="progress sm">
      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
  </div>
</div>
<!-- /.progress-group -->
<div class="progress-group">
    <span class="progress-text">Laguna</span>
    <span class="progress-number"><b>250</b></span>

    <div class="progress sm">
      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
  </div>
</div> 
<div class="progress-group">
    <span class="progress-text">Rizal</span>
    <span class="progress-number"><b>250</b></span>

    <div class="progress sm">
      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
  </div>
</div> 
<div class="progress-group">
    <span class="progress-text">Quezon</span>
    <span class="progress-number"><b>250</b></span>

    <div class="progress sm">
      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
  </div>
</div> 
<div class="progress-group">
    <span class="progress-text">Lucena City</span>
    <span class="progress-number"><b>250</b></span>

    <div class="progress sm">
      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
  </div>
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
        <img class="direct-chat-img" src="images/logo.png" alt="message user image">
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
                         <img class="direct-chat-img" src="images/logo.png" alt="message user image"><a href="">Charles Adrian T. Odi</a>
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
                    <a  class="pull-right btn btn-success btn-xs">View All</a>
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