<!DOCTYPE html>

<html>
<?php
$connect = new PDO("mysql:host=localhost;dbname=db_dilg_pmis", "root", "");
function app($connect)
{ 
  $output = '';
  $query = "SELECT sarogroup FROM `saro` Group BY sarogroup ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["sarogroup"].'">'.$row["sarogroup"].'</option>';
  }
  return $output;
}

?>
<!-- <style>
  a:hover {
  color: blue;
}
  .p:hover {
  color: blue;
}
  span:hover {
  color: blue;
}
</style> -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- Auto Complete -->
    


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Create Obligation</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspCreate Obligation</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-success"><a href="@obligation.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

      

      
      <!-- Start form -->
  <form class="" type='GET' action="@Functions/obcreatefunction.php" >
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">
                      <label>ORS Serial No.</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="" placeholder="Enter ORS Number" name="ors" required>
                      <br>
                      <label>PO No.</label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="ponum" placeholder="Search PO Number" name="ponum">
                      
                      <table class="table table-striped table-hover" id="main">
                      <tbody id="result">
                      </tbody>
                      </table>
                      <br>
                  <!-- Getting PO NUmber -->      
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
            <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsearchvaluesource.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result').html(data);
                    }
                  });
                }
                $('#ponum').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    load_data();
                    document.getElementById('supplier').value = "";
                    document.getElementById('particular').value = "";
                    document.getElementById("ponum").value = "";
                    $("#main").show();
                    
                  }
                });
              });
              function showRow(row)
              {
                var x=row.cells;
                document.getElementById("supplier").value = x[0].innerHTML;
                document.getElementById("particular").value = x[1].innerHTML;
                document.getElementById("ponum").value = x[2].innerHTML;
                
              }
            </script>   
                </div>    
                
                <div class="col-md-6">
                    <label>Date Received</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input value="<?php echo date('m/d/Y')?>" required type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="datereceived">
                    </div>
                    <br>
                    <br>
                    
                    <label>Date Processed</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input value="<?php echo date('m/d/Y')?>"date rety required type="text" class="form-control pull-right" id="datepicker2" placeholder='Enter Date' name="datereprocessed">
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="class">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                    <label>Payee</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="payee" placeholder="Payee" name="payee">
                    <br>

                    <label>Supplier</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="supplier" placeholder="Supplier" name="supplier">
                    <br>
                    <table class="table table-striped table-hover" id="main4">
                      <tbody id="result4">
                      </tbody>
                      </table>

                    <label>Particular/Purpose</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="particular" placeholder="Particular" name="particular">
                </div>

              <!-- supplier -->

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsupplier.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result4').html(data);
                    }
                  });
                }
                $('#supplier').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {

                    load_data();
                    document.getElementById('supplier').value = "";
                   
                    $("#main4").show();
                    
                  }
                });
              });
              function showRow4(row)
              {
                var x=row.cells;
                document.getElementById("supplier").value = x[0].innerHTML;
                
                
              }
            </script>





                <div class="col-md-6">
                <label>Date Returned</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker3" placeholder='Enter Date' name="datereturned">
                    </div>
                    <br>
                    
                    <label>Date Released</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input value="<?php echo date('m/d/Y')?>" required type="text" class="form-control pull-right" id="datepicker4" placeholder='Enter Date' name="datereleased">
                        <br>
                    </div>

                   
                </div>
                <!-- @Funtions/obsearchvalue.php -->
               
            </div>
           
             
             <br>
            <!-- SARO -->
            <div class="row">
                <div class="col-md-3">
                    <label>Fund Source</label>
                    <input required  type="text"  class="form-control" style="height: 40px;" id="saronum" placeholder="Fund Source" name="saronum"class="typeahead"/>
                    <!-- <input type="text" name="txtCountry" id="txtCountry" class="typeahead"/> -->
                      <table class="table table-striped table-hover" id="main1">
                      <tbody id="result1">
                      </tbody>
                      </table>
                </div>
                
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                  <script type="text/javascript">
                  $(document).ready(function(){
                  function load_data(query)
                  {
                    $.ajax({
                      url:"@obsarosearch.php",
                      method:"POST",
                      data:{query:query},
                      success:function(data)
                      {
                        $('#result1').html(data);
                      }
                    });
                  }
                  $('#saronum').keyup(function(){
                    var search = $(this).val();
                    if(search != '')
                    {
                      load_data(search);
                    }
                    else
                    {
                      load_data();
                      document.getElementById('saronum').value = "";
                      document.getElementById("main1").value="";
                      document.getElementById("sarogroup").value = "";
                      $("#main1").show();
                     
                      
                      
                    }
                  });
                });
                function showRow1(row)
                {
                  var x=row.cells;
                  document.getElementById("saronum").value = x[0].innerHTML;
                  document.getElementById("sarogroup").value = x[5].innerHTML;
                  document.getElementById("ppa").value = x[6].innerHTML;
                  
                  
                }
              </script>
                
                <div class="col-md-3">
                    <label>MFO/PPA</label>
                    <input readonly required  type="text"  class="form-control" style="height: 40px;" id="ppa" placeholder="PPA" name="ppa">
                    <table class="table table-striped table-hover" id="main3">
                    <tbody id="result3">
                    </tbody>
                    </table>
                </div>


              <!-- PPA Search -->
              
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsaroppasearch.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result3').html(data);
                    }
                  });
                }
                $('#ppa').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    load_data();
                    document.getElementById('ppa').value = "";
                   
                    $("#main3").show();
                    
                  }
                });
              });
              function showRow3(row)
              {
                var x=row.cells;
                document.getElementById("ppa").value = x[0].innerHTML;
                
                
              }
            </script>

                <!-- UACS Search -->
                <div class="col-md-3">
                    <label>UACS Object Code</label>
                    <input  required type="text"  class="form-control" style="height: 40px;" id="uacs" placeholder="UACS Code" name="uacs">
                    <table class="table table-striped table-hover" id="main2" name="main2">
                    <tbody id="result2">
                    </tbody>
                    </table>
                    
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsarouacssearch.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result2').html(data);
                    }
                  });
                }
                $('#uacs').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    // document.getElementById('uacs').value = "";
                    load_data();
          /* document.getElementById("code").value = ""; */
                    document.getElementById("uacs").value = "";
                    $("#main2").show();
                    
                    
                  }
                });
              });
              function showRow2(row)
              {
                var x=row.cells;
                document.getElementById("uacs").value = x[0].innerHTML;
                

                
                
              }
            </script>

                <div class="col-md-3">
                    <label>Amount</label>
                    <input required  type="text"  class="form-control" style="height: 40px;" id="" placeholder="Amount" name="amount">
                </div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label>Remarks</label>
                    <textarea class="form-control" placeholder="Remarks" name="remarks" style="width: 100%; height: 40px;" ></textarea> 
                </div>

                <div class="col-md-4">
                    <label>Group</label>
                    <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
                    <!-- <select class="form-control select" style="width: 100%; height: 40px;" name="sarogroup" id="sarogroup" required > -->
                    <!-- <option>Select Group</option> -->
                    <!-- <?php echo app($connect);?> -->
                    <!-- </select> -->
                    <input   type="text"  class="form-control" style="height: 40px;" id="sarogroup" placeholder="SARO Group" name="sarogroup" readonly>
                </div>
                <div class="col-md-4">
                    <label>Status</label>
                    <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
                    <select class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
                   
                    <option value = "Obligated">Obligated</option>
                    <option value = "Pending">Pending</option>
                    <!-- <option>Select Status</option> -->

                    
                    </select>
                </div>
            </div>
            <!-- END SARO -->
            <br>
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width: %;" class="btn btn-success">Submit</button>
    <br>
    <br>
    </div>
  </form>
    <!--End Submit -->
  </div>

    </section>
  </div>
 
</div>

<script src="dist/js/demo.js">
</script>
<!-- <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->


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


<script>
$(document).ready(function(){
  $("#result").click(function(){
    $("#main").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result1").click(function(){
    $("#main1").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result2").click(function(){
    $("#main2").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result3").click(function(){
    $("#main3").hide();
  });
});
</script>



<script>
$(document).ready(function(){
  $("#result4").click(function(){
    $("#main4").hide();
  });
});
</script>


</body>
</html>
