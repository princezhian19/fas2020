<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "root", "");
$conn=mysqli_connect("localhost","root","","fascalab_2020");
$rfq_id = $_GET['rfq_id'];

$select_rfq = mysqli_query($conn,"SELECT * FROM rfq WHERE id = $rfq_id");
$rowR = mysqli_fetch_array($select_rfq);
$rfq_no = $rowR['rfq_no'];
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
    $conn=mysqli_connect("localhost","root","","fascalab_2020");
    $rfq_id = $_GET['rfq_id'];
  
    $select_items = mysqli_query($conn,"SELECT app.procurement,rq.id FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id WHERE rq.rfq_id = $rfq_id");
    while ($row = mysqli_fetch_assoc($select_items)) {
        $procurement = $row['procurement'];
        $item_id = $row['id'];

        echo   '<table id="example1" class="table table-bordered-striped table-bordered" style="width:;background-color: white;">
    <thead>
    <tr style="background-color: white;color:black;">
    <th>Item</th>
    <th>Price per Unit</th>
    </tr>
    </thead>' ;

        echo  '<td width="800">';
        echo $procurement;
        echo '</td>';
        echo '<td hidden><textarea name="remarks[]">';
        echo $procurement;    
        echo '</textarea></td>';
        echo '<td hidden><textarea name="item_id[]">';
        echo $item_id;    
        echo '</textarea></td>';
        echo  '<td>
        <input type="text" required name="ppu[]" class="form-control col-md-6">
        </td>';
    }
    echo '</table>';
}
if (isset($_POST['submit'])) {
    $supplier_id = $_POST['supplier_id'];
    $item_id = $_POST['item_id'];
    $ppu = $_POST['ppu'];
    $remarks = $_POST['remarks'];

     for($count = 0; $count < count($_POST["ppu"]); $count++){
        $ppu = $_POST['ppu'][$count]; 
        $remarks = $_POST['remarks'][$count]; 
        $item_id = $_POST['item_id'][$count]; 


    $INSERT = mysqli_query($conn,"INSERT INTO supplier_quote(supplier_id,rfq_item_id,ppu,remarks) VALUES('$supplier_id','$item_id','$ppu','$remarks')");

    if ($INSERT) {
       
            echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Supplier Qoute Created!')
        window.location.href='CreateSupplierQuote.php?rfq_id=$rfq_id';
        </SCRIPT>");
       
   }else{

        }

    }

    $insertAOQ = mysqli_query($conn,"INSERT INTO abstract_of_quote(supplier_id,rfq_id) VALUES('$supplier_id','$rfq_id')");
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="supplier-quote-form">
    <form method="POST">
        <div class="panel panel-default">
           <h1><p style="padding-left: 15px;">Encode Supplier Quote for RFQ No. <?php echo $rfq_no;?></p></h1> 
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
                        <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="supplier_id" name="supplier_id" >
                         <option value="" disabled selected>Select your Supplier</option>
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
         <button class="btn btn-success" name="submit">Create</button>
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





