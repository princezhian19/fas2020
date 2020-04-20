<div class="box">
  <div class="box-body">
          <h1 align="">&nbspDisbursement</h1>
          <div class="box-header"style="overflow-x:auto;">
          </div>
          <br>
          <br>

          <br>
          <br>
          <div class=""  >
            <div class="col-md-0" style="overflow-x:auto;">
           <!--   <li class="btn btn-success"><a href="@disbursementcreate.php" style="color:white;text-decoration: none;">Create</a></li> -->
            </div>
            <div class="col-md-12" style="overflow-x:auto;">
            <form method = "POST" action = "@Functions/ddateexport1.php">
                <div class="input-group date" style="overflow-x:auto;">
                  <div class="input-group-addon" style="overflow-x:auto;">
                    FROM   <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 200px">
                  <div class="input-group date" style="overflow-x:auto;">
                    <div class="input-group-addon" style="overflow-x:auto;">
                      TO <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 200px">
                    <button type="submit" name="submit"  class="btn btn-success ">Filter/Export Data</button>
                    &nbsp  <button type="Summary" name="Summary"  class="btn btn-success ">Export Summary</button>
                  </div>                 
                </form>
            </div>
            <div class="col-md-1" style="overflow-x:auto;">
            </div>
            <div class="col-md-0" style="overflow-x:auto;">
              </div>
              <br>
              <br>
            </div>
            <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th style="text-align:center" width="">DVs No.</th>
                  <th style="text-align:center" width="">ORS/BURS No.</th>
                  <th style="text-align:center" width="">SR No.</th>
                  <th style="text-align:center" width="">PPA</th>
                  <th style="text-align:center" width="">UACS</th>
                  <th style="text-align:center" width="">DATE RECEIVED</th>
                  <th style="text-align:center" width="">DATE DISBURSED</th>
                  <th style="text-align:center" width="">DATE RELEASED</th>
                  <th style="text-align:center" width="">PAYEE</th>
                  <th style="text-align:center" width="">PARTICULAR</th>
                  <th style="text-align:center" width="">AMOUNT</th>
                  <th style="text-align:center" width="">TAX</th>
                  <th style="text-align:center" width="">GSIS</th>
                  <th style="text-align:center" width="">PAGIBIG</th>
                  <th style="text-align:center" width="">PHILHEALTH</th>
                  <th style="text-align:center" width="">OTHER PAYABLES</th>
                  <th style="text-align:center" width="">TOTAL DEDUCTIONS</th>
                  <th style="text-align:center" width="">NET</th>
                  <th style="text-align:center" width="">REMARKS</th>
                  <th style="text-align:center" width="">STATUS</th>
                  <th style="text-align:center" width="150">ACTION</th>
                </tr>
              </thead>
              <?php
              $servername ="localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
            // Create connection
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT * FROM disbursement order by ID desc");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["ID"]; 
                $dv = $row["dv"];
                $ors = $row["ors"];
                $sr = $row["sr"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $datereceived = $row["datereceived"];
                $datereceived11 = date('F d, Y', strtotime($datereceived));
                $timereceived = $row["timereceived"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $amount = $row["amount"];
                $tax = $row["tax"];
                $gsis = $row["gsis"];
                $pagibig  = $row["pagibig"];
                $philhealth = $row["philhealth"];
                $other = $row["other"];
                $total = $row["total"];
                $net = $row["net"];
                $remarks = $row["remarks"];
                $status = $row["status"];
                $date_proccess = $row["date_proccess"];
                $date_proccess1 = date('F d, Y', strtotime($date_proccess));
                $datereleased = $row["datereleased"];
                ?>
                <tr>
                  <td><?php echo $dv;?></td>
                  <td><?php echo $ors;?></td>
                  <td><?php echo $sr;?></td>
                  <td><?php echo $ppa;?></td>
                  <td><?php echo $uacs;?></td>
                  <?php if ($datereceived == '1970-01-01' || $datereceived =='0000-00-00'): ?>
                    <td><a href="received_dv.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs">Receive</a></td>
                    <?php else: ?>
                      <td><?php echo $datereceived11;?></td>
                    <?php endif ?>
                    <!-- <?php if ($datereceived != '0000-00-00'): ?>
                      <td><a class="btn btn-success btn-xs" href='CreateDisbursement.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                      <?php else: ?>
                        <?php if ($datereleased != '0000-00-00'): ?>
                          <td><?php echo $datereleased;?></td>
                          <?php else: ?>
                            <td></td>
                          <?php endif ?>
                          <td></td>
                          <?php endif ?> -->
                          <?php if ($date_proccess != NULL): ?>
                            <td><?php echo $date_proccess1;?></td>
                            <?php else: ?>
                              <?php if ($datereceived != '0000-00-00'): ?>
                                <td><a class="btn btn-success btn-xs" href='CreateDisbursement.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                                <?php else: ?>
                                  <td></td>
                                <?php endif ?>
                              <?php endif ?> 
                              <?php if ($datereleased != '0000-00-00'): ?>
                                <td><?php echo $datereleased;?></td>
                                <?php else: ?>
                                  <?php if ($date_proccess == NULL): ?>
                                    <td></td>
                                    <?php else: ?>
                                      <td><a class="btn btn-success btn-xs" href='release_dv.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                                    <?php endif ?>
                                  <?php endif ?>
                                  <td><?php echo $payee;?></td>
                                  <td><?php echo $particular;?></td>
                                  <td><?php echo $amount;?></td>
                                  <td><?php echo $tax;?></td>
                                  <td><?php echo $gsis;?></td>
                                  <td><?php echo $pagibig;?></td>
                                  <td><?php echo $philhealth;?></td>
                                  <td><?php echo $other;?></td>
                                  <td><?php echo $total;?></td>
                                  <td><?php echo $net;?></td>
                                  <td><?php echo $remarks;?></td>
                                  <?php if ($status=='Disbursed'): ?>
                                    <td style='background-color:green'><b>Disbursed</b></td>
                                    <?php else: ?>
                                      <?php if ($status=='Pending'): ?>
                                        <td style='background-color:red'><b>Pending</b></td>
                                        <?php else: ?>
                                          <td></td>
                                        <?php endif ?>
                                      <?php endif ?>
                                      <td>
                                        <a href='disbursementupdate.php?getid=<?php echo $id;?>' class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a>
                                        <!-- <a href='@Functions/ddeletefunction.php?getid=<?php echo $id;?>'> <i style='font-size:24px'> <i class='fa fa-trash-o'></i></i> </a> -->
                                      </td>
                                    </tr>
                                  <?php } ?>    
                                </table>
               

        
                <script type="text/javascript">
                        $(document).ready(function() {
                          $('#example1').DataTable();
                        } );
                      </script>
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
