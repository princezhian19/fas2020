<?php 

include('db.class.php'); 
$mydb = new db();
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
if (isset($_POST['submit'])) 
{
	$id = $_GET['id'];

	$unit_cost=$_POST['unit_cost'];
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

	$query = $mydb->execute("UPDATE old_stock SET code = '$code', unit_cost = '$unit_cost', items = '$items', unit = '$unit', balanceone = '$b1', one = '$one', delivery = '$delivery', avail_balance = '$avail_balance', issue_month = '$issue_month', balancetwo = '$b2', two = '$two', sn = '$sn', current_price = '$current_price',date_updated = now() WHERE id = '$id' ");
	if ($query)	
	{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert(' Update Successful!')
			window.location.href='@stocks.php';
			</SCRIPT>");
	} else {
		echo "Error: " ;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script src="js/jquery-1.11.3-jquery.min.js"></script>


  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
			<div class="box-body">
				<div class="well">
					<div class="row">
						<form method="POST">
							<div class="col-xs-3">
								
								
							</div>
							<br>
							<br>
							<br>
							<br>
							<div class="col-xs-3">
								<!-- <label>CODE : </label> -->
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="hidden" class="form-control" style="height: 40px;" name="code" value="'.$row['code'].'" />';   
								}
								?>

								<label>ITEMS : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="text" class="form-control" style="height: 40px;" readonly name="items" value="'.$row['items'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
							<label>UNIT : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="text" class="form-control" style="height: 40px;" readonly name="unit" value="'.$row['unit'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
							<label>Stock No. : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="text" class="form-control" style="height: 40px;" readonly name="sn" value="'.$row['sn'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
							<p>&nbsp</p>
							<p>&nbsp</p>
							</div>
							<p>&nbsp</p>
							<p>&nbsp</p>
							<div class="col-xs-3">
								<label>BALANCE AS OF : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="text" class="form-control" id="datepicker1" placeholder="Enter Date" name="balanceone" style="height: 35px; width: 375px" value="'.$row['balanceone'].'"/>';   
								}
								?>
							</div>
							<div class="col-xs-3">
								<label>Quantity :</label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="one" value="'.$row['one'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
								<label>Delivery for the month : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="delivery" value="'.$row['delivery'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
								<label>Available Balance : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="avail_balance" value="'.$row['avail_balance'].'" />';   
								}
								?>
							</div>
							<p>&nbsp</p>
							<p>&nbsp</p>
							<div class="col-xs-3">
								<label>Issued for the month : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="issue_month" value="'.$row['issue_month'].'" />';   
								}
								?>
							</div>
							<div class="col-xs-3">
								<label>BALANCE AS OF : </label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="text" class="form-control" id="datepicker2" placeholder="Enter Date" name="balancetwo" style="height: 35px; width: 375px" value="'.$row['balancetwo'].'"/>';
									
								}
								?>
							</div>
							<div  class="col-xs-3">
								<label>Quantity:</label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="two" value="'.$row['two'].'" />';   
								}
								?>
							</div>
							<div  class="col-xs-3">
								<label>Current Price:</label>
								<?php
								$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
								$sq = mysqli_query($conn,"SELECT * FROM old_stock where id ='".$_GET['id']."' ");
								while ($row = mysqli_fetch_assoc($sq)) {
									echo '<input type="number" class="form-control" style="height: 40px;"  name="current_price" value="'.$row['current_price'].'" />';   
								}
								?>
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
