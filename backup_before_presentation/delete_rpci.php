<?php 
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$delete = mysqli_query($conn,"DELETE FROM rpci WHERE id = '$id' ");
if ($delete) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Deleted!')
      window.location.href = 'ViewRPCI.php';
      </SCRIPT>");
}else{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!');
      </SCRIPT>");
}
?>