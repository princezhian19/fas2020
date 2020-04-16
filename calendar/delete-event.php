<?php
require_once "db.php";

$id = $_POST['id'];
$sqlDelete = "DELETE from events WHERE id=".$id;

mysqli_query($conn, $sqlDelete);

?>