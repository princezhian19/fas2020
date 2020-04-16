<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css">

	<script src="js/jquery-1.11.3-jquery.min.js"></script> 
	<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
	

	<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <script type="text/javascript">
		$(document).ready(function(){


			function load_data(query)
			{
				$.ajax({
					url:"fetchStocks.php",
					method:"POST",
					data:{query:query},
					success:function(data)
					{
						$('#result').html(data);
					}
				});
			}

			$('#sn').keyup(function(){
				var search = $(this).val();
				if(search != '')
				{
					load_data(search);
				}
				else
				{
					load_data();
					/* document.getElementById("code").value = ""; */
					document.getElementById("items").value = "";
					document.getElementById("t1").value="";

					/* var tr = $('#t1');
                	el = tr.find('label:contains('+val+')').closest('td1')
                	tr.not(el).fadeOut();
                	el.fadeIn(); */
					/* document.getElementById("sn").value = ""; */

				}
			});
		});


		function showRow(row)
		{
			var x=row.cells;
			// /document.getElementById("id").value = x[0].innerHTML;
			//document.getElementById("code").value = x[0].innerHTML;
			document.getElementById("items").value = x[1].innerHTML;
			document.getElementById("sn").value = x[2].innerHTML;
		}




	</script>



</head>
<body style="background: lightgray;">
	<div class="">
		<div class="panel panel-default">
			<br>
			
			<h1 align="">&nbspUpdate Stocks</h1>
			<div class="box-header with-border">
			</div>
			<br>
			&nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="@stocks.php" style="color:white;text-decoration: none;">Back</a></li>
			<br>
			<br>
			<div class="col-xs-6">
				<!-- <label>Search Code/Items : </label>
				<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Code" class="" /> -->
				<br>
			</div>
			
			<div class="box-body">
				<div class="well">
					<div class="row">
						<form method="POST">
							<div hidden>
								<input  type="text"  class="form-control" id="id"  placeholder="" name="id">
							</div>

							<div class="col-xs-3">
							<label>STOCK NO. : </label>
								<input  type="text" class="form-control" style="height: px;" id="sn" placeholder="" name="sn">
								<table class="table table-striped table-hover" id="t1" name="t1">
								<tbody align="center" id="result">
								</tbody>
								</table>
							</div>
							<div class="col-xs-3">
								<label>ITEMS : </label>
								<input  type="text" class="form-control" style="height: 40px;" id="items" placeholder="" name="items">
							</div>
							<div class="col-xs-3">
								<label>UNIT : </label>
								<input  type="text" class="form-control" style="height: 40px;" id="unit" placeholder="" name="unit">
							</div>
							<div class="col-xs-3">
							<p>&nbsp</p>
							<p>&nbsp</p>	
							</div>
							<p>&nbsp</p>
							<p>&nbsp</p>
							<div class="col-xs-3">
								<label>BALANCE AS OF : </label>
								<br>
								<input type="text" class="" id="datepicker1" placeholder='Enter Date' name="balanceone" style="height: 35px; width: 375px">
							</div>
							<div class="col-xs-3">
								<label>Quantity :</label>
								<input type="number" class="form-control" style="height: 40px;" id="one" placeholder="" name="one">
							</div>
							<div class="col-xs-3">
								<label>Delivery for the month : </label>
								<input type="number" class="form-control" style="height: 40px;" id="delivery" placeholder="" name="delivery">
							</div>
							<div class="col-xs-3">
								<label>Available Balance : </label>
								<input type="number" class="form-control" style="height: 40px;" id="avail_balance" placeholder="" name="avail_balance">
							</div>
							<p>&nbsp</p>
							<p>&nbsp</p>
							<div class="col-xs-3">
								<label>Issued for the month : </label>
								<input type="number" class="form-control" style="height: 40px;" id="issue_month" placeholder="" name="issue_month">
							</div>
							<div class="col-xs-3">
							<label>BALANCE AS OF : </label>
								<br>
								<input type="text" class="" id="datepicker2" placeholder='Enter Date' name="balancetwo" style="height: 35px; width: 375px">
							</div>
							<div  class="col-xs-3">
								<label>Quantity:</label>
								<input type="number" class="form-control" id="two"  name="two">
							</div>
							<div  class="col-xs-3">
								<label>Current Price:</label>
								<input type="number" class="form-control" id="current_price"  name="current_price">
							</div>
						</div>
					</div>
				</div>
				
				<div style="padding: 20px;">
					<button type="submit" name="submit"  class="btn btn-primary">Submit</button>
				</div>


			</form>
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

<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

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
<?php
include('db.class.php'); 
$mydb = new db();
if (isset($_POST['submit'])) 
{
	$code=$_POST['code'];
	$items=$_POST['items'];
	$unit=$_POST['unit'];
	$balanceone=$_POST['balanceone'];
	$b1 = date('Y-m-d', strtotime($balanceone)); 
	$one=$_POST['one'];
	$delivery=$_POST['delivery'];
	$avail_balance=$_POST['avail_balance'];
	$issue_month=$_POST['issue_month'];
	$balancetwo=$_POST['balancetwo'];
	$b2 = date('Y-m-d', strtotime($balancetwo));
	$two=$_POST['two'];
	$sn=$_POST['sn'];
	$current_price=$_POST['current_price'];

	$id=$_POST['id'];

	$query = $mydb->execute('INSERT INTO old_stock (code,items,sn,unit,balanceone,one,delivery,avail_balance,issue_month,balancetwo,two,current_price) 
		VALUES ("'.$code.'","'.$items.'","'.$sn.'","'.$unit.'","'.$b1.'","'.$one.'","'.$delivery.'","'.$avail_balance.'","'.$issue_month.'","'.$b2.'","'.$two.'","'.$current_price.'")');
	if (!empty($query))	
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Successful!')
			window.location.href='ViewStocks.php';
			</SCRIPT>");
	} else {
		echo "Error: " ;
	}
}   
?>



