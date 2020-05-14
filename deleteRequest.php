<?php
require_once "calendar/db.php";

$id = $_POST['control_no'];
$sqlDelete = "DELETE from  tbltechnical_assistance WHERE CONTROL_NO='".$id."'";
echo $sqlDelete;

mysqli_query($conn, $sqlDelete);

?>