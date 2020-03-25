<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$user = $_SESSION['username'];
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>
<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
     <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <br>
          <h1 align="">&nbsp&nbsp&nbsp&nbspDisbursement Voucher</h1>
          <div class="box-header with-border">
          </div>
          <br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreateDV.php" style="color:white;text-decoration: none;">Create</a></li>
          <br>
          <br>
          <br>
          <br>
          <table id="example1" class="table table-bordered-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>PAYEE</th>
                <th>PARTICULAR</th>
                <th>AMOUNT</th>
                <th>OFFICE</th>
                <th>PO NO.</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <?php
            $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
            $view_query = mysqli_query($conn, "SELECT dv.status,dv.id,pmo.pmo_title,dv.po_no,dv.supplier,dv.address,dv.purpose,dv.amount FROM dv LEFT JOIN pmo on pmo.id = dv.office  order by dv.id desc ");
            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $office = $row["pmo_title"];
              $po_no = $row["po_no"];  
              $supplier = $row["supplier"];
              $address = $row["address"];
              $purpose = $row["purpose"];
              $amount = $row["amount"];
              $status = $row["status"];
              $format_amount = number_format($amount,2);
              ?>
              <tr>
                <td><?php echo $supplier;?></td>
                <td><?php echo $purpose;?></td>
                <td><?php echo $format_amount;?></td>
                <td><?php echo $office;?></td>
                <td><?php echo $po_no;?></td>
                <td><?php if ($status == 0) {
                  echo "Needs to Submit";
                }elseif ($status == 1) {
                  echo "Submitted";
                }elseif ($status == 2 || $status == 4) {
                  echo "Received";
                }elseif ($status == 3) {
                  echo '<b style="color:red">Returned</b>';
                }elseif ($status == 6) {
                  echo 'Released';
                }
                else{
                  echo "Approved";
                }
                ?>
              </td>
              <td>
                <?php if ($status == 3 ): ?>
                  <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' > Edit </a> | <a class="btn btn-success btn-xs" href='submit_dv.php?id=<?php echo $id; ?>&stat=2'>Submit</a>
                  <?php else: ?>
                    <?php if ($status == 1  || $status == 2  || $status == 6  || $status == 4  || $status == 5 ): ?>
                      <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' > View </a> 
                      <?php else: ?>
                        <a class="btn btn-primary btn-xs" href='UpdateDV.php?id=<?php echo $id; ?>' > Edit </a> | <a class="btn btn-success btn-xs" href='submit_dv.php?id=<?php echo $id; ?>&stat=2'>Submit</a>
                        
                      <?php endif ?>
                    <?php endif ?>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
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
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
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


</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



