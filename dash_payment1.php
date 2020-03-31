<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h1>Monitoring of Payments</h1>
                  <p></p>
             <br>
             <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
                <thead>
                <tr style="background-color: white;color:blue;">
                        <th style="text-align:center" width="800">DATE</th>
                        <th style="text-align:center" width="800">PAYEE</th>
                        <th style="text-align:center" width="800">PARTICULAR</th>
                        <th style="text-align:center" width="800">DV NUMBER</th>
                        <th style="text-align:center" width="800">LDDAP-ADA/CHECK</th>
                        <th style="text-align:center" width="800">ORS NUMBER</th>
                        <th style="text-align:center" width="800">NET</th>
                        <th style="text-align:center" width="800">REMARKS</th>
                        <th style="text-align:center" width="800">STATUS</th>
                    </tr>
                </thead>
            
            <?php
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
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
                <?php if ( $date1=="0000-00-00" ): ?>
                <td style="text-align:center" ></td>
                <?php else : ?>
                <td style="text-align:center" ><?php echo $date?></td>
                <?php endif ?>
                <td style="text-align:center" ><?php echo $payee?></td>
                <td style="text-align:center" ><?php echo $particular?></td>
                <td style="text-align:center" ><?php echo $dvno?></td>
                <td style="text-align:center" ><?php echo $lddap?></td>
                <td style="text-align:center" ><?php echo $orsno?></td>
                <td style="text-align:center" ><?php echo $net?></td>
                <td style="text-align:center" ><?php echo $remarks?></td>
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
</html>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('.select2').select2()
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('[data-mask]').inputmask()
    $('#reservation').daterangepicker()
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
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
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    $('.my-colorpicker1').colorpicker()
    $('.my-colorpicker2').colorpicker()
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
