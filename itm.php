<?php
if(isset($_POST["item_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "root", "");
<<<<<<< HEAD
 $conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
 $conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
 // $order_id = uniqid();
 $item_quantity = $_POST['item_quantity'];
 $item_name = $_POST['item_name'];
 $dept = $_POST['dept'];
 $ris = $_POST['ris'];
 $request_by = $_POST['request_by'];
 $approved_by = $_POST['approved_by'];
 $issued_by = $_POST['issued_by'];
 $recieved_by = $_POST['recieved_by'];
 $purpose = $_POST['purpose'];
 $app_id = $_POST['app_id'];
 $rfq_id = $_POST['rfq_id'];
 $iar_id = $_POST['iar_id'];
 $remarks = $_POST['remarks'];
 $ris_no = $_POST['ris_no'];

 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {  

  $updateQ ='UPDATE iar_stock SET qty = qty - "'.$_POST["item_quantity"][$count].'" WHERE id = "'.$_POST["item_unit"][$count].'"';
  $statement = $connect->prepare($updateQ);

  $selectRIS = '';
  $statementRIS = $connect->prepare($selectRIS);
  $statementRIS->execute();

  $sql = mysqli_query($conn, 'SELECT ris_no FROM ris where ris_no = "'.$_POST["ris_no"][$count].'" ');
  $row = mysqli_fetch_array($sql);
  $RISr = $row['ris_no'];
  if ($row>0) { 
    $query2 = mysqli_query($conn,'UPDATE ris SET remarks = "'.$_POST["remarks"][$count].'", app_id = "'.$_POST["app_id"][$count].'",rfq_id = "'.$_POST["rfq_id"][$count].'",iar_id = "'.$_POST["iar_id"][$count].'",division = "'.$_POST["dept"][$count].'", ris_no = "'.$_POST["ris_no"][$count].'",po_no = "'.$_POST["po_no"][$count].'",request_by = "'.$_POST["request_by"][$count].'", approved_by = "'.$_POST["approved_by"][$count].'", issued_by = "'.$_POST["issued_by"][$count].'", recieved_by = "'.$_POST["recieved_by"][$count].'", purpose = "'.$_POST["purpose"][$count].'" WHERE ris_no =  "'.$_POST["ris_no"][$count].'" ');
  }else{
    $query2 = mysqli_query($conn,'INSERT INTO ris
      (remarks,app_id,rfq_id,iar_id,division,ris_no,po_no,request_by,approved_by,issued_by,recieved_by,purpose) 
      VALUES ("'.$_POST["remarks"][$count].'","'.$_POST["app_id"][$count].'","'.$_POST["rfq_id"][$count].'","'.$_POST["iar_id"][$count].'","'.$_POST["dept"][$count].'","'.$_POST["ris_no"][$count].'","'.$_POST["item_name"][$count].'", "'.$_POST["request_by"][$count].'", "'.$_POST["approved_by"][$count].'", "'.$_POST["issued_by"][$count].'", "'.$_POST["recieved_by"][$count].'", "'.$_POST["purpose"][$count].'")');
  }
  $updateQ2 ='UPDATE iar_stock SET qtyRIS = "'.$_POST["item_quantity"][$count].'" WHERE id = "'.$_POST["item_unit"][$count].'"';
  $statement2 = $connect->prepare($updateQ2);  

  $selectDetails = 'INSERT INTO ris_stock(rfq_id,ris_no,app_id,procurement,description,unit_id,qty,qty_original,abc,status)
  SELECT rfq_id, "'.$_POST["ris_no"][$count].'",app_id,procurement,description,unit_id,qtyRIS,qty_original,abc,1
  FROM iar_stock WHERE id = "'.$_POST["item_unit"][$count].'" ';
  $statement3 = $connect->prepare($selectDetails);  


  $statement2->execute(
   array(
    ':item_name'  => $_POST["item_name"][$count], 
    ':dept'  => $_POST["dept"][$count], 
    ':ris_no'  => $_POST["ris_no"][$count], 
    ':request_by'  => $_POST["request_by"][$count], 
    ':approved_by'  => $_POST["approved_by"][$count], 
    ':issued_by'  => $_POST["issued_by"][$count], 
    ':recieved_by'  => $_POST["recieved_by"][$count], 
    ':purpose'  => $_POST["purpose"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':item_unit'  => $_POST["item_unit"][$count]
  )
 );

  $statement->execute(
   array(
    ':item_name'  => $_POST["item_name"][$count], 
    ':dept'  => $_POST["dept"][$count], 
    ':ris_no'  => $_POST["ris_no"][$count], 
    ':request_by'  => $_POST["request_by"][$count], 
    ':approved_by'  => $_POST["approved_by"][$count], 
    ':issued_by'  => $_POST["issued_by"][$count], 
    ':recieved_by'  => $_POST["recieved_by"][$count], 
    ':purpose'  => $_POST["purpose"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':item_unit'  => $_POST["item_unit"][$count]
  )
 );
  $statement3->execute(
   array(
    ':item_name'  => $_POST["item_name"][$count], 
    ':dept'  => $_POST["dept"][$count], 
    ':ris_no'  => $_POST["ris_no"][$count], 
    ':request_by'  => $_POST["request_by"][$count], 
    ':approved_by'  => $_POST["approved_by"][$count], 
    ':issued_by'  => $_POST["issued_by"][$count], 
    ':recieved_by'  => $_POST["recieved_by"][$count], 
    ':purpose'  => $_POST["purpose"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':item_unit'  => $_POST["item_unit"][$count]
  )
 );

}
$result = $statement->fetchAll();
if(isset($result))
{
  echo 'ok';
}

}
?>