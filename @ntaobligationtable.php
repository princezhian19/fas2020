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
        <div class=""style="overflow-x:auto;"> 
          <div class=""style="overflow-x:auto;">

            <h1 align="">&nbspNTA Payment</h1>
             <div class="box-header "style="overflow-x:auto;">
            </div>

  <div class="section group"  style="overflow-x:auto;">
        
        <div class="col-md-1" >
           <li class="btn btn-success"><a href="ntaobcreate.php" style="color:white;text-decoration: none;">Create</a></li>
        </div>
          <div class="col-md-2" style="overflow-x:auto;">
          <!-- <form method = "POST" action = "@Functions/obdateexport.php">
                        <div class="input-group-addon">
                        FROM   <i class="fa fa-calendar"></i>
                        <input type="text" class="" id="datepicker1" placeholder='Enter Date' name="datefrom" style="height: 35px; width: 200px">
                        </div>
                        <div class="input-group-addon">
                        TO   <i class="fa fa-calendar"></i>
                        <input type="text" class="" id="datepicker2" placeholder='Enter Date' name="dateto" style="height: 35px; width: 200px">
                        &nbsp<button type="submit" name="submit"  class="btn btn-success ">Filter/Export Data</button>
                        </div>                
          </form> -->
         <!--  <input type="text" class="form-control" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" > -->       
         <br>
         <br>
         <br>
         <br>
          </div>
          <div class="col-md-2" style="overflow-x:auto;">
         
         
          </div>

        <div class="col-md-8" style="overflow-x:auto;">
         
         <!--  <form method = "POST" action = "@Functions/obexportall.php">
            &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-success ">Export All</button>
          </form> -->


          
          <!-- <form method = "POST" action = "@Functions/obdateexport.php">
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
                        &nbsp<button type="submit" name="submit"  class="btn btn-success ">Filter/Export Data</button>
                        &nbsp<button type="submit" name="Summary"  class="btn btn-success ">Export Summary</button>
                    
                    </div>                        
                      
          </form> -->
        </div>
        <br>
        <br>
        
    </div>
      
      <!-- table here -->
      <!-- <input type="text" style="height: 35px; width: 500px; margin-left: 40px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
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
                    <br> -->
        <br>
      <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
                <thead>
                <tr style="background-color: white;color:blue;">
                      
                        <th style="text-align:center" width="">ACCOUNT NO</th>
                        <th style="text-align:center" width="">DATE</th>
                        <th style="text-align:center" width="">PAYEE</th>
                        <th style="text-align:center" width="">PARTICULAR</th>
                        <th style="text-align:center" width="">DV NUMBER</th>
                        <th style="text-align:center" width="">LDDAP-ADA/CHECK</th>
                        <th style="text-align:center" width="">ORS NUMBER</th>
                        <th style="text-align:center" width="">PPA</th>
                        <th style="text-align:center" width="">UACS</th>
                        <th style="text-align:center" width="">GROSS</th>
                        <th style="text-align:center" width="">TAX</th>
                        <th style="text-align:center" width="">NET</th>
                        <th style="text-align:center" width="">REMARKS</th>
                        <th style="text-align:center" width="">STATUS</th>
                        <th style="text-align:center" width="150">ACTION</th>
                       
                        

                    </tr>
                </thead>
            
            <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM ntaob order by id desc");

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

                <tr align = ''>
             
                
                <td style="text-align:center" ><?php echo $accountno?></td>
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
                <td style="text-align:center" ><?php echo $ppa?></td>
                <td style="text-align:center" ><?php echo $uacs?></td>
                <td style="text-align:center" ><?php echo $gross?></td>
                <td style="text-align:center" ><?php echo $totaldeduc?></td>
                <td style="text-align:center" ><?php echo $net?></td>
                <td style="text-align:center" ><?php echo $remarks?></td>
                <td style="text-align:center" ><?php echo $status?></td>
                
                <td style="text-align:center" > 
                
                <a href='ntaobupdate.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                
                <!-- <a href='@Functions/sofexport.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa fa-fw fa-download'></i></a>
                <a href='@obtableViewMain.php?getsaroID=<?php echo $saronumber?>&getuacs=<?php echo $uacs?>'> <i style='font-size:24px' class='fa'>&#xf06e;</i> </a> -->
                </td>
                
               

                </tr>

            
            <?php }?>


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

   
<div class="panel-footer"></div>
</div>
</div>


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



