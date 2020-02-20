
<?php
$id = $_GET['id'];
$conn=mysqli_connect("localhost","root","","db_dilg_pmis");
// get data from db
$select = mysqli_query($conn,"SELECT burs_id FROM saroob WHERE id = '$id '");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];

$select_part = mysqli_query($conn,"SELECT * FROM burs WHERE id = '$burs_id'");
$rowB = mysqli_fetch_array($select_part);
$supplier = $rowB['supplier'];
$purpose = $rowB['purpose'];
$doc_type = $rowB['doc_type'];
$amount = $rowB['amount'];
$date_received1 = $rowB['date_received'];
$date_return1 = $rowB['date_return'];
$po_no = $rowB['po_no'];

if ($date_return1 == NULL) {
  $date_return = $date_return1;
}else{
  $date_return = date("m-d-Y",strtotime($date_return1));
}

if ($date_received1 == NULL) {
  $date_received = $date_received1;
}else{
  $date_received = date("m-d-Y",strtotime($date_received1));

}
// end of get data from db

if (isset($_POST['submit'])) {

  $datereceived = $_POST['datereceived'];
  $d1 = date('Y-m-d', strtotime($datereceived));

  $datereprocessed = $_POST['datereprocessed'];
  $d2 = date('Y-m-d', strtotime($datereprocessed));

  $datereturned = $_POST['datereturned'];
  if($datereturned==''){
    $d3 = "";
  }
  else{
    $d3 = date('Y-m-d', strtotime($datereturned));
  }
  $datereleased = $_POST['datereleased'];
  $d4 = date('Y-m-d', strtotime($datereleased));

  $ors = $_POST['ors'];
  $po = $_POST['ponum'];
  $payee = $_POST['payee'];
  $particular = $_POST['particular'];
  $saronum = $_POST['saronum'];
  $ppa = $_POST['ppa'];
  $uacs = $_POST['uacs'];
  $amount = $_POST['amount'];
  $remarks = $_POST['remarks'];
  $sarogroup = $_POST['sarogroup'];
  $status = $_POST['status'];

//Update kasi meron ng data to sa pag submit palang ni user...
  $query = mysqli_query($conn,"UPDATE saroob SET datereceived ='$d1', datereprocessed = now(), datereturned = '$d3', datereleased = '$d4', ors = '$ors', ponum = '$po', payee = '$payee', particular = '$particular', saronumber = '$saronum', ppa = '$ppa', uacs = '$uacs', amount = '$amount', remarks = '$remarks', sarogroup = '$sarogroup', status = '$status' WHERE burs_id = '$burs_id' ");

// $query = mysqli_query($conn,"INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
// VALUES ('$d1','$d2 ','$d3','$d4','$ors','$po','$payee','$particular','$saronum','$ppa','$uacs','$amount','$remarks','$sarogroup','$status')");

  if($query){
    //updating obligation
    $update = mysqli_query($conn,"Update saro set obligated = obligated + $amount where saronumber = '$saronum' and uacs = '$uacs' ");
//updating balance
    $update1 = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saronum' and uacs = '$uacs' ");
// update nya lang stats sa burs para sa user buttons.
    $update2 = mysqli_query($conn,"UPDATE burs SET status = 4, date_proccess = now() WHERE id = '$burs_id' ");


      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Data Added Successfully!')
        window.location.href='@obligation.php';
        </SCRIPT>");
    $validate = mysqli_query($conn,"SELECT * FROM disbursement WHERE burs_id = '$burs_id' ");
//     if (mysqli_num_rows($validate)>0) {
//       $get_data = mysqli_query($conn,"SELECT * FROM saroob WHERE burs_id = '$burs_id' ");
//       $rowUpdate = mysqli_fetch_array($get_data);
//       $burs_id_saroo = $rowUpdate['burs_id'];
//       $payee = $rowUpdate['payee'];
//       $particular = $rowUpdate['particular'];
//       $ppa = $rowUpdate['ppa'];
//       $uacs = $rowUpdate['uacs'];
//       $amount = $rowUpdate['amount'];

// // kulang
//       $queryY = mysqli_query($conn,"UPDATE disbursement SET ors ='$ors', sr = '$saronum', burs_id = '$burs_id_saroo', payee = '$payee', particular = '$particular', ppa = '$ppa', uacs = '$uacs', amount = '$amount' WHERE burs_id = '$burs_id' ");

//       echo ("<SCRIPT LANGUAGE='JavaScript'>
//         window.alert('Data Added Successfully!')
//         window.location.href='@obligation.php';
//         </SCRIPT>");
//     }else{
//       $queryY = mysqli_query($conn,"INSERT INTO disbursement(burs_id,ors,sr,office,po_no,payee,particular,ppa,uacs,amount) SELECT burs_id,ors,saronumber,office,ponum,payee,particular,ppa,uacs,amount FROM saroob WHERE id = '$id' ");

//       if ($queryY) {
//         $updateY = mysqli_query($conn,"UPDATE burs SET status = 5, date_release = now() WHERE id = '$burs_id'");

//         echo ("<SCRIPT LANGUAGE='JavaScript'>
//           window.alert('Data Added Successfully!')
//           window.location.href='@obligation.php';
//           </SCRIPT>");

//       }else{
//         echo ("<SCRIPT LANGUAGE='JavaScript'>
//           window.alert('Error!')
//           window.location.href='@obligation.php';
//           </SCRIPT>");

//       }



//     }


  }
  else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error!')
      window.location.href='@obligation.php';
      </SCRIPT>");
  }
}
?>
<!DOCTYPE html>

<html>
<?php
$connect = new PDO("mysql:host=localhost;dbname=db_dilg_pmis", "root", "");
function app($connect)
{ 
  $output = '';
  $query = "SELECT sarogroup FROM `saro` Group BY sarogroup ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["sarogroup"].'">'.$row["sarogroup"].'</option>';
  }
  return $output;
}

?>
<!-- <style>
  a:hover {
  color: blue;
}
  .p:hover {
  color: blue;
}
  span:hover {
  color: blue;
}
</style> -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- Auto Complete -->



</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('sidebar.php');?>

    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
          <li class="active">Create Obligation</li>
        </ol>
        <br>
        <br>

        <!-- Start Panel -->
        <div class="panel panel-default">
          <br>

          <h1 align="">&nbspCreate Obligation</h1>
          <div class="box-header with-border">

            <br>
            <li class="btn btn-success"><a href="@obligation.php" style="color:white;text-decoration: none;">Back</a></li>
            <br>
            <br>
            <!-- Start form -->
            <form method="POST">
              <!-- Start Menu -->
              <div class="class-bordered" >
                <div class="row">
                  <div class="col-md-6">
                    <label>ORS Serial No.</label>
                    <input  type="text" class="form-control" style="height: 35px;" id="" placeholder="Enter ORS Number" name="ors" required>
                    <br>
                    <label>PO No.</label>
                    <input  value="<?php echo $po_no;?>"  type="text" class="form-control" style="height: 35px;" id="ponum" name="ponum">

                    <table class="table table-striped table-hover" id="main">
                      <tbody id="result">
                      </tbody>
                    </table>
                    <br>
                    <!-- Getting PO NUmber -->      
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

          <!--   <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@obsearchvaluesource.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result').html(data);
                    }
                  });
                }
                $('#ponum').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    document.getElementById('payee').value = "";
                    document.getElementById('particular').value = "";
                    document.getElementById("ponum").value = "";
                    
                  }
                });
              });
              function showRow(row)
              {
                var x=row.cells;
                document.getElementById("payee").value = x[0].innerHTML;
                document.getElementById("particular").value = x[1].innerHTML;
                document.getElementById("ponum").value = x[2].innerHTML;
                
              }
            </script>    -->
          </div>    

          <div class="col-md-6">
            <label>Date Received</label>
            <br>
              <input readonly value="<?php echo $date_received;?>" required type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="datereceived">
            <br>
            <br>
            <br>
             <label>Particular/Purpose</label>
          <input readonly value="<?php echo $purpose;?>" type="text"   class="form-control" style="height: 35px;" id="particular" placeholder="Particular" name="particular">
            <div hidden>
            <label>Date Processed</label>
            <br>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input  type="text" class="form-control pull-right" id="datepicker2" placeholder='Enter Date' name="datereprocessed">
              <br>
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="class">
       <!-- ORS -->
       <div class="row">
        <div class="col-md-6">
          <label>Payee/Supplier</label>
          <input readonly value="<?php echo $supplier;?>" type="text"  class="form-control" style="height: 35px;" id="payee" placeholder="Payee" name="payee">
          <br>
        </div>
        <div class="col-md-6">
          <div hidden>
          <label>Date Returned</label>
          <br>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input value="<?php echo $date_return;?>" type="text" class="form-control pull-right" id="datepicker3" placeholder='Enter Date' name="datereturned">
          </div>
          </div>
          <br>
          <div hidden>
          <label>Date Released</label>
          <br>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input  type="text" class="form-control pull-right" id="datepicker4" placeholder='Enter Date' name="datereleased">
            <br>
          </div>
          </div>

        </div>
        <!-- @Funtions/obsearchvalue.php -->

      </div>


      <br>
      <!-- SARO -->
      <div class="row">
        <div class="col-md-3">
          <label>Fund Source</label>
          <input required  type="text"  class="form-control" style="height: 40px;" id="saronum" placeholder="Fund Source" name="saronum"class="typeahead"/>
          <!-- <input type="text" name="txtCountry" id="txtCountry" class="typeahead"/> -->
          <table class="table table-striped table-hover" id="main1">
            <tbody id="result1">
            </tbody>
          </table>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            function load_data(query)
            {
              $.ajax({
                url:"@obsarosearch.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                  $('#result1').html(data);
                }
              });
            }
            $('#saronum').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
                load_data(search);
              }
              else
              {
                load_data();
                document.getElementById('saronum').value = "";
                document.getElementById("main1").value="";
                document.getElementById("sarogroup").value = "";



              }
            });
          });
          function showRow1(row)
          {
            var x=row.cells;
            document.getElementById("saronum").value = x[0].innerHTML;
            document.getElementById("sarogroup").value = x[5].innerHTML;


          }
        </script>

        <div class="col-md-3">
          <label>MFO/PPA</label>
          <input required  type="text"  class="form-control" style="height: 40px;" id="ppa" placeholder="PPA" name="ppa">
          <table class="table table-striped table-hover" id="main3">
            <tbody id="result3">
            </tbody>
          </table>
        </div>


        <!-- PPA Search -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            function load_data(query)
            {
              $.ajax({
                url:"@obsaroppasearch.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                  $('#result3').html(data);
                }
              });
            }
            $('#ppa').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
                load_data(search);
              }
              else
              {
                document.getElementById('ppa').value = "";



              }
            });
          });
          function showRow3(row)
          {
            var x=row.cells;
            document.getElementById("ppa").value = x[0].innerHTML;


          }
        </script>

        <!-- UACS Search -->
        <div class="col-md-3">
          <label>UACS Object Code</label>
          <input  required type="text"  class="form-control" style="height: 40px;" id="uacs" placeholder="UACS Code" name="uacs">
          <table class="table table-striped table-hover" id="main2" name="main2">
            <tbody id="result2">
            </tbody>
          </table>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            function load_data(query)
            {
              $.ajax({
                url:"@obsarouacssearch.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                  $('#result2').html(data);
                }
              });
            }
            $('#uacs').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
                load_data(search);
              }
              else
              {
                    // document.getElementById('uacs').value = "";
                   //load_data();
                   /* document.getElementById("code").value = ""; */
                   document.getElementById("uacs").value = "";



                 }
               });
          });
          function showRow2(row)
          {
            var x=row.cells;
            document.getElementById("uacs").value = x[0].innerHTML;




          }
        </script>

        <div class="col-md-3">
          <label>Amount</label>
          <input value="<?php echo $amount;?>" required  type="text"  class="form-control" style="height: 40px;" id="" placeholder="Amount" name="amount">
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-md-4">
          <label>Remarks</label>
          <textarea class="form-control" placeholder="Remarks" name="remarks" style="width: 100%; height: 40px;" ></textarea> 
        </div>

        <div class="col-md-4">
          <label>Group</label>
          <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
          <!-- <select class="form-control select" style="width: 100%; height: 40px;" name="sarogroup" id="sarogroup" required > -->
            <!-- <option>Select Group</option> -->
            <!-- <?php echo app($connect);?> -->
            <!-- </select> -->
            <input  type="text"  class="form-control" style="height: 40px;" id="sarogroup" placeholder="" name="sarogroup" readonly>
          </div>
          <div class="col-md-4" hidden>
            <label>Status</label>
            <!-- <textarea class="form-control" placeholder="Remarks" name="remarks" ></textarea> --> 
            <select class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
              <option value = "Obligated">Obligated</option>
              <option value = "Pending">Pending</option>
              <!-- <option>Select Status</option> -->


            </select>
          </div>
        </div>
        <!-- END SARO -->
        <br>

      </div>
      <!-- End Menu -->
      <!-- End Panel -->
      <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width: %;" class="btn btn-success">Submit</button>
    <br>
    <br>
  </div>
</form>
<!--End Submit -->
</div>

</section>
</div>

</div>

<script src="dist/js/demo.js">
</script>
<!-- <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->


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


</body>
</html>
