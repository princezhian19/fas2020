<?php
$connect = new PDO("mysql:host=localhost;dbname=db_dilg_pmis", "root", "");
$conn=mysqli_connect("localhost","root","","db_dilg_pmis");
$rfq_id = $_GET['rfq_id'];
$supplier_id = $_GET['supplier_id'];

$select_rfq = mysqli_query($conn,"SELECT * FROM rfq WHERE id = $rfq_id");
$rowR = mysqli_fetch_array($select_rfq);
$rfq_no = $rowR['rfq_no'];
$select_sq = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
$rowsq = mysqli_fetch_array($select_sq);
$rfq_item_id = $rowsq['id'];

$select_sup = mysqli_query($conn,"SELECT s.supplier_title,s.id FROM supplier_quote sq LEFT JOIN supplier s on s.id = sq.supplier_id WHERE rfq_item_id = $rfq_item_id AND sq.supplier_id = $supplier_id");
$rowsup = mysqli_fetch_array($select_sup);
$supplierName = $rowsup['supplier_title'];
$supplierID = $rowsup['id'];

function supplier($connect)
{ 
  $output = '';
  $query = "SELECT * FROM supplier GROUP BY id DESC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["supplier_title"].'</option>';
  }
  return $output;
}
function table(){
  $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
  $rfq_id = $_GET['rfq_id'];
  $supplier_id = $_GET['supplier_id'];
  $select_sq = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
  $rowsq = mysqli_fetch_array($select_sq);
  $rfq_item_id = $rowsq['id'];

  $select_items = mysqli_query($conn,"SELECT sq.id,sq.ppu,sq.remarks,app.procurement  FROM supplier_quote sq LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id LEFT JOIN app on app.id = rq.app_id WHERE rq.rfq_id = $rfq_id AND sq.supplier_id = $supplier_id");

  while ($row = mysqli_fetch_assoc($select_items)) {
    $remarks = $row['remarks'];
    $suppQ_id = $row['id'];
    $ppu = $row['ppu'];

      echo   '<table id="example1" class="table table-bordered-striped table-bordered" style="width:;background-color: white;">
  <thead>
  <tr style="background-color: white;color:black;">
  <th>Item</th>
  <th>Price per Unit</th>
  </tr>
  </thead>' ;

    echo  '<td width="800">';
    echo $remarks;
    echo '</td>';
    echo '<td hidden><textarea name="remarks[]">';
    echo $remarks;    
    echo '</textarea></td>';
    echo '<td hidden><textarea name="suppQ_id[]">';
    echo $suppQ_id;    
    echo '</textarea></td>';
    echo  "<td>
    <input type='text' name='ppu[]' value='$ppu' class='form-control col-md-6' >";
 
    echo '</td>';
  }
  echo '</table>';
}
if (isset($_POST['submit'])) {
  $supplier_id = $_POST['supplier_id'];
  $suppQ_id = $_POST['suppQ_id'];
  $ppu = $_POST['ppu'];
  $remarks = $_POST['remarks'];

   for($count = 0; $count < count($_POST["ppu"]); $count++){
        $ppu = $_POST['ppu'][$count]; 
        $remarks = $_POST['remarks'][$count]; 
        $suppQ_id = $_POST['suppQ_id'][$count]; 

        

  $INSERT = mysqli_query($conn,"UPDATE supplier_quote SET ppu = '$ppu',supplier_id = '$supplier_id' WHERE id = $suppQ_id");

  if ($INSERT) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Supplier Qoute Updated!')
    window.location.href='UpdateSupplierQuote.php?rfq_id=$rfq_id&supplier_id=$supplier_id';
    </SCRIPT>");
 }else{

 }

 $update = mysqli_query($conn,"UPDATE abstract_of_quote SET supplier_id = $supplier_id WHERE supplier_id = $supplier_id AND rfq_id = $rfq_id");
}
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="supplier-quote-form">
  <form method="POST">
    <div class="panel panel-default">
     <h1><p style="padding-left: 15px;">Update Supplier Quote for RFQ No. <?php echo $rfq_no;?></p></h1> 
     <div class="panel-heading">
      <i class="fa fa-file-text"></i> Quotation(s)
      <!-- <span style="margin-right: 10px"><button type="button" class="pull-right add_form_field btn btn-success btn-xs"><i class="fa fa-plus"></i>  Add Supplier Quote</button></span> -->
      <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items"><!-- widgetContainer -->
      <legend class="panel-heading ">
        <span class="panel-title-address">Quote </span>

                   <!--  <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    <div class="clearfix"></div> -->
                  </legend>
                  <div class="well">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Select Supplier</label>
                        <select class="form-control select2" style="width: 100%;" autocomplete="off" id="supplier_id" name="supplier_id" >
                         <option value="<?php echo $supplierID?>" ><?php echo $supplierName?></option>
                         <?php echo supplier($connect); ?>
                       </select> 
                     </div>
                     <br>
                     <br> 
                     <br> 
                     <br> 
                     <?php echo table()?>
                   </div>
                 </div>
               </div>
               <div class="container1">

               </div>
               <div style="padding-left: 15px;padding-bottom: 15px;">
                 <button class="btn btn-primary" name="submit">Update</button>
               </div>
             </form>
           </div>
<!-- <script>
  $(document).ready(function() {
    var max_fields = 5;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");
    var x = 1;
    $(add_button).click(function(e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
            $(wrapper).append(' <div class="panel-body container-items"><legend class="panel-heading "><span class="panel-title-address">Quote </span><button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button><div class="clearfix"></div></legend><div class="well"><div class="row"><div class="col-md-6"><label>Select Supplier</label><select class="form-control select2" style="width: 100%;" autocomplete="off" id="supplier_id" name="supplier_id" ><option value="" disabled selected>Select your Supplier</option><?php echo supplier($connect); ?></select></div><br><br><br><br><?php echo table()?></div></div></div>');
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
</script> -->





