<?php 
$id = $_GET['id'];
$app_id = $_GET['app_id'];
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$delete2 = mysqli_query($conn,"DELETE FROM estimated_budget WHERE app_id = '$id' ");
$delete = mysqli_query($conn,"DELETE FROM app_items WHERE id = '$id' ");

if ($delete) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Deleted!');
      window.location.href = 'UpdateAPP.php?id=$app_id';
      </SCRIPT>");
}else{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!');
      </SCRIPT>");
}
?>