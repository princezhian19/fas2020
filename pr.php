
<?php
error_reporting(0);
ini_set('display_errors', 0);

ob_start();  

//Get the ipconfig details using system commond  
system('ipconfig /all');  

// Capture the output into a variable  
$mycomsys=ob_get_contents();  

// Clean (erase) the output buffer  
ob_clean();  

$find_mac = "Physical"; 
//find the "Physical" & Find the position of Physical text  

$pmac = strpos($mycomsys, $find_mac);  
// Get Physical Address  

$macaddress=substr($mycomsys,($pmac+36),17);  

// echo $macaddress;
// echo "<br>";
// echo $pmac;
//Display Mac Address

$macaddress = $_SERVER['REMOTE_ADDR'];   

$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

function app($connect)
{ 
  $output = '';
  $query = "SELECT id,procurement FROM `app` ORDER BY procurement ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["procurement"].'</option>';
  }
  return $output;
}

function pmo($connect)
{ 
  $output = '';
  $query = "SELECT id,pmo_title FROM `pmo` ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["pmo_title"].'">'.$row["pmo_title"].'</option>';
  }
  return $output;
}


$idGet='';
$getDate = date('Y');
$m = date('m');
// $auto = mysqli_query($conn,"SELECT pr_no as a FROM pr order by id desc limit 1");
$auto = mysqli_query($conn,"SELECT count(*) as a FROM pr WHERE YEAR(pr_date) = '2021'");

// 
while ($row = mysqli_fetch_assoc($auto)) {

  $idGet1 = $row["a"];
  $str = str_replace("2021-01-","",$idGet1);
  $idGet = (int)$str + 1;
}

$latest_pr_no = $getDate.'-'.$m.'-'.'00'.$idGet;

$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$target_date = $_GET['target_date'];
$purpose = $_GET['purpose'];
$pr_no = $_GET['pr_no'];
$type = $_POST['type'];
if($type == ''){
  $type = $_GET['type'];
}


if(isset($POST['del'])){

  $id = $_GET['id'];
  $pr_no = $_GET['pr_no'];
  $pmo = $_GET['pmo'];
  $pr_date = $_GET['pr_date'];
  $purpose = $_GET['purpose'];
  $target_date = $_GET['target_date'];
  $type = $_GET['type'];
  
  $DeleteQuery = mysqli_query($conn,"DELETE FROM pr_approved WHERE id = '$id' ");
  echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Deleted Successfully.  </p> </div></div>  '; 

}

if (isset($_POST['submit'])) {
  $pr_date1 = $_POST['pr_date'];

  $d1 = date('Y-m-d', strtotime($pr_date1));

  $purpose11 = $_POST['purpose'];
$purpose1 = str_replace("'", "", $purpose11);
  
  $pmo1 = $_POST['pmo'];
  $unit1 = $_POST['unit1'];
  $pr_no1 = $latest_pr_no;
  // $pr_no1 = $_POST['pr_no'];
  $pmo2 = $_POST['pmo'];
  $type = $_POST['type'];
  $target_date = $_POST['target_date'];
  $d2 = date('Y-m-d', strtotime($target_date));


  if ($pmo2 == "ORD") {
    $pmo3 = 1;
  }
  if ($pmo2 == "LGMED") {
    $pmo3 = 3;
  }
  if ($pmo2 == "LGCDD") {
    $pmo3 = 4;
  }
  if ($pmo2 == "FAD") {
    $pmo3 = 5;
  }
  if ($pmo2 == "LGMED-PDMU") {
    $pmo3 = 6;
  }
  if ($pmo2 == "LGCDD-MBRTG") {
    $pmo3 =7 ;
  }

  if ($pmo == "ORD") {
    $pmo3 = 1;
  }
  if ($pmo == "LGMED") {
    $pmo3 = 3;
  }
  if ($pmo == "LGCDD") {
    $pmo3 = 4;
  }
  if ($pmo == "FAD") {
    $pmo3 = 5;
  }
  if ($pmo == "LGMED-PDMU") {
    $pmo3 = 6;
  }
  if ($pmo == "LGCDD-MBRTG") {
    $pmo3 =7 ;
  }

  if ($unit == "bottle"){
    $unit = 11;
  }
  if ($unit == "box"){
    $unit = 2;
  }
  if ($unit == "bundle"){
    $unit = 14;
  }
  if ($unit == "can"){
    $unit = 10;
  }
  if ($unit == "cart"){
    $unit = 21;
  }
  if ($unit == "crtg"){
    $unit = 6;
  }
  if ($unit == "dozen"){
    $unit = 18;
  }
  if ($unit == "gallon"){
    $unit = 20;
  }
  if ($unit == "jar"){
    $unit = 13;
  }
  if ($unit == "lot"){
    $unit = 4;
  }
  if ($unit == "pack"){
    $unit = 7;
  }
  if ($unit == "pad"){
    $unit = 15;
  }
  if ($unit == "pair"){
    $unit = 19;
  }
  if ($unit == "piece"){
    $unit = 1;
  }
  if ($unit == "pouch"){
    $unit = 17;
  }
  if ($unit == "ream"){
    $unit = 3;
  }
  if ($unit == "roll"){
    $unit = 9;
  }
  if ($unit == "set"){
    $unit = 12;
  }
  if ($unit == "tube"){
    $unit = 8;
  }
  if ($unit == "unit"){
    $unit = 5;
  }
  
  if ($unit == "pax"){
    $unit = 22;
  }
  if ($unit == "liters"){
    $unit = 23;
  }
  if ($unit == "meters"){
    $unit = 24;
  }
  
  $check = mysqli_query($conn,"SELECT pr_no FROM pr WHERE pr_no = '$pr_no1' ");

  if (mysqli_num_rows($check)>0) {
    echo "<div style='background-color:lightblue;color:red;'> <p> <b>This PR_NO is already existing</b> <p> </div>";
  }else{

    $insert_pr = mysqli_query($conn,"INSERT INTO pr(pr_no,pmo,purpose,pr_date,type,target_date) VALUES('$latest_pr_no','$pmo1','$purpose1','$d1','$type','$d2')");

    for($count = 0; $count < count($_POST["items1"]); $count++)
    {  
      $app_idS = $_POST['items1'][$count];
      $qty11 = $_POST['qty1'][$count];
      
      $select_app_id = mysqli_query($conn,"SELECT id,sn FROM app WHERE id = $app_idS ");
      $rowAI = mysqli_fetch_array($select_app_id);
      $snAi = $rowAI['sn'];

      $insert_items = mysqli_query($conn,'INSERT INTO pr_items(pr_no,items,description,unit,qty,abc)
        VALUES("'.$pr_no1.'","'.$_POST['items1'][$count].'","'.$_POST['description1'][$count].'","'.$unit1[$count].'","'.$_POST['qty1'][$count].'","'.$_POST['abc1'][$count].'")');

      $update_minus = mysqli_query($conn,'UPDATE app_items SET qty_original = qty_original - '.$_POST['qty1'][$count].' WHERE pmo_id = '.$pmo3.' AND sn = "'.$snAi.'" ');

     // echo 'UPDATE app_items SET qty_original = qty_original - '.$_POST['qty1'][$count].' WHERE pmo_id = '.$pmo3.' AND sn = "'.$snAi.'"';
    }


    $select_id = mysqli_query($conn,"SELECT * FROM pr WHERE pr_no = '$pr_no1'");
    $rowW = mysqli_fetch_array($select_id);
    $ids = $rowW['id'];
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Saved!')
      window.location.href = 'ViewPRv.php?id=$ids';
      </SCRIPT>");

  }

}





if (isset($_POST['add'])) {
  $pr_no = $_POST["pr_no"];
  $pmo = $_POST["pmo"];
  $app_items = $_POST["app_items"];
  $udescriptionnit = $_POST["description"];
  $unit = $_POST["unit"];
  $qty = $_POST["qty"];
  $abc = $_POST["abc"];

  if ($pmo == "ORD") {
    $pmo3 = 1;
  }
  if ($pmo == "LGMED") {
    $pmo3 = 3;
  }
  if ($pmo == "LGCDD") {
    $pmo3 = 4;
  }
  if ($pmo == "FAD") {
    $pmo3 = 5;
  }
  if ($pmo == "LGMED-PDMU") {
    $pmo3 = 6;
  }
  if ($pmo == "LGCDD-MBRTG") {
    $pmo3 =7 ;
  }

  if ($unit == "bottle"){
    $unit = 11;
  }
  if ($unit == "box"){
    $unit = 2;
  }
  if ($unit == "bundle"){
    $unit = 14;
  }
  if ($unit == "can"){
    $unit = 10;
  }
  if ($unit == "cart"){
    $unit = 21;
  }
  if ($unit == "crtg"){
    $unit = 6;
  }
  if ($unit == "dozen"){
    $unit = 18;
  }
  if ($unit == "gallon"){
    $unit = 20;
  }
  if ($unit == "jar"){
    $unit = 13;
  }
  if ($unit == "lot"){
    $unit = 4;
  }
  if ($unit == "pack"){
    $unit = 7;
  }
  if ($unit == "pad"){
    $unit = 15;
  }
  if ($unit == "pair"){
    $unit = 19;
  }
  if ($unit == "piece"){
    $unit = 1;
  }
  if ($unit == "pouch"){
    $unit = 17;
  }
  if ($unit == "ream"){
    $unit = 3;
  }
  if ($unit == "roll"){
    $unit = 9;
  }
  if ($unit == "set"){
    $unit = 12;
  }
  if ($unit == "tube"){
    $unit = 8;
  }
  if ($unit == "unit"){
    $unit = 5;
  }
  if ($unit == "liter"){
    $unit = 22;
  }

  if ($unit == "pax"){
    $unit = 22;
  }
  if ($unit == "liters"){
    $unit = 23;
  }
  if ($unit == "meters"){
    $unit = 24;
  }




  $check = mysqli_query($conn,"SELECT pr_no FROM pr WHERE pr_no = '$pr_no' ");

  $select_app_id = mysqli_query($conn,"SELECT id,sn FROM app WHERE id = $app_items ");
  $rowAI = mysqli_fetch_array($select_app_id);
  $snAi = $rowAI['sn'];

  $select_Aitems = mysqli_query($conn,"SELECT * FROM app_items WHERE sn = '$snAi' AND pmo_id = $pmo3");
  $rowPmo = mysqli_fetch_array($select_Aitems);
  $qty_original = $rowPmo['qty_original'];

  
  // if ($qty_original == 0 )
  // {
  //   echo "<div style='background-color:lightblue;color:red;'> <p>  <p> <div>";
  // }
  // else
  // {   

  if ($app_items == '')
  {
    echo "<div style='background-color:lightblue;color:red;'> <p> <b>Please Select Item Field!</b> <p> </div>";
  }
  else
  {
    if ($pmo == 'Please Select') {
      echo "<div style='background-color:lightblue;color:red;'> <p> <b>PMO field is Empty!</b> <p> </div>";
    }else{
      if ($app_items =="dummy") {
        echo "<div style='background-color:lightblue;color:red;'> <p> <b>This PR_NO is already existing</b> <p> </div>";
      }
      if($unit ==""){
        echo "<div style='background-color:lightblue;color:red;'> <p> <b>Unit Cannot Be Blank</b> <p> </div>";

      } else{
       $insert_items = mysqli_query($conn,'INSERT INTO pr_approved(pr_no,items,pmo,description,unit,qty,abc,mac) 
        VALUES("'.$latest_pr_no.'","'.$_POST['app_items'].'","'.$_POST['pmo'].'","'.$_POST['description'].'","'.$unit.'","'.$_POST['qty'].'","'.$_POST['abc'].'","'.$macaddress.'")');
       echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Successfuly Saved!  </p> </div></div>  '; 
     }
   }
 }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    function load_data(query)
    {
      $.ajax({
        url:"fetch_pr.php?",
        method:"POST",
        data:{query:query},
        success:function(data)
        {
          $('#result').html(data);
        }
      });
    }
    $('#app_items').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
        load_data(search);
      }
      else
      {

        load_data();
        /* document.getElementById("code").value = ""; */
        document.getElementById("stocknumber").value = "";
        document.getElementById("abc").value="";
        document.getElementById("unit").value="";
        $("#main").show();
        
      }
    });
  });
  function showRow(row)
  {

    var x=row.cells;
    document.getElementById("id").value = x[0].innerHTML;
    document.getElementById("abc").value = x[1].innerHTML;
    document.getElementById("stocknumber").value = x[2].innerHTML;
    document.getElementById("abc").value = x[3].innerHTML;
    document.getElementById("app_items").value = x[4].innerHTML;
    document.getElementById("unit").value = x[5].innerHTML;
  }
</script>
</head>
<body>
  <div class="box">
    <div class="box-body">
      <h1 align="">&nbsp<b>Create Purchase Request</b></h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <form method="POST" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>PR No. <label style="color: Red;" >*</label> </label>
                  <?php if ($pr_no != ''): ?>
                   <input readonly autocomplete = "off" value="<?php echo $getDate.'-'.$m.'-'.'00'.$idGet?>" class="form-control" name="pr_no" type="text" id="pr_no" class="demoInputBox" onBlur="checkAvailability()"><span id="user-availability-status"></span>
                   <?php else:  ?>
                    <input  readonly autocomplete = "off" value="<?php echo $getDate.'-'.$m.'-'.'00'.$idGet?>" class="form-control" name="pr_no" type="text" id="pr_no" class="demoInputBox" onBlur="checkAvailability()"><span id="user-availability-status"></span> 
                  <?php endif ?>
                </div>
                <div class="form-group">
                  <label>Office <label style="color: Red;" >*</label></label>
                  <?php if ($username == 'ctronquillo' || $username == 'sglee' || $username == 'jamonteiro'): ?>
                    <?php if ($pmo == ''): ?>
                      <select class="form-control select2" name="pmo">
                        <option><?php echo pmo($connect)?></option>
                      </select>
                      <?php else: ?>
                        <select class="form-control select2" name="pmo">
                          <option><?php echo $pmo?></option>
                          <option><?php echo pmo($connect)?></option>
                        </select>
                      <?php endif ?>

                      <?php else: ?>
                        <select class="form-control select2" name="pmo">
                        <option><?php echo $pmo?></option>
                          <option><?php echo pmo($connect)?></option>
                      </select>
                      <!-- Change by: Mark Kim A. Sacluti
                      Date: Sept 10, 2020
                      Requestes by: Shaira Glee -->
                        <!-- <input type="text" class="form-control" style="width: 100%;" name="pmo" id="pmo" readonly value="FAD" > -->
                      <?php endif ?>
                    </div>
                    <div class="form-group">
                      <label>Type <label style="color: Red;" >*</label></label>
                      <?php if ($type == 1): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="5">Other Services</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                          <option value="4">Supplies, Materials and Devices</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == 2): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="1">Catering Services</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="4">Supplies, Materials and Devices</option>
                          <option value="5">Other Services</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == 3): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="3">Repair and Maintenance</option>
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="4">Supplies, Materials and Devices</option>
                          <option value="5">Other Services</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == 4): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="4">Supplies, Materials and Devices</option>
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="5">Other Services</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == 5): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="5">Other Services</option>
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="4">Supplies, Materials and Devices</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == 6): ?>
                        <select class="form-control " style="width: 100%;" name="type" id="type" >
                          <option value="6">Reimbursement and Petty Cash</option>
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="4">Supplies, Materials and Devices</option>
                          <option value="5">Other Services</option>
                        </select>
                      <?php endif ?>
                      <?php if ($type == ''): ?>
                        <select required class="form-control " style="width: 100%;" name="type" id="type" >
                          <option selected disabled></option>
                          <option value="1">Catering Services</option>
                          <option value="2">Meals, Venue and Accommodation</option>
                          <option value="5">Other Services</option>
                          <option value="3">Repair and Maintenance</option>
                          <option value="6">Reimbursement and Petty Cash</option>
                          <option value="4">Supplies, Materials and Devices</option>
                        </select>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>PR Date <label style="color: red;" >*</label></label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <?php if ($pr_date ==''): ?>
                          <input required  type="text" class="form-control pull-right" name="pr_date" id="datepicker1" value="<?php $now = date("m/d/Y"); echo $now;  ?>">
                          <?php else: ?>
                            <input required  type="text" class="form-control pull-right" name="pr_date" id="datepicker1" value="<?php $now =  date("m/d/Y"); echo $now;  ?>">
                          <?php endif ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Target Date <label style="color: Red;" >*</label></label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php if ($target_date ==''): ?>
                            <input type="text" class="form-control pull-right" name="target_date" id="datepicker2" value="<?php echo isset($_POST['target_date']) ? $_POST['target_date'] : '' ?>" required placeholder="mm/dd/yyyy">
                            <?php else: ?>
                              <input type="text" class="form-control pull-right" name="target_date" id="datepicker2" value="<?php echo $target_date ?>" required placeholder="mm/dd/yyyy">
                            <?php endif ?>
                          </div>
                        </div>
                        <div class="form-group" >
                          <label>Purpose <label style="color: Red;" >*</label></label>
                          <?php if ($purpose ==''): ?>
                            <input required type="text" style="height: 60px" class="form-control pull-right" name="purpose" id="purpose" value="<?php echo isset($_POST['purpose']) ? $_POST['purpose'] : '' ?>" required placeholder="Purpose">
                            <?php else: ?>
                              <input required type="text" style="height: 60px" class="form-control pull-right" name="purpose" id="purpose"  required placeholder="Purpose">
                            <?php endif ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> <b> NOTE : </b> Please do not include this characters <b>( ' and " and & ) </b> the system will not accept this characters.Applicable to all fields. </p> </div></div>
                    <?php 
                    if ($insert_items) {
                      echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Item Added!  </p> </div></div>  '; 
                    }
                    ?> 
                    <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-info pull-right">Add Items</button>
                    <br>
                    <br>
                    <!-- start of modal add items -->
                    <form method="POST">
                     <div class="modal fade" id="modal-default">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Add Items</h4>
                            </div>
                            <div class="modal-body">
                              <label>Item/s <font style="color: Red;" >*</font> </label>
                              <input onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" type="text" class="form-control" name="app" id="app_items" placeholder="Search" class="" />
                              <font id="p" hidden>&nbsp</font>
                              <table class="table table-striped table-hover" id="main">
                                <tbody id="result">
                                </tbody>
                              </table>
                              <div hidden>
                                <input type="text" name="app_items" id="id" class="form-control"/>
                              </div>
                              <br>
                              <label>Stock/Property No.  <font style="color: Red;" >*</font> </label>
                              <input type="text" name="stocknumber" id="stocknumber" class="form-control" readonly>
                              <br>
                              <label>Description/Specification </label>
                              <input type="text" name="description" class="form-control">
                              <br>
                              <label>Unit <font style="color: Red;" >*</font></label>
                              <input  type="text" name="unit" id="unit"  class="form-control" readonly>
                              <br>
                              <label >Quantity <font style="color: Red;" >*</font></label>
                              <br>
                              <input  class="form-control" type="number" id="qty" name="qty" >
                              <br>
                              <label>Unit Cost <font style="color: Red;" >*</font></label>
                              <br>
                              <input  class="form-control" type="text" id="abc"  name="abc" readonly>
                            </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                              <button type="submit" class="btn btn-primary" name="add">Add Item</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    </form>
                    <!-- end of modal add items -->
                    <br>
                    <br>
                    <div class="form-group">
                      <label>Added PR Item/s.</label>
                      <div>
                        <div class="panel-body container-items">
                         <table style="background-color: white;border-width: medium;" class="table " id="item_table" >
                          <tr>
                            <th width="50">Stock/Property No.</th>
                            <th width="100">Unit </th>
                            <th width="200">Item</th>
                            <th width="250">Description</th>
                            <th width="100">Quantity</th>
                            <th width="100">Unit Cost</th>
                            <th width="150">Total Cost </th>
                            <th width="100">Option</th>
                          </tr>
                          <tr>
                            <?php 
                            $conn = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');
                            $pr_no = $_POST['pr_no'];
                            $pmo = $_POST['pmo'];
                            $pr_date = $_POST['pr_date'];
                            $purpose = $_POST['purpose'];
                            if ($pr_no == '') {
                              $pr_no = $_GET['pr_no'];
                            }
                            $sql_items = $conn->query("SELECT a.sn,pa.id,pa.qty,pa.items,pa.app_id,pa.pr_no,pa.description,pa.unit,pa.abc,a.procurement FROM pr_approved pa left join app a on a.id = pa.items  WHERE pa.pr_no = '$pr_no' AND pmo = '$pmo' AND mac = '$macaddress' ");
                            while ($row = $sql_items->fetch()) {
                              $sn = $row['sn'];
                              $id = $row['id'];
                              $qty1 = $row['qty'];
                              $items1 = $row['items'];
                              $description1 = $row['description'];
                              $unit1 = $row['unit'];
                              $abc1 = $row['abc'];
                              $procurement1 = $row['procurement'];

                              if ($unit1 == "1") {
                                $unit1a = "piece";
                              }

                              if ($unit1 == "2") {
                                $unit1a = "box";
                              }

                              if ($unit1 == "3") {
                                $unit1a = "ream";
                              }

                              if ($unit1 == "4") {
                                $unit1a = "lot";
                              }

                              if ($unit1 == "5") {
                                $unit1a = "unit";
                              }

                              if ($unit1 == "6") {
                                $unit1a = "crtg";
                              }

                              if ($unit1 == "7") {
                                $unit1a = "pack";
                              }
                              if ($unit1 == "8") {
                                $unit1a = "tube";
                              }

                              if ($unit1 == "9") {
                                $unit1a = "roll";
                              }

                              if ($unit1 == "10") {
                                $unit1a = "can";
                              }

                              if ($unit1 == "11") {
                                $unit1a = "bottle";
                              }

                              if ($unit1 == "12") {
                                $unit1a = "set";
                              }

                              if ($unit1 == "13") {
                                $unit1a = "jar";
                              }

                              if ($unit1 == "14") {
                                $unit1a = "bundle";
                              }

                              if ($unit1 == "15") {
                                $unit1a = "pad";
                              }

                              if ($unit1 == "16") {
                                $unit1a = "book";
                              }

                              if ($unit1 == "17") {
                                $unit1a = "pouch";
                              }

                              if ($unit1 == "18") {
                                $unit1a = "dozen";
                              }

                              if ($unit1 == "19") {
                                $unit1a = "pair";
                              }
                              if ($unit1 == "20") {
                                $unit1a = "gallon";
                              }

                              if ($unit1 == "21") {
                                $unit1a = "cart";
                              }
                              if ($unit1 == "22") {
                                $unit1a = "pax";
                              }
                              if ($unit == "23") {
                                $unit = "liters";
                              } 
                              if ($unit == "24") {
                                $unit = "meters";
                              } 
                              ?>

                              <td id="tdvalue" hidden><?php echo $pr_no?> </td>
                              <td><?php echo $sn ?></td>
                              <td><input hidden type="text" name="unit1[]" value="<?php echo $unit1 ?>"><?php echo $unit1a?></td>
                              <td><input hidden type="text" name="items1[]" value="<?php echo $items1 ?>"><?php echo  $procurement1;?> </td>
                              <td><input hidden type="text" name="description1[]" value="<?php echo $description1 ?>"><?php echo $description1?></td>
                              <td><input hidden type="text" name="qty1[]" value="<?php echo $qty1 ?>"><?php echo $qty1?></td>
                              <td><input hidden type="text" name="abc1[]" value="<?php echo $abc1 ?>"><?php echo $abc1?></td>

                              <td><?php  $ans = $abc1*$qty1;  echo $ans; ?></td>
                              <td hidden><input hidden type="text" name="description1[]" value="<?php echo $description1 ?>"><?php echo $description1?></td>
                              <td>
                               <!-- <?php echo '<a href="ViewEditPR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'" class="btn btn-primary btn-xs" ><i class="fa">&#xf044;</i></a>' ?> -->

                               <a onclick="return confirm('Are you sure you want to Delete?');" name="del"  href="deletePR.php?id=<?php echo $id; ?>&pr_no=<?php echo $pr_no; ?>&pmo=<?php echo $pmo; ?>&pr_date=<?php echo $pr_date; ?>&purpose=<?php echo $purpose; ?> " class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                             </td>
                           </tr>
                         <?php } ?>
                       </table>
                     </div>
                     <br>
                   </form>
                   <button class="btn btn-success" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>
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
                $("#result").click(function(){
                  $("#main").hide();
                  $("#p").show();
                });
              });
            </script>

            <script>
              $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
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
    var pmo = $('#pmo').val();
    var purpose = $('#purpose').val();

    window.location = 
    'ViewPRdetails1.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
  });
}) ;
</script>

