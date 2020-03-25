<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>

<!DOCTYPE html>
<html>
<head>
  <title>Annual Procurement Plan</title>

</head>

<body>
<div class="box">
  <div class="box-body">
  <h1 align="">Annual Procurement Plan</h1>
    <div class="box-header">
    </div>
  

            <li class="btn btn-success"><a href="CreateAPP.php" style="color:white;text-decoration: none;">Add Item</a></li>
            <!-- &nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-info"><a href="http://localhost/pmis/frontend/web/form/excel-consolidated-app?id=" style="color:white;text-decoration: none;">Export Consolidated App</a></li> -->
            <br>
            <br>
         <!--    &nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example11 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script>   -->
            <br>
            <br>


            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        
                        <th width="150">STOCK NO</th>
                        <th width="150">CODE (PAP)</th>
                        <th width="150">CATEGORY</th>
                        <th width="150">ITEM</th>
                        <th width="150">OFFICE</th>
                        <th width="150">MODE OF PROCUREMENT</th>
                        <th width="150">SOURCE OF FUNDS</th>
                        <th width="0">ACTION</th>
                        <th width="150">HISTORY</th>
                        
                        
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "
                    SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
                    FROM app 
                    LEFT JOIN item_category ic on ic.id = app.category_id 
                    LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
                    LEFT JOIN pmo on pmo.id = app.pmo_id 
                    LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
                    ORDER BY app.id DESC ");

                while ($row = mysqli_fetch_assoc($view_query)) {

                    $id = $row["id"];  
                    $sn = $row["sn"];  
                    $code = $row["code"];
                    $item_category_title = $row["item_category_title"];
                    $procurement = $row["procurement"];
                    $pmo_title = $row["pmo_title"];
                    $mode = $row["mode_of_proc_title"];
                    $source_of_funds_title = $row["source_of_funds_title"];

                    // if pmo == 1 and 2 print ord and lgmed

                    ?>
                    <tr>
                        
                        <td width="1000"><?php echo $sn;?></td>
                        <td width="1000"><?php echo $code;?></td>
                        <td width="1000"><?php echo $item_category_title;?></td>
                        <td width="2000"><?php echo $procurement;?></td>
                        <td width="150"><?php echo $pmo_title;?></td>
                        <td width="1000"><?php echo $mode;?></td>
                        <td width="1000"><?php echo $source_of_funds_title;?></td>
                        <td width="150">
                         <!--  &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=<?php echo $id; ?>' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='UpdateAPP.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf044;</i> </a>

                     </td>
                      <td>&nbsp&nbsp&nbsp&nbsp&nbsp<a  href='ViewApp_History.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a></td>
                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
                <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_app.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>

                    </td> -->
                    
                    
                </tr>
            <?php } ?>
        </table>
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
</div>
</div>
    <!-- <div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
</div> -->

<div class="panel-footer"></div>
</div>
</div>



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
<script>

  $(document).ready(function(){
   table = document.getElementById("item_table");

   tr = table.getElementsByTagName("th");
   var td = document.getElementById("tdvalue");

   if(td <= 0){
    $('#finalizeButton').attr('disabled','disabled');
  } else {
    $('#finalizeButton').attr('enabled','enabled');
  }

  $('.link').click(function(){

    var f = $(this);
    var id = f.data('id');

    var pr_no = $('#pr_no').val();
    var pr_date = $('#pr_date').val();
    var pmo = $('#pmo').val();
    var purpose = $('#purpose').val();

    window.location = 
    'ViewPRdetails1.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
  });
}) ;
</script>

</html>