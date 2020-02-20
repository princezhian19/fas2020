<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>


<!DOCTYPE html>
<html>
<head>
	<title>Asset Management System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css">

	<script src="js/jquery-1.11.3-jquery.min.js"></script> 
	<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
	<script type="text/javascript">



		$(document).ready(function(){

			load_data();

			function load_data(query)
			{
				$.ajax({
					url:"fetch.php",
					method:"POST",
					data:{query:query},
					success:function(data)
					{
						$('#result').html(data);
					}
				});
			}

			$('#search_text').keyup(function(){
				var search = $(this).val();
				if(search != '')
				{
					load_data(search);
				}
				else
				{
					load_data();
				}
			});
		});


		function showRow(row)
		{
			var x=row.cells;
			document.getElementById("id").value = x[0].innerHTML;
			document.getElementById("code").value = x[1].innerHTML;
			document.getElementById("item").value = x[2].innerHTML;
		}




	</script>



</head>
<body>
</br>
<div class="container">
	<div class="panel panel-default">

		<div class="" style="background-color: skyblue;padding:50px;color: black;"><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbspASSET MANAGET MENT SYSTEM</h2></div>
		<div class="panel-body"> 
			<ul class="nav nav-tabs">
				<li class="active"><a href="index.php"><b>ADD STOCKS</b></a></li>
				<li class=""><a href="iar.php"><b>IAR</b></a></li>
				<!-- <li class=""><a href="newPatient.php"><b>Add new patient</b></a></li> -->
				<div align="right">
					<li class="btn btn-success"><a href="http://localhost/pmis/frontend/web/" style="color:white;">Back to PMIS</a></li>

				</div>

			</ul></br>

			<div class="col-sm-6">


				<div class=".col-md-6">

					<div class="panel panel-default">

						<div class="bs-example">


							<div class="form-group">
								<div class="input-group">

									<span class="input-group-addon"><b>SEARCH : </b></span>
									<input type="text" name="search_text" id="search_text" placeholder="Search Code or Item Description" class="form-control" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover" id="main">
					<thead>
						<tr>
							<!-- <th>Option</th> -->
							<th>CODE</th>
							<th>ITEM</th>
							<!-- <th>Age</th> -->
						</tr>
					</thead>



					<tbody id="result">

					</tbody>
				</table>
				<div class="paging_link"></div>
			</div>
			<div class="col-sm-6" >
				<form class="form-horizontal" method="post">
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-primary"><a href="addOldStock.php" style="color:white;">View Details</a></li>

					<div class="form-group">
						<label hidden class="control-label col-sm-3">ID:</label>
						<div   hidden class="col-sm-9">
							<input type="text"  class="form-control" id="id" required placeholder="" name="id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">CODE : </label>
						<div class="col-sm-9">
							<input type="text" readonly class="form-control" id="code" required placeholder="" name="code" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">ITEMS : </label>
						<div class="col-sm-9"> 
							<input type="text" readonly class="form-control" id="item" required placeholder="" name="items">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">UNIT : </label>
						<div class="col-sm-9"> 
							<input type="text"  class="form-control" id="unit" required placeholder="Unit" name="unit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">BALANCE AS OF : </label>
						<div class="col-sm-9"> 
							<input type="date"  class="form-control" id="balone" required placeholder="balance" name="balanceone">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Quantity : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="Quantity" required placeholder="Quantity" name="one">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Delivery for the month : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="del" required placeholder="Delivery for the month" name="delivery">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Available Balance : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="del" required placeholder="Available Balance" name="avail_balance">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Issued for the month : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="del" required placeholder="Issued for the month" name="issue_month">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">BALANCE AS OF : </label>
						<div class="col-sm-9"> 
							<input type="date"  class="form-control" id="baltwo" required placeholder="balance" name="balancetwo">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Quantity : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="Quantity2" required placeholder="Quantity" name="two">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Current Price : </label>
						<div class="col-sm-9"> 
							<input type="number"  class="form-control" id="Current Price" required placeholder="Current Price" name="current_price">
						</div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary" name="submit">Confirm</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
		if (isset($_POST['submit'])) 
		{
			$code=$_POST['code'];
			$items=$_POST['items'];
			$unit=$_POST['unit'];
			$balanceone=$_POST['balanceone'];
			$one=$_POST['one'];
			$delivery=$_POST['delivery'];
			$avail_balance=$_POST['avail_balance'];
			$issue_month=$_POST['issue_month'];
			$balancetwo=$_POST['balancetwo'];
			$two=$_POST['two'];
			$current_price=$_POST['current_price'];

			$id=$_POST['id'];

			$query = $mydb->execute('INSERT INTO old_stock (code,items,unit,balanceone,one,delivery,avail_balance,issue_month,balancetwo,two,current_price) 
				VALUES ("'.$code.'","'.$items.'","'.$unit.'","'.$balanceone.'","'.$one.'","'.$delivery.'","'.$avail_balance.'","'.$issue_month.'","'.$balancetwo.'","'.$two.'","'.$current_price.'")');
			if (!empty($query))	
			{
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Successful!')
					window.location.href='index.php';
					</SCRIPT>");
			} else {
				echo "Error: " ;
			}
		}   
		?>
		<div class="panel-footer"></div>
	</div>
</div>

</body>
</html>