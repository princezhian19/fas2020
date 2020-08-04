<?php 
error_reporting(0);
ini_set('display_errors', 0);

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$check = mysqli_query($conn,"SELECT * FROM names ");

if (isset($_POST['submit'])) {
	function randomName() {
		$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
		$select = mysqli_query($conn,"SELECT names FROM names WHERE stats IS NULL ");
		while ($row = mysqli_fetch_assoc($select)) {
			$fname[] = $row['names'];
		}
		$names = ($fname);


		return $names[rand ( 0 , count($names) -1)];


	}

	$UpdateName = randomName();
	if ($UpdateName == '') {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('No Available Name!');
			</SCRIPT>");
	# code...
	}
	$update = mysqli_query($conn,"UPDATE names SET stats = 1 WHERE names = '$UpdateName'");
	if ($update) {
		echo $UpdateName;
	}
}

if (isset($_POST['add'])) {

	$names = $_POST['name'];
	$check = mysqli_query($conn,"SELECT * FROM names WHERE names = '$names' ");
	if (mysqli_num_rows($check)>0) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Duplicated Name!');
			</SCRIPT>");
	}else{
		$insert = mysqli_query($conn,"INSERT INTO names(names) VALUES('$names') ");
		if ($insert) {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Successfuly Saved!');
      			window.location.href='raffle.php';
				</SCRIPT>");
		}
	}
}

if (isset($_POST['res'])) {

	$check = mysqli_query($conn,"SELECT * FROM names ");
	if (mysqli_num_rows($check)>0) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Please Insert Atleast 1 Data First!');
			</SCRIPT>");
	}
	$insert = mysqli_query($conn,"UPDATE names SET stats = NULL ");
	if ($insert) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('You can now raffle again!');
      		window.location.href='raffle.php';
			</SCRIPT>");
	}
}
?>
<form method="POST">
	<button type="submit" name="submit" onclick="randomName()">Shuffle</button>
	<br>	
	<br>	
	<input type="text" name="name">									
	<button type="submit" name="add" >Add names</button>
	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	
	<?php if (mysqli_num_rows($check)>0): ?>
	<button type="submit" name="res" >Shuffle again?</button>
	<?php endif ?>
</form>