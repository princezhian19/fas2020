<?php 
error_reporting(0);
ini_set('display_errors', 0);

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

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
				</SCRIPT>");
		}
	}
}
?>
<form method="POST">
	<button type="submit" name="submit" onclick="randomName()">Shuffle</button>
	<br>	
	<br>	
	<input type="text" name="name">									
	<button type="submit" name="add" >Add names</button>
</form>