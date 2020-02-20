<?php
require_once("DBController.php");
$db_handle = new DBController();


if(!empty($_POST["rfq_no"])) {
  $query = "SELECT * FROM rfq WHERE rfq_no ='" . $_POST["rfq_no"] . "'";
  $user_count = $db_handle->numRows($query);
  if($user_count>0) {
      echo "<span style= 'color:red' > RFQ No. is Not Available.</span>";
  }else{
      echo "<span style= 'color:green'> </span>";
  }
}
?>