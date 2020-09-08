<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



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
$id = $_GET['id'];
$select_uapp = mysqli_query($conn,"SELECT * FROM app WHERE id = $id ORDER BY id DESC");
$rowA = mysqli_fetch_array($select_uapp);
$snid = $rowA['id'];
$sn = $rowA['sn'];
$pmo_id = $rowA['pmo_id'];
$code = $rowA['code'];
$item = $rowA['procurement'];
$fund3 = $rowA['source_of_funds_id'];
$remarks = $rowA['remarks'];
$category = $rowA['category_id'];
$mode = $rowA['mode_of_proc_id'];
$price = $rowA['price'];
$app_price = $rowA['app_price'];
$unit_id = $rowA['unit_id'];

$select_cat = mysqli_query($conn, "SELECT item_category_title FROM item_category left join app on app.category_id = item_category.id WHERE app.id = '$id' ");
$rowC = mysqli_fetch_array($select_cat);
$item_title = $rowC['item_category_title'];

$select_app = mysqli_query($conn,"SELECT id FROM app WHERE sn = '$sn' ORDER BY id DESC LIMIT 1");
$rowID = mysqli_fetch_array($select_app);
$app_id = $rowID['id'];

$select_mooe = mysqli_query($conn,"SELECT * FROM estimated_budget WHERE app_id = $app_id ");
$rowM = mysqli_fetch_array($select_mooe);
$mooe2 = $rowM['mooe'];
$co2 = $rowM['co'];
$budget2 = $rowM['total_budget'];

if ($fund3 == 1) {
  $fund2 = "Local Fund";
}
if ($fund3 == 2) {
  $fund2 = "Regular Fund";
}
if ($fund3 == 3) {
  $fund2 = "Regular, Local and Trust Fund";
}

if ($mode == 1) {
  $mode2 = "Small Value Procurement";
}
if ($mode == 2) {
  $mode2 = "Shopping";
}
if ($mode == 4) {
  $mode2 = "NP Lease of Venue";
}
if ($mode == 5) {
  $mode2 = "Direct Contracting";
}
if ($mode == 6) {
  $mode2 = "Agency to Agency";
}

if ($mode == 7) {
  $mode2 = "Public Bidding";
}

if ($mode == 8) {
  $mode2 = "No Applicable N/A";
}

if (isset($_POST['submit'])) {
  $sn1 = $_POST['sn'];
  $code1 = $_POST['code'];
  $item1 = $_POST['item'];
  $fund1 = $_POST['fundasd'];
  $remarks1 = $_POST['remarks'];
  $category1 = $_POST['category'];
  $mode1 = $_POST['mode'];
  $price1 = $_POST['price'];
  $app_price1 = $_POST['app_price'];
  $mooe1 = $_POST['mooe'];
  $co1 = $_POST['co'];
  $budget1 = $_POST['budget'];
  $unit_id11 = $_POST['unit'];
  $year = 2020;
  if ($unit_id11 == 16) {
    $unit_id11 = "book";
  }
  if ($unit_id11 == 11) {
    $unit_id11 = "bottle";
  }
  if ($unit_id11 == 5) {
    $unit_id11 = "unit";
  }
 if ($unit_id11 == 8) {
    $unit_id11 = "tube";
  }
  if ($unit_id11 == 12) {
    $unit_id11 = "set";
  }
  if ($unit_id11 == 9) {
    $unit_id11 = "roll";
  }
  if ($unit_id11 == 3) {
    $unit_id11 = "ream";
  }
  if ($unit_id11 == 17) {
    $unit_id11 = "pouch";
  }
  if ($unit_id11 == 2) {
    $unit_id11 = "box";
  }
  if ($unit_id11 == 14) {
    $unit_id11 = "bundle";
  }
  if ($unit_id11 == 10) {
    $unit_id11 = "can";
  }
  if ($unit_id11 == 21) {
    $unit_id11 = "cart";
  }
  if ($unit_id11 == 6) {
    $unit_id11 = "crtg";
  }
  if ($unit_id11 == 18) {
    $unit_id11 = "dozen";
  }
  if ($unit_id11 == 20) {
    $unit_id11 = "gallon";
  }
  if ($unit_id11 == 13) {
    $unit_id11 = "jar";
  }
  if ($unit_id11 == 4) {
    $unit_id11 = "lot";
  }
  if ($unit_id11 == 7) {
    $unit_id11 = "pack";
  }
   if ($unit_id11 == 22) {
    $unit_id11 = "pax";
  }
  if ($unit_id11 == 15) {
    $unit_id11 = "pad";
  }
  if ($unit_id11 == 19) {
    $unit_id11 = "pair";
  }
  if ($unit_id11 == 1) {
    $unit_id11 = "piece";
  }

  $select_count = mysqli_query($conn,"SELECT * FROM app_items WHERE sn = '$sn' AND code = '$code' AND procurement = '$item1'");

  // echo "SELECT * FROM app_items WHERE sn = '$sn' AND code = '$code' AND procurement = '$item1' ";
  // echo "<br>";

  $count_rows = mysqli_num_rows($select_count);
  for($count = 0; $count < count($_POST["pmo"]); $count++) {
   $pmo = $_POST["pmo"][$count];
   $qty = $_POST["qty"][$count];
   $id1 = $_POST["id1"][$count];

   $count_pmo = count($_POST["pmo"]);

 }

 if ($count_pmo != $count_rows) {

  // echo "pag morethan";
  // echo "<br>";
  // echo $count_pmo;
  // echo "<br>";
  // echo $count_rows;
  // exit;
   $delete_old_app = mysqli_query($conn,"DELETE FROM app WHERE id = '$id'");
   $delete_old_app_items = mysqli_query($conn,"DELETE FROM app_items WHERE sn = '$sn1' AND code = '$code1' AND procurement = '$item1' ");
   for($count = 0; $count < count($_POST["pmo"]); $count++) {
     $id1 = $_POST["id1"][$count];
     $insert_app_items = mysqli_query($conn,'INSERT INTO app_items(sn,code,new_entry,merge_code,procurement,source_of_funds_id,category_id,pmo_id,qty,qty_original,mode_of_proc_id,price,app_price,remarks,app_year,unit_id)
      VALUES("'.$sn1.'","'.$code1.'",1,"'.$code1.'","'.$item1.'","'.$fund1.'","'.$category1.'","'.$_POST['pmo'][$count].'","'.$_POST['qty'][$count].'","'.$_POST['qty'][$count].'","'.$mode1.'","'.$price1.'","'.$app_price1.'","'.$remarks1.'","'.$year.'","'.$unit_id11.'")');
   }

   
   $select_app_items = mysqli_query($conn,"SELECT * FROM app_items ORDER BY id DESC LIMIT 1");
   $rowID = mysqli_fetch_array($select_app_items);
   $sn0 = $rowID['sn'];
   $code0 = $rowID['code'];
   $procurement0 = $rowID['procurement'];
   $source_of_funds_id0 = $rowID['source_of_funds_id'];
   $category_id0 = $rowID['category_id'];
   $pmo_id0 = $rowID['pmo_id'];
   $qty0 = $rowID['qty'];
   $mode_of_proc_id0 = $rowID['mode_of_proc_id'];
   $price0 = $rowID['price'];
   $remarks0 = $rowID['remarks'];
   $unit_id0 = $rowID['unit_id'];

   $insert_app = mysqli_query($conn,"INSERT INTO app(sn,code,new_entry,merge_code,procurement,source_of_funds_id,category_id,pmo_id,qty,mode_of_proc_id,price,app_price,remarks,app_year,unit_id) VALUES('$sn0','$code0',1,'$code0','$procurement0','$source_of_funds_id0','$category_id0','$pmo_id0','$qty0','$mode_of_proc_id0','$price0','$app_price1','$remarks0','2020','$unit_id0' )");
   
   $select_app2 = mysqli_query($conn,"SELECT id FROM app ORDER BY id DESC LIMIT 1");
   $rowID = mysqli_fetch_array($select_app2);
   $app_id2 = $rowID['id'];

   $insert_budget2 = mysqli_query($conn,"INSERT INTO estimated_budget(app_id,mooe,co,total_budget) VALUES ('$app_id2','$mooe1','$co1','$budget1')");

   $update_pr_items = mysqli_query($conn,"UPDATE pr_items SET items = $app_id2 WHERE items = $id");
   $update_rfq_items = mysqli_query($conn,"UPDATE rfq_items SET app_id = $app_id2 WHERE app_id = $id");

   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Update!');
    window.location.href = 'ViewApp.php?';
    </SCRIPT>");

 }else{

  // echo "pag lessthan";
  //  echo "<br>";
  // echo $count_pmo;
  // echo "<br>";
  // echo $count_rows;

  // exit;
  for($count = 0; $count < count($_POST["pmo"]); $count++) {
   $pmo2 = $_POST["pmo"][$count];
   $qty = $_POST["qty"][$count];
   $id1 = $_POST["id1"][$count];

   $update_app = mysqli_query($conn,"UPDATE app SET  pmo_id=$pmo2  WHERE id = $id1");
   $update_app2 = mysqli_query($conn,"UPDATE app_items SET  qty='$qty',pmo_id=$pmo2  WHERE id = $id1");
 }

 $uapp = mysqli_query($conn,"UPDATE app_items SET sn = '$sn1', code = '$code1', procurement = '$item1' WHERE sn = '$sn' AND pmo_id = $pmo_id AND procurement ='$item1' AND code = '$code1' ");

 $app = mysqli_query($conn,"UPDATE app SET unit_id = '$unit_id11', sn = '$sn1' , code = '$code1' , procurement = '$item1', source_of_funds_id = $fund1, category_id = $category1, mode_of_proc_id = $mode1, price = '$price1',app_price = '$app_price1', remarks = '$remarks1' WHERE id = $id ");


 $update_budget = mysqli_query($conn,"UPDATE estimated_budget SET mooe = '$mooe1' , co = '$co1' , total_budget = '$budget1' WHERE app_id = $app_id ");
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Successfuly Update!');
  window.location.href = 'ViewApp.php';
  </SCRIPT>");
}
}
?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Update Annual Procurement Plan for FY 2020</h1>
            &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewApp.php" style="color:white;text-decoration: none;">Back</a></li>
          
            
     <br>
     <br>
     <br>
     <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label>Stock No.</label>
              <input required autocomplete = "off" value="<?php echo $sn ?>" class="form-control" name="sn" type="text" id="sn" class="demoInputBox" onBlur="checkAvailability()">
            </div>
            <div class="form-group">
              <label>Code (PPAP)</label>
              <input required autocomplete = "off" value="<?php echo $code ?>" class="form-control" name="code" type="text" id="code" >
            </div>
            <div class="form-group">
              <label>Item</label>
              <input required autocomplete = "off" value="<?php echo $item ?>" class="form-control" name="item" type="text" id="item" >
            </div>
            <div class="form-group">
                    <label>Unit <label style="color: Red;" >*</label></label>
                    <?php if ($unit_id == NULL): ?>
                    <select required class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option disabled selected >Select Unit</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="22"></option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>  <?php if ($unit_id == "book"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "bottle"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="11">bottle</option>
                      <option value="16">book</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "box"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="2">box</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "bundle"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="14">bundle</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "can"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="10">can</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "cart"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="21">cart</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "crtg"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="6">crtg</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "dozen"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="18">dozen</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "gallon"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="20">gallon</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "jar"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="13">jar</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "lot"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="4">lot</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "pack"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="7">pack</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="15">pad</option>
                      <option value="22">pax</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "pad"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="15">pad</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "pair"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="19">pair</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="22">pax</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "piece"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="1">piece</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="22">pax</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "pouch"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="17">pouch</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "ream"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="3">ream</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="22">pax</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "roll"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="9">roll</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="22">pax</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "set"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="12">set</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "tube"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="8">tube</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="22">pax</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="5">unit</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "unit"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="5">unit</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="22">pax</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                    </select>
                  </div>
                    <?php endif ?>
                    <?php if ($unit_id == "pax"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="22">pax</option>
                      <option value="5">unit</option>
                      <option value="16">book</option>
                      <option value="24">meters</option>
                      <option value="23">liters</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                    </select>
                  </div>
                    <?php endif ?>

                    <?php if ($unit_id == "liters"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="23">liters</option>
                      <option value="22">pax</option>
                      <option value="5">unit</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="24">meters</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                    </select>
                  </div>
                    <?php endif ?>

                    <?php if ($unit_id == "meters"): ?>
                      
                    <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="24">meters</option>
                      <option value="22">pax</option>
                      <option value="5">unit</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="23">liters</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                    </select>
                  </div>
                    <?php endif ?>

            <div class="form-group">
              <label>Source of Fund</label>
              <select required class="form-control " style="width: 100%;" name="fundasd" id="fund" >
                <option value="<?php echo $fund3;?>"><?php echo $fund2;?></option>
                <option value="1">Local Fund</option>
                <option value="2">Regular Fund</option>
                <option value="3">Regular, Local and Trust Fund</option>
              </select>
            </div>
            <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" rows="5" name="remarks" ><?php echo $remarks;?></textarea>
            </div>

          </div>
          <div class="col-md-6">

           <div class="form-group">
            <label>Category</label>
            <select required class="form-control select2" style="width: 100%;" name="category" id="category" >
              <option value="<?php echo $category?>"><?php echo $item_title?></option>
              <?php echo app($connect)?>
            </select> 
          </div>
          <br>
          <div class="container1">
            <button class="add_form_field btn btn-info" >Add Office &nbsp; 
              <span style="font-size:16px; font-weight:bold;">+ </span>
            </button>

            <br>
            <br>
            <?php 
            $sell = mysqli_query($conn,"SELECT id,pmo_id,qty from app_items where procurement = '$item' AND code = '$code' AND sn = '$sn' AND pmo_id IS NOT NULL"); 

            while ($rowS = mysqli_fetch_assoc($sell)) {

              $pmo = $rowS['pmo_id'];
              $qty = $rowS['qty'];
              $id1 = $rowS['id'];

              if ($pmo == 1) {
                $pmo1 = "ORD";
              }

              if ($pmo == 3 ) {
                $pmo1 = "LGMED";
              }

              if ($pmo == 4 ) {
                $pmo1 = "LGCDD";
              }

              if ($pmo == 5 ) {
                $pmo1 = "FAD";
              }

              if ($pmo == 6 ) {
                $pmo1 = "LGMED-PDMU";
              }

              if ($pmo == 7 ) {
                $pmo1 = "LGCDD-MBRTG";
              }

              ?>
              <?php if (mysqli_num_rows($sell) > 0): ?>
                <!-- create php file that will delete this id in app -->
                <div>
                  <!-- <a href="delete_id_app.php?id=<?php echo $id1;?>&&app_id=<?php echo $snid;?>" class=" btn btn-danger">Delete</a> -->
                  <!-- <div><button name="delete" class=" btn btn-danger">Delete</button> -->
                    <input type="text" value="<?php echo $id1?>" name="id1[]" hidden>
                    <div class="form-group">
                      <label>Office </label>
                      <?php if ($pmo == 'Please Select'): ?>
                        <select required class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" >
                          <option value="<?php echo $pmo?>"><?php echo $pmo1?></option>
                          <option value="1">ORD</option>
                          <option value="3">LGMED</option>
                          <option value="4">LGCDD</option>
                          <option value="5">FAD</option>
                          <option value="6">LGMED-PDMU</option>
                          <option value="7">LGCDD-MBRTG</option>
                        </select>
                      <?php endif ?>

                      <select required class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" value="asdasd">
                        <option value="<?php echo $pmo?>"><?php echo $pmo1?></option>
                        <option value="1" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'ORD') ? 'selected="selected"' : ''; ?>>ORD</option>
                        <option value="3" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED') ? 'selected="selected"' : ''; ?>>LGMED</option>
                        <option value="4" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD') ? 'selected="selected"' : ''; ?>>LGCDD</option>
                        <option value="5" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'FAD') ? 'selected="selected"' : ''; ?>>FAD</option>
                        <option value="6" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED-PDMU') ? 'selected="selected"' : ''; ?>>LGMED-PDMU</option>
                        <option value="7" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD-MBRTG') ? 'selected="selected"' : ''; ?>>LGCDD-MBRTG</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Quantity</label>
                      <input required autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $qty?>" class="form-control" name="qty[]" type="text" id="qty[]" >

                    </div>
                  </div>

                  <?php else: ?>

                    <div><a href="#" class="delete btn btn-danger">Delete</a>
                      <div class="form-group">
                        <label>Office </label>
                        <?php if ($pmo == 'Please Select'): ?>
                          <select required class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" >
                            <option value="Please Select">Select Office</option>
                            <option value="1">ORD</option>
                            <option value="3">LGMED</option>
                            <option value="4">LGCDD</option>
                            <option value="5">FAD</option>
                            <option value="6">LGMED-PDMU</option>
                            <option value="7">LGCDD-MBRTG</option>
                          </select>
                        <?php endif ?>

                        <select required class="form-control select2" style="width: 100%;" name="pmo[]" id="pmo[]" value="asdasd">
                          <option value="Please Select" <?php echo (isset($_POST['pmo[]']) && $_POST['pmo[]'] == 'Please Select') ? 'selected="selected"' : ''; ?>>Select Office</option>
                          <option value="1" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'ORD') ? 'selected="selected"' : ''; ?>>ORD</option>
                          <option value="3" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED') ? 'selected="selected"' : ''; ?>>LGMED</option>
                          <option value="4" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD') ? 'selected="selected"' : ''; ?>>LGCDD</option>
                          <option value="5" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'FAD') ? 'selected="selected"' : ''; ?>>FAD</option>
                          <option value="6" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED-PDMU') ? 'selected="selected"' : ''; ?>>LGMED-PDMU</option>
                          <option value="7" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD-MBRTG') ? 'selected="selected"' : ''; ?>>LGCDD-MBRTG</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Quantity</label>
                        <input required autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo isset($_POST['qty[]']) ? $_POST['qty[]'] : '' ?>" class="form-control" name="qty[]" type="text" id="qty[]" >

                      </div>
                    </div>
                  <?php endif ?>
                <?php } ?>
              </div>

              <div class="form-group">
                <label>Mode of Procurement</label>
                <select required class="form-control select2" style="width: 100%;" name="mode">
                  <option value="<?php echo $mode?>"><?php echo $mode2?></option>
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
                <label>APP Price</label>
                <input required autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $app_price ?>" class="form-control" name="app_price" type="text" id="app_price" >

              </div>

              <div class="form-group">
                <label>Market Price</label>
                <input required autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $price ?>" class="form-control" name="price" type="text" id="price" >

              </div>

              <div class="form-group" hidden>
                <label>MOOE</label>
                <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $mooe2 ?>" class="form-control" name="mooe" type="text" id="mooe" >

              </div>
 
              <div class="form-group" hidden>
                <label>CO</label>
                <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $co2 ?>" class="form-control" name="co" type="text" id="co" >
              </div>
              <div class="form-group" hidden>
                <label>App Total Budget</label>
                <input autocomplete = "off" onKeyPress='return dec(event)' value="<?php echo $budget2 ?>" class="form-control" name="budget" type="text" id="budget" >
              </div>
              <br>
              <button class="btn btn-primary" style="float: right;" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to Update now?');">Update</button>


              <!-- /.box-body -->
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>

      </div>
    
    </form>



            </div>
        </div>
      </div>
    </div>
  </div>
</div>



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
            $(wrapper).append('<div><a href="#" class="delete btn btn-danger">Delete</a> <div class="form-group "><label>Office </label><select required class="form-control  select2" style="width: 100%;" name="pmo[]" id="pmo[]" ><option selected disabled >Select Office</option><option value="1">ORD</option><option value="3">LGMED</option><option value="4">LGCDD</option><option value="5">FAD</option><option value="6">LGMED-PDMU</option><option value="7">LGCDD-MBRTG</option></select></div><div class="form-group"><label>Quantity</label> <input required autocomplete = "off" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" value="<?php echo isset($_POST['qty[]']) ? $_POST['qty[]'] : '' ?>" class="form-control" name="qty[]" type="text" id="qty[]" > </div></div>'); //add input box
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

