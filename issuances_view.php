
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

            <script>
            <style>
              
            </style>
            </script>
<?php


$getid = $_GET['id'];
$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
$view_query = mysqli_query($conn, "SELECT * from issuances where id = '$getid'");

    while ($row = mysqli_fetch_assoc($view_query)) {
        

        $id = $row['id'];
        $category = $row['category'];
        $issuances = $row['issuance_no'];
        $dateissued = $row['date_issued'];
        $title = $row['subject'];
        $office = $row['office_responsible'];
        $file = $row['pdf_file'];
        $url = $row['url'];
        $postedby = $row['postedby'];
        $posteddate = $row['dateposted'];
        
    }

    $path = "files/".$file;

    $view_query1 = mysqli_query($conn, "SELECT * from issuances_category where id = '$category'");
    $row1 = mysqli_fetch_array($view_query1);
    $cat =  $row1['name'];

    //echo $cat;
   

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
        
            <h1 align="">View Issuances</h1>

            
        <br>
    

      <li class="btn btn-success"><a href="issuances.php" style="color:white;text-decoration: none;">Back</a></li>
    

      <br>
      <br>

        <div class="">

        <table class="table"> 
                    <tr>
                        <td class="col-md-2">Category</td>
                    <td class="col-md-5">
                        <?php echo $cat?>
                    </td>
                    </tr>
                    <tr>
                        <td class="col-md-2">Date Posted</td>
                            <td class="col-md-5"><?php echo $posteddate?></td>
                  
                    <tr>
                        <td class="col-md-2">Date Issued</td>
                            <td class="col-md-5">
                           <?php echo $dateissued;?>
                                    </tr>
                    <tr>

                    </tr>
                    <tr>  
                        <td class="col-md-2">Issuance No<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                           <?php echo $issuances;?>
                                    </td>
                                        </tr>
                        <td class="col-md-2">Uploading Details<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
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
                            
                             $fullName =  $DIVISION_M.'-'.$username;
                             //echo $fullName;
                            
                            ?>     
                            <?php echo $fullName;?></td>
                                </tr>
                    
                  
                </table>

        <embed src = "<?php echo $path;?>" type="application/pdf" width="100%" height="1000px" />
      

        


                
                  <br>
              <br>
                <!-- <input type="submit" name="submit" class="btn btn-primary pull-left" value="Update Data" id="butsave"> -->

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


<script type="text/javascript">
		$(document).ready(function() {

			var x = 1;
			$('#offices').click(function(e){
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
	    var text = $("input[name='po']");
	    var str = "";

	   $('.'+getcheckboxes).prop('checked',this.checked);


		});

/*			$(":checkbox").click(function () {
			    var delimiter = ";";
			    var text = $("input[name='po']");
			    var str = "";
			    
			    // for each checked checkbox, add the checkbox value and delimiter to the textbox
			    $(":checked").each(function () {
			        str += $(this).val() + delimiter;
			    });
			    
			    // set the value of the textbox
			    text.val(str);
			});*/



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


			$('input.date').Zebra_DatePicker({
				offset:[6,216]
			});	
			$('input.dateposted').Zebra_DatePicker({
				offset:[6,216]
			});	
			
			$(".fileBrowser").fancybox({		
				'maxWidth'			: 800,
				'maxHeight'			: 600,
				'fitToView'			: false,
				'width'				: '70%',
				'height'			: '70%',
				'autoSize'			: false,			
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'							
			});	
			
			$(".popup").fancybox({		
				'maxWidth'			: 800,
				'maxHeight'			: 600,
				'fitToView'			: false,
				'width'				: '70%',
				'height'			: '70%',
				'autoSize'			: false,			
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe',
				'afterClose'		: function() { location.reload();}								
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
                window.location = "<?php echo $_SERVER['PHP_SELF']; ?>?option=del&id="+id;
            }
        }	
		function copyToClipboard(text) {
		  window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
		}					
    </script>  
<script src="dist/js/demo.js">
</script>
<!-- <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->

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
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
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


<script>
$(document).ready(function(){
  $("#result").click(function(){
    $("#main").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result1").click(function(){
    $("#main1").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result2").click(function(){
    $("#main2").hide();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#result3").click(function(){
    $("#main3").hide();
  });
});
</script>


<script>
$(document).ready(function(){
  $("#result4").click(function(){
    $("#main4").hide();
  });
});
</script>


</body>
</html>
