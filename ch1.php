<?php 
// Establish database connection 
include("DBController.php");

// code user Email availablity
if(!empty($_POST["employee_number"])) {
	$employee_number= $_POST["employee_number"];
		$sql ="SELECT EMP_NUMBER FROM tblemployee WHERE EMP_NUMBER=:employee_number";
$query= $dbh -> prepare($sql);
$query-> bindParam(':employee_number', $employee_number, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;	
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Employee Number is Already Exist! </span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	// echo "<span style='color:green'> Employee Number is Available .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}

if(!empty($_POST["username"])) {
	$username= $_POST["username"];
		$sql ="SELECT UNAME FROM tblemployee WHERE UNAME=:username";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;	
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Username is Already Exist! </span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	// echo "<span style='color:green'> Employee Number is Available .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>