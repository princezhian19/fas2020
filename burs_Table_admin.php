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
 <div class="box-body">
  <div class="row">
    <div class="col-md-12">
      <br>
      <h1 align="">&nbsp&nbsp&nbsp&nbspORS/BURS Proccess</h1>
      <div class="box-header with-border">
      </div>
      <br>
      <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreateBURS.php" style="color:white;text-decoration: none;">Create</a></li>
      <br>
      <br> -->
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
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
            <th>DATE RECEIVED</th>
            <th>DATE RETURN</th>
            <th>DATE PROCCESS</th>
            <th>DATE RELEASE</th>
          </tr>
        </thead>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
          $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#example1 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });
        </script>
        <?php
        $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
        $view_query = mysqli_query($conn, "SELECT burs.date_release,burs.date_received,burs.date_proccess,burs.status,burs.id,pmo.pmo_title,burs.po_no,burs.supplier,burs.address,burs.purpose,burs.amount FROM burs LEFT JOIN pmo on pmo.id = burs.office WHERE burs.status = 1 OR burs.status = 2 OR burs.status = 4 OR burs.status = 5 OR burs.status = 6 order by burs.id desc ");
        while ($row = mysqli_fetch_assoc($view_query)) {
          $id = $row["id"];
          $office = $row["pmo_title"];
          $po_no = $row["po_no"];  
          $supplier = $row["supplier"];
          $address = $row["address"];
          $purpose = $row["purpose"];
          $amount1 = $row["amount"];
          $amount = number_format($amount1,2);
          $status = $row["status"];
          $date_proccess = $row["date_proccess"];
          $date_release = $row["date_release"];
          $date_received = $row["date_received"];
          $format_amount = number_format($amount,2);
          ?>
          <tr>
            <td><?php echo $supplier;?></td>
            <td><?php echo $purpose;?></td>
            <td><?php echo $amount;?></td>

            <td><?php echo $office;?></td>
            <td><?php echo $po_no;?></td>
            <?php if ($status == 1): ?>
              <td><a class="btn btn-primary btn-xs" href='received_burs.php?id=<?php echo $id; ?>&stat=1' >Received</a> </a></td>
              <?php else: ?>
                <td><?php echo $date_received;?></td>
              <?php endif ?>
              <?php if ($status == 5): ?>
                <td><?php echo $date_return;?></td>
                <?php else: ?>
                  <?php if ($status == 4 || $status == 5): ?>
                <td><?php echo $date_return;?></td>
                    <?php else: ?>
                      <td>
                       <a class="btn btn-danger btn-xs" href='ViewBURScomments.php?id=<?php echo $id; ?>&stat=2'>Return</a>
                     </td>
                   <?php endif ?>

                 <?php endif ?>

                 <?php if ($status == 1): ?>
                  <td>
                  </td>
                  <?php else: ?>
                    <?php if ($status == 4 OR $status == 5 ): ?>
                      <td><?php echo $date_proccess;?></td>
                      <?php else: ?>
                       <td>
                        <a class="btn btn-success btn-xs" href='CreateObligation.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> 
                      </td>
                    <?php endif ?>

                  <?php endif ?>
                  <?php if ($status == 4 || $status == 5): ?>
                    <?php if ($status == 5): ?>
                      <td><?php echo $date_release;?></td>
                      <?php else: ?>
                        <td>
                          <a class="btn btn-success btn-xs" href='release_burs.php?id=<?php echo $id; ?>&stat=1' >Release</a> 
                        </td>
                      <?php endif ?>
                      <?php else: ?>
                        <td></td>
                      <?php endif ?>

                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </body>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#exmaple1').DataTable();

          } );
        </script>
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



