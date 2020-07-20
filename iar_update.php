<?php 
ob_start();
?>
<html>
<head>
</head>
<body style="background: lightgray;">
  <div class="">
    <div class="panel panel-default">
      <br>
      
      <h1 align="">&nbspUpdate Inspection Acceptance Report</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewIAR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

      <table class="table table-striped table-hover" id="main">
        <tbody id="result">
        </tbody>
      </table>
      <div class="box-body">
        <div class="well">
          <div class="row">
            <form method="POST">

              <div class="col-xs-3">
                <label>Supplier : </label>
                <?php
                $conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
                $sq = mysqli_query($conn,"SELECT supplier from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" readonly placeholder="" name="sup" id="sup" value="'.$row['supplier'].'" />';   
                }
                ?>

              </div>
              <div class="col-xs-3">
                <label>PO No. : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT po_no from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" readonly placeholder="" name="po" id="po" value="'.$row['po_no'].'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>PO Date : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT po_date from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" readonly placeholder="" name="po_date" id="po_date" value="'.$row['po_date'].'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>Requisition Dept. : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT dept from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" readonly placeholder="" name="dept" id="dept" value="'.$row['dept'].'" />';   
                }
                ?>
              </div>
              <p>&nbsp</p>
              <p>&nbsp</p>
              <div class="col-xs-3">
                <label>Code Center</label>
                <?php
                $sq = mysqli_query($conn,"SELECT ccode from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" placeholder="" name="ccode" id="ccode" value="'.$row['ccode'].'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>Iar No. : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT iar_no from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" placeholder="" name="iar_no" id="iar_no" value="'.$row['iar_no'].'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>Iar Date : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT iar_date from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" placeholder="" name="iar_date" id="iar_date" value="'.date('m/d/Y',strtotime($row['iar_date'])).'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>Invoice No. : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT invoice_no from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" placeholder="" name="invoice" id="invoice" value="'.$row['invoice_no'].'" />';   
                }
                ?>
              </div>
              <p>&nbsp</p>
              <p>&nbsp</p>
              <div class="col-xs-3">
                <label>Invoice Date. : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT invoice_date from iar where id ='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {
                  echo '<input type="text" class="form-control" style="height: 40px;" placeholder="" name="invoice_date" id="invoice_date" value="'.date('m/d/Y',strtotime($row['invoice_date'])).'" />';   
                }
                ?>
              </div>
              <div class="col-xs-3">
                <label>Inspection Offircer : </label>
                <?php
                $sq = mysqli_query($conn,"SELECT officer from iar where id='".$_GET['id']."' ");
                while ($row = mysqli_fetch_assoc($sq)) {

                  if ($row['officer'] == 1) {
                   echo 
                   '<select name="officer" class="form-control">
                   <option value="1">Reschiel B. Veridiano</option>
                   <option value="2">Leticia A. Delgado</option>
                   <option value="3">Medel A. Saturno</option>
                   <option value="4">Rafael M. Saturno</option>
                   <option value="5">Camille T. Ronquillo</option>
                   <option value="6">Art Brian G. Rubio</option>
                   <option value="7">Hannah Grace P. Solis</option>
                   <option value="8">Eunice A. Sales</option>
                   </select>';  

                 }elseif($row['officer'] == 2){

                  echo 
                  '<select name="officer" class="form-control">
                  <option value="2">Leticia A. Delgado</option>
                  <option value="1">Reschiel B. Veridiano</option>
                  
                  <option value="3">Medel A. Saturno</option>
                  <option value="4">Rafael M. Saturno</option>
                  <option value="5">Camille T. Ronquillo</option>
                  <option value="6">Art Brian G. Rubio</option>
                  <option value="7">Hannah Grace P. Solis</option>
                  <option value="8">Eunice A. Sales</option>
                  </select>';  


                }elseif ($row['officer'] == 3) {
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="2">Leticia A. Delgado</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 
                 <option value="3">Medel A. Saturno</option>
                 <option value="4">Rafael M. Saturno</option>
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="6">Art Brian G. Rubio</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="8">Eunice A. Sales</option>

                 </select>';              
               }

               elseif ($row['officer'] == 4){
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="4">Rafael M. Saturno</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 <option value="2">Leticia A. Delgado</option>
                 <option value="3">Medel A. Saturno</option>
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="6">Art Brian G. Rubio</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="8">Eunice A. Sales</option>
                 
                 </select>';
               }elseif ($row['officer'] == 5){
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 <option value="2">Leticia A. Delgado</option>
                 <option value="3">Medel A. Saturno</option>
                 <option value="4">Rafael M. Saturno</option>
                 <option value="6">Art Brian G. Rubio</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="8">Eunice A. Sales</option>
                 
                 </select>';
               }elseif ($row['officer'] == 6){
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 <option value="2">Leticia A. Delgado</option>
                 <option value="3">Medel A. Saturno</option>
                 <option value="4">Rafael M. Saturno</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="8">Eunice A. Sales</option>
                 
                 </select>';
               }elseif ($row['officer'] == 7){
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 <option value="2">Leticia A. Delgado</option>
                 <option value="3">Medel A. Saturno</option>
                 <option value="4">Rafael M. Saturno</option>
                 <option value="8">Eunice A. Sales</option>
                 <option value="6">Art Brian G. Rubio</option>
                 
                 </select>';
               }
               elseif ($row['officer'] == 8){
                 echo 
                 '<select name="officer" class="form-control">
                 <option value="8">Eunice A. Sales</option>
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="1">Reschiel B. Veridiano</option>
                 <option value="2">Leticia A. Delgado</option>
                 <option value="3">Medel A. Saturno</option>
                 <option value="4">Rafael M. Saturno</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="6">Art Brian G. Rubio</option>
                 
                 </select>';
               }else{
                echo 
                '<select name="officer" class="form-control">
                
                <option value="1">Reschiel B. Veridiano</option>
                <option value="2">Leticia A. Delgado</option>
                <option value="3">Medel A. Saturno</option>
                <option value="4">Rafael M. Saturno</option>
                 <option value="5">Camille T. Ronquillo</option>
                 <option value="6">Art Brian G. Rubio</option>
                 <option value="7">Hannah Grace P. Solis</option>
                 <option value="8">Eunice A. Sales</option>
                </select>';

              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div style="padding:20px;">
     <button type="submit" name="submit"  class="btn btn-primary">Update</button>
   </div>

 </form>
</div>
</div>
</body>
</html>
<?php
if (isset($_POST['submit'])) 
{
  $sup = $_POST['sup'];
  $po = $_POST['po'];
  $po_date = $_POST['po_date'];
  $dept = $_POST['dept'];
  $ccode = $_POST['ccode'];
  $iar_no = $_POST['iar_no'];
  $iar_date = $_POST['iar_date'];
  $invoice = $_POST['invoice'];
  $invoice_date = $_POST['invoice_date'];
  $officer = $_POST['officer'];

  $sql1 = "UPDATE iar set supplier='$sup',po_no='$po',po_date ='$po_date',dept ='$dept',ccode ='$ccode',iar_no ='$iar_no',iar_date ='$iar_date',invoice_no = '$invoice',invoice_date ='$invoice_date',officer ='$officer' where id ='".$_GET['id']."' ";
  $result1 = mysqli_query($conn,$sql1);  

  if (!empty($sql1))
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('IAR Updated!')
      </SCRIPT>");
    header("Refresh:0");

  } else {
   echo "Error: " ;
 }

}


  // code 

ob_end_flush();
?>


