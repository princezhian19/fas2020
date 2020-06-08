<?php
date_default_timezone_set('Asia/Manila');
$timeNow = (new DateTime('now'))->format('F d, Y H:i:s');
//Replace now() Variable
echo $timeNow;

?>