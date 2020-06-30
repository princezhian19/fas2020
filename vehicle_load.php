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

  'ad1'   => $row["ad1"],
  'av1'   => $row["av1"],
  'plate1'   => $row["plate1"],

  'ad2'   => $row["ad2"],
  'av2'   => $row["av2"],
  'plate2'   => $row["plate2"],

  'vremarks'   => $row["vremarks"],

  'start'   => $row["assigneddate"],
  'end'   => $row["assigneddateend"]
 );
}

echo json_encode($data);

?>