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
            window.location.href = 'ViewPRv1.php?id=".$id." '
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


<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspUpdate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp   <li class="btn btn-success"><?php echo '<a href="ViewPR1.php?id='.$id.'" style="color:white;text-decoration: none;">Back</a>' ?> </li>
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
                  <label>Office<label style="color: Red;" >*</label></label>
                  <input class="form-control" type="text"  name="pmo" id="pmo" value="<?php echo $pmo;?>" readonly>
                  <!-- <?php if ($pmo == 'ORD'): ?>
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
                <?php endif ?> -->
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

                  <select class="form-control " style="width: 100%;" name="type" id="type" >
                      <option value="5">------------------------SELECT TYPE------------------------</option>
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
                    <input type="text" id = "" class="form-control pull-right"  name="pr_date" value="<?php 
                    /* if($pr_date='0000-00-00'){
                      $d11 = date('m/d/Y');
                    }
                    else{
                      $d11 = date('m/d/Y', strtotime($pr_date));
                    } */
                    echo $ddd11;?>" required readonly>
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
                  <label>Purpose<label style="color: Red;" >*</label></label>
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
            <?php echo ' <a href="CreateUpdatePR1.php?pr_no='.$pr_no.'&id='.$id.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'" class="btn btn-success pull-right"> Add more</a>'?>
               <!-- <?php echo '<a href="ViewEditPR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'  " ><i style="font-size:24px" class="fa">&#xf044;</i></a>' ?> -->

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
           <th width="100">Option</th>
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

              $qty1 = $row['qty'];
              $qty = number_format( $qty1,2);


              $ans1 = $qty1*$abc1;
              //echo $ans = number_format($ans1,2);
              

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
              if ($unit == "22"){
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
              <td><?php echo $qty1?></td>
              <td><?php echo $abc?></td>
              <td><?php  $ans = $abc1*$qty;  echo number_format($ans,2); ?></td>

              <td>
               <?php echo '<a href="ViewUpdateRFQ1.php?id2='.$_GET['id'].'&id='.$id.'&id='.$id.' "  class = "btn btn-primary btn-xs" ><i  class="fa">&#xf044;</i> Edit</a>' ?>

           <!--  <a onclick="return confirm('Are you sure you want to Delete?');" href="delete_rfq_items1.php?id2=<?php echo $id2; ?>&id=<?php echo $id; ?> "><i style="font-size:24px" class="fa fa-trash-o"></i></a>' -->
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
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</html>
</body>
