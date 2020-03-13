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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
   <!--  <div class="panel panel-default">
 -->        <br>
        <div class="box">
          <div class="box-body">
      
            <h1 align="">Create Obligation</h1>
         <!--    <div class="box-header with-border">
     -->
        <br>
      <li class="btn btn-success"><a href="@obligation.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

      
    <!--   <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      </div> -->

      <!-- Start form -->
      <!-- <form id="fupForm" name="form1" method="post"> -->
      <form id="fupForm" name="form1" Type="GET">
     <!--  <form class="" type='GET' action="@Functions/obcreatefunction.php" > -->
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">
                      <label>ORS Serial No.</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="ors" placeholder="Enter ORS Number" name="ors" required>
                      <br>
                      <label>PO No.</label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="ponum" placeholder="Search PO Number" name="ponum" value="<?php echo isset($_GET['ponum']) ? $_GET['ponum'] : '' ?>">
                      
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
            <div class="well">
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
                     // document.getElementById("uacs").value = "";

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
                  //document.getElementById("uacs").value = x[1].innerHTML;
                  
                  
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
                    <input required  type="number"  class="form-control" style="height: 40px;" id="amount" placeholder="Amount" name="amount">
                </div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label>Remarks</label>
                    <textarea class="form-control" placeholder="Remarks" id="remarks" name="remarks" style="width: 100%; height: 40px;" ></textarea> 
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
            </div>
            <!-- END SARO -->
            <br>
           <!--  <input type="button" name="save" class="btn btn-primary" value="Save" id="butsave"> -->
              <input type="button" name="send" class="btn btn-primary" value="Add data" id="butsend">
              <input type="button" name="save" class="btn btn-primary pull-right" value="Save Data" id="butsave">
              <br>
              <br>

              <div class=""  style="overflow-x:auto;">
              <!-- Append -->
          <table id="table1" name="table1" class="table table-bordered"  style="background-color: white;border-width: medium;">
         
          <tbody>
          <tr>
        
          <th>DATE RECEIVED</th>
          <th>DATE OBLIGATED</th>
          <th>DATE RETURNED</th>
          <th>DATE RELEASED</th>
          <th>ORS NUMBER</th>
          <th>PO NUMBER</th>
          <th>PAYEE</th>
          <th>SUPPLIER</th>
          <th>PARTICULAR</th>
          <th>SARO NUMBER</th>
          <th>PPA</th>
          <th>UACS</th>
          <th>AMOUNT</th>
          <th>REMARKS</th>
          <th>GROUP</th>
          <th>STATUS</th>
          <th>ACTION</th>
         
          <tr>
          </tbody>
          </table>
          </div>



          <script>
          $(document).ready(function() {
          var id = 1; 
          /*Assigning id and class for tr and td tags for separation.*/
          $("#butsend").click(function() {
          var newid = id++; 
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
          <td width="100px" class="datereceived'+newid+'">' + $("#datepicker1").val() + '</td>\n\
          <td width="100px" class="datereprocessed'+newid+'">' + $("#datepicker2").val() + '</td>\n\
          <td width="100px" class="datereturned'+newid+'">' + $("#datepicker3").val() + '</td>\n\
          <td width="100px" class="datereleased'+newid+'">' + $("#datepicker4").val() + '</td>\n\
          <td width="100px" class="ors'+newid+'">' + $("#ors").val() + '</td>\n\
          <td width="100px" class="ponum'+newid+'">' + $("#ponum").val() + '</td>\n\
          <td width="100px" class="payee'+newid+'">' + $("#payee").val() + '</td>\n\
          <td width="100px" class="supplier'+newid+'">' + $("#supplier").val() + '</td>\n\
          <td width="100px" class="particular'+newid+'">' + $("#particular").val() + '</td>\n\
          <td width="100px" class="saronum'+newid+'">' + $("#saronum").val() + '</td>\n\
          <td width="100px" class="ppa'+newid+'">' + $("#ppa").val() + '</td>\n\
          <td width="100px" class="uacs'+newid+'">' + $("#uacs").val() + '</td>\n\
          <td width="100px" class="amount'+newid+'">' + $("#amount").val() + '</td>\n\
          <td width="100px" class="remarks'+newid+'">' + $("#remarks").val() + '</td>\n\
          <td width="100px" class="sarogroup'+newid+'">' + $("#sarogroup").val() + '</td>\n\
          <td width="100px" class="status'+newid+'">' + $("#status").val() + '</td>\n\
          <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
          });
          $("#table1").on('click', '.remCF', function() {
          $(this).parent().parent().remove();
          });
          /*crating new click event for save button*/
          $("#butsave").click(function() {
          var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/

          var datereceived = new Array();
		      var datereprocessed = new Array();
          var datereturned = new Array(); 
          var datereleased = new Array(); 
          var ors = new Array(); 
          var ponum = new Array(); 
          var payee = new Array(); 
          var supplier = new Array(); 
          var particular = new Array(); 
          var saronum = new Array(); 
          var ppa = new Array(); 
          var uacs = new Array(); 
          var amount = new Array(); 
          var remarks = new Array(); 
          var sarogroup = new Array(); 
          var status = new Array(); 
        
          for ( var i = 1; i <= lastRowId; i++) {
        // name.push($("#"+i+" .name"+i).html()); /*pushing all the names listed in the table*/
        // email.push($("#"+i+" .email"+i).html()); /*pushing all the emails listed in the table*/
         datereceived.push($("#"+i+" .datereceived"+i).html());
         datereprocessed.push($("#"+i+" .datereprocessed"+i).html()); 
         datereturned.push($("#"+i+" .datereturned"+i).html());
         datereleased.push($("#"+i+" .datereleased"+i).html()); 
         ors.push($("#"+i+" .ors"+i).html()); 
         ponum.push($("#"+i+" .ponum"+i).html()); 
         payee.push($("#"+i+" .payee"+i).html()); 
         supplier.push($("#"+i+" .supplier"+i).html()); 
         particular.push($("#"+i+" .particular"+i).html()); 
         saronum.push($("#"+i+" .saronum"+i).html()); 
         ppa.push($("#"+i+" .ppa"+i).html()); 
         uacs.push($("#"+i+" .uacs"+i).html()); 
         amount.push($("#"+i+" .amount"+i).html()); 
         remarks.push($("#"+i+" .remarks"+i).html()); 
         sarogroup.push($("#"+i+" .sarogroup"+i).html()); 
         status.push($("#"+i+" .status"+i).html()); 
		 
          }
        /*   var sendName = JSON.stringify(name); 
          var sendEmail = JSON.stringify(email); */

          var datereceived = JSON.stringify(datereceived);
          var datereprocessed = JSON.stringify(datereprocessed);
          var datereturned = JSON.stringify(datereturned);   
          var datereleased = JSON.stringify(datereleased);
          var ors = JSON.stringify(ors); 
          var ponum = JSON.stringify(ponum);
          var payee = JSON.stringify(payee);   
          var supplier = JSON.stringify(supplier);
          var particular = JSON.stringify(particular); 
          var saronum = JSON.stringify(saronum);
          var ppa = JSON.stringify(ppa);   
          var uacs = JSON.stringify(uacs);
          var amount = JSON.stringify(amount); 
          var remarks = JSON.stringify(remarks);
          var sarogroup = JSON.stringify(sarogroup);   
          var status = JSON.stringify(status);
          $.ajax({
          url: "obcreatefunction.php",
          type: "post",
          data: {datereceived : datereceived , 
            datereprocessed : datereprocessed, 
            datereturned : datereturned, 
            datereleased : datereleased, 
            ors : ors, 
            ponum : ponum, 
            payee : payee, 
            supplier : supplier, 
            particular : particular, 
            saronum : saronum, 
            ppa : ppa, 
            uacs : uacs, 
            amount : amount, 
            remarks : remarks, 
            sarogroup : sarogroup, 
            status : status},
          success : function(data){
          alert(data); /* alerts the response from php.*/
          window.location.href='/pmis/AMS/@obligation.php';
          }
          });
          });
          });
          </script>


          </div>
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    <!-- &nbsp&nbsp&nbsp<button type="submit" name="submit" class="btn btn-success">Submit</button> -->
  
    <br>
    <br>
    </div>
  </form>
    <!--End Submit -->
  </div>

    </section>
  </div>
 
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- <script>
/* AJAX */
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("enabled", "enabled");

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
    var status = $('#status').val();
		if(ors!="" ){
			$.ajax({
				url: "obcreatefunction.php",
				type: "POST",
				data: {
					datereceived: datereceived,
					datereprocessed: datereprocessed,
					datereturned: datereturned,
					datereleased: datereleased,
          ors: ors,
					ponum: ponum,
					payee: payee,
					supplier: supplier,
          particular: particular,
					saronum: saronum,
					ppa: ppa,
          uacs: uacs,
					amount: amount,
          remarks: remarks,
					sarogroup: sarogroup,
					status: status,
					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
            
						$("#butsave").removeAttr("disabled");
					//$('#fupForm').find('input:text').val('');
						$("#success").show();
					//	$('#success').html('Data added successfully!');
            alert("Data added successfully!");
           						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script> -->


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
