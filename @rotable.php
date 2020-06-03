<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}
  //echo $username;

  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $username = $_SESSION['username'];

  //echo $username;
  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
  $rowdiv = mysqli_fetch_array($select_user);
  $DIVISION_C = $rowdiv['DIVISION_C'];
 
  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
  $rowdiv1 = mysqli_fetch_array($select_office);
  $DIVISION_M = $rowdiv1['DIVISION_M'];

  //echo $DIVISION_M;

  $idGet='';
  $getDate = date('Y');
  $m = date('m');
  $auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM ro_roo order by id desc limit 1");
  while ($row = mysqli_fetch_assoc($auto)) {
  
    $idGet = $row["a"];
  }
  
  if($idGet<9){
  $obcount = $getDate.'-'.'00'.$idGet;
  
  }
  else if($idGet<99){
  
  $obcount = $getDate.'-'.'0'.$idGet;
  
  }
  else{
  $obcount = $getDate.'-'.$idGet;
  }


?>



<?php

$container = "";




$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

  function getData($conn,$query){
     
    $result = $conn->query($query);

    $data = array();
    foreach ($result as $row ) {
    $data[] = $row ;
    }
    return $data;

    $result->close();
    // $conn->close(); CTODI
    exit();
}

  
require_once('_includes/class.upload.php');






?>



<?php
// include('db.class.php'); // call db.class.php
$edit="edit";
?>
<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Regional Order and Regional Office Order</h1>
          
          <br>
          
<table class="table" > 

<!-- Header -->
<tr>
<td class="col-md-2">

<a name="Cancel" value="" id="Cancel"  data-toggle="modal" data-target="#add_data_Modal" title="Add" class = "btn btn-success" > <i class=''></i> Register</a> 
</td>

<td class="col-md-6" >


</td>
<form method = "POST" action = "ro_export_date.php">
<td class="col-md-1">

<?php if ($username1 == 'cvferrer' || $username1 == 'itdummy1' || $username1 == 'seolivar' || $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno'):?>

<b>Month</b>

<select class="" name="month" id = "selectMonth" style="width: 150px; Height:30px;">
<?php 
$current_month =  date('F');
switch($current_month){
case 'January':
echo '
<option value="01" selected>January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'February':
echo '
<option value="01">January</option>
<option value="02" selected>February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'March':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03" selected>March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'April':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04" selected>April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'May':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05" selected>May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'June':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06" selected>June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'July':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07" selected>July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'August':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08" selected>August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'September':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09" selected>September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'October':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10" selected>October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'November':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11" selected>November</option>
<option value="12">December</option>';
break;
case 'December':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12" selected>December</option>';
break;
}
?>

</select>
</td>
<td class="col-md-1" >
<b>Year</b>
<select class="" id="year" name="year" style="width: 150px; Height:30px;">
<!-- <option value="">Year</option> -->
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
<option value="2029">2029</option>
<option value="2030">2030</option>

</select>

</td>

<td class="col-md-1" >

<b>Office</b>
<select class="" id="office" name="office" style="width: 150px; Height:30px;">
<!-- <option value="" style="color:gray">Office</option> -->
<option value="ALL">ALL</option>
<option value="ORD">ORD</option>
<option value="FAD">FAD</option>
<option value="LGCDD">LGCDD</option>
<option value="MBRTG">MBRTG</option>
<option value="LGMED">LGMED</option>
<option value="PDMU">PDMU</option>
<option value="Batangas">Batangas</option>
<option value="Cavite">Cavite</option>
<option value="Laguna">Laguna</option>
<option value="Rizal">Rizal</option>
<option value="Quezon">Quezon</option>
<option value="Lucena City">Lucena City</option>

</select>
</td>
<td class="col-md-1" >
<br>
<button style="  Height:30px;"  id="" name="submit" type="submit"  class="btn btn-success pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Export&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
</td>
</form>


<?php else:?>

<?php endif?>

</tr>
<!-- Header -->
</table>  
          <div class=""  style="overflow-x:auto;">
         
            <!-- <li class="btn btn-success"><a href="CreateIssuances.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Add</a></li> -->
        
          
              <br>
              
            </div>
            <div class=""  style="overflow-x:auto;">
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">
                   <!-- <th width = '10'>TAG</th>  -->
                  <th width = '300'>CATEGORY</th>
                  <th width = '200'>ISSUANCE NO  </th>
                  <th width = '200'>ISSUANCE DATE  </th>
                  <th width = '700'>TITLE/SUBJECT  </th>
                  <th width = '250'>OFFICE</th>
                  <th width = '200'>REGISTERED BY </th>
                  <th width = '200'>REGISTERED DATE  </th>

                  <th width = '300'>ACTION<BR><BR></th>
                  
                </tr>
                </thead>

                
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * from ro_roo order by id desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];
                  
                  $category = $row["category"];

                  $issuanceno  = $row["issuanceno"];
                
                  $issuancedate1  = $row["issuancedate"];
                  $issuancedate = date('F d, Y', strtotime($issuancedate1));

                  $issuancedate11 = date('m/d/Y', strtotime($issuancedate1));

                  $title = $row["title"];
                
                  $office = $row["office"];
                 
                  $registeredby= $row["registeredby"];


               $registereddate1  = $row["registereddate"];
                  $registereddate = date('F d, Y', strtotime($registereddate1));
                  

             

               ?>

                <tr align = ''>

              
                

                <td><?php echo $category?></td>
                <td><?php echo $issuanceno?></td>
                <td><?php echo $issuancedate?></td>
                <td><?php echo $title?></td>
                <td><?php echo $office?></td>

                <td><?php echo $registeredby?></td>
                <td><?php echo $registereddate?></td>

                <td>
                  <?php
                  
                    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                    $username = $_SESSION['username'];

                    //echo $username;
                    $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                    $rowdiv = mysqli_fetch_array($select_user);
                    $DIVISION_C = $rowdiv['DIVISION_C'];

                    $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                    $rowdiv1 = mysqli_fetch_array($select_office);
                    $DIVISION_M = $rowdiv1['DIVISION_M'];
 


                  ?>

                    <?php if ($username1 == 'cvferrer' || $username1 == 'itdummy1' || $username1 == 'seolivar' || $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno'):?>


                    <a name="edit" onclick="myFunction(this)" data-office = "<?php echo $office;?>" data-id="<?php echo $id;?>"  data-registeredby = "<?php echo $registeredby;?>" data-registereddate = "<?php echo $registereddate;?>" data-title = "<?php echo $title;?>" data-issuanceno = "<?php echo $issuanceno;?>" data-issuancedate = "<?php echo $issuancedate11;?>"  data-category = "<?php echo $category;?>"   value="" id="edit"  data-toggle="modal" data-target="#edit_data_Modal" title="Edit" class = "btn btn-primary btn-xs" > <i class=''></i> <i class='fa'>&#xf044;</i> Edit</a> |

                    <a onclick="return confirm('Are you sure you want to delete this Regional Order/Regional Office Order?');" name="del"  href="ro_delete.php?id=<?php echo $id; ?>&issuance=<?php echo $issuance_no?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                    <?php else :?>


                    <?php endif?>
                
                       
            

              

                </td>
                
               

                </tr>

            
            <?php }?>


                
             
            </table>
                
                </div>
                            </div>
                            </div>
      
    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable=$('#example1').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true,
            "order": [[ 1, "asc" ]],
            aLengthMenu: [ [10, 20, -1], [ 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
            });
        
    } );
</script>


</body>
</html>


<!--Add modals -->

<div id="add_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Add Regional Order and Regional Office Order</b></h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="ro_create.php" enctype="multipart/form-data">
              
        
              <div class="addmodal" >
             



              <table class="table"> 


              <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
                      <option value="Regional Order">Select Category</option>
                      <option value="Regional Order">Regional Order</option>
                      <option value="Regional Office Order">Regional Office Order</option>
                     
                      </select></td>
                                </tr>
                    <tr>  
                        <td class="col-md-2"><b>Issuance No<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">
                            <input required readonly value="<?php echo $obcount; ?>"  class="form-control" type="text" class="" style="height: 35px;" id="issuanceno" name="issuanceno" placeholder="" name="issuances" >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Issuance Date<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5"> 
                            <input required type="text" class="form-control" style="height: 35px;" name="issuancedate" id="datepicker1" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
                                    </tr>
                    <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>


                        <tr>
                        <td class="col-md-2"><b>Office<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  

                            <input readonly hidden  value="<?php echo $DIVISION_M;?>" id="office" name="office" autocomplete ="off" type="text" class="form-control" placeholder="">

                            </td>
                    </tr>            


                    <tr>
                        <td class="col-md-2"><b>Registered By <span style = "color:red;">*</span></b></td>
                            <td class="col-md-5"> <?php

                             $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                             $username = $_SESSION['username'];
              
                             //echo $username;
                             $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                             $rowdiv = mysqli_fetch_array($select_user);
                             $DIVISION_C = $rowdiv['DIVISION_C'];
                            
                             $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                             $rowdiv1 = mysqli_fetch_array($select_office);
                             $DIVISION_M = $rowdiv1['DIVISION_M'];
                            
                            
                            ?>                             
                         


                            <input readonly value="<?php echo $username;?>" id="registeredby" name="registeredby" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Registered Date <span style = "color:red;">*</span></b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="registereddate" id="registereddate" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('F d, Y') ?>" ></td>
                                </tr>


            </table>
                 
           
            <button type="submit" name="Add" class="btn btn-success pull-right">Save</button>


                
                  <br>
              <br>
              
              
            
                </div>
           
                
          </div>
        </div>

      
    
    </div>

    </div>
 

          
              
              </form>
           
        <!-- Add modals -->




<!--Edit modals -->

<div id="edit_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Edit Regional Order and Regional Office Order</b></h4>
            </div>
            <div class="modal-body">


            <script>
                  function myFunction(idget) {
                    
                    //getting from data-id from button
                    var idmodal = idget.getAttribute("data-id");
                    var issuanceno1 = idget.getAttribute("data-issuanceno");
                    var issuancedate1 = idget.getAttribute("data-issuancedate");
                    var title1 = idget.getAttribute("data-title");
                    var office1 = idget.getAttribute("data-office");
                    var registeredby1 = idget.getAttribute("data-registeredby");
                    var registereddate1 = idget.getAttribute("data-registereddate");
                  
                   
                    //Getting input ID's
                    var id1 = $("input[name='getid']");
                    var issuanceno = $("input[name='issuanceno1']");
                    var issuancedate = $("input[name='issuancedate1']");
                    var title = $("input[name='title1']");
                    var office = $("input[name='office1']");
                    var registeredby = $("input[name='registeredby1']");
                    var registereddate = $("input[name='registereddate1']");

                    
                    //setting values to input
                    id1.val(idmodal);
                    issuanceno.val(issuanceno1);
                    issuancedate.val(issuancedate1);
                    title.val(title1);
                    office.val(office1);
                    registeredby.val(registeredby1);
                    registereddate.val(registereddate1);
                    
                  
                   
                  }

                

                  </script>


              <form method="POST" id="insert_form" action="ro_update.php" enctype="multipart/form-data">
              
        
              <div class="addmodal" >
             


              <table class="table"> 


<tr>
          <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
      <td class="col-md-5">
        <select class="form-control " style="width: 100%;" name="category1" id="category1" > 
        
        <option value="Regional Order">Regional Order</option>
        <option value="Regional Office Order">Regional Office Order</option>
       
        </select></td>
                  </tr>
      <tr>  
          <td class="col-md-2"><b>Issuance No<span style = "color:red;">*</span></b></td>
              <td class="col-md-5">
              <input required readonly  class="form-control" type="text" class="" style="height: 35px;" id="issuanceno1" name="issuanceno1" placeholder="" name="issuances" >
                      </td>
                          </tr>
      <tr>
          <td class="col-md-2"><b>Issuance Date<span style = "color:red;">*</span></b></td>
              <td class="col-md-5"> 
              <input required type="text" class="form-control" style="height: 35px;" name="issuancedate1" id="datepicker2" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
                      </tr>
      <tr>
          <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
              <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title1" placeholder="" name="title1"></td>
                  </tr>


          <tr>
          <td class="col-md-2"><b>Office<span style = "color:red;">*</span></b></td>
              <td class="col-md-5">  

              <input readonly hidden  value="<?php echo $DIVISION_M;?>" id="office1" name="office1" autocomplete ="off" type="text" class="form-control" placeholder="">

              </td>
      </tr>            


      <tr>
          <td class="col-md-2"><b>Registered By <span style = "color:red;">*</span></b></td>
              <td class="col-md-5"> 
              <input readonly value="" id="registeredby1" name="registeredby1" autocomplete ="off" type="text" class="form-control" placeholder="">
                      </td>
                          </tr>
      <tr>
          <td class="col-md-2"><b>Registered Date <span style = "color:red;">*</span></b></td>
              <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="registereddate1" id="registereddate1" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('F d, Y') ?>" ></td>
                  </tr>


                    </table>
                 
          
            <button type="submit" name="edit" class="btn btn-success pull-right">Save Changes</button>
            <input hidden   value="<?php echo $id;?>"   type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">


                
                  <br>
              <br>
              
              
            
                </div>
           
                
          </div>
        </div>

      
    
    </div>

    </div>
 

          
              
              </form>
           
        <!-- Edit modals -->


 


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 
        <script type="text/javascript">
		$(document).ready(function() {

			var x = 1;
			$('#office').click(function(e){
			  if( x == 1 ){
			    //console.log('even');
			    $('.office-responsible').show();
			    $(this).attr('placeholder','Click to Close');
			    x = 0;
			  } else {
			    //console.log('odd');
			    $('.office-responsible').hide();
			        $(this).attr('placeholder','Click to Select');

			    x = 1;
			  }
			  e.preventDefault();
			});

		$("legend :checkbox").click(function(){
   	    var getcheckboxes = $(this).attr('class');
	    var delimiter = ";";
	    var text = $("input[id='todiv']");
	    var str = "";

	   $('.'+getcheckboxes).prop('checked',this.checked);
     str += $(this).val() + delimiter;
     var final111 = str.replace(';;;;;;;15;on;on;','');
     text.val(final111);
		});

			$(":checkbox").click(function () {
			    var delimiter = ";";
			    var text = $("input[name='todiv']");
			    var str = "";
			    
			    // for each checked checkbox, add the checkbox value and delimiter to the textbox
			    $(":checked").each(function () {
			        str += $(this).val() + delimiter;
			    });
			    
			    // set the value of the textbox
          var final = str .replace('11;','');
     //alert(final);
         // var final1 = final.replace('11;','');
         // var final2 = final.replace('11;','');

          var final11 = final .replace(';;;;;;;15;','');
        
     text.val('');
     text.val(final11);


			});



				
		 });	
      
    </script>   



<script type="text/javascript">
$(document).ready(function() {

 var x = 1;
 $('#office1').click(function(e){
   if( x == 1 ){
     //console.log('even');
     $('.office-responsible1').show();
     $(this).attr('placeholder','Click to Close');
     x = 0;
   } else {
     //console.log('odd');
     $('.office-responsible1').hide();
         $(this).attr('placeholder','Click to Select');

     x = 1;
   }
   e.preventDefault();
 });

$("legend :checkbox").click(function(){
    var getcheckboxes1 = $(this).attr('class');
 var delimiter1 = ";";
 var text1 = $("input[id='todiv1']");
 var str1 = "";

$('.'+getcheckboxes1).prop('checked',this.checked);

  str1 += $(this).val() + delimiter1;
     var g = str1.replace(';;;;;;;15;','');
     var g1 = g.replace('on;','');
     text1.val(g1);
});

 $(":checkbox").click(function () {
     var delimiter1 = ";";
     var text1 = $("input[name='todiv1']");
     var str1 = "";
     
     // for each checked checkbox, add the checkbox value and delimiter to the textbox
     $(":checked").each(function () {
         str1 += $(this).val() + delimiter1;
        
       
     });
     
     // set the value of the textbox
   
     var final1 = str1 .replace(';;;;;;;15;','');
     var final2 = final1 .replace('11;','');
     //alert(final);
     text1.val('');
     text1.val(final2);
     
     
 });



  
});	
 		
</script> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
