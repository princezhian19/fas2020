<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2030 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
?>
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

<a name="" value="" id=""  data-toggle="modal" data-target="#add_data_Modal" title="Add" class = "btn btn-success" > <i class=''></i> Register</a> 
</td>

<td class="col-md-6" >


</td>
<?php if( $username1 == 'cvferrer' || $username1 == 'itdummy1' || $username1 == 'seolivar' || $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno'){
include('ro_include.php');

}
else{

}

?>

</tr>
<!-- Header -->
</table>  
          <div class=""  style="overflow-x:auto;">
     
              <br>
              
            </div>
            <div class=""  style="overflow-x:auto;">
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">
                  <th width = '300'>CATEGORY</th>
                  <th width = '200'>ISSUANCE NO  </th>
                  <th width = '200'>ISSUANCE DATE  </th>
                  <th width = '700'>TITLE/SUBJECT  </th>
                  <th width = '250'>OFFICE</th>
                  <th width = '200'>REGISTERED BY </th>
                  <th width = '200'>REGISTERED DATE  </th>
                  <th width = '200'>SUBMITTED DATE  </th>
                  <th width = '200'>RECEIVED DATE  </th>
                  <th width = '500'>ACTION<BR><BR></th>
                  
                </tr>
                </thead>

                
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            // $view_query = mysqli_query($conn, "SELECT * from ro_roo order by id desc");

            if ($username1 == 'cvferrer' || $username1 == 'itdummy1'|| $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno')
            {
              $view_query = mysqli_query($conn, "SELECT * from ro_roo order by id desc");
            }
            else{
              $view_query = mysqli_query($conn, "SELECT * from ro_roo where office ='$DIVISION_M' order by id desc");

            }

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

                


                  $submitteddate1  = $row["submitteddate"];
                  $submitteddate = date('F d, Y', strtotime($submitteddate1));
                  $submittedby= $row["submittedby"];

                  $submitteddate1  = $row["submitteddate"];
                  $submitteddate = date('F d, Y', strtotime($submitteddate1));
                  $submittedby= $row["submittedby"];

                  $receiveddate1  = $row["receiveddate"];
                  $receiveddate = date('F d, Y', strtotime($receiveddate1));
                  $receivedby= $row["receivedby"];

                  $cancelleddate1  = $row["cancelleddate"];
                  $cancelleddate = date('F d, Y', strtotime($cancelleddate1));
                  $cancelledby= $row["cancelledby"];

                  $status= $row["status"];
                  $reason= $row["reason"];



               ?>

                <tr align = ''>

            
                <td><?php echo $category?></td>
                <td><?php echo $issuanceno?></td>
                <td><?php echo $issuancedate?></td>
                <td><?php echo $title?></td>
                <td><?php echo $office?></td>

                <td><?php echo $registeredby?></td>
                <td><?php echo $registereddate?></td>
             
                <?php if ($submitteddate1 == '0000-00-00'): ?>
                  <?php if ($username1 == 'itdummy1' || $username1 == '' || $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno'):?>
                  <td></td>
                  <?php else: ?>
                  <?php if ($status!='cancelled'):?> 
                          <?php if ($office==$DIVISION_M):?> 
                          <td><a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to submit this RO and ROO?');" href='ro_submit.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Submit">Submit</a></td>
                          <?php else: ?>
                            <td></td>
                          <?php endif ?> 
                    <?php else: ?>
                  <td></td>
                  <?php endif ?>
                  <?php endif ?>

        
                  <?php else: ?>
                  <td><?php echo $submitteddate .'<br>'.$submittedby.''?></td>
                  <?php endif ?>

                    <!-- receive -->
                    <?php if ($receiveddate1 == '0000-00-00' && $submitteddate1!='0000-00-00'): ?>
                          <?php if ($username1 == 'itdummy1' || $username1 == 'cvferrer' || $username1 == 'magonzales' || $username1 == 'jbaco' || $username1 == 'gpvillanueva'|| $username1 == 'hpsolis'|| $username1 == 'rmsaturno'):?>
                              <?php if ($status=='cancelled'):?>
                              <td></td>
                              <?php else: ?>
                                <td><a class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to receive this Ro and ROO?');" href='ro_receive.php?id=<?php echo $id;?>&now=<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>&user=<?php echo $username1;?>'title="Receive">Receive</a></td>
                              <?php endif ?>
                          <?php else: ?>
                          <td></td>
                          <?php endif ?> 
                        <?php else: ?>
                         
                        <td>
                            
                          <?php if ($receiveddate1 == '0000-00-00'): ?>
                          <!-- //no dates -->
                          <?php else: ?>
                            <?php echo $receiveddate .'<br>'.$receivedby.''?>
                          <?php endif ?>

                        </td>
                         
                          <?php endif ?>
                  <!-- receive -->

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
                           <?php if ($submitteddate1 == 0000-00-00): ?>

                            <?php if ($status=='cancelled'):?>
                               

                              
                               <label style="color:red">Cancelled</label> <?php echo $cancelleddate.'&nbsp;'.$cancelledby.'<br>'.'Reason: '.$reason ?>

                              <?php else: ?>
                           
                            
                              <?php if ($office ==  $DIVISION_M ):?>
                           


                                  <a name="edit" onclick="myFunction(this)" data-office = "<?php echo $office;?>" data-id="<?php echo $id;?>"  data-registeredby = "<?php echo $registeredby;?>" data-registereddate = "<?php echo $registereddate;?>" data-title = "<?php echo $title;?>" data-issuanceno = "<?php echo $issuanceno;?>" data-issuancedate = "<?php echo $issuancedate11;?>"  data-category = "<?php echo $category;?>"   value="" id="edit"  data-toggle="modal" data-target="#edit_data_Modal" title="Edit" class = "btn btn-primary btn-xs" > <i class=''></i> <i class='fa'>&#xf044;</i> Edit</a> |

                              <!-- <a onclick="return confirm('Are you sure you want to delete this Regional Order/Regional Office Order?');" name="del"  href="ro_delete.php?id=<?php echo $id; ?>&issuance=<?php echo $issuance_no?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a> -->
                              <a name="Cancel" value="" id="Cancel" onclick="myFunction1(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="#cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 

                           <?php else :?>
                                       
                          
                        
                           <?php endif?>



                          <?php endif ?>
                          
                      <?php else :?>

                          <?php if ($status=='cancelled'):?>
                            
                               <label style="color:red">Cancelled</label> <?php echo $cancelleddate.'&nbsp;'.$cancelledby.'<br>'.'Reason: '.$reason ?>

                              <?php else: ?>
                           
                            
                              <?php if ($office ==  $DIVISION_M ):?>
                           

                              <a name="Cancel" value="" id="Cancel" onclick="myFunction1(this)" data-idtomodal="<?php echo $id;?>" data-toggle="modal" data-target="#cancel_data_Modal" title="cancel" class = "btn btn-warning btn-xs" > <i class='fa fa-fw fa-close'></i> Cancel</a> 

                           <?php else :?>
                                       
                          
                        
                           <?php endif?>


                           
                          <?php endif ?>

                      <?php endif ?>



                       


                          



                 
        
                </td>
          
                </tr>
            
            <?php }?>
        </table>
                
                </div>
      </div>
      </div>
      
   

</body>
</html>


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



<!-- //Setting ID -->

<script>
function myFunction1(idget1) {

var idtomodal1 = idget1.getAttribute("data-idtomodal");
var id1 = $("input[name='id1']");
id1.val(idtomodal1);




}
</script>
<!-- //Setting ID -->

<!--cancel modals -->

<div id="cancel_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Regional Order and Regional Office Order</h4>
            </div>
            <div class="modal-body">
              <form method="POST" action="ro_cancel.php" >
              
        
              <div class="addmodal" >
             



              <table class="table"> 
              <tr>
              <label>Reason</label>
              <input required type="text" name="reason" id="reason" class="form-control" />
                                  
              <br>
              
              
              <button type="submit" name="cancel" class="btn btn-warning pull-right">Cancel</button>


              <input  hidden type="text" name="id1" id="id1" value="" class=""/>
              <br>
              <input hidden  type="text" name="user" id="user" value="<?php echo $username1?>" class=""/>
              <br>
              <input hidden  type="text" name="now" id="now" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
              </tr>
              </table>
                
              
              
            
                </div>
           
                </form>
          </div>
        </div>

      
    
    </div>

    </div>
 

          
              
 
           
        <!-- cancel modals -->





<!--Add modals -->

<div id="add_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Add Regional Order and Regional Office Order</b></h4>
            </div>
            <div class="modal-body">
              <form method="POST" action="ro_create.php" >
              
        
              <div class="addmodal" >
             



              <table class="table"> 


              <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">

                 
                      <select required class="form-control select2" style="width: 100%;" name="category" id="category" > 
                      <option value="">Select Category</option>
                      <option value="Regional Order">Regional Order</option>
                      <option value="Regional Office Order">Regional Office Order</option>
                     
                      </select>
                  
                      </select>
                    
                    </td>
                                </tr>
                    <tr>  
                        <td class="col-md-2"><b>Issuance No<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">
                            <input required readonly value=""  class="form-control" type="text" class="" style="height: 35px;" id="issuanceno" name="issuanceno" placeholder="" name="issuances" >
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
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="registereddate" id="registereddate" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" ></td>
                                </tr>


            </table>
                 
           
            <button type="submit" name="Add"  id="Add" onclick="cat()" class="btn btn-success pull-right">Save</button>
            <input hidden   value=""   type="text"  class="" style="height: 35px;" id="rocount" placeholder="" name="rocount">

                
                  <br>
              <br>
              
              
            
                </div>
           
                </form>
          </div>
        </div>

      
    
    </div>

    </div>
 

          
              
 
           
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
                    var category1 = idget.getAttribute("data-category");
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
                    var category = $("input[name='category1']");

                  /*   if(category1=='Regional Order'){
                      document.getElementById("category1").selectedIndex = "0";
                      $("#category1").attr( "disabled", "disabled" );

                    }
                    else{
                      document.getElementById("category1").selectedIndex = "1";
                      $("#category1").attr( "disabled", "readonly" );
                    } */
                   
                    
                    //setting values to input
                    id1.val(idmodal);
                    category.val(category1);
                    issuanceno.val(issuanceno1);
                    issuancedate.val(issuancedate1);
                    title.val(title1);
                    office.val(office1);
                    registeredby.val(registeredby1);
                    registereddate.val(registereddate1);
                  }

                

                  </script>


              <form method="POST" id="" action="ro_update.php" >
              
        
              <div class="" >
             


              <table class="table"> 


<tr>
          <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
        <td class="col-md-5">
        <input required readonly value=""  class="form-control" type="text" class="" style="height: 35px;" id="category1" name="category1" placeholder=""  >
      <!--   <select class="form-control select 2 " style="width: 100%;" name="category1" id="category1" >

        <option value="Regional Order">Regional Order</option>
        <option value="Regional Office Order">Regional Office Order</option>
       
        </select> --></td>
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
              <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="registereddate1" id="registereddate1" value = "" ></td>
                  </tr>


                    </table>
                 
          
            <button type="submit" name="edit" class="btn btn-success pull-right">Save Changes</button>
            <input hidden   value="<?php echo $id;?>"   type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">

          
                  <br>
              <br>
              

                </div>
           
                </form>
          </div>
        </div>

    </div>

    </div>
        <!-- Edit modals -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- Select on change -->

<script>
$(document).ready(function(){
  $("#category").change(function (){


    cat = document.getElementById("category").value;

   
    if(cat=='Regional Order'){
   
        $.ajax({
        method:'POST',
        url:"ro_count.php?",
        data: {cat:cat},
        success : function(data) {
        var issuanceno = $("input[name='issuanceno']"); 
        var rocount = $("input[name='rocount']");
        if(data<9){
          var ro = '2020-00'+ data;
        }
        else if(data<99){
          var ro = '2020-0'+ data;

        }
        else{
          var ro = '2020-'+data;
        }
      
        issuanceno.val(ro);
        rocount.val(data);
      
        }
        });
    }
    else if(cat=='Regional Office Order'){
        $.ajax({
        method:'POST',
        url:"roo_count.php?",
        data: {cat:cat},
        success : function(data) {
        var issuanceno = $("input[name='issuanceno']"); 
        var rocount = $("input[name='rocount']");
        if(data<9){
        var roo = '2020-00'+ data;
        }
        else if(data<99){
        var roo = '2020-0'+ data;

        }
        else{
        var roo = '2020-'+data;
        }

        issuanceno.val(roo);
        rocount.val(data);
        //alert(data);
        }
        });
    }

    else{
      var issuanceno = $("input[name='issuanceno']");
      var rocount = $("input[name='rocount']");
      issuanceno.val('');
    
      rocount.val('');
    }
   
    //alert(cat);

  });
});
</script>


<!-- Select on change -->


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
