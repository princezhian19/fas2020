<?php
/* $datetime1 = new DateTime('8:00');//start time
$datetime2 = new DateTime('10:00');//end time
$dd22 = $datetime1->diff($datetime2); */
//echo $dd22->format('%Y years %m months %d days %H hours %i minutes %s seconds');
//00 years 0 months 0 days 02 hours 0 minutes 0 seconds
/* echo '<br>'; */
/* echo $dd22->format('%h:%i'); */

$time_in = '2020-06-01 10:13:00';
$time_in1 = new DateTime($time_in);
$time_in2 = new DateTime('2020-06-01 08:00');


if($time_in1 >$time_in2){ //morning late
$datetime1 = new DateTime('2020-06-01 08:00');//start time
$datetime2=  new DateTime('2020-06-01 10:13:00');//end time
$dd22 = $datetime1->diff($datetime2);
echo $dd22->format('%h:%i');
echo "<br>";
echo $time_in;
}


?>

