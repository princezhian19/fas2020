<?php
  if($_POST['title']){

    $view_query = mysqli_query($conn, "SELECT downloads.url,downloads.office,downloads.file, downloads.download_id ,downloads.category, downloads.title, downloads.dateposted, downloads.postedby, downloads_category.name from downloads left join downloads_category on downloads.category=downloads_category.id where dowloads.title like '%".$_POST['title']."%' order by downloads.download_id desc");
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

          
          <a name="Cancel" value="" id="Cancel"  data-toggle="modal" data-target="#add_data_Modal" title="Add" class = "btn btn-success" > <i class=''></i> Add</a> 
         
          <!--   <li class="btn btn-success"><a href="CreateDatabank.php" style="color:white;text-decoration: none;">Add</a></li> -->
         
              <br>
              <br>
              
            </div>

            <form method="POST" action=''  >

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <!-- <thead>
                    <tr style="background-color: white;color:blue; text-align:center ">
                 
                  <th width="200">CATEGORY <br><input onkeyup="myFunction()"   type="text"  class="form-control" style="height: 35px; width:100%" id="myInput" placeholder="" name=""> </th>
                  <th width="400">TITLE <br><input onkeyup="titlesearch()"   type="text"  class="form-control" style="height: 35px; width:100%" id="titlesearch" placeholder="" name=""></th>
                  <th width="100">OFFICE<br><input onkeyup="myFunction2()"   type="text"  class="form-control" style="height: 35px; width:100%" id="myInput2" placeholder="" name=""> </th>
                  <th width="150">POSTING DETAILS<br><input onkeyup="myFunction3()"  type="text"  class="form-control" style="height: 35px;" id="myInput3" placeholder="" name=""></th>
                  <th width="250">ACTION<br><br></th>
                  
                </tr>
                </thead> -->


                

                <thead>
                    <tr style="background-color: white;color:blue; text-align:center ">
                 
                  <th width="200">CATEGORY</th>
                  <th width="400">TITLE </th>
                  <th width="100">OFFICE</th>
                  <th width="150">POSTED BY</th>
                  <th width="150">POSTED DATE</th>
                  <th width="250">ACTION<br><br></th>
                  
                </tr>
                </thead>
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            
           
          

            $view_query = mysqli_query($conn, "SELECT downloads.url,downloads.office,downloads.file, downloads.download_id ,downloads.category, downloads.title, downloads.dateposted, downloads.postedby, downloads_category.name from downloads left join downloads_category on downloads.category=downloads_category.id order by downloads.download_id desc");
            
                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["download_id"];
                  
                  $name = $row["name"];
                  $file = $row["file"];

                  $title  = $row["title"];
                  $office  = $row["office"];
                $url= $row["url"];
                  $dateposted1  = $row["dateposted"];
                    $dateposted = date('F d, Y', strtotime($dateposted1));
                  $postedby = $row["postedby"];
                 $location = "files/".$file;
                 //echo $location;

               ?>

                <tr align = ''>
            
                
              
                <td><?php echo $name?></td>
                <td><?php echo $title?></td>
                <td><?php echo $office?></td>
                <td><?php echo $postedby?></td>
                <td><?php echo $dateposted?></td>
                

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
                         <!--  <a href="UpdateDatabank.php?id=<?php echo $id; ?>&option=edit"  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | -->
                          
                          <a name="edit" onclick="myFunction(this)" data-id="<?php echo $id;?>"  data-postedby = "<?php echo $postedby;?>" data-dateposted = "<?php echo $dateposted;?>" data-url = "<?php echo $url;?>" data-gettitle = "<?php echo $title;?>"  data-cat = "<?php echo $name;?>" data-file="<?php echo $file;?>"  value="" id="edit"  data-toggle="modal" data-target="#edit_data_Modal" title="Edit" class = "btn btn-primary btn-xs" > <i class=''></i> <i class='fa'>&#xf044;</i> Edit</a> |
                            
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
              <form method="POST" id="insert_form" action="databank_create1.php" enctype="multipart/form-data">
              
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

                                        <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate" id="posteddate" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('F d, Y') ?>" ></td>
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

 <div id="edit_data_Modal" class="modal fade ">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Edit Databank</b></h4>
            </div>
            <div class="modal-body">
          
                  <script>
                  function myFunction(idget) {

                    var idmodal = idget.getAttribute("data-id");
                    var cat = idget.getAttribute("data-cat");
                    var file = idget.getAttribute("data-file");

                    var title1 = idget.getAttribute("data-gettitle");

                    var url1 = idget.getAttribute("data-url");
                    var dateposted1 = idget.getAttribute("data-dateposted");
                    var postedby1 = idget.getAttribute("data-postedby");
                  
                    
                    var id1 = $("input[name='getid']");
                    var file1 = $("input[name='getfile']");

                    //fields
                    var category = $("input[name='category1']");
                    var title = $("input[name='title1']");

                    var url = $("input[name='url1']");
                    var dateposted = $("input[name='posteddate1']");
                    var postedby = $("input[name='postedby1']");


                   
                   
                    var filePath = "files/"+file;
                    
                    //values
                    id1.val(idmodal);
                    file1.val(file);
                    category.val(cat);
                    title.val(title1);
                    url.val(url1);
                    dateposted.val(dateposted1);
                    postedby.val(postedby1);

                   
                     
                     
                  


                    if(file!=""){
                      document.getElementById('modal-test').innerHTML = file;
                      document.getElementById('modal-test').href = filePath;
                    }
                   else{
                    document.getElementById('modal-test').innerHTML = "";
                    document.getElementById('modal-test').href = "";
                   }
                    
                   
                  }

                

                  </script>

        <form method="POST" action='databank_update1.php' enctype="multipart/form-data" >
       
       

        <table class="table"> 
                    <tr>
                    <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category1" id="category1" > 
                      <option value="21">Province ISO Forms</option>
                      <option value="20">Region ISO Forms</option>
                      <option value="19">ALL ISO Forms</option>
                    
                      </select>
                    </td>
                                </tr>
                  
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required   type="text"  class="form-control" style="height: 35px;" id="title1" placeholder="" name="title1"></td>
                                </tr>
                 
                    <tr>
                        <td class="col-md-2"><label>Attached File</label> </td>
                            <td class="col-md-5"> <input value="<?php echo $file;?>" id="issuances_attachment" type="file" name="file1"/>
                         
                            Current file: <a name="getfile"  id="modal-test" href="#" target="_blank"></a> <input hidden   id="" type="Text" value="" name="getfile"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <br>
                            Allowed file: *.pdf, *.doc,*.docx,*.docm,*.xls,*.xlsx,*.ppt,*.pptx,*.rar,*.zip,*.txt
											      <br>
											      Max allowed size: 5mb

                                            
                              
                           <!--  <li class="btn btn-primary"><a href="issuances.php" style="color:white;text-decoration: none;">Choose File</a> --></li><!-- <li class="button btn-primary">Choose File</button> --> <!-- <label>&nbsp&nbspNo file Chosen</label><label class="pull-right"> Allowed file: *.pdf   Max allowed size: 5mb</label></td> -->
                                </tr>
                    <tr>
                        <td class="col-md-2"><b>URL</b></td>  
                            <td class="col-md-5">
                            <input id="url1" value="<?php echo $url;?>" name="url1" autocomplete ="off" type="text" class="form-control" placeholder="">
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
                            <input readonly value="<?php echo $DIVISION_M;?>" id="office1" name="office1" autocomplete ="off" type="text" class="form-control" placeholder="">
                                </td>
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
                            <input readonly  id="postedby1" name="postedby1" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>


                            <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate1" id="posteddate1" value = "<?php echo $posteddate; ?>" ></td>
                                </tr>
                   
                </table>

                
                  <br>
              <br>
               <!--  <input type="submit" name="edit" class="btn btn-success pull-right" value="Save Changes" id="butsave"> -->

               <button type="submit" name="edit" class="btn btn-success pull-right">Save Changes</button>
                <input hidden  value="<?php echo $id;?>"   type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">
                <br>
              <br>
                </div>
              </form>
                
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
    // $('.select2').select2()

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

