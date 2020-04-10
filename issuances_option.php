<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>

<html>
<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
/* function app($connect)
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
} */

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


    
       
        <div class="box">
          <div class="box-body">
      
            <h1 align="">Create Issuances</h1>
         
        <br>
      <li class="btn btn-success"><a href="issuances.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

      <form id="fupForm" name="form1" Type="GET">
     
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">
                      <label>Category</label>
                      <select class="form-control " style="width: 100%;" name="category" id="category" >
                      <option value="11">Department Memorandum Circular</option>
                      <option value="12">Department Order</option>
                      <option value="14">Regional Memorandum Circular</option>
                      <option value="15">Regional Order</option>
                      <option value="20">Regional Office Order</option>
                      <option value="17">Executive Order</option>
                      <option value="18">Joint Memorandum Circular</option>
                      </select>
                      <!-- <input  type="text" class="form-control" style="height: 35px;" id="ors" placeholder="Enter ORS Number" name="ors" required> -->
                      <br>
                      <label>Issuance No</label>
                      <input  class="form-control" type="text" class="" style="height: 35px;" id="issuances" name="issuances" placeholder="" name="issuances" >

                      <br>
                      <label>Issuance Date</label>
                      <input type="text" class="form-control" style="height: 35px;" name="date_issued" id="" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('Y-m-d') ?>" >
                      <br>
                      <label>Title<!-- <label style="color: Red;" >*</label> --></label>
                      <input  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title">
                      <br>
                      <label class="or">Office Concerned</label>
                      <input id="offices" name="todiv" autocomplete ="off" type="text" class="form-control" placeholder="">
                     <!--  -->
                </div>  
                
                
            
                <div class="col-md-6">
                <label>Atatched File&nbsp&nbsp&nbsp</label>
                <button >Choose File</button> <label>&nbsp&nbspNo file Chosen</label>
                <br>
                
                <label class=""> Allowed file: *.pdf </label>
                <br>
                <label class="">Max allowed size: 5mb</label>
                <br>
                <label class="">URL</label>
                <input id="url" name="url" autocomplete ="off" type="text" class="form-control" placeholder="">
                <br>
                <label class=""> Office Responsible</label>
                <input id="url" name="url" autocomplete ="off" type="text" class="form-control" placeholder="">
                <br>
                <label class="">  Date Posted</label>
                <input readonly type="text" class="form-control" style="height: 35px;" name="date_issued" id="" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('Y-m-d') ?>" >
                <br>
                </div>

                
          </div>
        </div>

        <br>
    <br>
        <!-- End Menu -->
    <!-- End Panel -->
    <input type="button" name="save" class="btn btn-primary pull-left" value="Save Data" id="butsave">
    </div>

    
    <!-- &nbsp&nbsp&nbsp<button type="submit" name="submit" class="btn btn-success">Submit</button> -->
  
    <br>
    <br>

    
    </div>
    
  </form>
    <!--End Submit -->
  </div>

    </section>
  </div>
 
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- <script>
/* AJAX */
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("enabled", "enabled");

		var datereceived = $('#datepicker1').val();
		var datereprocessed = $('#datepicker2').val();
		var datereturned = $('#datepicker3').val();
		var datereleased = $('#datepicker4').val();
    var ors = $('#ors').val();
    var ponum = $('#ponum').val();
    var payee = $('#payee').val();
    var supplier = $('#supplier').val();
    var particular = $('#particular').val();
    var saronum = $('#saronum').val();
    var ppa = $('#ppa').val();
    var uacs = $('#uacs').val();
    var amount = $('#amount').val();
    var remarks = $('#remarks').val();
    var sarogroup = $('#sarogroup').val();
    var status = $('#status').val();
		if(ors!="" ){
			$.ajax({
				url: "obcreatefunction.php",
				type: "POST",
				data: {
					datereceived: datereceived,
					datereprocessed: datereprocessed,
					datereturned: datereturned,
					datereleased: datereleased,
          ors: ors,
					ponum: ponum,
					payee: payee,
					supplier: supplier,
          particular: particular,
					saronum: saronum,
					ppa: ppa,
          uacs: uacs,
					amount: amount,
          remarks: remarks,
					sarogroup: sarogroup,
					status: status,
					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
            
						$("#butsave").removeAttr("disabled");
					//$('#fupForm').find('input:text').val('');
						$("#success").show();
					//	$('#success').html('Data added successfully!');
            alert("Data added successfully!");
           						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script> -->


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


<script>
$(document).ready(function(){
  $("#result").click(function(){
    $("#main").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result1").click(function(){
    $("#main1").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result2").click(function(){
    $("#main2").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result3").click(function(){
    $("#main3").hide();
  });
});
</script>


<script>
$(document).ready(function(){
  $("#result4").click(function(){
    $("#main4").hide();
  });
});
</script>


</body>
</html>
