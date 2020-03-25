
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
function fill_unit_select_box($connect)
{ 
  $po_no = $_GET['po_no'];
  $output = '';
  $query = "SELECT * FROM iar_stock where po_no = '$po_no' ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    // $output .= '<option value="'.$row["id"].'">'.$row["procurement"].''.'&nbsp'.''.'&nbsp'.''.'&nbsp'.''.'&nbsp'.''.'QTY'.' '.'('.''.$row["qty"].''.')'.'</option>';
    $output .= '<option value="'.$row["id"].'">'.$row["procurement"].'</option>';
  }
  return $output;
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
    <h1 align="">&nbspCreate Requisition and Issue Slip to Many</h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreateRIS.php" style="color:white;text-decoration: none;">Back</a></li>
    <br>
    <br>
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
      <input value="<?php echo $_GET['division'];?>" type="text" readonly class="form-control" style="height: 40px;" id="division" placeholder="" name="dept">
    </div>
    <div class="col-xs-3">
      <label>PO No. : </label>
      <input value="<?php echo $_GET['po_no'];?>" type="text" readonly class="form-control" style="height: 40px;" id="po_no" placeholder="" name="po_no">
    </div>
    <div class="col-xs-3">
      <label>RIS No : </label>
      <input required value="<?php echo $_GET['ris_no'];?>" type="text" readonly class="form-control" style="height: 40px;" id="ris_no" placeholder="" name="ris_no">
    </div>
    <div  class="col-xs-3">
      <label>Remarks : </label>
      <textarea value=""  class="form-control"  readonly placeholder="Remarks" name="remarks" id="remarks" ><?php echo $_GET['remarks'];?></textarea> 
    </div>
    <p>&nbsp</p>
    <p>&nbsp</p>

    <?php if ($_GET['request_by'] == 1): ?>
      <div class="col-xs-3">
        <label>Requested by : </label>
        <select readonly name="request_by" id="request_by" class="form-control">
          <option value="1">ELOISA G. ROZUL</option>
          <option value="2">JOHN M. CEREZO</option>
          <option value="3">DR. CARINA S. CRUZ</option>
        </select>
      </div>

    <?php endif ?>
    <?php if ($_GET['request_by'] == 2): ?>
      <div class="col-xs-3">
        <label>Requested by : </label>
        <select readonly name="request_by" id="request_by" class="form-control">
          <option value="2">JOHN M. CEREZO</option>
          <option value="1">ELOISA G. ROZUL</option>
          <option value="3">DR. CARINA S. CRUZ</option>
        </select>
      </div>
    <?php endif ?>
    <?php if ($_GET['request_by'] == 3): ?>
      <div class="col-xs-3">
        <label>Requested by : </label>
        <select readonly name="request_by" id="request_by" class="form-control">
          <option value="3">DR. CARINA S. CRUZ</option>
          <option value="2">JOHN M. CEREZO</option>
          <option value="1">ELOISA G. ROZUL</option>
        </select>
      </div>

    <?php endif ?>


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
      <input readonly value="<?php echo $_GET['recieved_by'];?>" type="text" class="form-control" id="recieved_by" placeholder="" name="recieved_by">
    </div>
    <p>&nbsp</p>
    <p>&nbsp</p>
    <div  class="col-xs-3">
      <label>Purpose : </label>
      <textarea readonly class="form-control" placeholder="Purpose" id="purpose" style="width: 1000px;height: 100px;" name="purpose" ><?php echo $_GET['purpose'];?></textarea> 
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

    <form method="post" id="insert_form">
      <div class="table-repsonsive">
       <span id="error"></span>

       <div align="right" style="background-color:lightblue;padding-right: 10px;padding-bottom: 10px;padding-top: 10px;">
          <label style="padding-right: 1050px;font-weight:5;color: green;"><i class="fa fa-fw fa-tasks"></i>Item(s)</label>
          <button type="button" name="add" style="padding-top:1px;padding-bottom: 1px;padding-left: 3px;padding-right: 5px;background-color:#009933;" class="btn btn-success btn-sm add"><span class="fa fa-fw fa-cart-plus"></span>Add Item
          </div>
      </button>
      <table style="background-color: white;padding-left: 10px;padding-right: 10px;" class="table" id="item_table">
         <th>Select Item </th>
         <th width="50">Option</th>
       </tr>
       <tr>
         <td hidden><input type="text" readonly name="app_id[]" value="<?php echo $app_id; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="iar_id[]" value="<?php echo $iar_id; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="remarks[]" value="<?php echo $remarks; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="rfq_id[]" value="<?php echo $rfq_id; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="rfq_id[]" value="<?php echo $rfq_id; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="ris_no[]" value="<?php echo $ris_no; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="dept[]" value="<?php echo $dept; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="request_by[]" value="<?php echo $request_by; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="recieved_by[]" value="<?php echo $recieved_by; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="purpose[]" value="<?php echo $purpose; ?>" class="form-control " /></td>
         <td hidden><input type="text" readonly name="item_name[]" value="<?php echo $po_no; ?>" class="form-control item_name" /></td>
         <td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>
         <td hidden><input type="text" name="item_quantity[]" class="form-control item_quantity" value="1" /></td>
         <td hidden><input type="text" name="approved_by[]" value="ELIAS F. FERNANDEZ JR." class="form-control " /></td>
         <td hidden><input type="text" name="issued_by[]" value="BEZALEEL O. SOLTURA" class="form-control " /></td>
         <td align="center"><button style="padding-top: 1px;padding-bottom: 1px;padding-left: 5px;padding-right: 5px;" type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>


       </tr>
     </table>

     <div align="left" style="padding-left: 20px;">
      <input type="submit" name="submit" class="btn btn-primary" value="Save" />
      <br>
      <br>
    </div>
  </div>
</div>
</form>
</div>
</div>

</body>
</html>

<script>
  $(document).ready(function(){

   $(document).on('click', '.add', function(){
    var html = '';
    html += '<tr>';

    html += '<td hidden><input type="text" readonly name="ris_no[]" value="<?php echo $ris_no; ?>" class="form-control " /></td>';
    html += '<td hidden><input type="text" readonly name="app_id[]" value="<?php echo $app_id; ?>" class="form-control " /></td>';
    html += '<td hidden><input type="text" readonly name="iar_id[]" value="<?php echo $_GET['iar_id'];?>" class="form-control item_name" /></td>';
    html += '<td hidden><input type="text" readonly name="remarks[]" value="<?php echo $remarks; ?>" class="form-control " /></td>';
    html += '<td hidden><input type="text" readonly name="dept[]" value="<?php echo $dept; ?>" class="form-control " /></td>';
    html += '<td hidden><input type="text" readonly name="request_by[]" value="<?php echo $request_by; ?>" class="form-control item_name" /></td>';
    html += '<td hidden><input type="text" readonly name="recieved_by[]" value="<?php echo $recieved_by; ?>" class="form-control item_name" /></td>';
    html += '<td hidden><input type="text" readonly name="purpose[]" value="<?php echo $purpose; ?>" class="form-control " /></td>';
    html += '<td hidden><input type="text" readonly name="item_name[]" value="<?php echo $po_no; ?>" class="form-control item_name" /></td>';
    html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
    html += '<td hidden><input type="text" name="item_quantity[]" class="form-control item_quantity" value = "1"/></td>';
    html += '<td hidden><input type="text" name="approved_by[]" value="ELIAS F. FERNANDEZ JR." class="form-control " /></td>';
    html += '<td hidden><input type="text" name="issued_by[]" value="BEZALEEL O. SOLTURA" class="form-control " /></td>';



    html += '<td align="center"><button style="padding-top: 1px;padding-bottom: 1px;padding-left: 5px;padding-right: 5px;" type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
    $('#item_table').append(html);
  });

   $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
  });

   $('#insert_form').on('submit', function(event){
    event.preventDefault();
    var error = '';
    $('.item_name').each(function(){
     var count = 1;
     if($(this).val() == '')
     {
      error += "<p>Enter Item Name at "+count+" Row</p>";
      return false;
    }
    count = count + 1;
  });

    $('.item_quantity').each(function(){
     var count = 1;
     if($(this).val() == '')
     {
      error += "<p>Enter Item Quantity at "+count+" Row</p>";
      return false;
    }
    count = count + 1;
  });

    $('.item_unit').each(function(){
     var count = 1;
     if($(this).val() == '')
     {
      error += "<p>Select Unit at "+count+" Row</p>";
      return false;
    }
    count = count + 1;
  });
    var form_data = $(this).serialize();
    if(error == '')
    {
     $.ajax({
      url:"itm.php",
      method:"POST",
      data:form_data,
      success:function(data)
      {
        $('#item_table').find("tr:gt(0)").remove();
        $('#error').html('<div class="alert alert-success">RIS Details Saved</div>');
        alert('RIS Details Saved');
        window.location.href = "ViewRIS.php";
    }
  });
   }
   else
   {
     $('#error').html('<div class="alert alert-danger">'+error+'</div>');
   }
 });

 });
</script>






<!-- INSERT.PHP -->

