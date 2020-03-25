<?php
require_once('functions.php'); 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$select_ = mysqli_query($conn,"SELECT rfq.rfq_no,s.id,s.supplier_title FROM abstract_of_quote abs LEFT JOIN rfq on rfq.id = abs.rfq_id LEFT JOIN supplier s on s.id = abs.supplier_id LEFT JOIN rfq_items rq on rq.rfq_id = abs.rfq_id WHERE abs.rfq_id = $rfq_id AND abs.abstract_no IS NOT NULL");
$row_ = mysqli_fetch_array($select_);
$rfq_no = $row_['rfq_no'];
$supplier_title = $row_['supplier_title'];
$supplier_id = $row_['id'];

$selectPPU = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while($rowP = mysqli_fetch_array($selectPPU)){
$ritems[] = $rowP['id'];
}

$implode = implode(',', $ritems);

$select_tots = mysqli_query($conn,"SELECT sum(ppu*qty) as ABCtots FROM supplier_quote sq LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE rfq_item_id in($implode) AND supplier_id = $supplier_id");
while($row_tots = mysqli_fetch_array($select_tots)){
$POamount = $row_tots['ABCtots'];
}
?>
<?php 
if (isset($_POST['submit'])) {
$po_no1 = $_POST['po_no'];
$rfq_no1 = $_POST['rfq_no'];
$supplier_id1 = $_POST['supplier_id'];
$po_date1 = $_POST['po_date'];
$ntp_date1 = $_POST['ntp_date'];
$noa_date1 = $_POST['noa_date'];
$po_amount1 = $_POST['po_amount'];
$remarks1 = $_POST['remarks'];

$insertPO = mysqli_query($conn,"INSERT INTO po(po_no,po_date,noa_date,ntp_date,po_amount,remarks) VALUES('$po_no1','$po_date1','$noa_date1','$ntp_date1','$po_amount1','$remarks1')");

$select_aoqID = mysqli_query($conn,"SELECT abstract_no FROM abstract_of_quote WHERE rfq_id = $rfq_id and supplier_id = $supplier_id");
$absno = mysqli_fetch_array($select_aoqID);
$aoq_id = $absno['abstract_no'];

$selectDescPO = mysqli_query($conn,"SELECT id FROM po ORDER BY id DESC LIMIT 1");
$rowlastid = mysqli_fetch_array($selectDescPO);
$rowrecentid = $rowlastid['id'];

$updateSquote = mysqli_query($conn,"UPDATE selected_quote SET po_id = $rowrecentid WHERE rfq_id = $rfq_id AND aoq_id = $aoq_id");

foreach ($_POST['note_id'] as $notas) {

$insert_nota = mysqli_query($conn,"INSERT INTO po_checklist(po_id,checklist_id) VALUES($rowrecentid,$notas)");

}


echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Successful!');
window.location.href='ViewPO.php?rfq_id=$rfq_id&supplier_id=$supplier_id';
</SCRIPT>");

}

$idGet='';
$getDate = date('Y');
$m = date('m');
$auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM po order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {
  $idGet = $row["a"];
}
$autoNo = $getDate.'-'.$m.'-'.'0'.$idGet;


?>

<!DOCTYPE html>
<html>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate ORS/BURS</h1>
      <div class="box-header with-border">
      </div>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
          <div class="">
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                    <label>PO No. :  </label>
                    <input required type="text" name="po_no" class="form-control" value = '<?php echo $autoNo;?>'>
                </div>
                <div class="form-group">
                    <label>RFQ No. :  </label>
                    <input required class="form-control" type="text" name="rfq_no" value="<?php echo $rfq_no;?>">
                </div>
                <div class="form-group">
                    <label>Supplier : <small style="color:red;">*</small></label>
                    <select class="form-control" name="supplier_id">
                        <option selected value="<?php echo $supplier_id;?>"><?php echo $supplier_title;?></option>
                    </select>
                </div>

            </div>
            <div class="col-md-6">

               <div class="form-group">
                  <label>PO Date :</label>
                  <input  type="date" name="po_date" class="form-control">
              </div>

              <div class="form-group">
                  <label>Ntp Date : <small style="color:red;">*</small></label>
                  <input type="date" name="ntp_date" class="form-control">
              </div>

              <div class="form-group">
                  <label>Noa Date : <small style="color:red;">*</small></label>
                  <input type="date" name="noa_date" class="form-control">
              </div>

          </div>
            <div class="col-md-12">
          <label>PO Amount :</label>
          <input required type="text" name="po_amount" class="form-control" value="<?php echo $POamount;?>">
            &nbsp
          </div>
          <div class="col-md-6">
           <div class="form-group">
              <div style="font-size: 13px;" class="well" >
                <label>Check List(s)</label>
                <br>
                <?php 
                $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $select = mysqli_query($conn,"SELECT * FROM checklist");
                while ($rowC = mysqli_fetch_assoc($select)) {
                    $id = $rowC['id'];
                    $note = $rowC['note'];
                    ?>
                    <input type="checkbox" checked name="note_id[]" value="<?php echo $id; ?>">&nbsp<b><?php echo $note;?></b></input>
                    <br>

                <?php } ?>
            </div>
        </div>

    </div>
    <div class="col-md-6">

      <div class="form-group">
        <label>Remarks</label>
        <textarea class="form-control" name="remarks"></textarea>
    </div>

</div>
</div>
</div>
</div>
<div style="padding:15px;">
<button class="btn btn-success btn-s" style="float: left;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>
</div>
<br>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>
