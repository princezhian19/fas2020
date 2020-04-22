
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


if(isset($_POST['submit'])){


    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
        
    
        if(isset($filename)){
            if(!empty($filename)){
    
                $location = "files/";
                if(move_uploaded_file($tempname, $location.$filename)){
    
                   
    
                        //echo 'File Uploaded!';
                    
                }
               
            }
            
            
    
        }
    
$id = $_POST['getid'];
$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued1 = $_POST['dateissued'];

$dateissued = date('Y-m-d', strtotime($dateissued1));
$title = $_POST['title'];

$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];

$office = $_POST['office'];

$getfile = $_POST['getfile'];
//echo $getfile;

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



if(empty($_FILES['file']['name'])){

  //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached file cannot be empty. </p> </div></div>  '; 

  $query = mysqli_query($conn,"UPDATE downloads set title='$title',file='$getfile',category='$category',dateposted='$posteddate',postedby='$username1',url='$url',office='$office' where download_id ='$id'");
}
else
{
 $query = mysqli_query($conn,"UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$username1',url='$url',office='$office' where download_id ='$id'");
}

// echo "UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$username1',url='$url' where download_id ='$id'";
// exit();

mysqli_close($conn);

if($query){

  echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
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



<?php


$getid = $_GET['id'];
$option = $_GET['option'];
//echo $option;
$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
$view_query = mysqli_query($conn, "SELECT * from downloads where download_id = '$getid'");

    while ($row = mysqli_fetch_assoc($view_query)) {
        

        $id = $row['download_id'];
        $category = $row['category'];
      
       

        
        $title = $row['title'];
       
        $file = $row['file'];
        $url = $row['url'];
        $postedby = $row['postedby'];
        $posteddate = $row['dateposted'];






        
    }
    $container = "";
    //$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
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
      
            <h1 align="">Edit Databank</h1>
         
        <br>
      <li class="btn btn-success"><a href="databank.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>

        <div class="class" >

        <form method="POST" action='' enctype="multipart/form-data" >
       
        <input value="<?php echo $id;?>" hidden  type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">

        <table class="table"> 
                    <tr>
                    <td class="col-md-2"><b>Category<span style = "color:red;">*</span></b></td>
                    <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
                      <option value="21">Province ISO Forms</option>
                      <option value="20">Region ISO Forms</option>
                      <option value="19">ALL ISO Forms</option>
                    
                      </select>
                    </td>
                                </tr>
                  
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required value="<?php echo $title;?>"  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>
                 
                    <tr>
                        <td class="col-md-2"><label>Attached File</label> </td>
                            <td class="col-md-5"> <input value="<?php echo $file;?>" id="issuances_attachment" type="file" name="file"/>
                            <?php
                                              
                                              // /echo "Current File: ".$file;
                                              //echo $option;
                                              if (!empty($option) && $option == 'edit') {
                                                echo  'Current file: <a name="getfile" href="files/'. $file.'" target="_blank">'.$file.'</a> <input hidden id="" type="Text" value="'.$file.'" name="getfile"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/> Allowed file: *.pdf
                                                <br>
                                                Max allowed size: 5mb';
                                           
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
                            <input id="url" value="<?php echo $url;?>" name="url" autocomplete ="off" type="text" class="form-control" placeholder="">
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

                    <tr>
                        <td class="col-md-2"><b>Posted Date</b></td>
                            <td class="col-md-5"><input readonly type="text" class="form-control" style="height: 35px;" name="posteddate" id="posteddate" value = "<?php echo $posteddate; ?>" ></td>
                                </tr>


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
                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave">

                <br>
              <br>
                </div>
              </form>
                
          </div>
        </div>

      
    
    </div>

  
    <br>
    <br>

    
    </div>
    
  </form>
   
  </div>

    </section>
  </div>
 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <!-- TinyMCE -->
 <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
   <!--  <script type="text/javascript">
        // O2k7 skin (silver)
        tinyMCE.init({
            // General options
            mode : "exact",
            elements : "tinyeditor",
            theme : "advanced",
            skin : "o2k7",
            skin_variant : "silver",
            plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
    
            // Theme options
            theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true
        });
    </script> -->
    <!-- /TinyMCE -->

<!-- 	<script type="text/javascript" src="js/zebra_datepicker.js"></script>    
	<link rel="stylesheet" href="css/zebra_datepicker_metallic.css" type="text/css">      
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.0" media="screen" /> -->
        
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
	    var text = $("input[name='todiv']");
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
