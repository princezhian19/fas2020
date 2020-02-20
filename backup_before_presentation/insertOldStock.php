<?php
$connect = mysqli_connect("localhost","root","","db_dilg_pmis");
if(isset($_POST["code"],$_POST["items"], $_POST["unit"], $_POST["balanceone"], $_POST["one"], $_POST["delivery"], $_POST["avail_balance"], $_POST["issue_month"], $_POST["balancetwo"], $_POST["two"], $_POST["current_price"]))
{
 $code = mysqli_real_escape_string($connect, $_POST["code"]);
 $items = mysqli_real_escape_string($connect, $_POST["items"]);
 $unit = mysqli_real_escape_string($connect, $_POST["unit"]);
 $balanceone = mysqli_real_escape_string($connect, $_POST["balanceone"]);
 $one = mysqli_real_escape_string($connect, $_POST["one"]);
 $delivery = mysqli_real_escape_string($connect, $_POST["delivery"]);
 $avail_balance = mysqli_real_escape_string($connect, $_POST["avail_balance"]);
 $issue_month = mysqli_real_escape_string($connect, $_POST["issue_month"]);
 $balancetwo = mysqli_real_escape_string($connect, $_POST["balancetwo"]);
 $two = mysqli_real_escape_string($connect, $_POST["two"]);
 $current_price = mysqli_real_escape_string($connect, $_POST["current_price"]);
 $query = "INSERT INTO old_stock(code,items,unit,balanceone,one,delivery,avail_balance,issue_month,balancetwo,two,current_price) VALUES('$code','$items', '$unit', '$balanceone', '$one', '$delivery', '$avail_balance', '$issue_month', '$balancetwo', '$two', '$current_price')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
 else{
 	echo 'Data Error';
 }
}
?>
	<!-- 
items
unit
balanceone
one
delivery
avail_balance
issue_month
balancetwo
two
current_price
 -->
