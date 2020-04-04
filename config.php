<?php

$host = "localhost"; /* Host name */
$user = "fascalab_2020"; /* User */
$password = "w]zYV6X9{*BN"; /* Password */
$dbname = "fascalab_2020"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}