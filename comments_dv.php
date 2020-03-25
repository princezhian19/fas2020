<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
$user = $_SESSION['username'];
$s_user = mysqli_query($conn,"SELECT pmo_id FROM end_users WHERE username = '$user'");
$row_u = mysqli_fetch_array($s_user);
$pmo_id = $row_u['pmo_id'];
$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM dv WHERE id = '$id'");
$row = mysqli_fetch_array($query);
$burs_id1 = $row['id'];
$comment = $row['purpose'];
$comm = mysqli_query($conn,"SELECT dv.office,dv.comments,pmo.pmo_title,dv.date_stamp FROM comments_dv dv LEFT JOIN pmo on pmo.id = dv.office WHERE dv.dv_id = '$id' ORDER BY dv.id DESC");

$comm2 = mysqli_query($conn,"SELECT * FROM comments_dv  WHERE dv_id = '$id' ORDER BY id DESC");
$row2 = mysqli_fetch_array($comm2);
$date_stamp = $row2['date_stamp'];
$burs_id = $row2['dv_id'];
$date = date('F d Y ', strtotime($date_stamp));
$time = date(' F d Y h:i a', strtotime($date_stamp));

if (isset($_POST['submit'])) {
  $comments1 = $_POST['comments'];
  $insert = mysqli_query($conn,"INSERT INTO comments_dv(office,comments,dv_id) VALUES(0,'$comments1','$burs_id1')");
  if ($insert) {
    $update = mysqli_query($conn,"UPDATE dv SET status = 3, date_return = now() WHERE id = '$id' ");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewDV.php';
      </SCRIPT>");
  }  else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured in Saving');
    </SCRIPT>");
 }
}
?>
<!DOCTYPE html>
<html>
<body>
 <div class="box box-default">
  <div class="box-header with-border">
    <h1>
      Comment
      <small>Section</small>
    </h1>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php if (mysqli_num_rows($comm) > 0 ): ?>

            <ul class="timeline">
<!--               <li class="time-label">
                <span class="bg-green">
                  <?php echo $date;?>
                </span>
              </li> -->
              <!-- loop here  -->
              <?php 
              while ($rowA = mysqli_fetch_assoc($comm)) {
                $comments = $rowA['comments'];
                $office = $rowA['pmo_title'];
                $office1 = $rowA['office'];
                $date_stamp = $rowA['date_stamp'];
                if ($office1 == 0 ) {
                  $office1 = "Budget Office";
                }
                ?>
                <li>
                  <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i><?php echo $time;?></span>
                    <h3 class="timeline-header"><a href="#">
                      <?php 
                      if ($office1 == 0 ) { 
                        echo $office1;
                      }else{
                        echo $office;
                      }
                      ?></a> sent you an email</h3>
                      <div class="timeline-body">
                        <?php echo $comments;?>
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </section>
        <?php endif ?>
        <?php if ($pmo_id == ''): ?>
          <form method="POST">
            <div>
              <textarea class="form-control" name="comments"></textarea>
              <br>
            </div>
            <div class="timeline-footer">
              <button class="btn btn-danger btn-xs" type="submit" name="submit">Return</button>
            </div>
          </form>
          <?php else: ?>

        <?php endif ?>
          
        </div>
      </div>

    </body>
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->
    <script>
      $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
