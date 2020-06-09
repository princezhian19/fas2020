<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $query = mysqli_query($conn, "SELECT FIRST_M,MIDDLE_M, LAST_M, DIVISION_C FROM tblemployeinfo where UNAME  = '$username'");
  
  $row = mysqli_fetch_array($query);
  
  
      $f = $row['FIRST_M'];
      $m = $row['MIDDLE_M'];
      $l= $row['LAST_M'];
     
  
  
  // echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
  // echo '<br>';
  
  //Get Office
  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeinfo WHERE UNAME = '$username'");
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
      $place = $_POST['place'];
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


if($checked=="checked"){

  
  
  $query = mysqli_query($conn,"UPDATE  ob set obno='$obno',date='$date',office='$office',name='$name',purpose='$purpose',place='$place',obdate='$obdate',timefrom='$timefrom1',timeto='0000-00-00',uc='1' where id = '$id'");
 
  /* echo "UPDATE  ob set obno='$obno',date='$date',office='$office',name='$name',purpose='$purpose',place='$place',obdate='$obdate',timefrom='$timefrom',uc='1' where id = '$id'";
  exit(); */


}

else
{
  $query = mysqli_query($conn,"UPDATE  ob set obno='$obno',date='$date',office='$office',name='$name',purpose='$purpose',place='$place',obdate='$obdate',timefrom='$timefrom1',timeto='$timeto1',uc='0' where id = '$id'");
  
  
}

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
                <table class="table"> 
                <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
                <table class="table"> 
              
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check" >

                <input value="<?php echo $id;?>" hidden  type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">

                    <tr>  
                    
                            <td class="col-md-5">
                            <input readonly value="<?php echo $obno;?>" required  class="form-control" type="text" class="" style="height: 35px;" id="obno" name="obno" placeholder="obno" >
                                    </td>
                    </tr>
                    <tr>
                    
                            <td class="col-md-5">
                            <input readonly required type="text" class="form-control" style="height: 35px;" name="date" id="" value = "<?php echo date('m/d/Y') ?>" >
                    </tr>
                    <tr>
                      
                            <td class="col-md-5">  <input readonly required  type="text"  class="form-control" style="height: 35px;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>"></td>
                    </tr>
                    <tr>
                     
                            <td class="col-md-5">
                            <input readonly id="name" name="name" autocomplete ="off" type="text" class="form-control" placeholder="name" value = "<?php echo $f.' '.$row['MIDDLE_M'].' '.$l.'';?>">
                            </td>
                    </tr>

                    
                    <tr>
                     
                            <td class="col-md-5">
                            <input value="<?php echo $purpose;?>" id="purpose" name="purpose" autocomplete ="off" type="text" class="form-control" placeholder="purpose">
                            </td>
                    </tr>

                    
                    <tr>
                     
                            <td class="col-md-5">
                            <input  value="<?php echo $place;?>" id="place" name="place" autocomplete ="off" type="text" class="form-control" placeholder="place">
                            </td>
                    </tr>
                
                    <tr>

                          <td class="col-md-5">
                          <input value="<?php echo $obdate;?>" required type="text" class="form-control" style="height: 35px;" name="obdate" id="datepicker2"  placeholder="mm/dd/yyyy">
                          </td>
                            <!-- <td class="col-md-5"><input  type="text" class="form-control" style="height: 35px;" name="obdate" id="datepicker2" value = "<?php echo date('m/d/Y') ?>" ></td> -->
                    </tr>

                    <tr>
                       
                       <td class="col-md-5"><input  value="<?php echo $timefrom1;?>" type="time" class="form-control" style="height: 35px;" name="timefrom" id="timefrom"></td>
                    </tr>

                    
                    <tr>
                       
                       <td class="col-md-5"><input value="<?php echo $timeto1;?>"  type="time" class="form-control" style="height: 35px;" style="display:block" name="timeto" id="timeto"></td>
                    </tr>

                    <tr>

                       <!-- <input  style = "margin-bottom:10px;" type = "checkbox" name = "uc" class = "checkboxgroup_g1" id = "uc" value ="1"> <br> -->
                       <td class="col-md-5"><input onclick="myFunction()"  type="checkbox" class="checkboxgroup_g1" value="1" style="height: 35px;" name="uc" id="uc" ><label> Upon Completion<label></td>
                    </tr>
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


 
<script>


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


</body>
</html>