<?php
error_reporting(0);
ini_set('display_errors', 0);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "root", "");
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
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

$id = $_GET['id'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];
$pr_no1 = $_GET['pr_no'];
$type = $_GET['type'];
$target_date = $_GET['target_date'];


// if (isset($_POST['submit'])) {
//   $pr_date = $_POST['pr_date'];
//   $purpose = $_POST['purpose'];
//   $pmo = $_POST['pmo'];
//   $unit1 = $_POST['unit1'];
//   $pr_no1 = $_POST['pr_no'];

  
//   $check = mysqli_query($conn,"SELECT pr_no FROM pr WHERE pr_no = '$pr_no1' ");

//   // if (mysqli_num_rows($check)>0) {
//   //   echo "<div style='background-color:lightblue;color:red;'> <p> <b>This PR_NO is already existing</b> <p> <div>";
//   // }else{


//     $insert_pr = mysqli_query($conn,"INSERT INTO pr(pr_no,pmo,purpose,pr_date) VALUES('$pr_no1','$pmo','$purpose','$pr_date')");

//     for($count = 0; $count < count($_POST["items1"]); $count++)
//     {  


//      $insert_items = mysqli_query($conn,'INSERT INTO pr_items(pr_no,items,description,unit,qty,abc) 
//       VALUES("'.$pr_no1.'","'.$_POST['items1'][$count].'","'.$_POST['description1'][$count].'","'.$unit1[$count].'","'.$_POST['qty1'][$count].'","'.$_POST['abc1'][$count].'")');
//    }
//    $select_id = mysqli_query($conn,"SELECT * FROM pr WHERE pr_no = '$pr_no1'");
//    $rowW = mysqli_fetch_array($select_id);
//    $ids = $rowW['id'];
//    echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Successfuly Saved!')
//     window.location.href = 'ViewPRv.php?id=$ids';
//     </SCRIPT>");

//  // }
// }

if (isset($_POST['add'])) {
  $pmo = $_POST["pmo"];
  $qty = $_POST["qty"];
  $pr_no = $_POST["pr_no"];
  $app_items = $_POST["app_items"];
  $description = $_POST["description"];
  $unit = $_POST["unit"];
  $qty = $_POST["qty"];
  $abc = $_POST["abc"];


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




if ($app_items == "------------------------------SELECT ITEM------------------------------") {
  echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Item Cannot be NULL!  </p> </div></div>  ';

}else{


  if ($unit == "0") {
  echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:red;font-size:16px;"> Unit Cannot be NULL!  </p> </div></div>  ';
  }else{
  $insert_items = mysqli_query($conn,"INSERT INTO pr_items(pr_no,items,description,unit,qty,abc) VALUES ('$pr_no1','$app_items','$description','$unit','$qty','$abc') ");

  echo '<div class="item panel panel-info"><div class="panel-heading"> <p style = "color:green;font-size:16px;"> Successfuly Saved!  </p> </div></div>  ';

   header('location: ViewRFQdetails.php?id='.$id.' ');
    echo ("<SCRIPT LANGUAGE='JavaScript'>
       window.alert('SUCCESS : Item Successfuly added!')
      window.location.href='ViewRFQdetails.php?id=$id';
      </SCRIPT>");
  }
}

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
    <h1 align="" >&nbspAdd Item for Purchase Request No. <?php echo $pr_no1?></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewRFQdetails.php?id=<?php echo $id?>" style="color:white;text-decoration: none;">Back</a></li>
    <!-- <a href="javascript:void(0);"  class="btn btn-primary link" data-id="<=$data['id']?>">View Items</a><br><br> -->

    <br>
    <br>
    <form method="POST" >
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <!-- <input class="form-control" type="text"  name="pr_no" value="<?php echo $pr_no;?>" > -->
                  <!-- <label>PR No.</label>
                  
                </div>


                <div class="form-group">
                  <label>Office</label>
                  <input class="form-control" type="text"  name="pmo" id="pmo" value="<?php echo $pmo;?>" readonly>
                 
              </div>
 -->
              <!-- <div class="form-group">
                  <label>Type <label style="color: Red;" >*</label></label>
                  <?php if ($type == 1): ?>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="1">Catering Services</option>
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="3">Repair and Maintenance</option>
                      <option value="4">Supplies, Materials and Devices</option>
                      <option value="5">Other Services</option>
                      
                    
                    </select>
                  <?php endif ?>
                  <?php if ($type == 2): ?>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="1">Catering Services</option>
                      <option value="3">Repair and Maintenance</option>
                      <option value="4">Supplies, Materials and Devices</option>
                      <option value="5">Other Services</option>
                    </select>
                  <?php endif ?>
                  <?php if ($type == 3): ?>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="3">Repair and Maintenance</option>
                      <option value="1">Catering Services</option>
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="4">Supplies, Materials and Devices</option>
                      <option value="5">Other Services</option>
                    </select>
                  <?php endif ?>
                  <?php if ($type == 4): ?>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="4">Supplies, Materials and Devices</option>
                      <option value="1">Catering Services</option>
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="3">Repair and Maintenance</option>
                      <option value="5">Other Services</option>
                    </select>
                  <?php endif ?>
                  <?php if ($type == 5): ?>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="5">Other Services</option>
                      <option value="1">Catering Services</option>
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="3">Repair and Maintenance</option>
                      <option value="4">Supplies, Materials and Devices</option>
                    
                    </select>
                  <?php endif ?>
                  <?php if ($type == ''): ?>

                  <select class="form-control select2" style="width: 100%;" name="type" id="type" >
                      <option value="0">------------------------SELECT TYPE------------------------</option>
                      <option value="1">Catering Services</option>
                      <option value="2">Meals, Venue and Accommodation</option>
                      <option value="3">Repair and Maintenance</option>
                      <option value="4">Supplies, Materials and Devices</option>
                      <option value="5">Other Services</option>
                    </select>
                  <?php endif ?>
                 
              </div> -->


          </div>
              
              <div class="col-md-6">

              <!--   <div class="form-group">
                  <label>PR Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right"  name="pr_date" value="<?php echo $pr_date;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label>Target Date <label style="color: Red;" >*</label></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php if ($target_date ==''): ?>
                    <input type="date" class="form-control pull-right" name="target_date" id="" value="<?php echo isset($_POST['target_date']) ? $_POST['target_date'] : '' ?>" required placeholder="mm/dd/yyyy">
                    <?php else: ?>
                      <input type="date" class="form-control pull-right" name="target_date" id="" value="<?php echo $target_date;?>" required placeholder="mm/dd/yyyy">
                    <?php endif ?>
                      <input type="date" class="form-control pull-right" name="target_date" id="target_date" value="" required>
                    
                    </div>
                  </div> -->

<!-- 
                <div class="form-group" >
                  <label>Purpose</label>
                  <textarea class="form-control" type="text"  name="purpose"><?php echo  $purpose; ?> </textarea> 
                </div> -->


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
            <i class="fa fa-list-alt"></i> Item
            <button class="btn btn-primary pull-right"  type="submit" name="add" onclick="return confirm('Are you sure you want to Add this item?');">Add Item</button>
            <div class="clearfix"></div>
          </div>
          <div class="panel-body container-items">
            <div class=""><!-- widgetBody -->
              <div class="row">
                <div class="col-md-6" style="padding-left: 30px;padding-top:10px;">
                <label>Item/s <label style="color: Red;" >*</label> </label>
                  <input type="text" class="form-control" name="app" id="app_items" placeholder="Search" class="" />
                  <table class="table table-striped table-hover" id="main">
                    <tbody id="result">
                    </tbody>
                  </table>
                  <br>
                  <br>
                  
                  <div hidden>
                    <input type="text" name="app_items" id="id" class="form-control"/>

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
                    document.getElementById("abc").value = x[6].innerHTML;
                  }
                </script>
                  </div>
                  <div class="form-group">
                    <label>Stock/Property No.  <label style="color: Red;" >*</label> </label>
                    <input type="text" name="stocknumber" id="stocknumber" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Description/Specification <label style="color: Red;" >*</label> </label>
                    <textarea class="form-control" rows="3" name="description" ></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <p></p>

                
                  <div class="form-group" hidden>
                    <label>Existing QTY</label>
                    <input class="form-control" type="number" readonly id="two" name="two">
                  </div>
                  <div class="form-group">
                    <label>Unit <label style="color: Red;" >*</label></label>
                    <input type="text" name="unit" id="unit"  class="form-control" readonly>
                    <!-- <select class="form-control select2" style="width: 100%;" name="unit" id="unit" >
                      <option value="5">------------------------------SELECT UNIT------------------------------</option>
                      <option value="16">book</option>
                      <option value="11">bottle</option>
                      <option value="2">box</option>
                      <option value="14">bundle</option>
                      <option value="10">can</option>
                      <option value="21">cart</option>
                      <option value="6">crtg</option>
                      <option value="18">dozen</option>
                      <option value="20">gallon</option>
                      <option value="13">jar</option>
                      <option value="4">lot</option>
                      <option value="7">pack</option>
                      <option value="15">pad</option>
                      <option value="19">pair</option>
                      <option value="1">piece</option>
                      <option value="17">pouch</option>
                      <option value="3">ream</option>
                      <option value="9">roll</option>
                      <option value="12">set</option>
                      <option value="8">tube</option>
                      <option value="5">unit</option>
                    </select> -->
                    <table class="table table-striped table-hover" id="main">
                    <tbody id="result">
                    </tbody>
                  </table>
                  <br>
                  
                   
                  
                 
                  </div>
                  
                 
                  <div class="form-group">
                    <label>Quantity <label style="color: Red;" >*</label></label>
                    <input class="form-control" type="number" id="qty" name="qty">
                  </div>
                  <div class="form-group">
                    <label>Unit Cost <label style="color: Red;" >*</label></label>
                    <input class="form-control" type="text" id="abc"  name="abc" readonly>
                  </div>

                  <!-- /.box-body -->
                </div>
              </div>
            </div>
          </div>
        </div>  


        <br>
        <br>
        <div class="panel-body container-items">
         
   </div>
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
  $("#result").click(function(){
    $("#main").hide();
  });
});
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
      'ViewPRdetails.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
    });
  }) ;
</script>

