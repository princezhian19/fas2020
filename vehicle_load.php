<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');

$data = array();

$query = "SELECT * FROM vr ORDER BY id asc" ;

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["purpose"],
  'assigneddate'   => $row["assigneddate"],
  'assignedtime'   => $row["assignedtime"],
  'dispatcher'   => $row["dispatcher"],
  'nov'   => $row["nov"],
  'ad'   => $row["ad"],
  'av'   => $row["av"],
  
  'plate'   => $row["plate"],
  'vremarks'   => $row["vremarks"],

  'start'   => $row["assigneddate"],
  'end'   => $row["assigneddateend"]
 );
}

echo json_encode($data);

?>