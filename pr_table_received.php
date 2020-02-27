<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>

</head>


<body>
<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body"> 
          
          
            <h1 align="">Purchase Request</h1>
            
            <br>

            <li class="btn btn-success"><a href="CreatePR.php" style="color:white;text-decoration: none;">Create</a></li>

            <br>
            <br>

             <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" > -->

            <br>
            <br>
   
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                <tr style="background-color: white;color:blue;">
                       
                        <th>PR NO</th>
                        <th>PR DATE</th>
                        <th>OFFICE</th>
                         <th width="200">TYPE</th>
                        <th width="500">PURPOSE</th>
                        <th>TARGET DATE</th>
                        <th width="200">ACTION</th>
                        <th width="200"></th>
                       
                    </tr>
                </thead>
                <?php
                $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $view_query = mysqli_query($conn, "SELECT * FROM pr order by id desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $getID = $row["id"]; 
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];  
                    $pmo = $row["pmo"];
                    $received_date = $row["received_date"];
                    $submitted_date = $row["submitted_date"];


                    $purpose = $row["purpose"];

                    $pr_date = $row["pr_date"];
                    $pr_date11 = date('F d, Y', strtotime($pr_date));

                    $type = $row["type"];

                    $target_date = $row["target_date"];
                    $target_date11 = date('F d, Y', strtotime($target_date));

                    ?>
                    <tr>
                      
                        <?php if ($pr_no == ''): ?>
                        <td><a href="set_pr.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs">Set Pr</a></td>
                          <?php else: ?>
                        <td><?php echo $pr_no;?></td>
                        <?php endif ?>
                         <?php if ($pr_date == "0000-00-00"): ?>
                          <td></td>
                        <?php else:?>
                          <td><?php echo $pr_date11;?></td>
                        <?php endif?>
                        <td><?php echo $pmo;?></td>
                    
                        <?php if ($type == "1"): ?>
                          <td><?php echo "Catering Services";?></td>
                        <?php endif?>
                        <?php if ($type == "2"): ?>
                          <td><?php echo "Meals, Venue and Accommodation";?></td>
                        <?php endif?>
                        <?php if ($type == "3"): ?>
                          <td><?php echo "Repair and Maintenance";?></td>
                        <?php endif?>
                        <?php if ($type == "4"): ?>
                          <td><?php echo "Supplies, Materials and Devices";?></td>
                        <?php endif?>
                        <?php if ($type == "5"): ?>
                          <td><?php echo "Other Services";?></td>
                        <?php endif?>
                        <?php if ($type == "6"): ?>
                          <td><?php echo " Reimbursement and Petty Cash";?></td>
                        <?php endif?>

                       
                        <td><?php echo $purpose;?></td>
                        <td><?php echo $target_date11;?></td>
                        <td>



                          &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $getID; ?>' > <i style='font-size:20px' class='fa'>&#xf044;</i> </a>

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='ViewPRv.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>

                        </td>
                        <?php if ($submitted_date == NULL): ?>
                          <td></td>
                          <?php else: ?>
                            <?php if ($submitted_date != NULL AND $received_date == NULL): ?>
                        <td>
                          <a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to Received this item?');" href='received_pr.php?id=<?php echo $id; ?>  ' title="Submit"> 
                          Received </a>    
                        </td>
                            <?php else: ?>
                              <td>Received Date <?php echo $received_date?></td>
                            <?php endif ?>
                        <?php endif ?>
                       
                        <!-- <td>                     
                        
                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='deletePRfinalize.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:24px' class='fa fa-trash-o' ></i> </a>

                    </td> -->


                    
                </tr>
            <?php } ?>

            
        </table>
    </div>
</div>

</div>
</div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
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



