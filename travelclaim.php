
<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'travelclaim_functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
  table{
    font-family:'Cambria';
  }
  th{
    color:black;
  }
</style>
</head>
<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>Create Itenerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
        <form method="POST" >
        <div class="box-body">
            <div class="well" style = "padding:20px;">

            <center>
              <table border = 0 style = "width:80%;">
                <thead>
                  <th colspan = "2">ITENERARY</th>
                    <tr>
                      <td colspan = "2">
                        <label>Entity Name: <label style="color: Red;" >*</label> </label>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Fund Cluster: <label style="color: Red;" >*</label> </label>
                      </td>
                      <td>
                        <label>No: <label style="color: Red;" >*</label> </label>
                      </td>
                    </tr>
                </thead>
              </table>
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1">
             
              <tbody>
                  <tr>
                    <td colspan = 6>Name:</td>
                    <td colspan = 3>Date of Travel:</td>
                  </tr>
                  
                  <tr>
                    <td colspan = 6>Position:</td>
                    <td colspan = 3 rowspan = 2>Purpose of Travel:</td>
                  </tr>
                  <tr>
                    <td colspan = 6>Official Station:</td>
                  </tr>
                 
                  <tr>
                  <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>
                    Date
                  </th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Places to be visited (Destination)</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" colspan = 2>Time</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Means of Transportation</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Transportation</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Per Diem</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Others</th>
                  <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>Total Amount</th>
              </tr>
              <tr>
              
                  <th style = "background-color:#F5F5F5;text-align:center;">From</th>
                  <th style = "background-color:#F5F5F5;text-align:center;">To</th>
               
                                </tr>
                                <tr>
                                <td colspan = 9>&nbsp;</td>
                                
              </tbody>
            </table>
        
           
            
            </center>
                
 </form>

</div>  
</div>  
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>

<script>
$(document).ready(function(){
  $("#result").click(function(){
    $("#main").hide();
    $("#p").show();
  });
});
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

