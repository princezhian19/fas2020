<?php 
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];

$query = mysqli_query($conn,"UPDATE pr SET submitted_date = now() WHERE id = $id ");

if ($query) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Submitted!')
    window.location.href = 'ViewPR1.php';
    </SCRIPT>");
}else{
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!')
    window.location.href = 'ViewPR1.php';
    </SCRIPT>");
}


?>