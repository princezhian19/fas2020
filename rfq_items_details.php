<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");




$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($query);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$pr_date = $row['pr_date'];
$ddd11 = date('m/d/Y', strtotime($pr_date));
$purpose = $row['purpose'];
$type = $row['type'];
$target_date = $row['target_date'];
$d22 = date('m/d/Y', strtotime($target_date));
$pr_no1 = $pr_no;

function pmo($connect)
{ 
  $output = '';
  $query = "SELECT id,pmo_title FROM `pmo` ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["pmo_title"].'">'.$row["pmo_title"].'</option>';
  }
  return $output;
}

if (isset($_POST['submit'])) {
  $purpose1 = $_POST['purpose'];
  $pr1 = $_POST['pr'];
  $pmo1 = $_POST['pmo'];
  $pr_date1 = $_POST['pr_date'];
  $d1 = date('Y-m-d', strtotime($pr_date1));
  $type1 = $_POST['type'];
  $target_date1 = $_POST['target_date'];
  $d2 = date('Y-m-d', strtotime($target_date1));

  /* $target_date = $_POST['target_date'];
  $d2 = date('Y-m-d', strtotime($target_date)); */


  
  $update = mysqli_query($conn,"UPDATE pr SET pr_no = '$pr1', pmo = '$pmo1', purpose = '$purpose1', type='$type1', pr_date = '$d1', target_date = '$d2'  where id = '$id' ");

  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Update Successful!')
      window.location.href = 'ViewPRv.php?id=".$id." '
      </SCRIPT>");
   // header('location: ViewRFQdetails.php?id='.$id.' ');

  }else{

   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error during saving!')
    </SCRIPT>");

 }

}

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
      $selectRid = mysqli_query($conn,"SELECT id FROM rfq WHERE pr_no = '$pr_no1");
      $rowrid = mysqli_fetch_array($selectRid);
      $rid = $rowrid['id'];
      
      if (mysqli_num_rows($selectRid)>0) {
        $insert_items = mysqli_query($conn,"INSERT INTO pr_items(pr_no,items,description,unit,qty,abc) VALUES ('$pr_no1','$app_items','$description','$unit','$qty','$abc') ");
        $total_amount = $qty * $abc;
        $insert_Ritems = mysqli_query($conn,"INSERT INTO rfq_items(rfq_id,pr_no,app_id,description,unit_id,qty,abc,total_amount) VALUES ('$rid','$pr_no1','$app_items','$description','$unit','$qty','$abc','$total_amount') ");
      }else{
        $insert_items = mysqli_query($conn,"INSERT INTO pr_items(pr_no,items,description,unit,qty,abc) VALUES ('$pr_no1','$app_items','$description','$unit','$qty','$abc') ");

      }


      echo ("<SCRIPT LANGUAGE='JavaScript'>
       window.alert('SUCCESS : Item Successfuly added!')
       window.location.href='ViewRFQdetails.php?id=$id';
       </SCRIPT>");
    }
  }

}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbsp<b>Edit Purchase Request</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><?php echo '<a href="ViewPR.php?id='.$id.'" style="color:white;text-decoration: none;">Back</a>' ?> </li>
    <br>
    <br>
    <form method="POST">
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>PR No.<label style="color: Red;" >*</label></label>
                <input class="form-control" type="text"  name="pr" value="<?php echo $pr_no;?>" readonly>
              </div>
              <div class="form-group">
                <label>Office <label style="color: Red;" >*</label></label>
                <?php if ($username == 'ctronquillo' || $username == 'sglee' || $username == 'jamonteiro'): ?>  
                  <?php if ($pmo == ''): ?>
                    <select class="form-control select2" name="pmo">
                      <option><?php echo pmo($connect)?></option>
                    </select>
                    <?php else: ?>
                      <select class="form-control select2" name="pmo">
                        <option><?php echo $pmo?></option>
                        <option><?php echo pmo($connect)?></option>
                      </select>
                    <?php endif ?>
                    
                    <?php else: ?>
                      <input type="text" class="form-control" style="width: 100%;" name="pmo" id="pmo" readonly value="<?php echo $pmo?>" >
                    <?php endif ?>
                  </div>

                  <div class="form-group">
                    <label>Type <label style="color: Red;" >*</label></label>
                    <?php if ($type == 1): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="5">Other Services</option>
                        <option value="6">Reimbursement and Petty Cash</option>


                      </select>
                    <?php endif ?>
                    <?php if ($type == 2): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="1">Catering Services</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="5">Other Services</option>
                        <option value="6">Reimbursement and Petty Cash</option>
                      </select>
                    <?php endif ?>
                    <?php if ($type == 3): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="3">Repair and Maintenance</option>
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="5">Other Services</option>
                        <option value="6">Reimbursement and Petty Cash</option>
                      </select>
                    <?php endif ?>
                    <?php if ($type == 4): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="5">Other Services</option>
                        <option value="6">Reimbursement and Petty Cash</option>
                      </select>
                    <?php endif ?>
                    <?php if ($type == 5): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="5">Other Services</option>
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="6">Reimbursement and Petty Cash</option>

                      </select>
                    <?php endif ?>

                    <?php if ($type == 6): ?>
                      <select class="form-control " style="width: 100%;" name="type" id="type" >
                        <option value="6">Reimbursement and Petty Cash</option>
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="5">Other Services</option>


                      </select>
                    <?php endif ?>
                    <?php if ($type == ''): ?>

                      <select required class="form-control " style="width: 100%;" name="type" id="type" >
                        <option selected disabled ></option>
                        <option value="1">Catering Services</option>
                        <option value="2">Meals, Venue and Accommodation</option>
                        <option value="3">Repair and Maintenance</option>
                        <option value="4">Supplies, Materials and Devices</option>
                        <option value="5">Other Services</option>
                        <option value="6">Reimbursement and Petty Cash</option>
                      </select>
                    <?php endif ?>

                  </div>


                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label>PR Date<label style="color: Red;" >*</label></label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id = "datepicker1" class="form-control pull-right"  name="pr_date" value="<?php 
                    /* if($pr_date='0000-00-00'){
                      $d11 = date('m/d/Y');
                    }
                    else{
                      $d11 = date('m/d/Y', strtotime($pr_date));
                      } */
                      echo $ddd11;?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Target Date<label style="color: Red;" >*</label></label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <?php if ($target_date ==''): ?>
                        <input type="text" class="form-control pull-right" name="target_date" id="datepicker2" value="<?php echo $d22;?>" required placeholder="mm/dd/yyyy">
                        <?php else: ?>
                          <input type="text" class="form-control pull-right" name="target_date" id="datepicker2" value="<?php echo $d22;?>" required placeholder="mm/dd/yyyy">
                        <?php endif ?>
                        <!-- <input type="date" class="form-control pull-right" name="target_date" id="target_date" value="" required> -->

                      </div>
                    </div>


                    <div class="form-group" >
                      <label>Purpose<label style="color: Red;" >*</label> </label>
                      <textarea class="form-control" type="text"  name="purpose"><?php echo  $purpose; ?> </textarea> 
                    </div>
                    <!-- <button class="btn btn-primary" style="float: right;" type="submit" name="submit">Update</button> -->

                  </div>
                </div>
              </div>
              <div class="panel panel-success" id="item_table">
               <div class="panel-heading">
                <i class="fa fa-list-alt"></i> Item(s) of PR No. <?php echo $pr_no;?>
                <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-info pull-right">Add More</button>
                <!-- start of modal add items -->
                <form method="POST">
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Add Items</h4>
                        </div>
                        <div class="modal-body">
                          <label>Item/s <font style="color: Red;" >*</font> </label>
                          <input onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" type="text" class="form-control" name="app" id="app_items" placeholder="Search" class="" />
                          <font id="p" hidden>&nbsp</font>
                          <table class="table table-striped table-hover" id="main">
                            <tbody id="result">
                            </tbody>
                          </table>
                          <div hidden>
                            <input type="text" name="app_items" id="id" class="form-control"/>
                          </div>
                          <br>
                          <label>Stock/Property No.  <font style="color: Red;" >*</font> </label>
                          <input type="text" name="stocknumber" id="stocknumber" class="form-control" readonly>
                          <br>
                          <label>Description/Specification </label>
                          <input type="text" name="description" class="form-control">
                          <br>
                          <label>Unit <font style="color: Red;" >*</font></label>
                          <input  type="text" name="unit" id="unit"  class="form-control" readonly>
                          <br>
                          <label >Quantity <font style="color: Red;" >*</font></label>
                          <br>
                          <input  class="form-control" type="number" id="qty" name="qty" >
                          <br>
                          <label>Unit Cost <font style="color: Red;" >*</font></label>
                          <br>
                          <input  class="form-control" type="text" id="abc"  name="abc" readonly>
                        </div>
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                          <button type="submit" class="btn btn-primary" name="add">Add Item</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </form>
                <!-- end of modal add items -->

                <div class="clearfix"></div>
              </div>
              <div class="panel-body container-items">
               <table style="background-color: white;border-width: medium;" class="table " id="item_table" >
                <tr>
                  <th width="50">Stock/Property No.</th>
                  <th width="100">Unit </th>
                  <th width="300">Item</th>
                  <th width="300">Description</th>
                  <th width="100">Quantity</th>
                  <th width="100">Unit Cost</th>
                  <th width="150">Total Cost </th>
                  <th width="150">Option</th>
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
                    $abc1 = $row['abc'];
                    $abc = number_format( $abc1,2);
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
                    if ($unit == "22") {
                      $unit = "pax";
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
                    <td><?php  $ans = $abc1*$qty;  echo number_format($ans,2); ?></td>

                    <td>
                      <!-- <a href='ViewRFQdetails.php?id=<?php echo $getID;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> -->
                      <?php  echo '<a href="ViewUpdateRFQ.php?id2='.$_GET['id'].'&id='.$id.'&id='.$id.'  "  class = "btn btn-primary btn-xs"><i class="fa">&#xf044;</i> Edit</a>' ?> | 
                      <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to Delete?');" href="delete_rfq_items.php?id2=<?php echo $id2; ?>&id=<?php echo $id; ?> "><i class="fa fa-fw fa-trash"></i>Delete </a>
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div> 
          <br>
          <input type="submit" name="submit" value="Edit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update now?');">

          <br>
          <br>

        </form>
      </div>  
    </div>
    <script>
      $(document).ready(function(){
        $("#result").click(function(){
          $("#main").hide();
          $("#d").show();
        });
      });
    </script>









