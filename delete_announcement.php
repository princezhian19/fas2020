<?php 
$id = $_GET['id'];
$username = $_GET['username'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$delete = mysqli_query($conn,"DELETE FROM announcement WHERE id = $id");

if ($activate) {
	if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Deleted!');
    window.location.href='home.php';
    </SCRIPT>");
	}else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Deleted!');
    window.location.href='home1.php';
    </SCRIPT>");
	}
   
}else{
 if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='home.php';
    </SCRIPT>");
	}else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='home1.php';
    </SCRIPT>");
	}
}
?>