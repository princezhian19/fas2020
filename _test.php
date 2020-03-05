<?php
$username = $_SESSION['username'];
require_once('_includes/setting.php');
require_once('_includes/dbaseCon.php');
require_once('_includes/library.php');
require_once('_includes/sql_statements.php');
// require_once('_includes/secure.php');



// exit();
function showUser()
{
 $position_c = '';
  echo '<select class="form-control select2" style="width: 100%;" name="requested_by" id="type" >';
  $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  

  $query = "SELECT * FROM `tblpersonneldivision` LEFT JOIN tblemployee ON tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C WHERE tblpersonneldivision.DIVISION_M LIKE '%".$_SESSION['username']."%' ";
  $result = mysqli_query($link, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
    {
          echo '<option value = '.$row['EMP_N'].'>'.$row['FIRST_M'].' '.$row['MIDDLE_M'].' '.$row['LAST_M'].'</option>';
    }
  echo '</select>';
  // echo '<input type = "text" value = '.$position_c.' />';
  }

?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
  
    .center-text{
        text-align:center;
    }
    .left-text{
        text-align:left;
    }
    .borderless{
         border: none;
    }
    .sizeMax{
        width:100%;
    }
    td.label-text{
        background-color:#B0BEC5;
        padding:5px 5px 5px 5px;
    }
    input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1); /* IE */
  -moz-transform: scale(1); /* FF */
  -webkit-transform: scale(1); /* Safari and Chrome */
  -o-transform: scale(1); /* Opera */
  transform: scale(1);
  padding: 10px;
}
.setDateIcon{
background-image:url(images/cal.gif); 
background-repeat: no-repeat; 
background-position: 90px 5px;
}
.disabletxtarea{
  pointer-events: none;

}
</style>
</head>

<body>        
<!-- <button class="btn btn-lg btn-danger sweet-14" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Danger']);">Danger</button> -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="box-body">      
                    <div>
                        <h1>Technical Assistance Request Form</h1><br>
                    </div>
                    <form method="POST" enctype="multipart/form-data" class="myformStyle" action = "JASPER/sample/sample1.php" >    
                        <input type = "hidden" name = "curuser" value = "" id = "selectedUser" />
                        <table  border = 1 class = "center-text" style = "width:100%;">
                            <tbody>
                                <tr>
                                    <td colspan = 4>ICT TECHNICAL ASSISTANCE REQUEST FORM</span></td>
                                    <td class = "label-text left-text">Control<br>Number.</td>
                                    <td colspan = 2 style = "padding:5px 5px 5px 5px;">
                                    <?php 
                                    $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                                                  $query = "SELECT count(*) as 'count' from tbltechnical_assistance ";
                                                  $result = mysqli_query($link, $query);
                                                  $val = array();
                                                  if($row = mysqli_fetch_array($result))
                                                  {
                                                    $count= $row['count']+1;
                                                    echo '<input style = "text-align:center;" type = "text"  readonly  placeholder = "Control No."  name = "control_no" class = "sizeMax alphanum subtxt" value=2020-0'.$count.' />';

                                                  }
                                      ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Request Date:</td>
                                    <td style = "width:15%;padding:5px 5px 5px 5px;">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name = "request_date" placeholder = "Request Date" class="datePicker1" value="" required placeholder="mm/dd/yyyy">
                                        </div>
                                    </td>
                                    <td style = "width:15%;"class = "label-text">Request Time:</td>
                                    <td style = "width:15%;  padding:5px 5px 5px 5px;"><input style = "text-align:center;" placeholder = "Request Time" type = "text" name = "request_time" class = "sizeMax alphanum subtxt" value ="<?php echo date("H:i A",strtotime(date("h:m A")));?>"/></td>
                                    <td colspan = 4 class = "label-text">HARDWARE INFORMATION</td>
                                </tr>
                                <tr>
                                    <td colspan = 4 class = "label-text">END-USER INFORMATION </td>
                                    <td class = "label-text left-text">Equipment</td>
                                    <td colspan = 3 class = "left-text " style = "padding:5px 5px 5px 5px;"><input  style ="width:100%;" placeholder = "Equipment Type" type = "text" name = "equipment_type" class = "alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Requested By:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;">
                                      <?php echo showUser(); ?>
                                    <td class = "label-text left-text">Brand Model:</td>
                                    <td colspan =3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Brand Model" type = "text" name = "brand_model" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td class = "label-text left-text">Office:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input id = "office" readonly placeholder = "Office" type = "text" name = "office" class = "sizeMax alphanum subtxt" value = "" readonly/></td>
                                    <td class = "label-text left-text">Property No.:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Property No." type = "text" name = "property_no" class = "sizeMax alphanum subtxt" /> </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Position/Designation:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input id = "position" readonly placeholder = "Position/Designation" type = "text" name = "position" class = "sizeMax alphanum subtxt" value = ""  /></td>
                                    <td class = "label-text left-text">Serial No.:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Serial No." type = "text" name = "serial_no" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Contact Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input id = "phone" placeholder = "Contact Number" type = "text" name = "contact_no" class = "sizeMax alphanum subtxt" value = "" /></td>
                                    <td class = "label-text left-text">IP Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "IP Address" type = "text" name = "ip_address" class = "sizeMax alphanum subtxt" value = "" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Email Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input id = "email" placeholder = "Email Address" type = "text" name = "email_address" class = "sizeMax alphanum subtxt" value = "<?php echo $email;?>"/></td>
                                    <td class = "label-text left-text">MAC Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "MAC Address" type = "text" name = "mac_address" class = "sizeMax alphanum subtxt" value = "" /></td>
                                </tr>
                            </tbody>
                        </table><br>
                        <u style = "margin-top:20px;">TYPE OF REQUEST</u>

                        <table style = "margin-top:20px;width:100%;">
                          <tr>
                              <td>
                                  <input type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g1" class = "checkbox_group" value = "DESKTOP/LAPTOP"> <b>DESKTOP/LAPTOP</b><br>
                                  <div style = "margin-left:30px;padding-top:10px;">
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Hardware Error"> Hardware Error<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Software Error"> Software Error<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Computer Assembly"> Computer Assembly<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Parts Replacement"> Parts Replacement<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Virus Scanning"> Virus Scanning
                                  </div>
                              </td> 
                              <td><br>
                                  <input type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g2" class = "checkbox_group" value = "INTERNET CONNECTIVITY"><b>&nbsp;INTERNET CONNECTIVITY</b><br>
                                  <div style = "margin-left:30px;padding-top:10px;">
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "New Connection(Wired or Wireless)"> New Connection(Wired or Wireless)<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "No Internet Connection(Cross or Exclamation)"> No Internet Connection(Cross or Exclamation)<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "Access to Blocked Site:"> Access to Blocked Site:
                                      <input type = "text" name = "site" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                                      Purpose:<input type = "text" name = "purpose" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "Internet for Personal Phone/Tablet/Laptop"> Internet for Personal Phone/Tablet/Laptop<br>
                                      Purpose:<input type = "text" name = "purpose2" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                  </div>
                              </td>  
                              <td style = "width:35%;">
                                  <input type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g3" class = "checkbox_group" value = "SOFTWARE/SYSTEM"> <b>SOFTWARE/SYSTEM</b><br>
                                  <div style = "margin-left:20px;padding-top:10px;">
                                      <input style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Operating System, Office, Anti-Virus"> Operating System, Office, Anti-Virus<br>
                                      <input style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Records Tracking System"> Records Tracking System<br>
                                      <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Google Drive"> Google Drive<br>
                                      <input style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "DILG Portals/Systems"> DILG Portals/Systems<br>
                                      <input style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Other software/s (please specify)"> Other software/s (please specify)
                                      <br><input type = "text" name = "softwares" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                  </div>
                              </td> 
                          </tr>
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <td>
                          <input type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g4" class = "checkbox_group" value = "SOFTWARE/SYSTEM"> <b>PRINTER/SCANNER</b><br>
                          <div style = "margin-left:30px;padding-top:10px;">
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Installation"> Installation<br>
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Troubleshooting"> Troubleshooting<br>
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Sharing/Networking"> Sharing/Networking<br>
                          </div>
                          </td> 
                          <td>
                          <input type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g5" class = "checkbox_group" value ="GOVMAIL" > <b>GOVMAIL</b><br>
                          <div style = "margin-left:30px;padding-top:10px;">
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "New Account"> New Account<br>
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Change Account to"> Change Account to <input type = "text" name = "changeaccount" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Password Reset"> Password Reset<br>
                          </div>
                          </td> 
                          <td>
                          <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_category[]" value = "Others"><b>Others</b><br>
                          <input type = "text" name = "others1" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                          <input type = "text" name = "others2" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                          <input type = "text" name = "others3" value = "" style = "border:none;border-bottom:1px solid black;"/><br>

                          </td> 

                          </tr>
                          </table>
                        <table border = 1 style = "margin-top:20px;width:100%;">
                                                  <tr>
                                                  <td colspan = 4 class = "center-text label-text" style = "width:50%;">END-USER</td>
                                                  <td colspan = 4 class = "center-text label-text">RICTU</td>
                                                  </tr>
                                                  <tr>
                                                  <td colspan = 4>ISSUE/PROBLEM/ERROR DETAILS:</td>
                                                  <td colspan = 4>FINDINGS AND RESOLUTION/RECOMMENDATION</td>
                                                  </tr>


                                                  <tr>
                                                  <td colspan = 4>
                                                  <textarea rows="20" name = "issue" cols="56"  style ="resize:none;width:100%;" >

                                                  </textarea>
                                                  </td>
                                                  <td colspan = 4>
                                                  <textarea rows="20" cols="56" style ="resize:none;width:100%;" name = "status" class = "disabletxtarea">

                                                  </textarea>
                                                  </td>
                                                  </tr>
                                                  <tr>
                                                  <td style = "width:12.5%;">Timeliness</td>
                                                  <td style = "width:12.5%;">
                                                  <select class="form-control " style="width: 100%;" name="timeliness" >
                                                  <option value = "YES">YES</option>
                                                  <option value = "NO">NO</option>
                                                  </select>
                                                  </td>
                                                  <td style = "width:12.5%;text-align:center;">Quality</td>
                                                  <td style = "width:12.5%;text-align:center;">
                                                  <select class="form-control " style="width: 100%;" name="quality" >

                                                  <option value = "5">Outstanding</option>
                                                  <option value = "4">Very-Satisfatory</option>
                                                  <option value = "3">Satisfatory</option>
                                                  <option value = "2">Unsatisfatory</option>
                                                  <option value = "1">Poor</option>
                                                  </select>

                                                  </td>
                                                  <td style = "width:12.5%;">Started Date:</td>
                                                  <td style = "width:12.5%;">
                                                    <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input disabled type="text" name = "started_date" placeholder = "Started Date" class="datePicker1" value="" required>
                                                    </div>
                                                  </td>
                                                  <td style = "width:12.5%;">Completed Date:</td>
                                                  <td style = "width:12.5%;">
                                                  <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input disabled type="text" name = "completed_date" placeholder = "Completed Date" class="datePicker1" value="" required>
                                                    </div>
                                                  </td>
                                                  </tr>
                                                  <tr> 
                                                  <td colspan = 4>
                                                  <!-- Assisted By:
                                                  <select name="assisted_by" class="dropdown size250">
                                                  <option value = "Charles Adrian T. Odi">Charles Adrian T. Odi</option>
                                                  <option value = "Christian Paul V. Ferrer">Christian Paul V. Ferrer</option>
                                                  <option value = "Mark Kim A. Sacluti">Mark Kim A. Sacluti</option>
                                                  </select> -->
                                                  </td>
                                                  <td style = "width:12.5%;">Started Time:</td>
                                                  <td style = "width:12.5%;">
                                                    <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input disabled type="text" name = "started_time" placeholder = "Started Time"  value="" required>
                                                    </div>
                                                  </td>
                                                  <td style = "width:12.5%;">Completed Time:</td>
                                                  <td style = "width:12.5%;">
                                                    <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input disabled type="text" name = "completed_time" placeholder = "Completed Time"  value="" required>
                                                    </div>
                                                  </td>
                                                  </tr>





                        </table><br>

                      <input style ="float:right;" type = "submit" value = "Submit" class="btn btn-primary btn-s sweet-14" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 </body>
</html>


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
  
    $('.select2').on('change', function()
      {
      var value = this.value;
        $.ajax({
            url:"_fetchOfficeInfo.php",
            method:"POST",
            data:{
            id:value
            },
            success:function(data)
            {
              var result = JSON.parse(data);
              $('#selectedUser').val(result[0].currentuser);
              $('#office').val(result[0].office);
              $('#position').val(result[0].position);
              $('#phone').val(result[0].phone);
              $('#email').val(result[0].email);
            }
          });
        });
   
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
    $( ".datePicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});


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
<script type = "text/javascript">
$(function() {
    enable_cb1();
    enable_cb2();
    enable_cb3();
    enable_cb4();
    enable_cb5();
  $("#checkboxgroup_g1").click(enable_cb1);
  $("#checkboxgroup_g2").click(enable_cb2);
  $("#checkboxgroup_g3").click(enable_cb3);
  $("#checkboxgroup_g4").click(enable_cb4);
  $("#checkboxgroup_g5").click(enable_cb5);
});

function enable_cb1() {
  if (this.checked) {
    $(".checkboxgroup_g1").removeAttr("disabled");
  } else {
    $(".checkboxgroup_g1").attr("disabled", true);
  }
}
function enable_cb2() {
  if (this.checked) {
    $(".checkboxgroup_g2").removeAttr("disabled");
  } else {
    $(".checkboxgroup_g2").attr("disabled", true);
  }
}
function enable_cb3() {
  if (this.checked) {
    $(".checkboxgroup_g3").removeAttr("disabled");
  } else {
    $(".checkboxgroup_g3").attr("disabled", true);
  }
}
function enable_cb4() {
  if (this.checked) {
    $(".checkboxgroup_g4").removeAttr("disabled");
  } else {
    $(".checkboxgroup_g4").attr("disabled", true);
  }
}
function enable_cb5() {
  if (this.checked) {
    $(".checkboxgroup_g5").removeAttr("disabled");
  } else {
    $(".checkboxgroup_g5").attr("disabled", true);
  }
}
$('.checkboxgroup_g1').on('change', function() {
    $('.checkboxgroup_g1').not(this).prop('checked', false);  
});
$('.checkboxgroup_g2').on('change', function() {
    $('.checkboxgroup_g2').not(this).prop('checked', false);  
});
$('.checkboxgroup_g3').on('change', function() {
    $('.checkboxgroup_g3').not(this).prop('checked', false);  
});
$('.checkboxgroup_g4').on('change', function() {
    $('.checkboxgroup_g4').not(this).prop('checked', false);  
});
$('.checkboxgroup_g5').on('change', function() {
    $('.checkboxgroup_g5').not(this).prop('checked', false);  
});
$('.checkboxgroup_g6').on('change', function() {
    $('.checkboxgroup_g6').not(this).prop('checked', false);  
});


$('.checkbox_group').on('change', function() {
    $('.checkbox_group').not(this).prop('checked', false);  
});

// DATE PICKER
$(function() {
$( ".datePicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( ".datePicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( ".datePicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

    
});
</script>


