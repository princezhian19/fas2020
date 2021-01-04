<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
function fill_unit_select_box($connect)
{ 
  $output = '';
  $query = "SELECT * FROM pr GROUP BY pr_no DESC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["pr_no"].'">'.$row["pr_no"].'</option>';
  }
  return $output;
}
//auto generation of rfq no.
$idGet='';
$getDate = date('Y');
// $auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM rfq order by id desc limit 1"); == charles
$auto = mysqli_query($conn,"SELECT rfq_no as a,YEAR(rfq_date) as year FROM rfq order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {


  $idGet1 = $row["a"];

    $str = str_replace("2021-","",$idGet1);
    $idGet = (int)$str + 1;



    
}

$getid = $_GET['prID'];
$query = mysqli_query($conn,"SELECT * FROM pr where id = '$getid' ");
    while ($row = mysqli_fetch_assoc($query)) 
    {
    $pr_no_get = $row["pr_no"];
    $pr_date_get = $row["pr_date"]; 
    $purpose_get = $row["purpose"]; 

  
    }



if (isset($_POST['submit'])) {
  $rfq_no = $_POST['rfq_no'];
  $pr_no = $_POST['pr_no'];
  $rfq_date = $_POST['rfq_date'];
  $d1 = date('Y-m-d', strtotime($rfq_date));
  $quotation_date = $_POST['quotation_date'];
  $dd2 = date('Y-m-d', strtotime($quotation_date));

  $pr_date_received = $_POST['pr_date_received'];
  $purpose = $_POST['purpose'];
  $pmo = $_POST['pmo'];
  $mode = $_POST['mode'];
  $action_officer = $_POST['action_officer'];
  $note_id = $_POST['note_id'];
  // $note_id2 = $_POST['note_id2'];

  $selectRfqID = mysqli_query($conn,"SELECT * FROM rfq WHERE rfq_no = '$rfq_no'");
  // $rowID = mysqli_fetch_array($selectRfqID);
  // $rfq_idd = $rowID['id'];

  $s = "14";
  $pr_nos = implode(",", $pr_no); 
  if ($pr_no == '') {
    # code...
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Please Select PR No.');
      </SCRIPT>");
  }
  else{

    if (mysqli_num_rows($selectRfqID) > 0) {
    # code...
      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('This RFQ No. is Already Exist!');
        </SCRIPT>");
    }else{

    /*   for($count = 0; $count < count($_POST["pr_no"]); $count++){
        $pr_noo = $_POST['pr_no'][$count]; */


   // $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,purpose,rfq_mode_id,rfq_date,pr_no,pr_received_date,action_officer)
   //  VALUES("'.$_POST['rfq_no'].'","'.$_POST['purpose'].'","'.$_POST['mode'].'","'.$_POST['rfq_date'].'","'.$_POST['pr_no'][$count].'","'.$_POST['pr_date_received'].'","'.$_POST['action_officer'].'") ');

    //   $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,rfq_mode_id,rfq_date,pr_received_date,action_officer)
    // VALUES("'.$_POST['rfq_no'].'","'.$_POST['mode'].'","'.$_POST['rfq_date'].'","'.$_POST['action_officer'].'") ');

      $insert_rfq = mysqli_query($conn,'INSERT INTO rfq (rfq_no,purpose,rfq_mode_id,rfq_date,pr_no,pr_received_date,action_officer,quotation_date)
          SELECT "'.$rfq_no.'",purpose,"'.$mode.'","'.$d1.'","'.$pr_no.'",pr_date,"'.$s.'","'.$quotation_date.'" FROM pr WHERE pr_no = "'.$pr_no.'" ');
     // }
     $UpdatePR = mysqli_query($conn,'UPDATE pr set stat="1" WHERE pr_no = "'.$pr_no.'" ');

      $selectRfqID = mysqli_query($conn,"SELECT id FROM rfq WHERE rfq_no = '$rfq_no'");
      $rowID = mysqli_fetch_array($selectRfqID);
      $rfq_idd = $rowID['id'];
      $rowsz = mysqli_num_rows($selectRfqID);

      if ($rowsz == 2) {
       $delete_desc = mysqli_query($conn,"DELETE FROM rfq WHERE rfq_no = '$rfq_no' ORDER BY id DESC LIMIT 1 ");
     }
       if ($rowsz == 3) {
       $delete_desc = mysqli_query($conn,"DELETE FROM rfq WHERE rfq_no = '$rfq_no' ORDER BY id DESC LIMIT 2");
     }

       if ($rowsz == 4) {
       $delete_desc = mysqli_query($conn,"DELETE FROM rfq WHERE rfq_no = '$rfq_no' ORDER BY id DESC LIMIT 3");
     }

       if ($rowsz == 5) {
       $delete_desc = mysqli_query($conn,"DELETE FROM rfq WHERE rfq_no = '$rfq_no' ORDER BY id DESC LIMIT 4");
     }

       if ($rowsz == 6) {
       $delete_desc = mysqli_query($conn,"DELETE FROM rfq WHERE rfq_no = '$rfq_no' ORDER BY id DESC LIMIT 5 ");
     }

    /*  foreach ($pr_no as $prs) { */

      $selectRfqID = mysqli_query($conn,"SELECT id FROM rfq WHERE rfq_no = '$rfq_no'");
      $rowID = mysqli_fetch_array($selectRfqID);
      $rfq_idd = $rowID['id'];

      $query = mysqli_query($conn,"INSERT INTO rfq_items(rfq_id,app_id,description,qty,unit_id,abc,total_amount) 
      SELECT '$rfq_idd',items,description,qty,unit,abc,(qty*abc) FROM pr_items  WHERE pr_no = '$pr_no' ");

    /*   echo "INSERT INTO rfq_items(rfq_id,app_id,description,qty,unit_id,abc,total_amount) 
      SELECT '$rfq_idd',items,description,qty,unit,abc,(qty*abc) FROM pr_items  WHERE pr_no = '$pr_no' ";
      exit(); */

      // $query = mysqli_query($conn,"INSERT INTO rfq_items(rfq_id,app_id,description,qty,unit_id,abc) 
      //  SELECT '$rfq_idd',items,description,SUM(qty),unit,SUM(abc) FROM pr_items  WHERE pr_no IN('$prs') GROUP BY items");

    //}
    foreach ($note_id as $note_idd) { 

      $insert_notes = mysqli_query($conn,"INSERT INTO rfq_notes(rfq_id,note_id) VALUES ('$rfq_idd','$note_idd')");
    }

    // foreach ($note_id2 as $note_idd2) { 

    //   $insert_notes = mysqli_query($conn,"INSERT INTO rfq_notes(rfq_id,note_id) VALUES ('$rfq_idd','$note_idd2')");
    // }
    // for($count = 0; $count < count($_POST["pr_no"]); $count++){

      $select_pmo = mysqli_query($conn,'SELECT pmo FROM pr WHERE pr_no = "'.$pr_no.'"');
      $rowPMO = mysqli_fetch_array($select_pmo);
      $pmoo = $rowPMO['pmo'];
      if ($pmoo == 'ORD') {
        $pmoo = 1;
      }
      if ($pmoo == 'LGMED') {
        $pmoo = 3;
      }
      if ($pmoo == 'LGCDD') {
        $pmoo = 4;
      }
      if ($pmoo == 'FAD') {
        $pmoo = 5;
      }
      if ($pmoo == 'LGMED-PDMU') {
        $pmoo = 6;
      }
      if ($pmoo == 'LGCDD-MBRTG') {
        $pmoo = 7;
      }

      $insert_pmo = mysqli_query($conn,"INSERT INTO rfq_pmo(rfq_id,pmo_id) VALUES('$rfq_idd','$pmoo')");
      /* $udpateprstat = mysqli_query($conn,"INSERT INTO rfq_pmo(rfq_id,pmo_id) VALUES('$rfq_idd','$pmoo')"); */


      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successful!');
      window.location.href='RFQdetails.php?id=$rfq_idd';
      </SCRIPT>");

   // header('location: ../frontend/web/rfq/index');
   // header('location: frontend/web/rfq/view?id=$rfq_idd');
    //}

  }

// rfq_id note_id RFQ NOTES
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
</head>
<script>
function checkAvailability() {
  $("#loaderIcon").show();
  jQuery.ajax({
  url: "check_availability.php",
  data:'rfq_no='+$("#rfq_no").val(),
  type: "POST",
  success:function(data){
    $("#user-availability-status").html(data);
    $("#loaderIcon").hide();
  },
  error:function (){}
  });
}
</script>
<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbsp <b>Create RFQ</b></h1>
      <div class="box-header with-border">
      </div>
        <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-warning"><a href="ViewRFQ.php" style="color:white;text-decoration: none;"><i class="fa fa-fw fa-arrow-left"></i>Back</a></li>
        <br>
        <br>
      <form method="POST">
        <div class="form-group" style="float: right;width:300px;padding-right: 20px;">
        </div>
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">

              <div class="form-group">
                <label>PR No.</label>
                <!-- <select class="form-control select2" style="width: 100%;" autocomplete="off" id="pr_no" name="pr_no[]" multiple="multiple"> -->
                <!-- <?php echo fill_unit_select_box($connect); ?> -->
                <!-- </select> -->
               <!--  <input  class="form-control" type="text" id="pr_no" name="pr_no"> -->
               <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="Search" value="<?php echo $pr_no_get?>" readonly>
               <table class="table table-striped table-hover" id="main">
                    <tbody id="result">
                    </tbody>
                  </table>

                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                  <script type="text/javascript">
                  $(document).ready(function(){
                    function load_data(query)
                    {
                      $.ajax({
                        url:"fetch_purpose.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data)
                        {
                          $('#result').html(data);
                          
                        }
                      });
                    }
                    $('#pr_no').keyup(function(){
                      var search = $(this).val();
                      if(search != '')
                      {
                        load_data(search);
                      }
                      else
                      {
                        load_data();
                        /* document.getElementById("code").value = ""; */
                        document.getElementById("purpose").value = "";
                        document.getElementById("pr_date").value="";
                      }
                    });
                  });
                  function showRow(row)
                  {
                    var x=row.cells;
                    document.getElementById("purpose").value = x[0].innerHTML;
                    document.getElementById("pr_date").value = x[1].innerHTML;
                  }
                </script>

              </div>

              

              <div class="form-group">
                <label>PR Date</label>
                <div hidden>
                <input  class="form-control" type="text" id="pr_date" name="pr_date" value="<?php echo $pr_date_get?>">
                </div>
                <input readonly class="form-control" type="text"  value="<?php echo date('F d, Y',strtotime($pr_date_get))?>">

              </div>

              
            <div class="form-group" >
                <label>Purpose</label>
                <input class="form-control" type="text" name="purpose" id="purpose" value="<?php echo $purpose_get?>" readonly>
              </div>
              <div class="form-group" hidden>
                <label>Office</label>
                <select class="form-control select2" style="width: 100%;" name="pmo" >
                  <option value="">Select PMO</option>
                  <option value="1">ORD</option>
                  <option value="3">LGMED</option>
                  <option value="4">LGCDD</option>
                  <option value="5">FAD</option>
                  <option value="6">LGMED-PDMU</option>
                  <option value="7">LGCDD-MBRTG</option>
                </select>
              </div>
              
              <!-- <div class="form-group" >
                <label>Purpose</label>
                <input class="form-control" type="text" name="purpose">
              </div> -->
            </div>
            <div class="col-md-6">
              <div class="form-group" hidden>
                <label>Status</label>
                <select class="form-control select2" style="width: 100%;" name="status">
                  <option>Select Status</option>
                  <option value="Draft">Draft</option>
                  <option value="For Posting">For Posting</option>
                </select>
              </div>
           <!--    <div class="form-group"> -->

               <div class="form-group">
                <label>RFQ No.</label>
                <!-- <input class="form-control" type="text" name="rfq_no"> -->
                 <input class="form-control" name="rfq_no" type="text" id="rfq_no" value="<?php echo $getDate.'-000'.$idGet?>">
                 <!-- <input class="form-control" name="rfq_no" type="text" id="rfq_no" class="demoInputBox" onBlur="checkAvailability()" value="<?php echo $getDate.'-'.'00'.$idGet?>"><span id="user-availability-status"></span> -->
              </div>

              <!-- <label>RFQ Date</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="rfq_date">
              </div>
            </div> -->

            <div class="form-group">
              <label>RFQ Date</label>
              <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php if ($rfq_date ==''): ?>
                      <input  type="text" class="form-control pull-right" name="rfq_date" id="datepicker1" value="<?php $now = date("m/d/Y"); echo $now;  ?>">
                    <?php else: ?>
                        <input  type="text" class="form-control pull-right" name="rfq_date" id="datepicker1" value="<?php $now =  date("m/d/Y"); echo $now;  ?>">
                    <?php endif ?>
                   
              </div>
            
            </div>

            
            <div class="form-group">
                <label>Mode of Procurement</label>
                <select class="form-control " style="width: 100%;" name="mode">
                <!--   <option selected="1">Select Mode of Procurement</option> -->
                  <option value="1">Small Value Procurement</option>
                  <option value="2">Shopping</option>
                  <option value="4">NP Lease of Venue</option>
                  <option value="5">Direct Contracting</option>
                  <option value="6">Agency to Agency</option>
                  <option value="7">Public Bidding</option>
                  <option value="8">Not Applicable N/A</option>
                </select>
              </div>

              <div class="form-group">
              <label>Quotation Date</label>
              <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                        <input  type="text" class="form-control pull-right" name="quotation_date" id="datepicker2" value="<?php $now =  date("m/d/Y"); echo $now;  ?>">
              </div>
            </div>


            <div class="form-group" hidden>
              <label>PR Date Recieve</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right" name="pr_date_received">
              </div>
            </div>






          </div>

        </div>
      </div>
      <div style="font-size: 13px;" class="well" >
        <label>Note(s)</label>
        <br>
        <?php

        $selectNotes = mysqli_query($conn,"SELECT  * FROM new_rfq_notes");

        while ($row = mysqli_fetch_assoc($selectNotes)) {

          $note_id = $row["id"];
          $note_desc = $row["note"];
          ?>
          <input type="checkbox" name="note_id[]" value="<?php echo $note_id; ?>">&nbsp<b>**<?php echo $note_desc;?></b></input>
          <br>

        <?php } ?>
      </div>
       <!-- <div style="font-size: 13px;" class="well" >
        <input type="checkbox" id="select-all" onClick="toggle(this)" ><label>Note(s)</label>
        <br>
        <?php

        $selectNotes = mysqli_query($conn,"SELECT  * FROM notes WHERE id != 1 AND id != 6 AND id !=7");

        while ($row = mysqli_fetch_assoc($selectNotes)) {

          $note_id = $row["id"];
          $note_desc = $row["note"];
          ?>
          <input type="checkbox"  name="note_id2[]" value="<?php echo $note_id; ?>">&nbsp<b>**<?php echo $note_desc;?></b></input>
          <br>

        <?php } ?>
      </div> -->
      <!-- style="float: right;" -->
      <button type="submit" name="submit" class="btn btn-success"  onclick="return confirm('Are you sure you want to save now?');">Create</button>
    </form>
  </div>  
</div>  
</body>
<script>
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
</script>

<script>
  $(document).ready(function(){
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
  })
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

</html>


