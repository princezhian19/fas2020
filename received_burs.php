<?php
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT burs_id FROM saroob WHERE id = '$id '");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];

$query = mysqli_query($conn,"UPDATE saroob SET datereceived = now() WHERE id = '$id'");
if ($query) {
$update = mysqli_query($conn,"UPDATE burs SET status = 2, date_received = now() WHERE id = '$burs_id'");
if ($update) {
	# code...
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = '@obligation.php';
    </SCRIPT>");
}
 
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = '@obligation.php';
  </SCRIPT>");
}

?>