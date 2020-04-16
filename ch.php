<?php
require_once("DBController.php");
$db_handle = new DBController();


if(!empty($_POST["pr_no"])) {
  $query = "SELECT * FROM pr WHERE pr_no ='" . $_POST["pr_no"] . "'";
  $user_count = $db_handle->numRows($query);
  if($user_count>0) {
      echo "<span style= 'color:red' > PR No. is Not Available.</span>";
  }else{
      echo "<span style= 'color:green'> </span>";
  }
}
?>