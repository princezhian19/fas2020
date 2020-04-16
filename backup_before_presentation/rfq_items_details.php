<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");




$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($query);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$pr_date = $row['pr_date'];
$purpose = $row['purpose'];



if (isset($_POST['submit'])) {
  $purpose1 = $_POST['purpose'];
  $pr1 = $_POST['pr'];
  $pmo1 = $_POST['pmo'];
  $pr_date1 = $_POST['pr_date'];

  
$update = mysqli_query($conn,"UPDATE pr SET pr_no = '$pr1', pmo = '$pmo1', purpose = '$purpose1', pr_date = '$pr_date1' where id = '$id' ");

if ($update) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Update Successful!')
            window.location.href = 'ViewRFQdetails.php?id=$id'
            </SCRIPT>");
   // header('location: ViewRFQdetails.php?id='.$id.' ');

}else{

     echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Error during saving!')
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
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspUpdate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
       &nbsp &nbsp &nbsp   <li class="btn btn-success"><?php echo '<a href="ViewPRv.php?id='.$id.'" style="color:white;text-decoration: none;">Back</a>' ?> </li>
      <br>
      <br>
      <form method="POST">
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>PR No.</label>
                  <input class="form-control" type="text"  name="pr" value="<?php echo $pr_no;?>">
                </div>
                <div class="form-group">
                  <label>Office</label>
                  <?php if ($pmo == 'ORD'): ?>
                   <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="ORD">ORD</option>
                    <option value="LGMED">LGMED</option>
                    <option value="LGCDD">LGCDD</option>
                    <option value="FAD">FAD</option>
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>


                <?php if ($pmo == 'LGMED'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="LGMED">LGMED</option>
                    <option value="ORD">ORD</option>
                    <option value="LGCDD">LGCDD</option>
                    <option value="FAD">FAD</option>
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == 'LGCDD'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="LGCDD">LGCDD</option>
                    <option value="LGMED">LGMED</option>
                    <option value="ORD">ORD</option>
                    <option value="FAD">FAD</option>
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == 'FAD'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="FAD">FAD</option>
                    <option value="LGCDD">LGCDD</option>
                    <option value="LGMED">LGMED</option>
                    <option value="ORD">ORD</option>
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == 'LGMED-PDMU'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="FAD">FAD</option>
                    <option value="LGCDD">LGCDD</option>
                    <option value="LGMED">LGMED</option>
                    <option value="ORD">ORD</option>
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == 'LGCDD-MBRTG'): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                    <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                    <option value="LGMED-PDMU">LGMED-PDMU</option>
                    <option value="FAD">FAD</option>
                    <option value="LGCDD">LGCDD</option>
                    <option value="LGMED">LGMED</option>
                    <option value="ORD">ORD</option>
                  </select>
                <?php endif ?>

                <?php if ($pmo == ''): ?>
                  <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" value="asdasd">
                    <option >Please Select</option>
                    <option value="ORD" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'ORD') ? 'selected="selected"' : ''; ?>>ORD</option>
                    <option value="LGMED" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED') ? 'selected="selected"' : ''; ?>>LGMED</option>
                    <option value="LGCDD" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD') ? 'selected="selected"' : ''; ?>>LGCDD</option>
                    <option value="FAD" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'FAD') ? 'selected="selected"' : ''; ?>>FAD</option>
                    <option value="LGMED-PDMU" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGMED-PDMU') ? 'selected="selected"' : ''; ?>>LGMED-PDMU</option>
                    <option value="LGCDD-MBRTG" <?php echo (isset($_POST['pmo']) && $_POST['pmo'] == 'LGCDD-MBRTG') ? 'selected="selected"' : ''; ?>>LGCDD-MBRTG</option>
                  </select>
                <?php endif ?>


              </div>
              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>PR Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right"  name="pr_date" value="<?php echo $pr_date;?>">
                  </div>
                </div>
                <div class="form-group" >
                  <label>Purpose</label>
                  <textarea class="form-control" type="text"  name="purpose"><?php echo  $purpose; ?> </textarea> 
                </div>
                <!-- <button class="btn btn-primary" style="float: right;" type="submit" name="submit">Update</button> -->

              </div>
            </div>
          </div>
          <div class="panel panel-success" id="item_table">
           <div class="panel-heading">
            <i class="fa fa-list-alt"></i> Item(s) of PR No. <?php echo $pr_no;?>
            <!-- <label class="pull-right"><i class="fa fa-cart-plus"></i> Items</label> -->
            <?php echo ' <a href="CreateUpdatePR.php?pr_no='.$pr_no.'&id='.$id.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'" class="btn btn-success pull-right"> Add more</a>'?>
               <!-- <?php echo '<a href="ViewEditPR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'  " ><i style="font-size:24px" class="fa">&#xf044;</i></a>' ?> -->

            <div class="clearfix"></div>
          </div>
          <div class="panel-body container-items">
           <table style="background-color: white;border-width: medium;" class="table " id="item_table" >
            <tr>
             <th width="150">Stock No.</th>
             <th width="100">Unit </th>
             <th width="350">Item</th>
             <th>Description </th>
             <th width="100">Quantity </th>
             <th width="150">Unit Cost </th>
             <th width="100">Option </th>
           </tr>
           <tr>
            <?php 
            $conn = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');

            // $sql_items = $conn->query("SELECT rfq_items.id,rfq_id,rfq_items.pr_no,app_id,qty,description,unit_id,abc,app.procurement,rfq.rfq_no FROM rfq_items 
            //   LEFT JOIN app ON app.id = rfq_items.app_id 
            //   LEFT JOIN rfq ON rfq.id = rfq_items.rfq_id WHERE rfq_items.pr_no = '$pr_no' ");

$sql_items = $conn->query("SELECT pr.id,pr.pr_no,a.procurement,a.sn,pr.description,pr.unit,pr.abc,pr.qty FROM pr_items pr  left join app a on a.id = pr.items WHERE pr_no = '$pr_no' ");
              $id2 = $_GET['id'];
            
            while ($row = $sql_items->fetch()) {
              $id = $row['id'];
              $sn = $row['sn'];
              $pr_no = $row['pr_no'];
              $app_id = $row['procurement'];
              $description = $row['description'];
              $unit = $row['unit'];
              $abc = $row['abc'];
              $qty = $row['qty'];

              if ($unit == "1") {
                $unit = "piece";
              }

              if ($unit == "2") {
                $unit = "box";
              }

              if ($unit == "3") {
                $unit = "ream";
              }

              if ($unit == "4") {
                $unit = "lot";
              }

              if ($unit == "5") {
                $unit = "unit";
              }

              if ($unit == "6") {
                $unit = "crtg";
              }

              if ($unit == "7") {
                $unit = "pack";
              }
              if ($unit == "8") {
                $unit = "tube";
              }

              if ($unit == "9") {
                $unit= "roll";
              }

              if ($unit == "10") {
                $unit = "can";
              }

              if ($unit == "11") {
                $unit = "bottle";
              }

              if ($unit == "12") {
                $unit = "set";
              }

              if ($unit == "13") {
                $unit = "jar";
              }

              if ($unit == "14") {
                $unit = "bundle";
              }

              if ($unit == "15") {
                $unit = "pad";
              }

              if ($unit == "16") {
                $unit = "book";
              }

              if ($unit == "17") {
                $unit = "pouch";
              }

              if ($unit == "18") {
                $unit = "dozen";
              }

              if ($unit== "19") {
                $unit = "pair";
              }

              if ($unit == "20") {
                $unit = "gallon";
              }

              if ($unit == "21") {
                $unit = "cart";
              } 
              ?>

              <td hidden><?php echo $pr_no?> </td>
              <td hidden><input  type="text" name="pr_no[]" value="<?php echo $pr_no ?>"> </td>
               <td hidden><?php echo $pr_no?> </td>
              <td hidden><?php echo $pmo?> </td>
              <td hidden><?php echo $pr_date?> </td>
              <td hidden><?php echo $purpose?> </td>

              <td><?php echo $sn?></td>
              <td><?php echo $unit?></td>
              <td><?php echo $app_id?></td>
              <td><?php echo $description?></td>
              <td><?php echo $qty?></td>
              <td><?php echo $abc?></td>
              <td>
               <?php echo '<a href="ViewUpdateRFQ.php?id2='.$_GET['id'].'&id='.$id.'&id='.$id.'  " ><i style="font-size:24px" class="fa">&#xf044;</i></a>' ?>



               <a onclick="return confirm('Are you sure you want to Delete?');" href="delete_rfq_items.php?id2=<?php echo $id2; ?>&id=<?php echo $id; ?> "><i style="font-size:24px" class="fa fa-trash-o"></i></a>'
             </td>
           </tr>
         <?php } ?>
       </table>
     </div>
   </div> 
   <br>
       <input type="submit" name="submit" value="Update" class="btn btn-primary" onclick="return confirm('Are you sure you want to update now?');">

   <br>
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

