<?php
include 'connection.php';

$rfq_id = $_GET['rfq_id'];
$abstract_no = $_GET['abstract_no'];
$pr_no = $_GET['pr_no'];

$sql = mysqli_query($conn, "SELECT rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rfq_id = '$rfq_id' ");
$row = mysqli_fetch_array($sql);
$rid = $row['id'];
$procurement = $row['procurement'];
$description = $row['description'];
$qty = $row['qty'];
$abc = $row['abc'];
$item_unit_title = $row['item_unit_title'];

$all_selected_suppliers1 = mysqli_query($conn, "SELECT count(*) as 'count_supplier', s.id,rq.rfq_id,sq.id,s.id as sid,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  ");
$count_supplier = '';
while ($allS = mysqli_fetch_assoc($all_selected_suppliers1)) {
  $Asupplier[] = $allS['sid'];
  $count_supplier = $allS['count_supplier'];
}

if($count_supplier >= 3)
{
header('Location: export_abstract2.php?rfq_id='.$rfq_id.'&abstract_no='.$abstract_no.'&pr_no='.$pr_no.'');
}else{
    header('Location: export_abstract.php?rfq_id='.$rfq_id.'&abstract_no='.$abstract_no.'&pr_no='.$pr_no.'');

}
?>