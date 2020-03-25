<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "root", "");
$conn = mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];
$pr_no = $_GET['pr_no'];


$query = mysqli_query($conn,"SELECT a.procurement,i.item_unit_title,pa.description,pa.qty,pa.unit,pa.abc from pr_approved pa left join app a on a.id = pa.items left join item_unit i on i.id = pa.unit  where pa.id = '$id' ");
$row = mysqli_fetch_array($query);
$items = $row['procurement'];
$description = $row['description'];
$qty = $row['qty'];
$unit = $row['item_unit_title'];
$abc = $row['abc'];
// $existing_qty = $row['existing_qty'];

if (isset($_POST['submit'])) {

  $id = $_GET['id'];
  $qty = $_POST['qty'];
  $existing_qty = $_POST['two'];
  $abc = $_POST['abc'];
  $description = $_POST['description'];

 
    $uupdated = mysqli_query($conn,"UPDATE ");

    $UpdateItems = mysqli_query($conn,"UPDATE pr_approved set description = '$description', qty ='$qty',description = '$description', abc = '$abc' WHERE id = '$id' ");

    if ($UpdateItems) {
      echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Successfuly Updated!  </p> </div></div>  ';
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
<script type="text/javascript">
  $(document).ready(function(){
    function load_data(query)
    {
      $.ajax({
        url:"fetch_pr.php",
        method:"POST",
        data:{query:query},
        success:function(data)
        {
          $('#result').html(data);
        }
      });
    }
    $('#search_text').keyup(function(){
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
  function showRow(row)
  {
    var x=row.cells;
    document.getElementById("id").value = x[0].innerHTML;
    document.getElementById("current_price").value = x[1].innerHTML;
    document.getElementById("unit").value = x[2].innerHTML;
    document.getElementById("two").value = x[3].innerHTML;
    document.getElementById("app_items").value = x[4].innerHTML;
  }
</script>

<body>
<!-- <script>
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
   document.location = delUrl;
  }
}
</script>

<a href="javascript:confirmDelete('delete.page?id=1')">Delete</a>
-->
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspCreate Purchase Request</h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success"><?php echo '<a href="ViewPRdetails1.php?pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'" style="color:white;text-decoration: none;">Back</a>' ?> </li>

    <li class="btn btn-info"><?php echo '<a href="CreatePr1.php?pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.' " style="color:white;text-decoration: none;">Add More Items</a>' ?></li>
    <br>
    <br>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>PR No.</label>
                <input class="form-control" type="text" name="pr_no" readonly  id="pr_no" value="<?php echo $_GET['pr_no'] ?>">
              </div>
              <div class="form-group">
                <label>PMO/End User</label>
                  <input type="text" class="form-control" readonly name="pmo" value="<?php echo $pmo;?>">
          </div>


        </div>
        <div class="col-md-6">

          <div class="form-group">
            <label>PR Date</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="date" class="form-control pull-right" readonly name="pr_date" id="pr_date" value="<?php echo $_GET['pr_date']?>">
            </div>
          </div>

          <div class="form-group">
            <label>Purpose</label>
            <textarea class="form-control" type="text" id="purpose" readonly name="purpose"><?php echo $_GET['purpose'] ?> </textarea> 
            <!-- <input type="text" name="purpose" value="<?php echo isset($_POST['purpose']) ? $_POST['purpose'] : '' ?>" /> -->

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
      <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items">
      <div class=""><!-- widgetBody -->

        <div class="row">
          <div class="col-md-6" style="padding-left: 30px;padding-top:10px;">
              <!--   <input type="text" class="form-control" name="search_text" id="search_text" autocomplete="off" placeholder="Search Item" class="" />
                <table class="table table-striped table-hover" id="main" style="border-style: solid;border-top-style: none;">
                  <tbody id="result">
                  </tbody>
                </table> -->




                <label>Item </label>

                <input type="text" readonly name="items" id="app_items" class="form-control" value="<?php echo $items ?>" />
                <br>
                <br>
                <div hidden>
                  <input type="text" name="id" id="id" class="form-control"/>
                  
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" name="description"><?php echo $description ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <p></p>
                
                <div class="form-group">
                  <label>QTY</label>
                  <input class="form-control" type="number" id="qty" name="qty" value="<?php echo $qty ?>">
                </div>
                <div class="form-group" hidden>
                  <label>Existing QTY</label>
                  <input class="form-control" type="number" readonly id="two" name="two" value="<?php echo $existing_qty?>">
                </div>
                <div class="form-group">
                  <label>Unit</label>
                  <input type="text" name="unit" id="unit" value="<?php echo $unit ?>" readonly class="form-control">
                </div>
                <div class="form-group">
                  <label>ABC per Item</label>
                  <input class="form-control" type="text" id="current_price" value="<?php echo $abc ?>"  name="abc">
                </div>

                <!-- /.box-body -->
              </div>
            </div>
          </div>
        </div>
      </div>  
      <button class="btn btn-primary"  type="submit" name="submit" onclick="return confirm('Are you sure you want to Update now?');">Update</button>

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

