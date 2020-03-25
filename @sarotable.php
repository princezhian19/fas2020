<?php
include('db.class.php'); // call db.class.php

?>


<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>


</head>
<body>
<div class="box">
  <div class="box-body">
        <div class=""  style="overflow-x:auto;"> 
          <div class=""  style="overflow-x:auto;">
            
            
      
            <h1 align="">SARO/SUB-ARO</h1>
             <div class=""  style="overflow-x:auto;">
    </div>
    <br>
    <br>
  
    <div class="class"  style="overflow-x:auto;">
          
         <div class="col-md-1">
          <li class="btn btn-success"><a href="sarocreate.php" style="color:white;text-decoration: none;">Create</a></li>


           


          </div>
          <div class="col-md-9">
        

          <form method = "POST" action = "@Functions/sarodateexport.php">
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
                        &nbsp<button type="submit" name="submit" style="width:%; height: 35px" class="btn btn-success ">Filter/Export Data</button>

                          &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="@Functions/saroexportall.php" style="color:white;text-decoration: none;">Export All</a></li>
                    </div>                            
          </form>



        </div>


        <br>
      <br>


      </div>

    <!--   <div class="class"  style=""> -->
        
     
   
        
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
                        
                        
                        <th width="800">DATE</th>
                        <th width="800">SOURCE</th>
                        <th width="800">FUND</th>
                        <th width="800">LEGAL BASIS</th>
                        <th width="800">PPA</th>
                        <th width="800">EXPENSE CLASS</th>
                        <th width="800">PARTICULARS</th>
                        <th width="800">UACS</th>
                        <th width="800">AMOUNT</th>
                        <th width="800">DISBURSEMENT</th>
                        <th width="800">BALANCE</th>
                        <th width="800">GROUP</th>
                        <th width="800">ACTION</th>
                        

                   
                </thead>
            
            <?php
            $servername = "localhost";

            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";

            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";

            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM saro order by sarodate desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $date = $row["sarodate"];
                  $date11 = date('F d, Y', strtotime($date));
                  $saronumber = $row["saronumber"];
                  $fund = $row["fund"];
                  $legalbasis = $row["legalbasis"];
                  $ppa = $row["ppa"];
                  $expenseclass = $row["expenseclass"];
                  $particulars = $row["particulars"];
                  $uacs = $row["uacs"];
                  $amount1 = $row["amount"];
                  $amount = number_format( $amount1,2);

                  $obligated1 = $row["obligated"];
                  $obligated = number_format( $obligated1,2);

                  $balance1 = $row["balance"];
                  $balance = number_format( $balance1,2);
                  
                  $sarogroup = $row["sarogroup"];
                ?>
                 <tr align = ''>
                    
                    <td><?php echo $date11?></td>
                    <td><?php echo $saronumber?></td>
                    <td><?php echo $fund?></td>
                    <td><?php echo $legalbasis?></td>
                    <td><?php echo $ppa?></td>
                    <td><?php echo $expenseclass?></td>
                    <td><?php echo $particulars?></td>
                    <td><?php echo $uacs?></td>
                    <td><?php echo $amount?></td>
                    <td><?php echo $obligated?></td>
                    <td><?php echo $balance?></td>
                    <td><?php echo $sarogroup?></td>
                  
                    
                    <td style="text-align:center" > 
                    
                    <a href='@saroupdate.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                   
                    <a href='@Functions/sofexport.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa fa-fw fa-download'></i></a>
                    <a href='@obtableViewMain.php?getsaroID=<?php echo $saronumber?>&getuacs=<?php echo $uacs?>'> <i style='font-size:24px' class='fa'>&#xf06e;</i> </a>
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



