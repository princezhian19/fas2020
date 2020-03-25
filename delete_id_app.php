<?php 
$id = $_GET['id'];
$app_id = $_GET['app_id'];
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
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