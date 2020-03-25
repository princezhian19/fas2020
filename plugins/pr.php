<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

function fill_unit_select_box($connect)
{ 
  $output = '';
  $query = "SELECT * FROM app LIMIT 10";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["procurement"].'</option>';
  }
    // $output .= '<option value="'.$row["id"].'">'.$row["procurement"].''.'&nbsp'.''.'&nbsp'.''.'&nbsp'.''.'&nbsp'.''.'QTY'.' '.'('.''.$row["qty"].''.')'.'</option>';

  return $output;
}

if (isset($_POST['submit'])) {

  $pr = $_POST['pr'];
  $pr_date = $_POST['pr_date'];
  $purpose = $_POST['purpose'];
  $pmo = $_POST['pmo'];


  for($count = 0; $count < count($_POST["app_items"]); $count++)
  {  
    $app_items = $_POST['app_items']

    foreach ($pmo as $end_user) {
      $insert_pr = mysqli_query($conn,"INSERT INTO pr (pr_no,pmo,purpose,pr_date) VALUES('$pr','$end_user','$purpose','$pr_date')");
    }

    $insert_items = mysqli_query($conn,'INSERT INTO pr_items(pr_no,items,description,unit,qty,abc) 
      VALUES("'.$_POST['pr'].'","'.$_POST['app_items'][$count].'","'.$_POST['description'][$count].'","'.$_POST['unit'][$count].'","'.$_POST['qty'][$count].'","'.$_POST['abc'][$count].'")');
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
  <script type="text/javascript">
    $(document).ready(function(){
      function load_data(query)
      {
        $.ajax({
          url:"fetch_iar.php",
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

        }
      });
    });
   
  </script>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <form method="POST">
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>PR No.</label>
                  <input class="form-control" type="text" name="pr">
                </div>
                <div class="form-group">
                  <label>Purpose</label>
                  <textarea class="form-control" type="text" name="purpose"> </textarea> 
                </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label>PMO/End User</label>
                <select class="form-control select2" style="width: 100%;" name="pmo[]" multiple="multiple">
                  <option value="ORD">ORD</option>
                  <option value="LGMED">LGMED</option>
                  <option value="LGCDD">LGCDD</option>
                  <option value="FAD">FAD</option>
                  <option value="LGMED-PDMU">LGMED-PDMU</option>
                  <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                </select>
              </div>
              <div class="form-group">
                <label>PR Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" name="pr_date">
                </div>
              </div>


              <!-- /.box-body -->
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <div class="panel panel-success" id="item_table">
         <?php
         $output = '';
         ?>
         <div class="panel-heading">
          <i class="fa fa-list-alt"></i> Item(s)
          <button type="button" class="pull-right add-item btn btn-success btn-xs add" name="add"><i class="fa fa-cart-plus"></i>  Add Item</button>
          <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items">
          <div class="item panel panel-info"><!-- widgetBody -->
            <div class="panel-heading">
              <span class="panel-title-address">Item(s)</span>
              <button type="button" class="pull-right remove-item btn btn-danger btn-xs" name="remove"><i class="glyphicon glyphicon-minus"></i></button>
              <div class="clearfix"></div>
            </div>
            <div class="row">
              <div class="col-md-6" style="padding-left: 30px;padding-top:10px;">
                <label>Item </label>
                <select name="app_items[]"  id="app_items" class="form-control select2" style="width: 100%;">
                  <option value="">Search Item</option><?php echo fill_unit_select_box($connect);?>
                </select>
                <br>
                <br>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" name="description[]" ></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <p></p>
                <div class="form-group">
                  <label>ABC per Item</label>
                  <input class="form-control" type="number" name="abc[]">
                </div>
                <div class="form-group">
                  <label>QTY</label>
                  <input class="form-control" type="number" name="qty[]">
                </div>
                <div class="form-group">
                  <label>Unit</label>
                  <select class="form-control " name="unit[]" style="width: 100%;">
                    <option>Select Status</option>
                    <option value="piece">piece</option>
                    <option value="box">box</option>
                    <option value="ream">ream</option>
                    <option value="lot">lot</option>
                    <option value="unit">unit</option>
                    <option value="crtg">crtg</option>
                    <option value="pack">pack</option>
                    <option value="tube">tube</option>
                    <option value="roll">roll</option>
                    <option value="can">can</option>
                    <option value="bottle">bottle</option>
                    <option value="set">set</option>
                    <option value="jar">jar</option>
                    <option value="bundle">bundle</option>
                    <option value="pad">pad</option>
                    <option value="book">book</option>
                    <option value="pouch">pouch</option>
                    <option value="dozen">dozen</option>
                    <option value="pair">pair</option>
                    <option value="gallon">gallon</option>
                  </select>
                </div>

                <!-- /.box-body -->
              </div>
            </div>
          </div>
        </div>
      </div>  
      <button class="btn btn-success" style="float: right;" type="submit" name="submit">Create</button>
      <br>
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
</body>
<script>
  $(document).ready(function(){

   $(document).on('click', '.add', function(){
    var html = '';
    html += ' <div class="panel panel-success asd" id="item_table"><?php $output = ''; ?><div class="panel-heading"><i class="fa fa-list-alt"></i> Item(s)<button type="button" class="pull-right add-item btn btn-success btn-xs add" name="add"><i class="fa fa-cart-plus"></i>  Add Item</button><div class="clearfix"></div></div><div class="panel-body container-items"><div class="item panel panel-info"><div class="panel-heading"><span class="panel-title-address">Item(s)</span><button type="button" class="pull-right remove-item btn btn-danger btn-xs" name="remove"><i class="glyphicon glyphicon-minus"></i></button><div class="clearfix"></div></div><div class="row"><div class="col-md-6" style="padding-left: 30px;padding-top:10px;"><label>Item </label><select name="app_items[]" class="form-control select2" style="width: 100%;"><option value="">Search Item</option><?php echo fill_unit_select_box($connect); ?></select><br><div class="form-group"><label>Description</label><textarea class="form-control" rows="3" name="description[]" ></textarea></div></div><div class="col-md-6"><p></p><div class="form-group"><label>ABC per Item</label><input class="form-control" type="number" name="abc[]"></div><div class="form-group"><label>QTY</label><input class="form-control" type="number" name="qty[]"></div><div class="form-group"><label>Unit</label><select class="form-control select2" name="unit[]" style="width: 100%;"><option>Select Status</option><option value="piece">piece</option><option value="box">box</option><option value="ream">ream</option><option value="lot">lot</option><option value="unit">unit</option><option value="crtg">crtg</option><option value="pack">pack</option><option value="tube">tube</option><option value="roll">roll</option><option value="can">can</option><option value="bottle">bottle</option><option value="set">set</option><option value="jar">jar</option><option value="bundle">bundle</option><option value="pad">pad</option><option value="book">book</option><option value="pouch">pouch</option><option value="dozen">dozen</option><option value="pair">pair</option><option value="gallon">gallon</option></select></div></div></div></div></div></div>';
    $('#item_table').append(html);
  });

   $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
  });



 });
</script>
