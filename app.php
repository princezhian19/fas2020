<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "root", "");
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
include('functions.php');
function app($connect)
{ 
  $output = '';
  $query = "SELECT id,item_category_title FROM `item_category` ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["item_category_title"].'</option>';
  }
  return $output;
}

 $idGet='';

$auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM app order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {

  $idGet = $row["a"];
}

if (isset($_POST['submit'])) {
  $sn = $_POST['sn'];
  $code = $_POST['code'];
  $item = $_POST['item'];
  $fund = $_POST['fund'];
  $remarks = $_POST['remarks'];
  $category = $_POST['category'];
  $pmo = $_POST['pmo'];
  $qty = $_POST['qty'];
  $mode = $_POST['mode'];
  $price = $_POST['price'];
  $app_price = $_POST['app_price'];
  $mooe = $_POST['mooe'];
  $co = $_POST['co'];
  $budget = $_POST['budget'];
  $unit_id = $_POST['unit'];

  $year = date("Y");

 
  
  $check = mysqli_query($conn,"SELECT sn FROM pr WHERE sn = '$sn' ");

  if (mysqli_num_rows($check)>0) {
    echo "<div style='background-color:lightblue;color:red;'> <p> <b>Stock Number is already existing</b> <p> <div>";
  }else{

   for($count = 0; $count < count($_POST["pmo"]); $count++) {
     $insert_app_items = mysqli_query($conn,'INSERT INTO app_items(sn,code,new_entry,merge_code,procurement,unit_id,source_of_funds_id,category_id,pmo_id,qty,qty_original,mode_of_proc_id,price,app_price,remarks,app_year)
      VALUES("'.$sn.'","'.$code.'","1","'.$code.'","'.$item.'","'.$unit_id.'","'.$fund.'","'.$category.'","'.$_POST['pmo'][$count].'","'.$_POST['qty'][$count].'","'.$_POST['qty'][$count].'","'.$mode.'","'.$price.'","'.$app_price.'","'.$remarks.'","'.$year.'")');
  }
 
  
  $select_app = mysqli_query($conn,"SELECT * FROM app_items ORDER BY id DESC LIMIT 1");
  $rowID = mysqli_fetch_array($select_app);
  $sn0 = $rowID['sn'];
  $code0 = $rowID['code'];
  $procurement0 = $rowID['procurement'];
  $source_of_funds_id0 = $rowID['source_of_funds_id'];
  $category_id0 = $rowID['category_id'];
  $pmo_id0 = $rowID['pmo_id'];
  $qty0 = $rowID['qty'];
  $mode_of_proc_id0 = $rowID['mode_of_proc_id'];
  $price0 = $rowID['price'];
  $app_price0 = $rowID['app_price'];
  $remarks0 = $rowID['remarks'];
  $unit_id0 = $rowID['unit_id'];

  $insert_app = mysqli_query($conn,"INSERT INTO app(sn,code,new_entry,merge_code,procurement,unit_id,source_of_funds_id,category_id,pmo_id,qty,mode_of_proc_id,price,app_price,remarks,app_year) VALUES('$sn0','$code0',1,'$code0','$procurement0','$unit_id0','$source_of_funds_id0','$category_id0','$pmo_id0','$qty0','$mode_of_proc_id0','$price0','$app_price0','$remarks0','2020' )");

  $select_app = mysqli_query($conn,"SELECT * FROM app ORDER BY id DESC LIMIT 1");
  $rowID = mysqli_fetch_array($select_app);
  $app_id = $rowID['id'];


  $insert_budget = mysqli_query($conn,"INSERT INTO estimated_budget(app_id,mooe,co,total_budget) VALUES ('$app_id','$mooe','$co','$budget')");
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'CreateAPP.php?';
    </SCRIPT>");

}

}

?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "ch.php",
      data:'pr_no='+$("#pr_no").val(),
      type: "POST",
      success:function(data){
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error:function (){}
    });
  }
</script>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
     <h1 align="">&nbspAdd Items(s)</h1>
     <div class="box-header with-border">
     </div>

     <br>
     <h3> <p align="center"> Annual Procurement Plan for FY 2020</p></h3>  
     <br>
     &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewApp.php" style="color:white;text-decoration: none;">Back</a></li>
     <!-- <a href="javascript:void(0);"  class="btn btn-primary link" data-id="<=$data['id']?>">View Items</a><br><br> -->
     <br>
     <br>
     <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label>Stock No.</label>
              <?php if ($sn != ''): ?>
                <input readonly autocomplete = "off" value="<?php echo 'S'.$idGet?>" class="form-control" name="sn" type="text" id="sn" class="demoInputBox" onBlur="checkAvailability()"><span id="user-availability-status"></span> 
                <?php else:  ?>
                  <input readonly autocomplete = "off" value="<?php echo 'S'.$idGet?>" class="form-control" name="sn" type="text" id="sn" class="demoInputBox" onBlur="checkAvailability()"><span id="user-availability-status"></span> 
                <?php endif ?>
              </div>
              <div class="form-group">
                <label>Code (PPAP)</label>
                <input autocomplete = "off" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>" class="form-control" name="code" type="text" id="code" >
              </div>
              <div class="form-group">
                <label>Item</label>
                <input autocomplete = "off" value="<?php echo isset($_POST['item']) ? $_POST['item'] : '' ?>" class="form-control" name="item" type="text" id="item" >
              </div>
               <div class="form-group">
                    <label>Unit </label>
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="unit">Select Unit</option>
                      <option value="book">book</option>
                      <option value="bottle">bottle</option>
                      <option value="box">box</option>
                      <option value="bundle">bundle</option>
                      <option value="can">can</option>
                      <option value="cart">cart</option>
                      <option value="crtg">crtg</option>
                      <option value="dozen">dozen</option>
                      <option value="gallon">gallon</option>
                      <option value="jar">jar</option>
                      <option value="lot">lot</option>
                      <option value="pack">pack</option>
                      <option value="pax">pax</option>
                      <option value="pad">pad</option>
                      <option value="pair">pair</option>
                      <option value="piece">piece</option>
                      <option value="pouch">pouch</option>
                      <option value="ream">ream</option>
                      <option value="roll">roll</option>
                      <option value="set">set</option>
                      <option value="tube">tube</option>
                      <option value="unit">unit</option>
                    </select>
                  </div>
              <div class="form-group">
                <label>Source of Fund</label>
                <select class="form-control select2" style="width: 100%;" name="fund" id="fund" >
                  <option value="3">Regular, Local and Trust Fund</option>
                  <option value="1">Local Fund</option>
                  <option value="2">Regular Fund</option>
                </select>
              </div>
              <div class="form-group">
                <label>Remarks</label>
                <textarea class="form-control" rows="5" name="remarks" ></textarea>
              </div>

            </div>
            <div class="col-md-6">

             <div class="form-group">
              <label>Category</label>
              <select class="form-control select2" style="width: 100%;" name="category" id="category" >
                <option>Select Category</option>
                <?php echo app($connect)?>
              </select> 
            </div>
            <br>
            <div class="container1">
              <button class="add_form_field btn btn-info">Add Office &nbsp; 
                <span style="font-size:16px; font-weight:bold;">+ </span>
              </button>
              <br>
              <div class="form-group">
                <label>Office </label>
                <?php if ($pmo == 'Please Select'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" >
                    <option value="Please Select">Select Office</option>
                    <option value="1">ORD</option>
                    <option value="3">LGMED</option>
                    <option value="4">LGCDD</option>
                    <option value="5">FAD</option>
                    <option value="6">LGMED-PDMU</option>
                    <option value="7">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == ''): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" value="asdasd">
                    <option value="Please Select" <?php echo (isset($_POST['pmo[]']) && $_POST['pmo[]'] == 'Please Select') ? 'selected="selected"' : ''; ?>>Select Office</option>
                    <option value="1" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'ORD') ? 'selected="selected"' : ''; ?>>ORD</option>
                    <option value="3" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED') ? 'selected="selected"' : ''; ?>>LGMED</option>
                    <option value="4" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD') ? 'selected="selected"' : ''; ?>>LGCDD</option>
                    <option value="5" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'FAD') ? 'selected="selected"' : ''; ?>>FAD</option>
                    <option value="6" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED-PDMU') ? 'selected="selected"' : ''; ?>>LGMED-PDMU</option>
                    <option value="7" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD-MBRTG') ? 'selected="selected"' : ''; ?>>LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>
              </div>

              <div class="form-group">
                <label>Quantity</label>
                <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['qty[]']) ? $_POST['qty[]'] : '' ?>" class="form-control" name="qty[]" type="text" id="qty[]" >

              </div>
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

            <div class="form-group">
              <label>App Price</label>
              <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['app_price']) ? $_POST['app_price'] : '' ?>" class="form-control" name="app_price" type="text" id="price" >

            </div>

             <div class="form-group">
              <label>Market Price</label>
              <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>" class="form-control" name="price" type="text" id="price" >

            </div>


            <div class="form-group" hidden>
              <label>MOOE</label>
              <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['mooe']) ? $_POST['mooe'] : '' ?>" class="form-control" name="mooe" type="text" id="mooe" >

            </div>

            <div class="form-group" hidden>
              <label>CO</label>
              <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['co']) ? $_POST['co'] : '' ?>" class="form-control" name="co" type="text" id="co" >
            </div>
            <div class="form-group">
              <label>App Total Budget</label>
              <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['budget']) ? $_POST['budget'] : '' ?>" class="form-control" name="budget" type="text" id="budget" >
            </div>
            <br>
            <button class="btn btn-success" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>


            <!-- /.box-body -->
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>

    </div>
  </div>  



</div>

<br>
</form>
</div>  
</div>  
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
<script>

  $(document).ready(function(){
   table = document.getElementById("item_table");

   tr = table.getElementsByTagName("th");
   var td = document.getElementById("tdvalue");

   if(td <= 0){
    $('#finalizeButton').attr('disabled','disabled');
  } else {
    $('#finalizeButton').attr('enabled','enabled');
  }

  $('.link').click(function(){

    var f = $(this);
    var id = f.data('id');

    var pr_no = $('#pr_no').val();
    var pr_date = $('#pr_date').val();
    var pmo[] = $('#pmo[]').val();
    var purpose = $('#purpose').val();

    window.location = 
    'ViewPRdetails.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo[]='+pmo[]+'&purpose='+purpose;
  });
}) ;
</script>
<script>
  $(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
            $(wrapper).append('<div><a href="#" class="delete btn btn-danger">Delete</a> <div class="form-group "><label>PMO/End User </label><select class="form-control  select2" style="width: 100%;" name="pmo[]" id="pmo[]" ><option value="Please Select">Select PMO/End User</option><option value="1">ORD</option><option value="2">LGMED</option><option value="3">LGCDD</option><option value="4">FAD</option><option value="5">LGMED-PDMU</option><option value="6">LGCDD-MBRTG</option></select></div><div class="form-group"><label>Quantity</label> <input autocomplete = "off" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="<?php echo isset($_POST['qty[]']) ? $_POST['qty[]'] : '' ?>" class="form-control" name="qty[]" type="text" id="qty[]" > </div></div>'); //add input box
          } else {
            alert('You Reached the limits')
          }
        });

    $(wrapper).on("click", ".delete", function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    })
  });
</script>

