
<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'travelclaim_functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>Create Itenerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
        <form method="POST" >
        <div class="box-body">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name <label style="color: Red;" >*</label> </label>
                                <input  readonly autocomplete = "off"  class="form-control" name="complete_name" type="text" value = "<?php echo getCompleteName();?>">
                                    </div>

                        <div class="form-group">
                            <label>Position <label style="color: Red;" >*</label></label>
                                <input type="text" class="form-control" style="width: 100%;" name="position"  readonly value= "<?php echo getPosition();?>">
                                    </div>

                        <div class="form-group">
                            <label>Office <label style="color: Red;" >*</label></label>
                                <input type="text" class="form-control" style="width: 100%;" name="office" readonly value="<?PHP echo getOffice();?>" >
                                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date of Filing <label style="color: red;" >*</label></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input required  type="text" class="form-control pull-right" name="date_of_filinf" id="datepicker1" value="<?php echo date("F d, Y"); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date of Travel <label style="color: Red;" >*</label></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="target_date" id="datepicker2" value="<?php echo $target_date ?>" required placeholder="mm/dd/yyyy">
                                </div>
                        </div>
                        <div class="form-group" >
                            <label>Purpose of Travel <label style="color: Red;" >*</label></label>
                            <input required type="text" style="height: 60px" class="form-control pull-right" name="purpose" id="purpose"  required placeholder="Purpose">
                        </div>
                    </div>
                </div>
            </div>
        
          <div class="panel panel-success" id="item_table">
           <div class="panel-heading">
            <i class="fa fa-list-alt"></i>&nbsp&nbsp&nbspPR Items <!-- Item(s) -->
            <div class="clearfix"></div>
          </div>
          <div class="panel-body container-items">
            <div class=""><!-- widgetBody -->
              <div class="row">
                <div class="col-md-6" style="padding-left: 30px;padding-top:10px;">
                  <label>RO/TO/OB No <font style="color: Red;" >*</font> </label>
                  <input  type="text" class="form-control" name="app" id="app_items" placeholder="Search" class="" />
                  <font id="p" hidden>&nbsp</font>
                  <table class="table table-striped table-hover" id="main">
                    <tbody id="result">
                    </tbody>
                  </table>
                  
                  <div hidden>
                    <input type="text" name="app_items" id="id" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Origin<font style="color: Red;" >*</font> </label>
                    <input type="text" name="stocknumber" id="stocknumber" class="form-control" readonly>
                  </div>
                 
                </div>

                <div class="col-md-6">
                  <p></p>

                
                  <div class="form-group" hidden>
                    <label>Existing QTY</label>
                    <input class="form-control" type="number" readonly id="two" name="two">
                  </div>
                  <div class="form-group">
                    <label>No. of Travel Days <font style="color: Red;" >*</font></label>
                    <input  type="text" name="unit" id="unit"  class="form-control" readonly>
                 
                  
                  </div>
                  <font id="p" hidden>&nbspasd</font>
                  <div class="form-group" style="padding-top: 5px;" >
                    <label >Destination <font style="color: Red;" >*</font></label>
                    <input  class="form-control" type="number" id="qty" name="qty" >
                  </div>
                 

                  <!-- /.box-body -->
                </div>
              </div>
            <button class="btn btn-primary pull-right"  type="submit" name="add" onclick="/* return confirm('Are you sure you want to Add this item?'); */">Add Travel Dates</button>
              
            </div>
          </div>
        </div>  


        <br>
        <br>
        <div class="form-group">
        <label>Added PR Item/s.</label>
        <div>
        <div class="panel-body container-items">
         <table style="background-color: white;border-width: medium;" class="table " id="item_table" >
          <tr>
          <th width="50">Date</th>
          <th width="100">Place to be Visited (Destination) </th>
           <th width="200">Departure Time</th>
           <th width="250">Arrival Time</th>
           <th width="100">Means of Transportation</th>
           <th width="100">Transportation</th>
          <th width="150">Per Diem</th>
           <th width="100">Others</th>
           <th width="100">Total Amount</th>
         </tr>
         <tr>
          <?php 
          $conn = new PDO('mysql:host=localhost;dbname=fascalab_2020;charset=utf8', 'fascalab_2020', 'w]zYV6X9{*BN');
          $pr_no = $_POST['pr_no'];
          $pmo = $_POST['pmo'];
          $pr_date = $_POST['pr_date'];
          $purpose = $_POST['purpose'];
          if ($pr_no == '') {
            $pr_no = $_GET['pr_no'];
          }
          $sql_items = $conn->query("SELECT a.sn,pa.id,pa.qty,pa.items,pa.app_id,pa.pr_no,pa.description,pa.unit,pa.abc,a.procurement FROM pr_approved pa left join app a on a.id = pa.items  WHERE pa.pr_no = '$pr_no' AND pmo = '$pmo' ");
          while ($row = $sql_items->fetch()) {
            $sn = $row['sn'];
            $id = $row['id'];
            $qty1 = $row['qty'];
            $items1 = $row['items'];
            $description1 = $row['description'];
            $unit1 = $row['unit'];
            $abc1 = $row['abc'];
            $procurement1 = $row['procurement'];

            if ($unit1 == "1") {
              $unit1a = "piece";
            }

            if ($unit1 == "2") {
              $unit1a = "box";
            }

            if ($unit1 == "3") {
              $unit1a = "ream";
            }

            if ($unit1 == "4") {
              $unit1a = "lot";
            }

            if ($unit1 == "5") {
              $unit1a = "unit";
            }

            if ($unit1 == "6") {
              $unit1a = "crtg";
            }

            if ($unit1 == "7") {
              $unit1a = "pack";
            }
            if ($unit1 == "8") {
              $unit1a = "tube";
            }

            if ($unit1 == "9") {
              $unit1a = "roll";
            }

            if ($unit1 == "10") {
              $unit1a = "can";
            }

            if ($unit1 == "11") {
              $unit1a = "bottle";
            }

            if ($unit1 == "12") {
              $unit1a = "set";
            }

            if ($unit1 == "13") {
              $unit1a = "jar";
            }

            if ($unit1 == "14") {
              $unit1a = "bundle";
            }

            if ($unit1 == "15") {
              $unit1a = "pad";
            }

            if ($unit1 == "16") {
              $unit1a = "book";
            }

            if ($unit1 == "17") {
              $unit1a = "pouch";
            }

            if ($unit1 == "18") {
              $unit1a = "dozen";
            }

            if ($unit1 == "19") {
              $unit1a = "pair";
            }
            if ($unit1 == "20") {
              $unit1a = "gallon";
            }

            if ($unit1 == "21") {
              $unit1a = "cart";
            }
            if ($unit1 == "22") {
              $unit1a = "pax";
            }
            ?>
            
            <td id="tdvalue" hidden><?php echo $pr_no?> </td>
            <td><?php echo $sn ?></td>
            <td><input hidden type="text" name="unit1[]" value="<?php echo $unit1 ?>"><?php echo $unit1a?></td>
            <td><input hidden type="text" name="items1[]" value="<?php echo $items1 ?>"><?php echo  $procurement1;?> </td>
            <td><input hidden type="text" name="description1[]" value="<?php echo $description1 ?>"><?php echo $description1?></td>
            <td><input hidden type="text" name="qty1[]" value="<?php echo $qty1 ?>"><?php echo $qty1?></td>
            <td><input hidden type="text" name="abc1[]" value="<?php echo $abc1 ?>"><?php echo $abc1?></td>
           
            <td><?php  $ans = $abc1*$qty1;  echo $ans; ?></td>
            <td hidden><input hidden type="text" name="description1[]" value="<?php echo $description1 ?>"><?php echo $description1?></td>
            <td>
             <!-- <?php echo '<a href="ViewEditPR.php?id='.$id.'&pr_no='.$pr_no.'&pmo='.$pmo.'&pr_date='.$pr_date.'&purpose='.$purpose.'" class="btn btn-primary btn-xs" ><i class="fa">&#xf044;</i></a>' ?> -->

             <a onclick="return confirm('Are you sure you want to Delete?');" name="del"  href="deletePR.php?id=<?php echo $id; ?>&pr_no=<?php echo $pr_no; ?>&pmo=<?php echo $pmo; ?>&pr_date=<?php echo $pr_date; ?>&purpose=<?php echo $purpose; ?> " class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>


             <!-- <button class="btn btn-danger btn-xs"   type="submit" name="del" onclick="/* return confirm('Are you sure you want to Add this item?'); */"><i class="fa fa-trash-o"></i> Delete</button> -->
           </td>
         </tr>
       <?php } ?>
     </table>
   </div>

   
   <br>
 </form>

 <button class="btn btn-success" id="finalizeButton" type="submit" name="submit" onclick="return confirm('Are you sure you want to save now?');">Create</button>
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
    $("#p").show();
  });
});
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
    'ViewPRdetails1.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
  });
}) ;
</script>

