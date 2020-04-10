<?php
include('db.class.php'); // call db.class.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Issuances</h1>
          
          <br>
        
          <div class=""  style="overflow-x:auto;">
         
            <li class="btn btn-success"><a href="CreateIssuances.php" style="color:white;text-decoration: none;">Create</a></li>
        
          
              <br>
              <br>
              <br>
            </div>

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                 
                  <th>CATEGORY</th>
                  <th>ISSUANCES NO</th>
                  <th>ISSUANCE DATE</th>
                  <th>TITLE/SUBJECT</th>
                  <th>ACTION</th>
                  
                </tr>
              </thead>


              <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT issuances.date_issued,issuances.postedby,issuances.office_responsible,pdf_file,issuances.id, issuances.type, issuance_no, `status`, `subject`, summary, dateposted, `name`, issuances.type, url
            FROM issuances LEFT JOIN issuances_category ON issuances.category = issuances_category.id 
            ORDER BY dateposted");

             /* where md5(issuances.id) ='".md5($_GET['id'])."' */

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];

                  $datenta1 = $row["datenta"];
                  $datenta = date('F d, Y', strtotime($datenta1));

                  $datereceived1 = $row["datereceived"];
                  $datereceived = date('F d, Y', strtotime($datereceived1));

                  $accountno = $row["accountno"];
                  $ntano = $row["ntano"];
                  $saronumber = $row["saronumber"];
                  $particular = $row["particular"];

                  $amount1 = $row["amount"];
                  $amount = number_format( $amount1,2);

                  $obligated1 = $row["obligated"];
                  $obligated = number_format( $obligated1,2);

                  $balance1 = $row["balance"];
                  $balance = number_format( $balance1,2);
                  
                  //$sarogroup = $row["sarogroup"];
                ?>
                 <tr align = ''>
                   
                    <?php if ( $datenta1=="0000-00-00" ): ?>
                    <td style="text-align:center" ></td>
                    <?php else : ?>
                    <td style="text-align:center" ><?php echo $datenta?></td>
                    <?php endif ?>

                    <?php if ( $datereceived1=="0000-00-00" ): ?>
                    <td style="text-align:center" ></td>
                    <?php else : ?>
                        <td style="text-align:center" ><?php echo $datereceived?></td>
                    <?php endif ?>

                   
              
                    <td style="text-align:center" ><?php echo $accountno?></td>
                    <td style="text-align:center" ><?php echo $ntano?></td>
                    <td style="text-align:center" ><?php echo $saronumber?></td>
                    <td style="text-align:center" ><?php echo $particular?></td>
                    <td style="text-align:center" ><?php echo $amount?></td>
                    <td style="text-align:center" ><?php echo $obligated?></td>
                    <td style="text-align:center" ><?php echo $balance?></td>
                    
                    <td style="text-align:center" > 
                    
                    <a href='ntaupdate.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    <a href='ntatableViewMain.php?getntano=<?php echo $ntano?>&getparticular=<?php echo $particular?>'> <i style='font-size:24px' class='fa'>&#xf06e;</i> </a>
                    
                    </td>
                   

                    </tr>

                
              <?php }?>
             
            </table>
                
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



</body>
</html>



