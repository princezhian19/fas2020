<?php
require_once "connection.php";

$id  = $_POST['id'];



$sqlUpdate = "DELETE FROM `supplier` WHERE id=".$id;
echo $sqlUpdate;
if (mysqli_query($conn, $sqlUpdate)) {
} else {
}
?>
