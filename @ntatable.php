<?php


?>


<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>

 

</head>
<body>
<div class="box">
  <div class="box-body">
            
      
            <h1 align="">&nbspNTA/NCA</h1>
             <div class="box-header "  style="overflow-x:auto;">
    </div>
    <br>
  
  
  
    <div class="class"  style="overflow-x:auto;">
          
         <div class="col-md-1">
         <li class="btn btn-success"><a href="ntacreate.php" style="color:white;text-decoration: none;">Create</a></li>


          </div>
          <div class="col-md-9">
        

          <form method = "POST" action = "@Functions/ntadateexport.php">
                    <div class="input-group date">
                        <div class="input-group-addon">
                        FROM   <i class="fa fa-calendar"></i>
                    </div>
                        <input type="text" class="form-control" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 200px">
                    
                    <div class="input-group date">
                        <div class="input-group-addon">
                        TO <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 200px">
                        &nbsp<button type="submit" name="submit" style="width:%; height: 35px" class="btn btn-success ">Export Data</button>

                          <!-- &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="@Functions/saroexportall.php" style="color:white;text-decoration: none;">Export All</a></li> -->
                    </div>                        
                      
          </form>



        </div>


        <br>
      <br>


      </div>

   <div class="class">

   <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 500px; margin-left: 40px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
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
                    </script> -->
        
            
        <br>
      <br>
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        
                       
                        <th style="text-align:center"  width="800">DATE NTA</th>
                        <th style="text-align:center"  width="800">DATE RECEIVED</th>
                        <th style="text-align:center" width="800">ACCOUNT NO</th>
                        <th style="text-align:center" width="800">NTA NO</th>
                        <th style="text-align:center" width="800">SARO</th>
                        <th style="text-align:center" width="800">PARTICULAR</th>
                        <th style="text-align:center" width="800">AMOUNT</th>
                        <th style="text-align:center" width="800">DISBURSEMENT</th>

                        <th style="text-align:center" width="800">BALANCE</th>
                       <!--  <th style="text-align:center" width="800">UACS</th>
                        <th style="text-align:center" width="800">AMOUNT</th>
                        <th style="text-align:center" width="800">OBLIGATED</th>
                        <th style="text-align:center" width="800">BALANCE</th>
                        <th style="text-align:center" width="800">GROUP</th> -->
                        <th style="text-align:center" width="800">ACTION</th>
                       

                    <!-- </tr> -->
                </thead>
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "db_dilg_pmis";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM nta order by datenta asc");

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
                    
                    <a href='@ntaupdate.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    <a href='@ntatableViewMain.php?getntano=<?php echo $ntano?>&getparticular=<?php echo $particular?>'> <i style='font-size:24px' class='fa'>&#xf06e;</i> </a>
                    
                    </td>
                   

                    </tr>

                
              <?php }?>
                 
                 <!-- <a href='@Functions/sarodeletefunction.php?getid=$id'> <i style='font-size:24px'<i class='fa fa-trash-o'></i> </a> -->
            </table>
           

            </div>
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
</div>
</div>

   
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


</body>
</html>



