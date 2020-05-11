<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $query = mysqli_query($conn, "SELECT FIRST_M,MIDDLE_M, LAST_M, DIVISION_C FROM tblemployee where UNAME  = '$username'");
  
  $row = mysqli_fetch_array($query);
  
      $f = $row['FIRST_M'];
      $m = $row['MIDDLE_M'];
      $l= $row['LAST_M'];
     
  
  
  // echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
  // echo '<br>';
  
  //Get Office
  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
  $rowdiv = mysqli_fetch_array($select_user);
  $DIVISION_C = $rowdiv['DIVISION_C'];
  
  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
  $rowdiv1 = mysqli_fetch_array($select_office);
  $DIVISION_M = $rowdiv1['DIVISION_M'];
  
  $checked = "";

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';
?>

<?php

$id=$_GET['id'];
//echo $id;
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$view_query = mysqli_query($conn, "SELECT * from ob where id = '$id'");



    while ($row = mysqli_fetch_assoc($view_query)) {

      $id=$row['id'];

      $obno = $row['obno'];
     
      $date1 = $row['date'];
      $date = date('m/d/Y', strtotime($date1));
      $office = $row['office'];
      $name = $row['name'];
      $purpose = $row['purpose'];
      $place = $row['place'];
      $obdate1 = $row['obdate'];
      $obdate = date('m/d/Y', strtotime($obdate1));
      
      $timefrom1 = $row['timefrom'];
      $timefrom=  date("h:i",$timefrom1);


      $timeto1 = $row['timeto'];
      $timeto=  date("h:i",$timeto1);


      $uc = $row['uc'];

      $submitteddate1 = $row['submitteddate'];
      $submitteddate = date('m/d/Y', strtotime($submitteddate1));


      $receiveddate = $row['receiveddate'];
      $receiveddate = date('m/d/Y', strtotime($receiveddate1));
    }

?>

<!-- Upadte Queries -->


<?php


if(isset($_POST['submit'])){


      $checked = $_POST['check'];
     // echo $checked;


      $id = $_POST['getid'];
      //echo $id;

      $obno = $_POST['obno'];
     
      $date1 = $_POST['date'];
      $date = date('Y-m-d', strtotime($date1));
      $office = $_POST['office'];
      $name = $_POST['name'];
      
      $purpose = $_POST['purpose'];
      $purpose1 = $_POST['purpose1'];
      
      $purposes = $purpose.' '.$purpose1;
      
      
      $place = $_POST['place'];
      $place1= $_POST['place1'];
      
      $places = $place.' '.$place1;
      $obdate1 = $_POST['obdate'];
      $obdate = date('Y-m-d', strtotime($obdate1));
      
      $timefrom1 = $_POST['timefrom'];
      $timefrom=  date("h:i A",$timefrom1);


      $timeto1 = $_POST['timeto'];
      $timeto=  date("h:i A",$timeto1);


      $uc = $row['uc'];

      $submitteddate1 = $_POST['submitteddate'];
      $submitteddate = date('Y-m-d', strtotime($submitteddate1));


      $receiveddate = $_POST['receiveddate'];
      $receiveddate = date('Y-m-d', strtotime($receiveddate1));



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
$username1 = $_SESSION['username'];
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


/* if($checked=="checked"){

  
  
  $query = mysqli_query($conn,"UPDATE  ob set obno='$obno',date='$date',office='$office',name='$name',purpose='$purpose',place='$place',obdate='$obdate',timefrom='$timefrom1',timeto='0000-00-00',uc='1' where id = '$id'");
 
  


}

else
{ */
  $query = mysqli_query($conn,"UPDATE  ob set obno='$obno',date='$date',office='$office',name='$name',purpose='$purposes',place='$places',obdate='$obdate',timefrom='$timefrom1',timeto='$timeto1' where id = '$id'");
  
  
//}

mysqli_close($conn);

if($query){

    echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
   
}
else{

    echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
    
}
}

?>




<!-- Upadte Queries -->
<div class="box">
          <div class="box-body">
      
            <h1 align="">Edit Official Business</h1>
         
        <br>
      <li class="btn btn-success"><a href="ob.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

        <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
            
              
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check" >

                <input value="<?php echo $id;?>" hidden  type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">


                      <div class="" style="border-style: ridge;">
                      <table class="table" > 

                      <input  hidden  type="text"  class="" style="height: 35px;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>">
                      <!-- Header -->
                      <tr>
                      <td class="col-md-1"></td>

                      <td class="col-md-2" >

                      <img id="img" class="pull-left"  style="margin-top:20px; width:100;height:120px;" src="images/male-user.png" title = "" />

                      </td>

                      <td class="col-md-6" style = "text-align:center;">

                      <br>
                      Republic of the Philippines
                      <br>
                      <h4><b>DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT
                      <br>
                      Region IV-A (CALABARZON)
                      <br></h4>
                      </b>
                      3/F Andenson Bldg. 1, National Highway, Brgy. Parian, City of Calamba, Laguna 4027

                      <br>
                      827-4745; 827-4560; 827-4587; 827-3143 ; 827-4745

                      <br>
                      dilg4a.calabarzon@gmail.com www.calabarzon.dilg.gov.ph

                      </td>



                      <td class="col-md-2" >
                      <img id="img" class=""  style="margin-top:20px; width:100;height:120px;" src="images/calabarzon.png" title = "" />
                      </td>

                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- Header -->



                      <!-- Permit -->
                      <tr>
                      <td class="col-md-1"></td>

                      <td class="col-md-2" >



                      </td>

                      <td class="col-md-6" style = "text-align:center; color:gray;">

                      <h3>PERMIT TO LEAVE THE OFFICE</h3>

                      </td>



                      <td class="col-md-2" >

                      </td>

                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- Permit -->

                      <!-- No -->
                      <tr>
                      <td class="col-md-1"></td>

                      <td class="col-md-2" >



                      </td>

                      <td class="col-md-4" style = "text-align:center; font-family:Sylfaen;">



                      </td>



                      <td class="col-md-4" >

                      <b><label style="height:20px">No	:</label></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input required value="<?php echo $obno; ?>" readonly  class="" type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; font:bold; color:red; height: 25px; width: 120px;" id="obno" name="obno" placeholder="obno" >
                      <br>
                      <label style="height:20px">Date :</label>&nbsp;&nbsp;&nbsp;<input readonly required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 25px; width: 120px;" name="date" id="" value = "<?php echo date('F d, Y') ?>" >
                      </td>

                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- No -->


                      <br>
                      <!-- Body -->
                      <tr>
                      <td class="col-md-1"></td>



                      <td colspan = 11 class="" style = " font-family:Sylfaen;">
                      <br>
                      Permission is requested by Mr./Ms.  &nbsp;&nbsp;<input required readonly style="font-weight:bold; border:none;border-bottom:1px solid black; height: 25px;width: 480px;"   id="name" name="name" autocomplete ="off" type="text" class="" placeholder="Name" value = "<?php echo $name;?>">
                      to leave the office for the following purpose(s):
                      <br>
                      <input value="<?php echo $purpose?>" required style="border:none;border-bottom:1px solid black; height: 25px;width: 975px; font-weight:bold;" id="purpose" name="purpose" autocomplete ="off" type="text" class="" placeholder="Purpose">
                      <input style="border:none;border-bottom:1px solid black; height: 25px;width: 972px; font-weight:bold;" id="purpose1" name="purpose1" autocomplete ="off" type="text" class="" placeholder="Purpose">.
                      <br>
                      </td>




                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- Body -->



                      <!-- place -->
                      <tr>
                      <td class="col-md-1"></td>



                      <td colspan = 2 class="" style = " font-family:Sylfaen;">

                      <br>
                      Place to be visited:
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input value="<?php echo $place?>" required style=" font-weight:bold;border:none;border-bottom:1px solid black; height: 25px;width: 200px;" id="place" name="place" autocomplete ="off" type="text" class="" placeholder="Place">
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;
                      <input style="font-weight:bold; border:none;border-bottom:1px solid black; height: 25px;width: 200px;" id="place1" name="place1" autocomplete ="off" type="text" class="" placeholder="Place">

                      <br>
                      Date:
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;

                      <input value="<?php echo $obdate?>" required type="text" class="" style="font-weight:bold; border:none;border-bottom:1px solid black; height: 25px;width: 200px;" name="obdate" id="datepicker2" value = "" placeholder="mm/dd/yyyy">
                      </td>

                      <td colspan = 1 class="" style = " font-family:Sylfaen;">

                      <br>

                      Time of Departure:
                      <input value="<?php echo $timefrom1?>" required  type="time" class="" style="font-weight:bold; border:none;border-bottom:1px solid black; height: 25px;width: 75px;" name="timefrom" id="timefrom">
                      <br>
                      Time of Return:
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <input value="<?php echo $timeto1?>" required  type="time" class="" style="font-weight:bold; border:none;border-bottom:1px solid black; height: 25px;width: 75px;" name="timeto" id="timeto" style="display:block">


                      <br>



                      </td>



                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- place -->


                      <!-- signature -->
                      <tr>
                      <td class="col-md-1" style="padding:5px 5px 5px 5px;"></td>



                      <td colspan = 2 class="" style = " font-family:Sylfaen;">

                      <b>
                      <br>
                      Employee(s) to perform official function and claim for
                      <br>    	           	 	
                      <b>
                      travelling expenses is hereby authorized.
                      <br>
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "checkbox" class = "checkboxgroup_g1" value ="Yes"> <b>Yes</b>
                      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "checkbox" class = "checkboxgroup_g2" value ="No"><b>No</b>
                      </td>

                      <td colspan = 1 class="" style = " font-family:Sylfaen;">
                      <br>
                      Signature of Requesting
                      <br>
                      Employee (s)
                      <br>
                      <br>
                      ________________________

                      </td>



                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- signature -->

                      <!-- Approved -->
                      <tr>

                      <?php
                      session_start();
                      $username = $_SESSION['username'];
                      $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                      //Get Office
                      $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                      $rowdiv = mysqli_fetch_array($select_user);
                      $DIVISION_C = $rowdiv['DIVISION_C'];
                      //echo $DIVISION_C;
                      $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                      $rowdiv1 = mysqli_fetch_array($select_office);
                      $DIVISION_M = $rowdiv1['DIVISION_M'];
                      //GET Chief    
                      /*  $select_office = mysqli_query($conn, "SELECT pmo_contact_person from pmo where id = '$DIVISION_C'");
                      $rowdiv1 = mysqli_fetch_array($select_office);
                      $DIVISION_M = $rowdiv1['DIVISION_M']; */
                      $approved="";
                      $pos="";
                      if($DIVISION_M=='ORD'){
                      $approved="Noel R. Bartolabac";
                      $pos="ASST. REGIONAL DIRECTOR";
                      }
                      else if($DIVISION_M=='LGMED'){

                      $approved="Gilberto L. Tumamac";
                      $pos="OIC - LGMED Chief";


                      }

                      else if($DIVISION_M=='LGCDD'){

                      $approved="Jay-ar T. Beltran";
                      $pos="OIC - LGCDD Chief";

                      }

                      else if($DIVISION_M=='FAD'){

                      $approved="Dr. Carina S. Cruz";
                      $pos="Chief, FAD";

                      }
                      else{

                        $approved="";
                        $pos="";
                      }
                      ?>
                      <td class="col-md-1" style="padding:5px 5px 5px 5px;"></td>



                      <td colspan = 2 class="" style = " font-family:Sylfaen;">


                      </td>

                      <td colspan = 1 class="" style = " font-family:Sylfaen;">
                      <br>
                      <b>Approved:</b>
                      <br>
                      <br>
                      ________________________
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                      <b><?php echo $approved;?></b>
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                      <b><?php echo $pos;?></b>


                      </td>



                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- Approved -->

                      <!-- copy -->
                      <tr>


                      <td class="col-md-1" style="padding:5px 5px 5px 5px;"></td>



                      <td colspan = 2 class="" style = " font-family:Sylfaen; font-style: italic;">
                      Copy for Personnel Section, FAD

                      </td>

                      <td colspan = 1 class="" style = " font-family:Sylfaen;">


                      </td>



                      <td class="col-md-1"></td> 


                      </tr>
                      <!-- copy -->

                      </table>


                      </div> 


                        <!-- <input onclick="myFunction()"  type="checkbox" class="checkboxgroup_g1" value="1" style="height: 25px;" name="uc" id="uc" ><label> Upon Completion<label> -->
                      

                </table>

                
                  <br>
                  <br>
                    <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave">

                    <br>
                  <br>
                    </div>
              </form>
                
          
       
  

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <script>
function myFunction() {
  var checkBox = document.getElementById("uc");
  var text = document.getElementById("timeto");
  var check = $("input[name='check']");
  //var str = $("input[name='timeto']");
  if (checkBox.checked == true){
    text.readOnly = true ;
    text.style = "background-color:gray; height: 25px;width: 150px;";

    check.val('checked');
    
  } else {
    text.readOnly = false;
    text.style = "background-color:white; height: 25px;width: 150px;";
    check.val('');
  }


}
</script>
 
<!-- <script>


$(document).ready(function(){
  $('#checkbox').checkBox({
      

    

    })
});


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
</script> -->
 



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


</body>
</html>

<script>
$(document).ready(function(){


  $('.checkboxgroup_g1').on('change', function() {
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
  });

  
  $('.checkboxgroup_g2').on('change', function() {
      $('.checkboxgroup_g1').not(this).prop('checked', false);  
  });

});
</script>