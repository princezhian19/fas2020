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
          
          <h1 align="">Issuances</h1>
          
          <br>
        
          <div class=""  style="overflow-x:auto;">
         
            <!-- <li class="btn btn-success"><a href="CreateIssuances.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Add</a></li> -->
        
            <a name="Cancel" value="" id="Cancel"  data-toggle="modal" data-target="#add_data_Modal" title="Add" class = "btn btn-success" > <i class=''></i> Add</a> 
              <br>
              <br>
              
            </div>
            <div class=""  style="overflow-x:auto;">
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">
                   <th width = '10'>TAG</th> 
                  <th width = '250'>CATEGORY</th>
                  <th width = '200'>ISSUANCE NO  </th>
                  <th width = '200'>ISSUANCE DATE  </th>
                  <th width = '500'>TITLE/SUBJECT  </th>
                  <th width = '200'>POSTED BY </th>
                  <th width = '200'>POSTED DATE  </th>

                  <th width = '600'>ACTION<BR><BR></th>
                  
                </tr>
                </thead>

                
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT issuances.url,issuances.pdf_file,issuances.office_responsible,issuances.id,issuances.category, issuances.issuance_no, issuances.date_issued, issuances.subject,issuances.postedby,issuances.dateposted, issuances_category.name from issuances left join issuances_category on issuances.category=issuances_category.id order by issuances.id desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];
                  
                  $name = $row["name"];

                  $issuance_no  = $row["issuance_no"];
                
                  $date_issued1  = $row["date_issued"];
                  $date_issued = date('F d, Y', strtotime($date_issued1));

                  $date_issued11 = date('m/d/Y', strtotime($date_issued1));
                   // $date_issued1 = date('F d, Y', strtotime($date1));
                  $subject = $row["subject"];

                  $office = $row["office_responsible"];
                  $file= $row["pdf_file"];

                  $url= $row["url"];


                  $dateposted1 = $row["dateposted"];

                  $dateposted = date('F d, Y', strtotime($dateposted1));
                  $postedby = $row["postedby"];


                  /* $title  = $row["title"];
                  $office  = $row["office"];
                  $url= $row["url"];
                  $dateposted1  = $row["dateposted"];
                    $dateposted = date('F d, Y', strtotime($dateposted1));
                  $postedby = $row["postedby"];
                  $location = "files/".$file; */
                  //echo $office;
                 

               ?>

                <tr align = ''>

                <?php

                $select_office_responsible = mysqli_query($conn, "SELECT office_responsible from  issuances_office_responsible where office_responsible = '$DIVISION_M' and issuance_id = '$issuance_no'");
                  
                while ($row111 = mysqli_fetch_assoc($select_office_responsible)) {

                  $DIVISION_R= $row111['office_responsible'];
                  //echo $DIVISION_R;



                }
                


               
                //echo $DIVISION_R; 	
                ?>
                
              
                
                    <?php if ($office ==  $DIVISION_R ):?>
                    <td style="background-color:green">YES</td>
                    <?php else :?>
                    <td style="background-color:white"></td>
                    <?php endif?>


                <td><?php echo $name?></td>
                <td><?php echo $issuance_no?></td>
                <td><?php echo $date_issued?></td>
                <td><?php echo $subject?></td>
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

                    $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                    $rowdiv1 = mysqli_fetch_array($select_office);
                    $DIVISION_M = $rowdiv1['DIVISION_M'];
 


                  ?>

                          <?php if ($office ==  $DIVISION_M ):?>
                          <a  href='ViewIssuance.php?division=<?php echo $_SESSION['division'];?>&id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> |
                          <!-- <a href='UpdateIssuances.php?id=<?php echo $id;?>&option=edit&issuance=<?php echo $issuance_no?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> |  -->

                          <a name="edit" onclick="myFunction(this)" data-id="<?php echo $id;?>"  data-postedby = "<?php echo $postedby;?>" data-dateposted = "<?php echo $dateposted;?>" data-url = "<?php echo $url;?>" data-gettitle = "<?php echo $subject;?>" data-issuance_no = "<?php echo $issuance_no;?>" data-date_issued = "<?php echo $date_issued11;?>"  data-cat = "<?php echo $name;?>" data-file="<?php echo $file;?>"  value="" id="edit"  data-toggle="modal" data-target="#edit_data_Modal" title="Edit" class = "btn btn-primary btn-xs" > <i class=''></i> <i class='fa'>&#xf044;</i> Edit</a> |

                          <a onclick="return confirm('Are you sure you want to delete this record?');" name="del"  href="@Functions/issuancesdelete.php?id=<?php echo $id; ?>&issuance=<?php echo $issuance_no?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                            <?php else :?>
                                          
                            <a  href='ViewIssuance.php?division=<?php echo $_SESSION['division'];?>&id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a>
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
              <h4 class="modal-title"><b>Add Issuances</b></h4>
            </div>
            <div class="modal-body">
              <form method="POST" id="insert_form" action="issuances_create1.php" enctype="multipart/form-data">
              
        
              <div class="addmodal" >
             



              <table class="table"> 


              <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
                      <option value="15">Select Category</option>
                      <option value="11">Department Memorandum Circular</option>
                      <option value="12">Department Order</option>
                      <option value="14">Regional Memorandum Circular</option>
                      <option value="15">Regional Order</option>
                      <option value="20">Regional Office Order</option>
                      <option value="17">Executive Order</option>
                      <option value="18">Joint Memorandum Circular</option>
                      </select></td>
                                </tr>
                    <tr>  
                        <td class="col-md-2"><b>Issuance No<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">
                            <input required  class="form-control" type="text" class="" style="height: 35px;" id="issuances" name="issuances" placeholder="" name="issuances" >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Issuance Date<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5"> 
                            <input required type="text" class="form-control" style="height: 35px;" name="dateissued" id="datepicker1" value = ""  autocomplete="off">
                                    </tr>
                    <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>


                                <tr>
                        <td class="col-md-2"><b>Concerned Office</b></td>
                            <td class="col-md-5"> 
                            
                              
                              <div style="margin-bottom: 20px;" class="form-group offices-container checkbox">
                              <input id="office" required name="todiv" autocomplete ="off" type="text" class="form-control" placeholder="Click to Select">
                              <div class="office-responsible well  " style="text-align:linear ;position: absolute;display: none;max-width: 80%;">

                          <?php
                         

                          $get_division ="SELECT * from tblpersonneldivision as a left join tbl_groupings as b on b.GROUP_N=a.GROUP_N";
                                $get_groupings ="SELECT * from tbl_groupings";
                          
                          $getdata = getData($conn,$get_division);
                          $getgroup = getData($conn,$get_groupings);
                          $countgroup = count($getgroup);
                          // print "<div>";
                          for ($i=0; $i < $countgroup; $i++) 
                       
                          {
                          $exploded= explode('', $getgroup[$i]['GROUP_M']);
                          	?>
                           <fieldset class="div " style="margin-top:20px">

                             <legend><?php echo $getgroup[$i]['GROUP_M'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="divs" class="divs<?php echo $i;?>"></legend>
                    
                   

                      <?php

                      $get_options = "SELECT * FROM tblpersonneldivision as a left join tbl_groupings as b on b.GROUP_N=a.GROUP_N WHERE a.GROUP_N=".$i."";
                      $getoptions = getData($conn,$get_options);
                      $getcount = count($getoptions);
                      foreach ($getoptions as $k) {


                      if ( $counter==0) { 
                      print "<div class='rows3 '>";
                     

                      print "</div>";

                      ?>
         
                   <?php
                    }
                    $counter++;

                    if (!empty($_GET['option']) && ($_GET['option'] == 'edit')) {
                 

                    
                     ?>

                   	
                <label><input type="checkbox" class="chkGrpSD3 divs<?php echo $i;?>"  id="checkboxP" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>">
               
                 <?php if(!empty($_POST['todiv'])) {if (in_array($k['DIVISION_N'], $_POST['todiv'])) echo "checked='checked'" ;}
                 else{ if(in_array($k['DIVISION_N'], $rro)): echo "checked='checked'";endif;} ?>/>
                 <span>
                  
                      <?php echo $k['DIVISION_M']; ?>

                   
                
                </span>
              
              </label>
               
                    <?php }else{
                    ?>
              <label>
                <input type="checkbox" style=" text-align:linear; " class="chkGrpSD3 divs<?php echo $i;?>" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>" 
              <?php if(!empty($_POST['todiv'])) {if (in_array($k['DIVISION_N'], $_POST['todiv'])) echo "checked='checked'" ;}else{echo "";} ?> />
              <span>
                <?php echo $k['DIVISION_M'];?>
              </span>
            </label>
              
                    <?php }
                		}

                     ?>
                           </fieldset>

                         <?php  }
                         // print "</div>";
                          ?>
                         
                          

                  </div>
                  </div>
                          
                                
                  </td>
                
                </tr>


                <tr>
                        <td class="col-md-2"><label>Attached File <span style = "color:red;">*</span></label> </td>
                            <td class="col-md-5"> <input required id="issuances_attachment" type="file" name="file"/>
                          <?php
							if (!empty($_GET['option']) && $_GET['option']== 'edit') {
							
							if (!empty($file) && (file_exists($directory.$file)))		
							{
								if (fileExtensionType($file) && fileExtensionType($file) == 'document' )
								{
															  
								  echo '<p class="form_details">          
											  <label>&nbsp;</label>
											  Current file: <a href="files/'.$file.'" target="_blank">'.$file.'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="deleteFile.php?id='.$id.'&i='.$file.'&d=files&t=issuances" title="Delete File">[x] Delete</a><br/>
											  Allowed file: *.pdf
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
											  Allowed file: *.pdf
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
                         


                            <input readonly value="<?php echo $username;?>" id="" name="" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate" id="posteddate" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('F d, Y') ?>" ></td>
                                </tr>


            </table>
                 
            <input readonly hidden  value="<?php echo $DIVISION_M;?>" id="postedby" name="postedby" autocomplete ="off" type="text" class="" placeholder="">
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
              <h4 class="modal-title"><b>Edit Issuances</b></h4>
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

                    var date_issued = idget.getAttribute("data-date_issued");
                    var issuance_no = idget.getAttribute("data-issuance_no");

                  
                    
                    var id1 = $("input[name='getid']");
                    var file1 = $("input[name='getfile1']");

                    //fields
                    var category = $("input[name='category1']");
                    var title = $("input[name='title1']");
                    var dateissued1 = $("input[name='dateissued1']");

                    var url = $("input[name='url1']");
                    var dateposted = $("input[name='posteddate1']");
                    var postedby = $("input[name='postedby1']");
                    var issuances1 = $("input[name='issuances1']");


                   
                   
                    var filePath = "files/"+file;
                    
                    //values
                    id1.val(idmodal);
                    file1.val(file);
                    category.val(cat);
                    title.val(title1);
                    url.val(url1);
                    dateposted.val(dateposted1);
                    postedby.val(postedby1);
                    dateissued1.val(date_issued);
                    issuances1.val(issuance_no);
                   
                     
                     
                  


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


              <form method="POST" id="insert_form" action="issuances_update1.php" enctype="multipart/form-data">
              
        
              <div class="addmodal" >
             



              <table class="table"> 


              <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category1" id="category1" > 
                      <option value="11">Department Memorandum Circular</option>
                      <option value="12">Department Order</option>
                      <option value="14">Regional Memorandum Circular</option>
                      <option value="15">Regional Order</option>
                      <option value="20">Regional Office Order</option>
                      <option value="17">Executive Order</option>
                      <option value="18">Joint Memorandum Circular</option>
                      </select></td>
                                </tr>
                    <tr>  
                        <td class="col-md-2"><b>Issuance No<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">
                            <input required  class="form-control" type="text" class="" style="height: 35px;" id="issuances1" name="issuances1" placeholder="" name="issuances" >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Issuance Date<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5"> 
                            <input required type="text" class="form-control" style="height: 35px;" name="dateissued1" id="" value = "" >
                                    </tr>
                    <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title1" placeholder="" name="title1"></td>
                                </tr>


                                <tr>
                        <td class="col-md-2"><b>Concerned Office</b></td>
                            <td class="col-md-5"> 
                            
                              
                              <div style="margin-bottom: 20px;" class="form-group offices-container checkbox">
                              <input id="office1" required name="todiv1" autocomplete ="off" type="text" class="form-control" placeholder="Click to Select">
                              <div class="office-responsible1 well  " style="text-align:linear ;position: absolute;display: none;max-width: 80%;">

                          <?php
                         

                          $get_division ="SELECT * from tblpersonneldivision as a left join tbl_groupings as b on b.GROUP_N=a.GROUP_N";
                                $get_groupings ="SELECT * from tbl_groupings";
                          
                          $getdata = getData($conn,$get_division);
                          $getgroup = getData($conn,$get_groupings);
                          $countgroup = count($getgroup);
                          // print "<div>";
                          for ($i=0; $i < $countgroup; $i++) 
                       
                          {
                          $exploded= explode('', $getgroup[$i]['GROUP_M']);
                          	?>
                           <fieldset class="div " style="margin-top:20px">

                             <legend><?php echo $getgroup[$i]['GROUP_M'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="divs" class="divs<?php echo $i;?>"></legend>
                    
                   

                      <?php

                      $get_options = "SELECT * FROM tblpersonneldivision as a left join tbl_groupings as b on b.GROUP_N=a.GROUP_N WHERE a.GROUP_N=".$i."";
                      $getoptions = getData($conn,$get_options);
                      $getcount = count($getoptions);
                      foreach ($getoptions as $k) {


                      if ( $counter==0) { 
                      print "<div class='rows3 '>";
                     

                      print "</div>";

                      ?>
         
                   <?php
                    }
                    $counter++;

                    if (!empty($_GET['option']) && ($_GET['option'] == 'edit')) {
                 

                    
                     ?>

                   	
                <label><input type="checkbox" class="chkGrpSD3 divs<?php echo $i;?>"  id="checkboxP" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>">
               
                 <?php if(!empty($_POST['todiv'])) {if (in_array($k['DIVISION_N'], $_POST['todiv'])) echo "checked='checked'" ;}
                 else{ if(in_array($k['DIVISION_N'], $rro)): echo "checked='checked'";endif;} ?>/>
                 <span>
                  
                      <?php echo $k['DIVISION_M']; ?>

                   
                
                </span>
              
              </label>
               
                    <?php }else{
                    ?>
              <label>
                <input type="checkbox" style=" text-align:linear; " class="chkGrpSD3 divs<?php echo $i;?>" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>" 
              <?php if(!empty($_POST['todiv'])) {if (in_array($k[''], $_POST['todiv'])) echo "checked='checked'" ;}else{echo "";} ?> />
              <span>
                <?php echo $k['DIVISION_M'];?>
              </span>
            </label>
              
                    <?php }
                		}

                     ?>
                           </fieldset>

                         <?php  }
                         // print "</div>";
                          ?>
                         
                          

                  </div>
                  </div>
                          
                                
                  </td>
                
                </tr>


                <tr>
                        <td class="col-md-2"><label>Attached File <span style = "color:red;">*</span></label> </td>
                            <td class="col-md-5"> <input  id="issuances_attachment" type="file" name="file1"/>
                            Current file: <a name="getfile1"  id="modal-test" href="#" target="_blank"></a> <input hidden   id="" type="Text" value="" name="getfile1"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <br>
                            Allowed file: *.pdf
											      <br>
											      Max allowed size: 5mb
                                </tr>
                    <tr>
                        <td class="col-md-2"><b>URL</b></td>  
                            <td class="col-md-5">
                            <input id="url1" name="url1" autocomplete ="off" type="text" class="form-control" placeholder="">
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
                         

                         <!-- <input readonly value="<?php echo $username;?>" id="" name="" autocomplete ="off" type="text" class="form-control" placeholder=""> -->
                            <input readonly value="" id="postedby1" name="postedby1" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate1" id="posteddate1" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('m/d/Y') ?>" ></td>
                                </tr>


            </table>
                 
            <input readonly hidden  value="<?php echo $DIVISION_M;?>" id="office_responsible1" name="office_responsible1" autocomplete ="off" type="text" class="" placeholder="">
            <button type="submit" name="edit" class="btn btn-success pull-right">Save Changes</button>
            <input hidden  value="<?php echo $id;?>"   type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">


                
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
          var final1 = final.replace('11;','');
          var final2 = final.replace('11;','');
        
     text.val('');
     text.val(final1);


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
   
     var final1 = str1 .replace('11;11;','');
     //alert(final);
     text1.val('');
     text1.val(final1);
     
     
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>



</script>