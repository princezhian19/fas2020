<?php
require_once "db.php";

$id = $_POST['title'];
$sqlDelete = "DELETE from events WHERE title='".$id."'";
echo $sqlDelete;

mysqli_query($conn, $sqlDelete);

?>