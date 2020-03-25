<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "");
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
function fill_unit_select_box($connect)
{ 
  $output = '';
  $query = "SELECT * FROM pr GROUP BY pr_no DESC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["pr_no"].'">'.$row["pr_no"].'</option>';
  }
  return $output;
}

if (isset($_POST['submit'])) {
  $rfq_no = $_POST['rfq_no'];
  $pr_no = $_POST['pr_no'];
  $rfq_date = $_POST['rfq_date'];
  $pr_date_received = $_POST['pr_date_received'];
  $purpose = $_POST['purpose'];
  $pmo = $_POST['pmo'];
  $mode = $_POST['mode'];
  $action_officer = $_POST['action_officer'];
  $note_id = $_POST['note_id'];

  $selectRfqID = mysqli_query($conn,"SELECT * FROM rfq WHERE rfq_no = '$rfq_no'");
  // $rowID = mysqli_fetch_array($selectRfqID);
  // $rfq_idd = $rowID['id'];
  $s = "14";

  // var_dump(count($selectRfqID));
  // exit();
  if ($pr_no == '') {
    # code...
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Please Select PR No.');
      </SCRIPT>");
  }
  else{

  if (mysqli_num_rows($selectRfqID) > 0) {
    # code...
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('This RFQ No. is Already Exist!');
      </SCRIPT>");
  }else{


  for($count = 0; $count < count($_POST["pr_no"]); $count++){

   // $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,purpose,rfq_mode_id,rfq_date,pr_no,pr_received_date,action_officer)
   //  VALUES("'.$_POST['rfq_no'].'","'.$_POST['purpose'].'","'.$_POST['mode'].'","'.$_POST['rfq_date'].'","'.$_POST['pr_no'][$count].'","'.$_POST['pr_date_received'].'","'.$_POST['action_officer'].'") ');

    //   $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,rfq_mode_id,rfq_date,pr_received_date,action_officer)
    // VALUES("'.$_POST['rfq_no'].'","'.$_POST['mode'].'","'.$_POST['rfq_date'].'","'.$_POST['action_officer'].'") ');

    $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,purpose,rfq_mode_id,rfq_date,pr_no,pr_received_date,action_officer)
                  SELECT "'.$rfq_no.'",purpose,"'.$mode.'","'.$rfq_date.'",pr_no,pr_date,"'.$s.'" FROM pr WHERE pr_no = "'.$_POST['pr_no'][$count].'" ');



 }
 $selectRfqID = mysqli_query($conn,"SELECT id FROM rfq WHERE rfq_no = '$rfq_no'");
  $rowID = mysqli_fetch_array($selectRfqID);
  $rfq_idd = $rowID['id'];

 foreach ($pr_no as $prs) { 

  $selectRfqID = mysqli_query($conn,"SELECT id FROM rfq WHERE rfq_no = '$rfq_no'");
  $rowID = mysqli_fetch_array($selectRfqID);
  $rfq_idd = $rowID['id'];

  $query = mysqli_query($conn,"INSERT INTO rfq_items(rfq_id,app_id,description,qty,unit_id,abc) 
   SELECT '$rfq_idd',items,description,qty,unit,abc FROM pr_items  WHERE pr_no IN ('$prs')");

}
foreach ($note_id as $note_idd) { 

  $insert_notes = mysqli_query($conn,"INSERT INTO rfq_notes(rfq_id,note_id) VALUES ('$rfq_idd','$note_idd')");
}
  for($count = 0; $count < count($_POST["pr_no"]); $count++){

$select_pmo = mysqli_query($conn,'SELECT pmo FROM pr WHERE pr_no = "'.$_POST['pr_no'][$count].'"');
$rowPMO = mysqli_fetch_array($select_pmo);
$pmoo = $rowPMO['pmo'];
if ($pmoo == ORD) {
  $pmoo = 1;
}
if ($pmoo == LGMED) {
  $pmoo = 3;
}
if ($pmoo == LGCDD) {
  $pmoo = 4;
}
if ($pmoo == FAD) {
  $pmoo = 5;
}
if ($pmoo == LGMED-PDMU) {
  $pmoo = 6;
}
if ($pmoo == LGCDD-MBRTG) {
  $pmoo = 7;
}

$insert_pmo = mysqli_query($conn,"INSERT INTO rfq_pmo(rfq_id,pmo_id) VALUES('$rfq_idd','$pmoo')");
   
  echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successful!');
      window.location.href='../frontend/web/rfq/view?id=$rfq_idd';
      </SCRIPT>");
   // header('location: ../frontend/web/rfq/index');
   // header('location: frontend/web/rfq/view?id=$rfq_idd');
}

}

// rfq_id note_id RFQ NOTES
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate RFQ</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="/pmis/frontend/web/rfq/index" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <form method="POST">
        <div class="form-group" style="float: right;width:300px;padding-right: 20px;">
          <!-- <label>Action Officer </label>
          <select class="form-control select2" style="width: 100%;" name="action_officer">
            <option value="14">JORGE ALVIN MONTEIRO</option>
            <option value="12">CAMILLE T. RONQUILLO</option>
          </select> -->
        </div>
        <br>
        <br>
        <br>
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">

               <div class="form-group">
                <label>PR No.</label>
                <select class="form-control select2" style="width: 100%;" autocomplete="off" name="pr_no[]" multiple="multiple">
                  <?php echo fill_unit_select_box($connect); ?>
                </select>

              </div>

              <div class="form-group" hidden>
                <label>Purpose</label>
                <input class="form-control" type="text" name="purpose">
              </div>
              <div class="form-group" hidden>
                <label>Office</label>
                <select class="form-control select2" style="width: 100%;" name="pmo" >
                  <option value="">Select PMO</option>
                  <option value="1">ORD</option>
                  <option value="3">LGMED</option>
                  <option value="4">LGCDD</option>
                  <option value="5">FAD</option>
                  <option value="6">LGMED-PDMU</option>
                  <option value="7">LGCDD-MBRTG</option>
                </select>
              </div>
              <div class="form-group">
                <label>Mode of Procurement</label>
                <select class="form-control select2" style="width: 100%;" name="mode">
                  <option selected="selected">Select Mode of Procurement</option>
                  <option value="1">Small Value Procurement</option>
                  <option value="2">Shopping</option>
                  <option value="4">NP Lease of Venue</option>
                  <option value="5">Direct Contracting</option>
                  <option value="6">Agency to Agency</option>
                  <option value="7">Public Bidding</option>
                  <option value="8">Not Applicable N/A</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" hidden>
                <label>Status</label>
                <select class="form-control select2" style="width: 100%;" name="status">
                  <option>Select Status</option>
                  <option value="Draft">Draft</option>
                  <option value="For Posting">For Posting</option>
                </select>
              </div>
              <div class="form-group">

               <div class="form-group">
                <label>RFQ No.</label>
                <input class="form-control" type="text" name="rfq_no">
              </div>

              <label>RFQ Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="rfq_date">
              </div>
            </div>



            <div class="form-group" hidden>
              <label>PR Date Recieve</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="pr_date_received">
              </div>
            </div>

          </div>

        </div>
      </div>
      <div style="width: 530px;font-size: 13px;" class="well">
        <label>Note(s)</label>
        <br>
        <?php

        $selectNotes = mysqli_query($conn,"SELECT  * FROM notes");

        while ($row = mysqli_fetch_assoc($selectNotes)) {

          $note_id = $row["id"];
          $note_desc = $row["note"];
          ?>
          <input type="checkbox" checked name="note_id[]" value="<?php echo $note_id; ?>">&nbsp<b><?php echo $note_desc;?></b></input>
          <br>

        <?php } ?>
      </div>
      <!-- style="float: right;" -->
      <button type="submit" name="submit" class="btn btn-success"  onclick="return confirm('Are you sure you want to save now?');">Create</button>
    </form>
  </div>  
</div>  
</body>
</html>


