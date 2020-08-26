<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$query = mysqli_query($conn, "SELECT FIRST_M,MIDDLE_M, LAST_M, DIVISION_C FROM tblemployeeinfo where UNAME  = '$username'");

$row = mysqli_fetch_array($query);


    $f = $row['FIRST_M'];
    $m = $row['MIDDLE_M'];
    $l= $row['LAST_M'];
   


// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';

//Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];

$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];

$checked = "";

echo $DIVISION_M;






//count ob
$idGet='';
$getDate = date('Y');
$m = date('m');
$auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM ob order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {

  $idGet = $row["a"];
}

$obcount = $getDate.'-'.'00'.$idGet;




?>


<!-- 

value ="<?php echo date("h:i:s A");?>" -->

<!-- Insert Query -->

<?php


if(isset($_POST['submit'])){



$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$username1 = $_SESSION['username'];
 
$checked = $_POST['check'];
//echo $checked;

$obno = $_POST['obno'];
$date1 = $_POST['date'];
$date = date('Y-m-d', strtotime($date1));
$office = $_POST['office'];

$name = $_POST['name'];
$purpose = $_POST['purpose'];
$place = $_POST['place'];
$obdate1 = $_POST['obdate'];
$obdate = date('Y-m-d', strtotime($obdate1));

$timefrom = $_POST['timefrom'];
$timeto = $_POST['timeto'];
$timefrom = $_POST['timefrom'];

$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if($checked=="checked"){

  //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached File cannot be empty. </p> </div></div>  '; 

  $query = mysqli_query($conn,"INSERT INTO ob (obno,date,office,name,purpose,place,obdate,timefrom,uc) 
  VALUES ('$obno','$date','$office','$name','$purpose','$place','$obdate','$timefrom','1')");
 
 /*  echo "INSERT INTO ob (obno ,date,office,name,purpose,place,obdate,timefrom,timeto,uc) 
  VALUES ('$obno','$date','$office','$name','$purpose','$place','$obdate','$timefrom','1')";
  exit(); */
 

}
else{

  $query = mysqli_query($conn,"INSERT INTO ob (obno,date,office,name,purpose,place,obdate,timefrom,timeto) 
  VALUES ('$obno','$date','$office','$name','$purpose','$place','$obdate','$timefrom','$timeto')");
 
  /* echo "INSERT INTO ob (obno ,date,office,name,purpose,place,obdate,timefrom,timeto) 
  VALUES ('$obno','$date','$office','$name','$purpose','$place','$obdate','$timefrom','$timeto')";
  exit(); */
 
  }


mysqli_close($conn);

if($query){

    echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully added. </p> </div></div>  '; 
 

}
else{

  
  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
   
}

}



?>
<!-- Insert Query -->
       
<div class="box" style="border-style: groove;">
          <div class="box-body">
      
            <h1 align="">Add Official Business</h1>
         
        <br>
      <li class="btn btn-success"><a href="ob.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

        <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
                <table class="table"> 
              
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check" >

                    <div class="div">


                    <!-- Header -->
                    <div class="row">

                        <div class="col-md-2 " >
                        </div>

                     

                        <div class="col-md-8" >

                        <img id="img" class="pull-left"  style="width:100;height:180px;" src="images/logo.png" title = "" />



                        <div class="div" style ="text-align:center">

                        <br>
                        Republic of the Philippines
                        <br>
                        <h4><b>DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT
                        <br>
                        Region IV-A (CALABARZON)
                        <br></h4>
                        </b>
                        Andenson Building 1, National Highway, Brgy. Parian
                        <br>
                        City of Calamba, Laguna
                        <br>
                        Tel: (049)8274755/(049)8274587/(049)8274560 •  Fax: (049) 8274745

                        <br>
                        Email: dilgcalabarzon@yahoo.com   •  Website: www.calabarzon.dilg.gov.ph
                      
                        </div>
                       

                        </div>
                        <div class="col-md-2 " >
                        </div>

                      

                    </div>
                     <!-- Header -->

                    <br> 
                    <br>
                    
                    <!-- Permit Row -->
                    <div class="row">

                        <div class="col-md-12" style = "text-align:center">
                        <h3>PERMIT TO LEAVE THE OFFICE</h3>
                      </div>


                    </div>
                <!-- Permit Row -->


                  <!-- No and date -->
                  <div class="row">

                  <div class="col-md-2" style = "text-align:center">
                
                  </div>
                  <div class="col-md-4" style = "text-align:center">
                 
                  </div>

                  <div class="col-md-4" >
                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                  <label style="height:20px">No.</label>&nbsp;&nbsp;&nbsp;&nbsp; <input required value="<?php echo $obcount; ?>" readonly  class="pull-right" type="text" class="" style="height: 25px; width: 150px;" id="obno" name="obno" placeholder="obno" >
                  <br>
                  
                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                  <label style="height:20px">Date</label>&nbsp;&nbsp;&nbsp;<input readonly required type="text" class="pull-right" style="height: 25px; width: 150px;" name="date" id="" value = "<?php echo date('m/d/Y') ?>" >
                  <br>
                  </div>

                  <div class="col-md-2" style = "text-align:center">
                
                  </div>


                  </div>
                <!-- No and date -->

                    <br> 
                    <br>

                 <!--Body -->
                 <div class="row">

                <div class="col-md-2" style = "text-align:center">

                </div>
                 <input hidden readonly required  type="text"  class="" style="height: 35px;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>">

                <div class="col-md-8" style = "text-align:center">
                Permission is requested by Mr./Ms. &nbsp;&nbsp;&nbsp;<input required style="height: 25px;width: 150px;"   id="name" name="name" autocomplete ="off" type="text" class="" placeholder="Name" value = "">&nbsp;&nbsp;&nbsp;
                to leave the office for the following purpose (s).&nbsp;&nbsp;&nbsp;<input style="height: 25px;width: 270px;" id="purpose" name="purpose" autocomplete ="off" type="text" class="" placeholder="Purpose">
                </div>

                <div class="col-md-2" style = "text-align:center">
                <br>

                </div>


                </div>
                <!--Body -->
                
                <br> 
                <br>

              <!--Body 2nd -->
              <div class="row">

              <div class="col-md-2" >

              </div>

              <div class="col-md-4 pull-left" >
              Place to be visited:  &nbsp;&nbsp;&nbsp;  <input style="height: 25px;width: 150px;" id="place" name="place" autocomplete ="off" type="text" class="" placeholder="Place">
              <br>
              <br>
             
              Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input required type="text" class="" style="height: 25px;width: 150px;" name="obdate" id="datepicker2" value = "" placeholder="mm/dd/yyyy">

              </div>


              <div class="col-md-4" >
              &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
              Time of Departure:<input  type="time" class="pull-right" style="height: 25px;width: 150px;" name="timefrom" id="timefrom">
              <br>
              <br>

              &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
              Time of Return:
              <input  type="time" class="pull-right" style="height: 25px;width: 150px;" name="timeto" id="timefrom">
              </div>




              <div class="col-md-2" >
            

              </div>


              </div>
              <!--Body 2nd -->
              <br> 
              <br>


               <!--Signature -->
               <div class="row">

              <div class="col-md-2" style = "text-align:center">

              </div>


              <div class="col-md-4" style = "text-align:center">
              
              </div>


              <div class="col-md-4" style = "text-align:center">
              &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
              Signature of Requesting Employee (s).
              <br>
              <br>
              <input style="height: 25px;width: 220px;"  required id="" name="" autocomplete ="off" type="text" class="pull-right" placeholder="Name" value = "">
              </div>
             
              <div class="col-md-2" style = "text-align:center">
             

              </div>


              </div>
              <!--Signature -->
              <br> 
            

              
               <!--Note -->
               <div class="row">

              <div class="col-md-2" style = "text-align:center">

              </div>


              <div class="col-md-4" style = "text-align:left">
              

              <b>Employee(s) to perform official function and claim for 
              Travelling expenses is hereby authorized.</b>
             <!--  <br>
              <br>
              <input type="checkbox" name="" id="">YES &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  <input type="checkbox" name="" id="">NO -->
              
              

              </div>


              <div class="col-md-4" style = "text-align:center">
             
              </div>
             
              <div class="col-md-2" style = "text-align:center">
             

              </div>


              </div>
              <!--Note -->

              <br> 
              <br>


            <!--Approved -->
            <div class="row">

            <div class="col-md-2" style = "text-align:center">

            </div>


            <div class="col-md-4" style = "text-align:left">

            </div>


            <div class="col-md-4" style = "text-align:center">
           <!--  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
            <b>Approved:</b> -->
            </div>

            <div class="col-md-2" style = "text-align:center">


            </div>


            </div>
            <!--Approved -->




                  <!-- End -->
                    </div>
                  <!-- End -->

                 <!--  <?php echo $f.' '.$row['MIDDLE_M'].' '.$l.'';?> -->
                    

               
                </table>

                
                  <br>
                  <br>
                    <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave">

                    <br>
                  <br>
                    </div>
              </form>
                
          </div>
       
    
  </form>
   
  

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!--  <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </div>
</div>


 -->


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 
 <script>
function myFunction() {
  var checkBox = document.getElementById("uc");
  var text = document.getElementById("timeto");
  var check = $("input[name='check']");
  //var str = $("input[name='timeto']");
  if (checkBox.checked == true){
    text.readOnly = true ;

    check.val('checked');
    
  } else {
    text.readOnly = false;

    check.val('');
  }


}
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
    $('.timepicker1').timepicker({
      showInputs: true
    })

    $('.timepicker2').timepicker({
      showInputs: true
    })
  })
</script>


</body>
</html>