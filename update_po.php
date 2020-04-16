<?php
require_once('functions.php'); 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$po_noD = $_GET['po_no'];
$po_dateD1 = $_GET['po_date'];
$noa_dateD1 = $_GET['noa_date'];
$ntp_dateD1 = $_GET['ntp_date'];
$remarksD = $_GET['remarks'];
$supplier_title = $_GET['supplier_title'];
$po_amount = $_GET['po_amount'];
$rfq_no = $_GET['rfq_no'];


$po_dateD = date('Y-m-d',strtotime($po_dateD1));
$ntp_dateD = date('Y-m-d',strtotime($ntp_dateD1));
$noa_dateD = date('Y-m-d',strtotime($noa_dateD1));



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

$insertPO = mysqli_query($conn,"UPDATE po SET po_date = '$po_date1', noa_date = '$noa_date1', ntp_date = '$ntp_date1', remarks = '$remarks1' WHERE id = $po_idsel");
if($insertPO){
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Successful!');
  window.location.href='UpdatePo.php?rfq_id=$rfq_id&supplier_id=$supplier_id&po_no=$po_no&po_date=$po_date&noa_date=$noa_date&ntp_date=$ntp_date&remarks=$remarks&supplier_title=$supplsupplier_titleier_id&po_amount=$po_amount&rfq_no=$rfq_no';
  </SCRIPT>");
}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Error Occured!');
  </SCRIPT>");
}

}




?>

<!DOCTYPE html>
<html>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspUpdate PO</h1>
      <div class="box-header with-border">
      </div>
      <form method="POST" autocomplete="off" >
        <div class="box-body">
          <div class="">
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                    <label>PO No. :  </label>
                    <input disabled type="text" name="po_no" class="form-control" value="<?php echo $po_noD;?>">
                </div>
                <div class="form-group">
                    <label>RFQ No. :  </label>
                    <input disabled class="form-control" type="text" name="rfq_no" value="<?php echo $rfq_no;?>">
                </div>
                <div class="form-group">
                    <label>Supplier : <small style="color:red;">*</small></label>
                    <select disabled class="form-control" name="supplier_id">
                        <option disabled selected value="<?php echo $supplier_id;?>"><?php echo $supplier_title;?></option>
                    </select>
                </div>

            </div>
            <div class="col-md-6">

               <div class="form-group">
                  <label>PO Date :</label>
                  <input  type="date" name="po_date" class="form-control" value="<?php echo $po_dateD;?>">
              </div>

              <div class="form-group">
                  <label>Ntp Date : <small style="color:red;">*</small></label>
                  <input type="date" name="ntp_date" class="form-control"value="<?php echo $ntp_dateD;?>">
              </div>

              <div class="form-group">
                  <label>Noa Date : <small style="color:red;">*</small></label>
                  <input type="date" name="noa_date" class="form-control"value="<?php echo $noa_dateD;?>">
              </div>

          </div>
            <div class="col-md-12">
          <label>PO Amount :</label>
          <input disabled type="text" name="po_amount" class="form-control" value="<?php echo $po_amount;?>">
            &nbsp
          </div>
          <div class="col-md-6" hidden>
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
                    <input type="checkbox" checked  name="note_id[]" value="<?php echo $id; ?>">&nbsp<b><?php echo $note;?></b></input>
                    <br>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Remarks</label>
        <textarea class="form-control" name="remarks" style="width: 970px;"><?php echo $remarksD?></textarea>
    </div>

</div>
</div>
</div>
</div>
<div style="padding:15px;">
<button class="btn btn-primary btn-s" style="float: left;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to update now?');">Update</button>
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
