<?php



if (isset($_POST['assign'])){
 
$id=$_POST["assignID"];
$now1=$_POST["nowv"];
$date = date('Y-m-d', strtotime($now1));
$user=$_POST["userv"];

$assigneddate1=$_POST["assigneddate"];
$assigneddate = date('Y-m-d', strtotime($assigneddate1));

$assignedtime1=$_POST["assignedtime"];
$assignedtime = date('H:i', strtotime($assignedtime1));

$dispatcher=$_POST["dispatcher"];
$nov=$_POST["nov"];
$av=$_POST["av"];
$ad=$_POST["ad"];
$plate=$_POST["plate"];

$av1=$_POST["av1"];
$ad1=$_POST["ad1"];
$plate1=$_POST["plate1"];

$av2=$_POST["av2"];
$ad2=$_POST["ad2"];
$plate2=$_POST["plate2"];

$vremarks=$_POST["vremarks"];

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
     

$query = mysqli_query($conn, "UPDATE vr set assigneddate='$assigneddate', assignedtime='$assignedtime',dispatcher='$dispatcher',nov='$nov',av='$av',ad='$ad',plate='$plate',av1='$av1',ad1='$ad1',plate1='$plate1',av2='$av2',ad2='$ad2',plate2='$plate2',vremarks='$vremarks' where id = '$id'");
echo "UPDATE vr set assigneddate='$assigneddate', assignedtime='$assignedtime',dispatcher='$dispatcher',nov='$nov',av='$av',ad='$ad',plate='$plate',av1='$av1',ad1='$ad1',plate1='$plate1',av2='$av2',ad2='$ad2',plate2='$plate2',vremarks='$vremarks' where id = '$id'";
exit();


/* echo "UPDATE vr set assigneddate='$assigndate', assignedtime='$assigntime',dispatcher='$dispatcher',nov='$nov',av='$av',ad='$ad',plate='$plate',vremarks='$vremarks' where id = '$id'";
exit(); */

 mysqli_close($conn);

if($query){
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Vehicle Request details assigned successfully.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>"); 
}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>");
}

}


?>