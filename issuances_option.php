
<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

 
?>


<?php


if(isset($_POST['submit'])){
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
//$office = $_POST['office'];
//$file = $_POST['file'];
$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if(empty($_FILES['file']['name'])  ){

  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached File cannot be empty. </p> </div></div>  '; 


}
else{

  if(empty($_POST['todiv'])){

    echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Concerned office cannot be empty. </p> </div></div> '; 
  }else{

    $counted = count($_POST['todiv']);
    
    for ($i=0; $i < $counted ; $i++)
    { 
  
        
        $insertofficerespo = "INSERT INTO issuances_office_responsible (issuance_id,office_responsible) values ( ?,?)";
        $insertofficeresponsible = $conn->prepare($insertofficerespo);
        $insertofficeresponsible->bind_param("ss",$issuances,$_POST['todiv'][$i]);
        $insertofficeresponsible->execute();
    
  
    }

 $query = mysqli_query($conn,"INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')");

 

  }
}

mysqli_close($conn);

if($query){

    echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully added. </p> </div></div>  '; 
   /*  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../CreateIssuances.php';
    </SCRIPT>");  */

}
else{

  
  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
   /*  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='../CreateIssuances.php';
    </SCRIPT>"); */
}

}



?>

<!DOCTYPE html>

<html>






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


<style>
  
 
  .office-responsible{
   
    text-align:left;
  }

  #checkboxP{
   
   text-align:left;
 }

  
  
    </style>




    
       
        <div class="box">
          <div class="box-body">
      
            <h1 align="">Add Issuances</h1>
         
        <br>
      <li class="btn btn-success"><a href="issuances.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

        <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
        <table class="table"> 
                    <tr>
                        <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
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
                            <input required type="text" class="form-control" style="height: 35px;" name="dateissued" id="datepicker1" value = "<?php echo date('m/d/Y') ?>" >
                                    </tr>
                    <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><b>Concerned Office</b></td>
                            <td class="col-md-5"> 
                            
                              
                              <div style="margin-bottom: 20px;" class="form-group offices-container checkbox">
                              <input id="office" name="todiv" autocomplete ="off" type="text" class="form-control" placeholder="Click to Select">
                              <div class="office-responsible well  " style="text-align:linear ;position: absolute;display: none;max-width: 80%;    ">

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

                   
                
                </span></label>
               
                    <?php }else{
                    ?>
              <label><input type="checkbox" style=" text-align:linear; " class="chkGrpSD3 divs<?php echo $i;?>" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>" 
              <?php if(!empty($_POST['todiv'])) {if (in_array($k[''], $_POST['todiv'])) echo "checked='checked'" ;}else{echo "";} ?> />
              <span>
                <?php echo $k['DIVISION_M'];?>
              </span></label>
              
                    <?php }
                		}

                     ?>
                           </fieldset>

                         <?php  }
                         // print "</div>";
                          ?>
                         
                          

                  </div>
                  </div>
                          
                                </tr>
                    <tr>
                        <td class="col-md-2"><label>Attached File <span style = "color:red;">*</span></label> </td>
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
                            <input readonly value="<?php echo $DIVISION_M;?>" id="postedby" name="postedby" autocomplete ="off" type="text" class="form-control" placeholder="">
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate" id="posteddate" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('Y-m-d') ?>" ></td>
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
	    var delimiter = ",";
	    var text = $("input[id='todiv']");
	    var str = "";

	   $('.'+getcheckboxes).prop('checked',this.checked);


		});

			$(":checkbox").click(function () {
			    var delimiter = ",";
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


</body>
</html>
