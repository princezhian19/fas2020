
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
//require_once('_includes/dbaseCon.php');


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
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Dashboard</h1>
              <strong>Monitoring of PRs</strong>
              <form method="POST" action='@Functions/issuancescreate.php' enctype="multipart/form-data" >
                <table class="table"> 
                    <tr>
                      <td class="col-md-2">Category<span style = "color:red;">*</span></td>
                      <td class="col-md-5">
                      <select class="form-control " style="width: 100%;" name="category" id="category" > 
                      <option value="11">Department Memorandum Circular</option>
                      <option value="12">Department Order</option>
                      <option value="14">Regional Memorandum Circular</option>
                      <option value="15">Regional Order</option>
                      <option value="20">Regional Office Order</option>
                      <option value="17">Executive Order</option>
                      <option value="18">Joint Memorandum Circular</option>
                      </select>
                      </td>
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
                            <input required type="text" class="form-control" style="height: 35px;" name="dateissued" id="datepicker1" value = "<?php if (isset($_POST["date_issued"])) echo $_POST["date_issued"]; else echo date('Y-m-d') ?>" >
                                    </tr>
                    <tr>
                        <td class="col-md-2"><b>Title/Subject<span style = "color:red;">*</span></b></td>
                            <td class="col-md-5">  <input required  type="text"  class="form-control" style="height: 35px;" id="title" placeholder="" name="title"></td>
                                </tr>
                    <tr>
                                      <td class="col-md-2">Concerned Office</td>
                                          <td class="col-md-5"> 
                                            <!-- <input id="offices" name="office" autocomplete ="off" type="text" class="form-control" placeholder=""></td> -->

                                            <div style="margin-bottom: 20px;" class="form-group offices-container">
                                            <input id="office" name="todiv" autocomplete ="off" type="text" class="form-control" placeholder="Click to Select">
                                            <div class="office-responsible" style="position: absolute;display: none;width: 30%; background-color:lightgray">

                                        <?php
                                        $counter = 0; 

                                        $get_issuance_no = "SELECT id,issuance_no from issuances";
                                        $issuance_no_issuances = getData($conn,$get_issuance_no);

                              

                                        $query_responsible_office = "SELECT division_m,b.issuance_id, issuance_no, `status`, `subject`, summary, keywords, b.office_responsible, pdf_file, dateposted, postedby, type, category FROM issuances a
                                            right join issuances_office_responsible b on a.issuance_no = b.issuance_id
                                                left join tblpersonneldivision c on c.division_n =b.office_responsible";
                                        $queryoffices = "SELECT b.issuance_id, issuance_no, `status`, `subject`, summary, keywords, b.office_responsible, pdf_file, dateposted, postedby, type, category FROM issuances a
                                            right join issuances_office_responsible b on a.issuance_no = b.issuance_id";	

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
                                        <fieldset class="div">

                                          <legend><?php echo $getgroup[$i]['GROUP_M'];?><input type="checkbox" name="divs" class="divs<?php echo $i;?>"></legend>
                                        <?php
                                        $get_options = "SELECT * FROM tblpersonneldivision as a left join tbl_groupings as b on b.GROUP_N=a.GROUP_N WHERE a.GROUP_N=".$i."";
                                        $getoptions = getData($conn,$get_options);
                                        $getcount = count($getoptions);
                                        foreach ($getoptions as $k) {
                                          
                                        
                                      if ( $counter % 3 ==0) { 
                                      print "<div class='rows3'>\n";
                                      print "</div>";

                                          ?>
                            
                                      <?php
                                        }
                                        $counter++;

                                        if (!empty($_GET['option']) && ($_GET['option'] == 'edit')) {
                                    

                                          //we check if id is valid
                                          if (empty($issuance_no_issuances)) {
                                            //header("Location: http://www.loop.calabarzon.dilg.gov.ph/issuances_option.php");
                                          }
                                          $query_responsible_office_division = "SELECT division_n,division_m,b.issuance_id, issuance_no, `status`, `subject`, summary, keywords, b.office_responsible, pdf_file, dateposted, postedby, type, category FROM issuances a
                                              right join issuances_office_responsible b on a.issuance_no = b.issuance_id
                                                left join tblpersonneldivision c on c.division_n =b.office_responsible where b.issuance_id= '".$issuance_no_issuances[0]['issuance_no']."'";

                                              $result_responsible_office = getData($conn,$query_responsible_office_division);
                                              $rro = [];
                                              foreach ($result_responsible_office as $key) {
                                                  $rro[]= $key['division_n'];
                                              }
                                        ?>

                                  
                              <label><input type="checkbox" class="chkGrpSD3 divs<?php echo $i;?>" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>"
                              <?php if(!empty($_POST['todiv'])) {if (in_array($k['DIVISION_N'], $_POST['todiv'])) echo "checked='checked'" ;}
                              else{ if(in_array($k['DIVISION_N'], $rro)): echo "checked='checked'";endif;} ?>/>
                              <span>
                                <?php echo $k['DIVISION_M'];?>
                              </span></label>
                                  
                                  <?php }else{
                                  ?>
                            <label><input type="checkbox" class="chkGrpSD3 divs<?php echo $i;?>" name="todiv[]" value="<?php echo $k['DIVISION_M'];?>" 
                            <?php if(!empty($_POST['todiv'])) {if (in_array($k['DIVISION_N'], $_POST['todiv'])) echo "checked='checked'" ;}else{echo "";} ?> />
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
                                        <td class="col-md-2"><label>Attached File</label> </td>
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
        </div>
      </div>
    </div>
  </div>
</div>

    




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

