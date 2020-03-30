<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
      <h1>Monitoring of Disbursements</h1>
                  <p></p>
                  <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white; color:blue;">
                  <th>DATE RECEIVED</th>
                  <th>DATE DISBURSED</th>
                  <th>DATE RELEASED</th>
                  <th>DV NUMBER</th>
                  <th>PO NUMBER</th>
                  <th>PAYEE</th>
                  <th>PARTICULAR</th>
                  <th>AMOUNT</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <?php
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
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
                  <?php if ($datereceived !='0000-00-00' ): ?>
                    <td><?php echo $datereceived11;?></td>
                    <?php else: ?>
                      <td></td>
                    <?php endif ?>
                      <?php if ($datereprocessed !='0000-00-00'): ?>
                        <td><?php echo $datereprocessed11;?></td>
                        <?php else: ?>
                          <td></td>
                        <?php endif ?>
                              <?php if ($datereleased =='0000-00-00'): ?>
                               <td></td>
                             <?php else: ?> 
                             <td><?php echo $datereleased11;?></td>
                             <?php endif ?>
                             <td><?php echo $dv;?></td>
                             <td><?php echo $ponum;?></td>
                             <td><?php echo $payee;?></td>
                             <td><?php echo $particular;?></td>
                             <td><?php echo $amount;?></td>
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
