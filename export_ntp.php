<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_ntp.xlsx");
$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$supplier_id = $_GET['supplier_id'];
$po_id = $_GET['po_id'];

$sql = mysqli_query($conn, "SELECT * FROM po WHERE id = $po_id ");
$row = mysqli_fetch_array($sql);
$po_date1 = $row['po_date'];
$po_date = date('F d, Y',strtotime($po_date1));

$sql2 = mysqli_query($conn, "SELECT supplier_title,supplier_address,contact_person FROM supplier WHERE id = $supplier_id ");
$row2 = mysqli_fetch_array($sql2);
$supplier_title = $row2['supplier_title'];
$supplier_address = $row2['supplier_address'];
$contact_person = $row2['contact_person'];

$sql3 = mysqli_query($conn, "SELECT pr.purpose,pr.pmo,pr.type FROM pr LEFT JOIN rfq on rfq.pr_no = pr.pr_no WHERE rfq.id = $rfq_id ");
$row3 = mysqli_fetch_array($sql3);
$purpose = $row3['purpose'];
$pmo = $row3['pmo'];
$type = $row3['type'];

if ($type == 1) {
  $type = 'Catering Services';
}
if ($type == 2) {
  $type = 'Meals, Venue and Accommodation';
}
if ($type == 3) {
  $type = 'Repair and Maintenance';
}
if ($type == 4) {
  $type = 'Supplies, Materials and Devices';
}
if ($type == 5) {
  $type = 'Other Services';
}
if ($type == 6) {
  $type = 'Reimbursement and Petty Cash';
}


$select_rfqitems = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while ($rfqitems = mysqli_fetch_assoc($select_rfqitems)) {
  $rfq_items_id_abc[] = $rfqitems['id'];
}
$implode = implode(',', $rfq_items_id_abc);

$view_query = mysqli_query($conn, "SELECT sum(sq.ppu*rq.qty) as totalABC,rq.total_amount as abc,iu.item_unit_title,rq.qty,app.procurement,sq.ppu,sq.remarks FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN supplier_quote sq on sq.rfq_item_id = rq.id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rq.id in($implode) AND sq.supplier_id = $supplier_id ");
$rowtots = mysqli_fetch_array($view_query);
$totalABC = $rowtots['totalABC'];

$objPHPExcel->getActiveSheet()->getStyle('A13')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A15')->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A13',$po_date);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A15',$contact_person);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A16',$supplier_title);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A43',"                                    ".$contact_person);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A17',$supplier_address);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A20','Dear Mr./Ms. '.$contact_person);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A23',$supplier_title.' that the Procurement of '.$type.' for the '.$purpose.' shall commence upon receipt of the Notice to Proceed. ');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C37',$designation);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_ntp.xlsx');

?>