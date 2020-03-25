
<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$app_id = $_GET['app_id'];
$rfq_id = $_GET['rfq_id'];
$iar_id = $_GET['iar_id'];
$dept = $_GET['division'];
$ris_no = $_GET['ris_no'];
$remarks = $_GET['remarks'];
$request_by = $_GET['request_by'];
$approved_by = $_GET['approved_by'];
$issued_by = $_GET['issued_by'];
$recieved_by = $_GET['recieved_by'];
$purpose = $_GET['purpose'];
$po_no = $_GET['po_no'];
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
      <h1 align="">&nbspCreate Requisition and Issue Slip to Many</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreateRIS.php" style="color:white;text-decoration: none;">Back</a></li>
      <div class="box-body">
        <div class="well">
          <div class="row">
            <form method="post" id ="f">
              <div hidden class="col-xs-3">
                <label>IAR ID : </label>
                <input value="<?php echo $_GET['iar_id'];?>" type="text" class="form-control" style="height: 40px;" id="iar_id" placeholder="" name="iar_id" >
              </div>
              <div hidden class="col-xs-3">
                <label>rfq ID : </label>
                <input value="<?php echo $_GET['rfq_id'];?>" type="text" class="form-control" style="height: 40px;" id="rfq_id" placeholder="" name="rfq_id">
              </div>
              <div hidden class="col-xs-3">
                <label>app ID : </label>
                <input value="<?php echo $_GET['app_id'];?>" type="text" class="form-control" style="height: 40px;" id="app_id" placeholder="" name="app_id">
              </div>
              <div class="col-xs-3">
                <label>Division : </label>
                <!-- <input value="<?php echo $_GET['division'];?>" type="text"  class="form-control" style="height: 40px;" id="division" placeholder="" name="dept"> -->
                <?php if ($_GET['division'] == "ORD"): ?>
                 <select  name="dept" id="dept" class="form-control"  >
                  <option value="ORD">ORD</option >
                  <option value="LGMED">LGMED</option>
                  <option value="LGCDD">LGCDD</option >
                  <option value="FAD">FAD</option >
                  <option value="LGMED-PDMU">LGMED-PDMU</option >
                  <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
                </select>
              <?php endif ?>

              <?php if ($_GET['division'] == "LGMED"): ?>
               <select  name="dept" id="dept" class="form-control"  >
                <option value="LGMED">LGMED</option>
                <option value="ORD">ORD</option >
                <option value="LGCDD">LGCDD</option >
                <option value="FAD">FAD</option >
                <option value="LGMED-PDMU">LGMED-PDMU</option >
                <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
              </select>
            <?php endif ?>

            <?php if ($_GET['division'] == "LGCDD"): ?>
             <select  name="dept" id="dept" class="form-control"  >
              <option value="LGCDD">LGCDD</option >
              <option value="LGMED">LGMED</option>
              <option value="ORD">ORD</option >
              <option value="FAD">FAD</option >
              <option value="LGMED-PDMU">LGMED-PDMU</option >
              <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
            </select>
          <?php endif ?>


          <?php if ($_GET['division'] == "FAD"): ?>
           <select  name="dept" id="dept" class="form-control"  >
            <option value="FAD">FAD</option >
            <option value="LGCDD">LGCDD</option >
            <option value="LGMED">LGMED</option>
            <option value="ORD">ORD</option >
            <option value="LGMED-PDMU">LGMED-PDMU</option >
            <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
          </select>
        <?php endif ?>

        <?php if ($_GET['division'] == "LGMED-PDMU"): ?>
         <select  name="dept" id="dept" class="form-control"  >
          <option value="LGMED-PDMU">LGMED-PDMU</option >
          <option value="FAD">FAD</option >
          <option value="LGCDD">LGCDD</option >
          <option value="LGMED">LGMED</option>
          <option value="ORD">ORD</option >
          <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
        </select>
      <?php endif ?>


      <?php if ($_GET['division'] == "LGCDD-MBRTG"): ?>
       <select  name="dept" id="dept" class="form-control"  >
        <option value="LGCDD-MBRTG">LGCDD-MBRTG</option >
        <option value="LGMED-PDMU">LGMED-PDMU</option >
        <option value="FAD">FAD</option >
        <option value="LGCDD">LGCDD</option >
        <option value="LGMED">LGMED</option>
        <option value="ORD">ORD</option >
      </select>
    <?php endif ?>

  </div>
  <div class="col-xs-3">
    <label>PO No. : </label>
    <input value="<?php echo $_GET['po_no'];?>" type="text" readonly class="form-control" style="height: 40px;" id="po_no" placeholder="" name="po_no">
  </div>
  <div class="col-xs-3">
    <label>RIS No : </label>
    <input required value="<?php echo $_GET['ris_no'];?>" type="text"  class="form-control" style="height: 40px;" id="ris_no" placeholder="" name="ris_no">
  </div>
  <div  class="col-xs-3">
    <label>Remarks : </label>
    <textarea value=""  class="form-control"   placeholder="Remarks" name="remarks" id="remarks" ><?php echo $_GET['remarks'];?></textarea> 
  </div>
  <p>&nbsp</p>
  <p>&nbsp</p>

    <div class="col-xs-3">
      <label>Requested by : </label>
                <input value="<?php echo $_GET['request_by'];?>" type="text"  class="form-control" style="height: 40px;" id="request_by" placeholder="" name="request_by">
     
    </div>

  <div class="col-xs-3">
    <label>Approve by : </label>
    <input  type="text" readonly class="form-control" style="height: 40px;" id="approved_by" placeholder="" name="approved_by" value="ELIAS F. FERNANDEZ JR.">
  </div>

  <div class="col-xs-3">
    <label>Issued by : </label>
    <input type="text" readonly="" class="form-control" style="height: 40px;" id="issued_by" placeholder="" name="issued_by" value="BEZALEEL O. SOLTURA">
  </div>

  <div  class="col-xs-3">
    <label>Recieved by : </label>
    <input  value="<?php echo $_GET['recieved_by'];?>" type="text" class="form-control" id="recieved_by" placeholder="" name="recieved_by">
  </div>
  <p>&nbsp</p>
  <p>&nbsp</p>
  <div  class="col-xs-3">
    <label>Purpose : </label>
    <textarea  class="form-control" placeholder="Purpose" id="purpose" style="width: 1000px;height: 100px;" name="purpose" ><?php echo $_GET['purpose'];?></textarea> 
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
</div>
</div>
<div class="box box-default">
  <div class="box-header with-border">
    <div class="box box-default">
      <div style="background-color: #ABB1D6;color:green;padding: 10px;">
        <i class="fa fa-fw fa-tasks"></i>Item(s)
      </div>
      <div class="box-header with-border">
        <div class="table-repsonsive">
          <table align="center"  style="background-color: white;width: 500px;border-width: medium;" class="table table-bordered" id="item_table" >
            <tr style="background-color: lightblue;">
             <th><i class="fa fa-fw fa-thumb-tack"></i></th>
             <th>Procurement Item(s) of Purchase Order Number : <?php echo $po_no?> </th>
             <th style="width: 150px;text-align: center;"><i class="fa fa-fw fa-thumb-tack"></i>Quantity </th>
           </tr>
           <tr>
            <?php 
            $conn = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', '');
            $sql_items = $conn->query("SELECT * FROM iar_stock WHERE po_no = '$po_no'");
            while ($row = $sql_items->fetch()) {
              $id = $row['id'];
              $qty = $row['qty'];
              $procurement1 = $row['procurement'];
              $rfq_id1 = $row['rfq_id'];
              $app_id1 = $row['app_id'];
              $description1 = $row['description'];
              $unit_id1 = $row['unit_id'];
              $abc1 = $row['abc'];
              ?>
              <td align="center"> <input type="checkbox" name="id[]" id="checkBox<?php echo $row['id'];?>" onclick="enableDisable(this.checked, 'textBox<?php echo $row['id'];?>')"></td>

              <td align="center" hidden> <input  type="text" name="rfq_id1[]" value="<?php echo $rfq_id1; ?>"></td>
              <td align="center" hidden> <input  type="text" name="app_id1[]" value="<?php echo $app_id1; ?>"></td>
              <td align="center" hidden> <input  type="text" name="description1[]" value="<?php echo $description1; ?>"></td>
              <td align="center" hidden> <input  type="text" name="unit_id1[]" value="<?php echo $unit_id1; ?>"></td>
              <td align="center" hidden> <input  type="text" name="abc1[]" value="<?php echo $abc1; ?>"></td>
              <td> <input hidden disabled type="text" id="textBox<?php echo $row['id'];?>"  name="procurement1[]" value="<?php echo $procurement1; ?>"><label><?php echo $procurement1; ?></label></td>
              <td align="center"><input type="checkbox" id="checkBox<?php echo $row['id'];?>" onclick="enableDisable1(this.checked, 'textBox1<?php echo $row['id'];?>')"> <input style="width:70px;" type="text" name="qty[]" value="<?php echo $row['qty']; ?>" id="textBox1<?php echo $row['id'];?>" disabled >
                

              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <div align="center" style="padding-left: 20px;">
    <input type="submit" name="submit" class="btn btn-primary" value="Save" />
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>
</div>
</div>
</div>
</div>
</form>



</div>
</div>
</body>
<script language="javascript">
  function enableDisable(bEnable, textBoxID)
  {
   document.getElementById(textBoxID).disabled = !bEnable
 }
</script>

<script language="javascript">
  function enableDisable1(bEnable, textBoxID)
  {
   document.getElementById(textBoxID).disabled = !bEnable
 }
</script>

</html>

<?php
if (isset($_POST['submit'])) { 
 $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
<<<<<<< HEAD
 $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
 $conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
 $rfq_id = $_POST['rfq_id'];
 $iar_id = $_POST['iar_id'];
 $iar_id = $_POST['iar_id'];
 $dept = $_POST['dept'];
 $ris_no = $_POST['ris_no'];
 $remarks = $_POST['remarks'];
 $request_by = $_POST['request_by'];
 $approved_by = $_POST['approved_by'];
 $issued_by = $_POST['issued_by'];
 $recieved_by = $_POST['recieved_by'];
 $purpose = $_POST['purpose'];
 $po_no = $_POST['po_no'];
 $qty = $_POST['qty'];
 $id  = $_POST['id'];

 for($count = 0; $count < count($_POST["id"]); $count++)
 {  

  $sql = mysqli_query($conn, 'SELECT ris_no FROM ris where ris_no = "'.$_POST["ris_no"].'" ');
  $row = mysqli_fetch_array($sql);
  $RISr = $row['ris_no'];

  if ($row>0) { 
    $query2 = mysqli_query($conn,'UPDATE ris SET remarks = "'.$_POST["remarks"].'", app_id = "'.$_POST["app_id"].'",rfq_id = "'.$_POST["rfq_id"].'",iar_id = "'.$_POST["iar_id"].'",division = "'.$_POST["dept"].'", ris_no = "'.$_POST["ris_no"].'",po_no = "'.$_POST["po_no"].'",request_by = "'.$_POST["request_by"].'", approved_by = "'.$_POST["approved_by"].'", issued_by = "'.$_POST["issued_by"].'", recieved_by = "'.$_POST["recieved_by"].'", purpose = "'.$_POST["purpose"].'" WHERE ris_no =  "'.$_POST["ris_no"].'" ');
  }else{
    $query2 = mysqli_query($conn,'INSERT INTO ris
      (remarks,app_id,rfq_id,iar_id,division,ris_no,po_no,request_by,approved_by,issued_by,recieved_by,purpose) 
      VALUES ("'.$_POST["remarks"].'","'.$_POST["app_id"].'","'.$_POST["rfq_id"].'","'.$_POST["iar_id"].'","'.$_POST["dept"].'","'.$_POST["ris_no"].'","'.$_POST["po_no"].'", "'.$_POST["request_by"].'", "'.$_POST["approved_by"].'", "'.$_POST["issued_by"].'", "'.$_POST["recieved_by"].'", "'.$_POST["purpose"].'")');
  }


  $saveRIStock = 'INSERT INTO ris_stock(rfq_id,ris_no,app_id,procurement,description,unit_id,qty,abc,status) 
  VALUES("'.$_POST["rfq_id1"][$count].'","'.$_POST["ris_no"].'","'.$_POST["app_id1"][$count].'","'.$_POST["procurement1"][$count].'","'.$_POST["description1"][$count].'","'.$_POST["unit_id1"][$count].'","'.$_POST["qty"][$count].'","'.$_POST["abc1"][$count].'",1) ';
  $statement3 = $connect->prepare($saveRIStock);
  $statement3->execute();  


}
echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('RIS Created!')
  window.location.href='ViewRIS.php';
  </SCRIPT>");
}
?>
