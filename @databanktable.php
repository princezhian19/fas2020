
<?php




if(isset($_POST['Add'])){
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

    $username1 = $_SESSION['username'];
    
  
$filename = $_FILES['file']['name'];
$tempname = $_FILES['file']['tmp_name'];
    

    if(isset($filename)){
        if(!empty($_FILES['file']['name'])){

            $location = "files/";

                 
            
            if(move_uploaded_file($tempname, $location.$filename)){

               

                    //echo 'File Uploaded!';
                
            }
           
        }
        
        

    }

   

$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued1 = $_POST['dateissued'];
$dateissued = date('Y-m-d', strtotime($dateissued1));
$title = $_POST['title'];

$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];
$office = $_POST['office'];


$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if(empty($_FILES['file']['name'])){

  echo '<div class="addmodal"><div class="" style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached file cannot be empty. </p> </div></div>  '; 
/*  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Attached file cannot be empty.!')
  </SCRIPT>"); */

}
else{
  $query = mysqli_query($conn,"INSERT INTO downloads (title,file,category,dateposted,postedby,url,office) 
  VALUES ('$title','$filename','$category','$posteddate','$username1','$url','$office')");

if($query){

  // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Databank has been successfully added. </p> </div></div>  '; 
   echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.alert(' Databank has been successfully added.')
   window.location.href='';
   </SCRIPT>"); 
 
 }
 else{
 
 
 echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
  /*  echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.alert('Error!')
   window.location.href='../CreateIssuances.php';
   </SCRIPT>"); */
 }
 

}

 /* echo "INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')";
 exit(); */

/*  echo "INSERT INTO downloads (title,file,category,dateposted,postedby,url) VALUES ('$title','$filename','$category','$posteddate','$username1','$url')";
 exit(); */


mysqli_close($conn);



}



?>






<?php
include('db.class.php'); // call db.class.php
?>


<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
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


<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>

</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Databank</h1>
          
          <br>
        
          <div class=""  style="overflow-x:auto;">

          <!-- onclick="myFunction(this)" data-idtomodal="<?php echo $id;?>" -->
          <a name="Cancel" value="" id="Cancel"  data-toggle="modal" data-target="#add_data_Modal" title="Add" class = "btn btn-success" > <i class=''></i> Add</a> 
         
          <!--   <li class="btn btn-success"><a href="CreateDatabank.php" style="color:white;text-decoration: none;">Add</a></li> -->
         
              <br>
              <br>
              
            </div>

            <form method="POST" action='' enctype="multipart/form-data" >

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center ">
                 
                  <th width="200">CATEGORY</th>
                  <th width="400">TITLE</th>
                  <th width="100">OFFICE</th>
                  <th width="150">POSTING DETAILS</th>
                  <th width="250">ACTION</th>
                  
                </tr>
                </thead>
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT downloads.office,downloads.file, downloads.download_id ,downloads.category, downloads.title, downloads.dateposted, downloads.postedby, downloads_category.name from downloads left join downloads_category on downloads.category=downloads_category.id order by dateposted desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["download_id"];
                  
                  $name = $row["name"];
                  $file = $row["file"];

                  $title  = $row["title"];
                  $office  = $row["office"];
                
                  $dateposted  = $row["dateposted"];
                   // $date_issued1 = date('F d, Y', strtotime($date1));
                  $postedby = $row["postedby"];
                 $location = "files/".$file;
                 //echo $location;

               ?>

                <tr align = ''>
            
                
              
                <td><?php echo $name?></td>
                <td><?php echo $title?></td>
                <td><?php echo $office?></td>
                <td><?php echo $dateposted."-".$postedby?></td>
                

                <td>
                <?php   
                            $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                            $username = $_SESSION['username'];

                            //echo $username;
                            $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                            $rowdiv = mysqli_fetch_array($select_user);
                            $DIVISION_C = $rowdiv['DIVISION_C'];
                            //echo $DIVISION_C;
                            
                ?>

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

                          <?php if ($office ==  $DIVISION_M ):?>
                          
                          <a  href="<?php echo $location?>" title="View" download="<?php $file?>" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> Download</a> |
                          <a href="UpdateDatabank.php?id=<?php echo $id; ?>&option=edit"  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 
                          <a onclick="return confirm('Are you sure you want to delete this record?');" name="del"  href="@Functions/databankdelete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                          
                          <?php else :?>
                                        
                            <a  href="<?php echo $location?>" title="View" download="<?php $file?>" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> Download</a>
                         
                           <?php endif?>
              
                            
             
         
                </td>
                
               

                </tr>

            
            <?php }?>



             
            </table>
              </form>
                
                </div>
            </div>
                

    </body>

              



</body>
</html>


 <!--Add modals -->

 <div id="add_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Add Databank</b></h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="" enctype="multipart/form-data">
              
            <!--   <label>Reason</label>
              <input required type="text" name="reason" id="reason" class="form-control" />
                                  
              <br> -->
              <div class="addmodal" >
              <div></div>
       
        <table class="table"> 
                    <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
                      <option value="21">Province ISO Forms</option>
                      <option value="20">Region ISO Forms</option>
                      <option value="19">ALL ISO Forms</option>
                    
                      </select></td>
                                </tr>

                                <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>
                   
                 
                       
                    <tr>
                        <td class="col-md-2"><label>Attached File<span style = "color:red;">*</span></label> </td>
                            <td class="col-md-5"> <input id="issuances_attachment" type="file" name="file"/>
                          <?php
							if (!empty($_GET['option']) && $_GET['option']== 'edit') {
							
							if (!empty($file) && (file_exists($directory.$file)))		
							{
								if (fileExtensionType($file) && fileExtensionType($file) == 'document' )
								{
															  
								  echo '<p class="form_details">          
											  <label>&nbsp;</label>
											  Current file: <a href="files/'.$file.'" target="_blank">'.$file.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="deleteFile.php?id='.$id.'&i='.$file.'&d=files&t=issuances" title="Delete File">[x] Delete</a><br/>
											  Allowed file: *.pdf, *.doc,*.docx,*.docm,*.xls,*.xlsx,*.ppt,*.pptx,*.rar,*.zip,*.txt
											  <br>
											  Max allowed size: 5mb
										  </p>';				
								}
							}
							} 
							else
							{
								  echo '<p class="form_details">          
											  <label>&nbsp;</label>
											  Allowed file: *.pdf, *.doc,*.docx,*.docm,*.xls,*.xlsx,*.ppt,*.pptx,*.rar,*.zip,*.txt
											    <br>
											  Max allowed size: 5mb
										  </p>';								
							}	                         
						  ?>
                              
                           <!--  <li class="btn btn-primary"><a href="issuances.php" style="color:white;text-decoration: none;">Choose File</a> --></li><!-- <li class="button btn-primary">Choose File</button> --> <!-- <label>&nbsp&nbspNo file Chosen</label><label class="pull-right"> Allowed file: *.pdf   Max allowed size: 5mb</label></td> -->
                                </tr>


                              
                    <tr>
                        <td class="col-md-2"><b>URL</b></td> 
                            <td class="col-md-5">
                            <input id="url" name="url" autocomplete ="off" type="text" class="form-control" placeholder="">
                                </td>
                                    </tr>
                                    <tr>
                        <td class="col-md-2"><b>Office</b></td>
                            <td class="col-md-5">
                            <!-- <input id="url" name="url" autocomplete ="off" type="text" class="form-control" placeholder=""> -->
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
                            <input readonly value="<?php echo $DIVISION_M;?>" id="office" name="office" autocomplete ="off" type="text" class="form-control" placeholder="">
                                </td>
                                    </tr>

                                    <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate" id="posteddate" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('Y-m-d') ?>" ></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><b>Posted By</b></td>
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
                            <input readonly value="<?php echo $username;?>" id="postedby" name="postedby" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>
                  
                </table>

                
                  <br>
              <br>
               <!--  <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave"> -->
               <button type="submit" name="Add" class="btn btn-success pull-right">Save</button>
                <br>
              <br>
                </div>
           
                
          </div>
        </div>

      
    
    </div>

    
    </div>






              
            


            
             
             
              <br />

              <!-- <input type="submit" name="submit" id="submit" value="Cancel" class="btn btn-warning" /> -->

             
          
              
              </form>
            </div>
            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
            </div>
          </div>
          </div>

          <div id="dataModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Travel Order</h4>
            </div>
            <div class="modal-body" id="employee_detail">
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->

              
            </div>
            </div>
          </div>
          </div>
        <!-- Add modals -->






 <!--Edit modals -->

 <div id="add_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Edit Databank</b></h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="" enctype="multipart/form-data">
              
            <!--   <label>Reason</label>
              <input required type="text" name="reason" id="reason" class="form-control" />
                                  
              <br> -->
              <div class="addmodal" >
           
       





              
            


            
             
             
              <br />

              <!-- <input type="submit" name="submit" id="submit" value="Cancel" class="btn btn-warning" /> -->

             
          
              
              </form>
            </div>
            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
            </div>
          </div>
          </div>

          <div id="dataModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cancel Travel Order</h4>
            </div>
            <div class="modal-body" id="employee_detail">
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->

              
            </div>
            </div>
          </div>
          </div>
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
        // echo (str);
         text.val(str);
         // echo (str);
     });



       $('#submit').click(function(e){
                 if (!$('#offices-hidden').val()) {
                               e.preventDefault();

                     alert('empty');
                 }
                 else{
                     // $("#ms").find('option').attr('selected',true);
                     $('#form1').submit()
                 }
             });


   
     $(".page_link").change(function(){
       var id=$(this).val();
             getProAge(id);		
     });
     function getProAge(page)
     {
       if (page != ''){							
         $.post("issuances-list.php",{ p: page },
         function(data){
           $('.proage').html(data.issuanceslist);				
         }, "json");   
       }
     }				
     
     var oid = $(".page_link").val();
     var cid = $(".proage").val();
     if (oid != '' && cid == '')
     {
             getProAge(oid);
     }										
       
    });	
      function confirmDelete(id, rno) { 
       var msg = "Are you sure you want to delete record no. "+rno+" ?";
           if ( confirm(msg) ) {
               // window.location = "<?php echo $_SERVER['PHP_SELF']; ?>?option=del&id="+id;
           }
       }	
   function copyToClipboard(text) {
     window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
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