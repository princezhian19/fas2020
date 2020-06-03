<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
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
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-wid, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


    <!-- Auto Complete -->
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
  <?php include('test1.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
       
        <li class="active">Budget</li>
      
        <li class="active">Create SARO/SUB-ARO</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspCreate SARO/SUB-ARO</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-success"><a href="saro.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <!-- Start form -->
  <!-- <form class="" type='GET' action="@Functions/sarocreatefunction.php" > -->
  <form id="fupForm" name="form1" Type="GET">
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">

                <label>Date</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="date">
                    </div>
                    <br>
                    <label>Source No. <label style="color: Red;" >*</label></label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="saronumber" placeholder="Enter Source" name="saronumber">
                      <br>
                      <label>PPA</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="ppa" placeholder="Enter PPA" name="ppa">
                    <br>
                    
                </div>    
                
                <div class="col-md-6">
                    
                    <label>Fund</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="fund" placeholder="Enter Fund" name="fund">
                    <br>
                    <label>Legal Basis</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="legalbasis" placeholder="Enter Legal Basis" name="legalbasis">
                    <br>
                  
                    <label>Particulars</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="particulars" placeholder="Enter Particulars" name="particulars">
                    <br>
                     
                    
                </div>
            </div>
        </div>
        <div class="well">
        <div class="class">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                    <label>Expense Class</label>
                    <select  requried class="form-control" style="width: 100%; height: 40px;" name="expenseclass" id="expenseclass"  >
                    <option selected disabled> Please Select </option>
                    <option value = "PS">Personnel Service</option>
                    <option value = "MOOE">Maintenance and Other Operating Expenses</option>
                    <option value = "FE">Financial Expenses</option>
                    <option value = "CO">Capital Outlay</option>
                    </select>
                    
                  <!--   <input  type="text"   class="form-control" style="height: 35px;" id="expenseclass" placeholder="Enter Expense Class" name="expenseclass"> -->
                    <br>
                </div>
                <div class="col-md-6">
              
                    
                    <label>UACS</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="uacs" placeholder="Enter UACS" name="uacs">
                    <br>
                   
                </div>
               
            </div>
           
             
             <br>
           
            <div class="row">

            <div class="col-md-3">
                    <label>Group</label>
                    <input  type="text"  class="form-control" style="height: 40px;" id="group" placeholder="" name="group">
                   
                </div>


                <div class="col-md-3">
                    <label>Amount <label style="color: Red;" >*</label></label>
                    <input  type="number"  class="form-control" style="height: 40px;" id="amount" placeholder="Enter amount" name="amount">
                   
                </div>

              
                <div class="col-md-3">
                    <label>Disbursement</label>
                    <input  type="text" readonly  class="form-control" style="height: 40px;" id="obligated" placeholder="" name="obligated" value="0">
                    
                </div>

                <div class="col-md-3">
                    <label>Balance</label>
                    <input  type="text" readonly  class="form-control" style="height: 40px;" id="balance" placeholder="0" name="balance" value="0" >
                </div>

            
            </div>           
            <!-- END SARO -->
            <br> 
        </div>
        </div>
        <br>
           <!--  <input type="button" name="save" class="btn btn-primary" value="Save" id="butsave"> -->
              <input type="button" name="send" class="btn btn-primary pull-right" value="Add Expense Class" id="butsend">
              <br>
              <br>

              <div class=""  style="overflow-x:auto;">
              <!-- Append -->
          <table id="table1" name="table1" class="table table-bordered"  style="background-color: white;border-width: medium;">
         
          <tbody>
          <tr>
        
          <th width="">DATE</th>
          <th width="">SOURCE</th>
          <th width="">FUND</th>
          <th width="">LEGAL BASIS</th>
          <th width="">PPA</th>
          <th width="">EXPENSE CLASS</th>
          <th width="">PARTICULARS</th>
          <th width="">UACS</th>
          <th width="">AMOUNT</th>
          <th width="">DISBURSEMENT</th>
          <th width="">BALANCE</th>
          <th width="">GROUP</th>
          <th width="">ACTION</th>
          
          <tr>
          </tbody>
          </table>
              <input type="button" name="save" class="btn btn-success " value="Save Data" id="butsave">

          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          
          <script>
          $(document).ready(function() {
          var id = 1; 
          /*Assigning id and class for tr and td tags for separation.*/
          $("#butsend").click(function() {
          var newid = id++; 

          var amount = $('#amount').val();
          var saronumber = $('#saronumber').val();


          if(amount=="" || saronumber==""){
            alert("Required Fields Detected!");
          }else
          {
             /* 
          var datereceived = $('#datepicker1').val();
		      var datereprocessed = $('#datepicker2').val();
          var datereturned = $('#datepicker3').val();
          var datereleased = $('#datepicker4').val();
          var ors = $('#ors').val();
          var ponum = $('#ponum').val();
          var payee = $('#payee').val();
          var supplier = $('#supplier').val();
          var particular = $('#particular').val();
          var saronum = $('#saronum').val();
          var ppa = $('#ppa').val();
          var uacs = $('#uacs').val();
          var amount = $('#amount').val();
          var remarks = $('#remarks').val();
          var sarogroup = $('#sarogroup').val();
          var status = $('#status').val(); */

          $("#table1").append('<tr valign="top" id="'+newid+'">\n\
          <td width="100px" class="date'+newid+'">' + $("#datepicker1").val() + '</td>\n\
          <td width="100px" class="saronumber'+newid+'">' + $("#saronumber").val() + '</td>\n\
          <td width="100px" class="fund'+newid+'">' + $("#fund").val() + '</td>\n\
          <td width="100px" class="legalbasis'+newid+'">' + $("#legalbasis").val() + '</td>\n\
          <td width="100px" class="ppa'+newid+'">' + $("#ppa").val() + '</td>\n\
          <td width="100px" class="expenseclass'+newid+'">' + $("#expenseclass").val() + '</td>\n\
          <td width="100px" class="particulars'+newid+'">' + $("#particulars").val() + '</td>\n\
          <td width="100px" class="uacs'+newid+'">' + $("#uacs").val() + '</td>\n\
          <td width="100px" class="amount'+newid+'">' + $("#amount").val() + '</td>\n\
          <td width="100px" class="obligated'+newid+'">' + $("#obligated").val() + '</td>\n\
          <td width="100px" class="balance'+newid+'">' + $("#balance").val() + '</td>\n\
          <td width="100px" class="group'+newid+'">' + $("#group").val() + '</td>\n\
          <td width="100px"><a href="javascript:void(0);" class="remCF btn btn-danger btn-xs"><i class"fa fa-fw fa-trash-o"></i>Remove</a></td>\n\ </tr>');
          }

          }
         );
          $("#table1").on('click', '.remCF', function() {
          $(this).parent().parent().remove();
          });
          /*crating new click event for save button*/
          $("#butsave").click(function() {
          var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/

          var date = new Array();
		      var saronumber = new Array();
          var fund = new Array(); 
          var legalbasis = new Array(); 
          var ppa = new Array(); 
          var expenseclass = new Array(); 
          var particulars = new Array(); 
          var uacs = new Array(); 
          var amount = new Array(); 
          var obligated = new Array(); 
          var balance = new Array(); 
          var group = new Array(); 
       
        
          for ( var i = 1; i <= lastRowId; i++) {
        // name.push($("#"+i+" .name"+i).html()); /*pushing all the names listed in the table*/
        // email.push($("#"+i+" .email"+i).html()); /*pushing all the emails listed in the table*/
        date.push($("#"+i+" .date"+i).html());
        saronumber.push($("#"+i+" .saronumber"+i).html()); 
        fund.push($("#"+i+" .fund"+i).html());
        legalbasis.push($("#"+i+" .legalbasis"+i).html()); 
        ppa.push($("#"+i+" .ppa"+i).html()); 
        expenseclass.push($("#"+i+" .expenseclass"+i).html()); 
        particulars.push($("#"+i+" .particulars"+i).html()); 
        uacs.push($("#"+i+" .uacs"+i).html()); 
        amount.push($("#"+i+" .amount"+i).html()); 
        obligated.push($("#"+i+" .obligated"+i).html()); 
        balance.push($("#"+i+" .balance"+i).html()); 
        group.push($("#"+i+" .group"+i).html()); 
        
          }
        /*   var sendName = JSON.stringify(name); 
          var sendEmail = JSON.stringify(email); */

          var date = JSON.stringify(date);
          var saronumber = JSON.stringify(saronumber);
          var fund = JSON.stringify(fund);   
          var legalbasis = JSON.stringify(legalbasis);
          var ppa = JSON.stringify(ppa); 
          var expenseclass = JSON.stringify(expenseclass);
          var particulars = JSON.stringify(particulars);  
          var uacs = JSON.stringify(uacs);  
          var amount = JSON.stringify(amount);
          var obligated = JSON.stringify(obligated); 
          var balance = JSON.stringify(balance);
          var group = JSON.stringify(group);   
        
          $.ajax({
          url: "sarocreatefunction.php",
          type: "post",
          data: {date : date, 
            saronumber : saronumber, 
            fund : fund, 
            legalbasis : legalbasis, 
            ppa : ppa, 
            expenseclass : expenseclass, 
            particulars : particulars, 
            uacs : uacs, 
            amount : amount, 
            obligated : obligated, 
            balance : balance, 
            group : group
           },
          success : function(data){
          alert(data); /* alerts the response from php.*/
          window.location.href='saro.php';
          }
          });
          });
          });
          </script>



        
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>

    
   <!--  &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-success">Create</button> -->
    <br>
    <br>
    </div>
  </form>
    <!--End Submit -->
  </div>
  <footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
    </footer>
    <br>
    </section>
  </div>
 
</div>


<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>



<script>
$(document).ready(function(){
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
});
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
