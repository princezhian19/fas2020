<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

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

$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];
$pr_no = $_GET['pr_no'];

if (isset($_POST['submit'])) {
  $pmo = $_POST["pmo"];
  $qty = $_POST["qty"];
  $existing_qty = $_POST["two"];

  // if ($qty > $existing_qty) {

  //   echo '<p style = "background-color:red;color:white;padding:10px;"> WARNING : You Entered Invalid Quantity </p>   ';

    // echo ("<SCRIPT LANGUAGE='JavaScript'>
    //   window.alert('WARNING : Invalid Quantity')
    //   window.location.href='CreatePr.php';
    //   </SCRIPT>");
   // header('location: CreatePr.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');

  // }else{

  for($count = 0; $count < count($_POST["app_items"]); $count++)
  {  
    $insert_items = mysqli_query($conn,'INSERT INTO pr_approved(pr_no,app_id,items,description,unit,existing_qty,qty,abc) 
      VALUES("'.$_POST['pr_no'].'","'.$_POST['app_id'][$count].'","'.$_POST['app_items'][$count].'","'.$_POST['description'][$count].'","'.$_POST['unit'][$count].'","'.$_POST['two'][$count].'","'.$_POST['qty'][$count].'","'.$_POST['abc'][$count].'")');
  }

    echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Successfuly Saved! <br> Click view items button to see all items that you saved. </p> </div></div>  ';
                    


               

    // }
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
  function showRow(row)
  {
    // var x=row.cells;
    // document.getElementById("id").value = x[0].innerHTML;
    // document.getElementById("current_price").value = x[1].innerHTML;
    // document.getElementById("unit").value = x[2].innerHTML;
    // document.getElementById("two").value = x[3].innerHTML;
    // document.getElementById("app_items").value = x[4].innerHTML;
    // document.getElementById("app_id").value = x[5].innerHTML;
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
    &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>
    <a href="javascript:void(0);"  class="btn btn-primary link" data-id="<=$data['id']?>">View Items</a><br><br>

    <br>
    <br>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>PR No.</label>
                <?php if ($pr_no != ''): ?>
                  <input class="form-control" type="text" name="pr_no" id="pr_no" autocomplete = "off" value="<?php echo $pr_no ?>">
                  <?php else:  ?>
                    <input class="form-control" type="text" name="pr_no" id="pr_no" autocomplete = "off" value="<?php echo isset($_POST['pr_no']) ? $_POST['pr_no'] : '' ?>">
                  <?php endif ?>

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



                <!-- <?php if ($pmo == ''): ?>
                  <option value="">---Select---</option>
                  <option value="ORD">ORD</option>
                  <option value="LGMED">LGMED</option>
                  <option value="LGCDD">LGCDD</option>
                  <option value="FAD">FAD</option>
                  <option value="LGMED-PDMU">LGMED-PDMU</option>
                  <option value="LGCDD-MBRTG">LGCDD-MBRTG</option>
                </select>
                <?php endif ?> -->


                <?php if ($pmo == ''): ?>
                 <select class="form-control select2" style="width: 100%;" name="pmo" id="pmo" >
                  <option <?php if (isset($pmo) && $pmo=="") echo "Please Select";?>>Please Select</option>
                  <option <?php if (isset($pmo) && $pmo=="ORD") echo "ORD";?>>ORD</option>
                  <option <?php if (isset($pmo) && $pmo=="LGMED") echo "LGMED";?>>LGMED</option>
                  <option <?php if (isset($pmo) && $pmo=="LGCDD") echo "LGCDD";?>>LGCDD</option>
                  <option <?php if (isset($pmo) && $pmo=="FAD") echo "FAD";?>>FAD</option>
                  <option <?php if (isset($pmo) && $pmo=="LGMED-PDMU") echo "LGMED-PDMU";?>>LGMED-PDMU</option>
                  <option <?php if (isset($pmo) && $pmo=="LGCDD-MBRTG") echo "LGCDD-MBRTG";?>>LGCDD-MBRTG</option>
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
                <?php if ($pr_date ==''): ?>
                  <input type="date" class="form-control pull-right" name="pr_date" id="pr_date" value="<?php echo isset($_POST['pr_date']) ? $_POST['pr_date'] : '' ?>">
                  <?php else: ?>
                    <input type="date" class="form-control pull-right" name="pr_date" id="pr_date" value="<?php echo $pr_date ?>">
                  <?php endif ?>
                </div>
              </div>

              <div class="form-group">
                <label>Purpose</label>
                <?php if ($purpose ==''): ?>
                  <textarea class="form-control" type="text" id="purpose" name="purpose"><?php echo isset($_POST['purpose']) ? $_POST['purpose'] : '' ?> </textarea> 
                  <?php else: ?>
                    <textarea class="form-control" type="text" id="purpose" name="purpose"><?php echo $purpose ?> </textarea> 

                  <?php endif ?>

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
                  <label>Item </label>
                  <!-- <input type="text"  name="app_items[]" id="app_items" autocomplete="off" class="form-control"/>
                  <table class="table table-striped table-hover" id="main" style="border-style: solid;border-top-style: none;">
                    <tbody id="result">
                    </tbody>
                  </table> -->
                    <select class="form-control select2" style="width: 100%;" name="app_items[]" id="app_items" >
                      <option>------------------------------SELECT ITEM------------------------------</option>
                      <?php echo app($connect);?>
                    </select>
                  <br>
                  <br>
                  <div hidden>
                    <input type="text" name="id" id="id" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <div hidden>
                    <input  type="text" name="app_id[]" id="app_id" class="form-control"/>
                    </div>
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description[]" ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <p></p>

                  <div class="form-group">
                    <label>QTY</label>
                    <input class="form-control" type="number" id="qty" name="qty[]">
                  </div>
                  <div class="form-group" hidden>
                    <label>Existing QTY</label>
                    <input class="form-control" type="number" readonly id="two" name="two[]">
                  </div>
                  <div class="form-group">
                    <label>Unit</label>
                    <!-- <input type="text" name="unit[]" id="unit"  class="form-control"> -->
                    <select class="form-control select2" style="width: 100%;" name="unit[]" id="unit" >
                    <option value="1">------------------------------SELECT UNIT------------------------------</option>
                    <option value="1">piece</option>
                    <option value="2">box</option>
                    <option value="3">ream</option>
                    <option value="4">lot</option>
                    <option value="5">unit</option>
                    <option value="6">crtg</option>
                    <option value="7">pack</option>
                    <option value="8">tube</option>
                    <option value="9">roll</option>
                    <option value="10">can</option>
                    <option value="11">bottle</option>
                    <option value="12">set</option>
                    <option value="13">jar</option>
                    <option value="14">bundle</option>
                    <option value="15">pad</option>
                    <option value="16">book</option>
                    <option value="17">pouch</option>
                    <option value="18">dozen</option>
                    <option value="19">pair</option>
                    <option value="20">gallon</option>
                    <option value="21">cart</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label>ABC per Item</label>
                    <input class="form-control" type="text" id="current_price"  name="abc[]">
                  </div>

                  <!-- /.box-body -->
                </div>
              </div>
            </div>
          </div>
        </div>  
        <button class="btn btn-primary"  type="submit" name="submit" onclick="return confirm('Are you sure you want to Add this item?');">Add Item</button>

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

    $('.link').click(function(){

      var f = $(this);
      var id = f.data('id');

      var pr_no = $('#pr_no').val();
      var pr_date = $('#pr_date').val();
      var pmo = $('#pmo').val();
      var purpose = $('#purpose').val();

      window.location = 
      'ViewPRdetails.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
    });
  }) ;
</script>

