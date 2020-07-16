<?php
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$query = mysqli_query($conn,"SELECT rn.note_id,rfq.rfq_mode_id,rfq.rfq_no,rfq.quotation_date,rfq.rfq_date,rfq.pr_no,pr.purpose,pr.pr_date,mop.mode_of_proc_title FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no LEFT JOIN mode_of_proc mop on mop.id = rfq.rfq_mode_id LEFT JOIN rfq_notes rn on rn.rfq_id = rfq.id WHERE rfq.id = '$id' ");
$row = mysqli_fetch_assoc($query);
$rfq_id = $row["id"];
$note_id = $row["note_id"];
$rfq_no = $row["rfq_no"];
$rfq_date1 = $row["rfq_date"];
$rfq_date = date('m/d/Y',strtotime($rfq_date1)); 
$quotation_date1 = $row["quotation_date"]; 
$quotation_date = date('m/d/Y',strtotime($quotation_date1)); 
if ($quotation_date == '01/01/1970') {
  $quotation_date = '';
}
$pr_no = $row["pr_no"]; 
$pr_date1 = $row["pr_date"]; 
$pr_date = date('m/d/Y',strtotime($pr_date1)); 
$purpose = $row["purpose"]; 
$mode_of_proc_title = $row["mode_of_proc_title"]; 
$rfq_mode_id = $row["rfq_mode_id"]; 


if (isset($_POST['submit'])) {
  $rfq_date = $_POST['rfq_date'];
  $d1 = date('Y-m-d', strtotime($rfq_date));
  $quotation_date = $_POST['quotation_date'];
  $dd2 = date('Y-m-d', strtotime($quotation_date));
  $rfq_mode_id = $_POST['mode'];
  $note_id = $_POST['note_id'];

  // $rfq = mysqli_query($conn,"UPDATE rfq SET rfq_date = '$d1', rfq_mode_id = '$rfq_mode_id', quotation_date = '$dd2' WHERE id = $id");

  if ($note_id = '') {
      foreach ($note_id as $note_idd) { 
        $insert_notes = mysqli_query($conn,"INSERT INTO rfq_notes(rfq_id,note_id) VALUES ('$rfq_id','$note_idd')");
      }
  }
  
  if ($rfq) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successful!');
    window.location.href='UpdateRFQ.php?id=$id';
    </SCRIPT>");
 }else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    </SCRIPT>");
 }
}
?>
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbsp <b>Create RFQ</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><a href="ViewRFQ.php" style="color:white;text-decoration: none;"><i class="fa fa-fw fa-arrow-left"></i>Back</a></li>
    <br>
    <br>
    <form method="POST">
      <div class="form-group" style="float: right;width:300px;padding-right: 20px;">
      </div>
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>PR No.</label>
                <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="Search" value="<?php echo $pr_no?>" readonly>
              </div>
              <div class="form-group">
                <label>PR Date</label>
                <input readonly class="form-control" type="text"  value="<?php echo $pr_date?>">
              </div>
              <div class="form-group" >
                <label>Purpose</label>
                <input class="form-control" type="text" name="purpose" id="purpose" value="<?php echo $purpose?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label>RFQ No.</label>
              <input class="form-control" name="rfq_no" type="text" id="rfq_no" value="<?php echo $rfq_no?>">
            </div>
            <div class="form-group">
              <label>RFQ Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input  type="text" class="form-control pull-right" name="rfq_date" id="datepicker1" value="<?php echo  $rfq_date?>">
              </div>
            </div>
            <div class="form-group">
              <label>Mode of Procurement</label>
              <select class="form-control " style="width: 100%;" name="mode">
                <option value="<?php echo $rfq_mode_id ?>"><?php echo $mode_of_proc_title?></option>
                <option value="1">Small Value Procurement</option>
                <option value="2">Shopping</option>
                <option value="4">NP Lease of Venue</option>
                <option value="5">Direct Contracting</option>
                <option value="6">Agency to Agency</option>
                <option value="7">Public Bidding</option>
                <option value="8">Not Applicable N/A</option>
              </select>
            </div>
            <div class="form-group">
              <label>Quotation Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input  type="text" class="form-control pull-right" name="quotation_date" id="datepicker2" value="<?php echo $quotation_date?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="font-size: 13px;" class="well" >
        <label>Note(s)</label>
        <br>
        <?php

        $selectNotes = mysqli_query($conn,"SELECT  * FROM new_rfq_notes ");

        while ($row = mysqli_fetch_assoc($selectNotes)) {

          $note_id1 = $row["id"];
          $note_desc = $row["note"];
          ?>
          <?php if ($note_id1 == $note_id): ?>
            <input type="checkbox" checked name="note_id[]" value="<?php echo $note_id1; ?>">&nbsp<b>**<?php echo $note_desc;?></b></input>
            <?php else: ?>
              <input type="checkbox" name="note_id[]" value="<?php echo $note_id1; ?>">&nbsp<b>**<?php echo $note_desc;?></b></input>

            <?php endif ?>
            <br>

          <?php } ?>
        </div>
        <button type="submit" name="submit" class="btn btn-primary"  onclick="return confirm('Are you sure you want to save now?');">Update</button>
      </form>
    </div>  
  </div>  
</body>




