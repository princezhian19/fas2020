<?php


$username = $_SESSION['username'];
require_once('_includes/setting.php');
require_once('_includes/dbaseCon.php');
require_once('_includes/library.php');
require_once('_includes/sql_statements.php');
// require_once('_includes/secure.php');

function fillTableInfo()
{
    include 'connection.php';
    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
    $query = "SELECT EMP_N,FIRST_M,MIDDLE_M, LAST_M, MOBILEPHONE, EMAIL,DIVISION_N, DIVISION_M , POSITION_M FROM tblpersonneldivision 
    INNER JOIN tblemployee on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C 
    INNER JOIN tbldilgposition on tblemployee.POSITION_C = tbldilgposition.POSITION_ID
    where tblemployee.UNAME  = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    $val = array();
    if($row = mysqli_fetch_array($result))
      {
          ?>
                                  <input required type = "hidden" name = "curuser" value = "<?php echo $row['EMP_N'];?>" id = "selectedUser" />

               <table  border = 1 class = "center-text" style = "width:100%;">
                            <tbody>
                                <tr>
                                    <td colspan = 4 class = "label-text"> ONLINE ICT TECHNICAL ASSISTANCE REQUEST FORM</span></td>
                                    <td class = "label-text left-text">Control<br>Number:<span style = "color:red;">*</span></td>
                                    <td colspan = 2 style = "padding:5px 5px 5px 5px;background-color:#CFD8DC;">
                                    <?php echo countCN();?>
                                      </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Request Date:<span style = "color:red;">*</span></td>
                                    <td style = "width:15%;padding:5px 5px 5px 5px;">
                                    <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input required type="text" name = "request_date" placeholder = "Request Date" class="datePicker1" value="" required placeholder="mm/dd/yyyy" >
                                        </div>
                                    </td>
                                    <td style = "width:15%;"class = "label-text">Request Time:<span style = "color:red;">*</span></td>
                                    <td style = "width:15%;  padding:5px 5px 5px 5px;">
                                    <input required style = "text-align:left;" placeholder = "Request Time" type = "text" name = "request_time" class = "sizeMax alphanum subtxt" value ="<?php echo date("h:i:s A");?>"/>
                                    </td>
                                    <!-- date("H:i A",strtotime(date("h:m A"))) -->
                                    <td colspan = 4 class = "label-text">HARDWARE INFORMATION</td>
                                </tr>
                                <tr>
                                    <td colspan = 4 class = "label-text">END-USER INFORMATION </td>
                                    <td class = "label-text left-text">Equipment</td>
                                    <td colspan = 3 class = "left-text " style = "padding:5px 5px 5px 5px;">
                                      <input required  required style ="width:100%;" type = "text" name = "equipment_type" class = "alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Requested By:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;">
                                      <input required type = "hidden"  name="requested_by" value = "<?php $row['EMP_N'];?>" />
                                      <input required type = "text" class = "sizeMax alphanum subtxt" value = "<?php echo $row['FIRST_M'].' '.$row['MIDDLE_M'].' '.$row['LAST_M'].' ';?>" >
                                    <td class = "label-text left-text">Brand Model:</td>
                                    <td colspan =3 style = "  padding:5px 5px 5px 5px;"><input required   type = "text" name = "brand_model" class = "sizeMax alphanum subtxt" value = ""/></td>
                                </tr>
                                <tr>
                                    <td class = "label-text left-text">Office:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required id = "office" placeholder = "Office" type = "text" name = "office" class = "sizeMax alphanum subtxt" value = "<?php echo $row['DIVISION_M'];?>" /></td>
                                    <td class = "label-text left-text">Property Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required type = "text" name = "property_no" class = "sizeMax alphanum subtxt" value = "" /> </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Position/Designation:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required id = "position"  placeholder = "Position/Designation" type = "text" name = "position" class = "sizeMax alphanum subtxt" value = "<?php echo $row['POSITION_M'];?>"  /></td>
                                    <td class = "label-text left-text">Serial Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required   type = "text" name = "serial_no" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Contact Number:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required id = "phone" placeholder = "Contact Number" type = "text" name = "contact_no" class = "sizeMax alphanum subtxt" value = "<?php echo $row['MOBILEPHONE'];?>"  /></td>
                                    <td class = "label-text left-text">IP Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required   type = "text" name = "ip_address" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Email Address:<span style = "color:red;">*</span></td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required id = "email" placeholder = "Email Address" type = "text" name = "email_address" class = "sizeMax alphanum subtxt" value = "<?php echo $row['EMAIL'];?>"/></td>
                                    <td class = "label-text left-text">MAC Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input required type = "text" name = "mac_address" class = "sizeMax alphanum subtxt" value = ""/></td>
                                </tr>
                            </tbody>
                        </table>
          <?php
      }
}

function countCN()
{
                                    include 'connection.php';
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                                                  $query = "SELECT count(*) as 'count' from tbltechnical_assistance ";
                                                  $result = mysqli_query($conn, $query);
                                                  $val = array();
                                                  if($row = mysqli_fetch_array($result))
                                                  {
                                                    $count= $row['count']+1;
                                                    echo '<input required style = "text-align:center;color:red;font-weight:bold;" type = "text"  readonly  placeholder = "Control No."  name = "control_no" class = "sizeMax alphanum subtxt" value=2020-'.$count.' />';

                                                  }
}
function showUser()
{
  $position_c = '';
  echo '<select class="form-control select2" style="width: 100%;" name="requested_by" id="type" >';
  include 'connection.php';
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  
  
  $query = "SELECT * FROM `tblpersonneldivision` 
  LEFT JOIN tblemployee ON tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C 
  WHERE tblemployee.UNAME  = '".$_SESSION['username']."' ";
  $result = mysqli_query($link, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
    {
          echo '<option value = '.$row['EMP_N'].'>'.$row['FIRST_M'].' '.$row['MIDDLE_M'].' '.$row['LAST_M'].'</option>';
    }
  echo '</select>';
  // echo '<input required type = "text" value = '.$position_c.' />';
  }

?>
 
<!DOCTYPE html>
<html>
<head>
  <title></title>
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
                        <h1>ICT Technical Assistance</h1><br>
                    </div>
                    <form method="POST" enctype="multipart/form-data" class="myformStyle" action = "JASPER/sample/sample1.php" >    
                        <?php echo fillTableInfo(); ?>
                     <input required type = "hidden" name = "division" value = "<?php echo $_GET['division'];?>" />
                        <br>
                        <u style = "margin-top:20px;" class = "label-text">TYPE OF REQUEST</u>
                        <table style = "margin-top:20px;width:100%;" >
                          <tr>
                              <td>
                                  <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g1" class = "checkbox_group" value = "DESKTOP/LAPTOP"> <b>DESKTOP/LAPTOP<span style = "color:red;">*</span></b><br>
                                  <div style = "margin-left:30px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Hardware Error"> Hardware Error<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Software Error"> Software Error<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Computer Assembly"> Computer Assembly<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Parts Replacement"> Parts Replacement<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g1" value ="Virus Scanning"> Virus Scanning
                                  </div>
                              </td> 
                              <td><br>
                                  <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g2" class = "checkbox_group" value = "INTERNET CONNECTIVITY"><b>&nbsp;INTERNET CONNECTIVITY<span style = "color:red;">*</span></b><br>
                                  <div style = "margin-left:30px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "New Connection(Wired or Wireless)"> New Connection(Wired or Wireless)<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "No Internet Connection(Cross or Exclamation)"> No Internet Connection(Cross or Exclamation)<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "Access to Blocked Site:"> Access to Blocked Site:
                                      <input  type = "text" name = "site" id = "site" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                                      Purpose:<input  type = "text" name = "purpose" id = "purpose" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "Internet for Personal Phone/Tablet/Laptop"> Internet for Personal Phone/Tablet/Laptop<br>
                                      Purpose:<input  type = "text" name = "purpose2" id =  "purpose2" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                  </div>
                              </td>  
                              <td style = "width:35%;">
                                  <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g3" class = "checkbox_group" value = "SOFTWARE/SYSTEM"> <b>SOFTWARE/SYSTEM<span style = "color:red;">*</span></b><br>
                                  <div style = "margin-left:20px;padding-top:10px;" >
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Operating System, Office, Anti-Virus"> Operating System, Office, Anti-Virus<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Records Tracking System"> Records Tracking System<br>
                                      <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Google Drive"> Google Drive<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "DILG Portals/Systems"> DILG Portals/Systems<br>
                                      <input  style = "margin-bottom:10px;"type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g3" value = "Other software/s (please specify)"> Other software/s (please specify)
                                      <br><input  type = "text" name = "softwares" id= "softwares" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                                  </div>
                              </td> 
                          </tr>
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <td>
                          <div style = "margin-left:30px;padding-top:10px;" >
                          <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g4" class = "checkbox_group" value = "PRINTER/SCANNER"> <b>PRINTER/SCANNER<span style = "color:red;">*</span></b><br>

                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Installation"> Installation<br>
                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Troubleshooting"> Troubleshooting<br>
                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g4" value = "Sharing/Networking"> Sharing/Networking<br>
                          </div>
                          </td> 
                          <td>
                            <input  type = "checkbox" name = "req_type_category[]" id = "checkboxgroup_g5" class = "checkbox_group" value ="GOVMAIL" > <b>GOVMAIL<span style = "color:red;">*</span></b><br>
                            <div style = "margin-left:30px;padding-top:10px;">
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "New Account"> New Account<br>
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Change Account to"> Change Account to <input required type = "text" id = "changeaccount" name = "changeaccount" value = "" style = "width:30%;border:none;border-bottom:1px solid black;" /><br>
                            <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Password Reset"> Password Reset<br>
                          </div>
                          </td> 
                          <td>
                          <input  style = "margin-bottom:10px;" type = "checkbox" name = "req_type_category[]"  id = "checkboxgroup_g6" value = "Others"><b>Others<span style = "color:red;">*</span></b><br>
                          <input  type = "text" name = "others1" id = "others1" class = "checkboxgroup_g6" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                          <input  type = "text" name = "others2" id = "others2" class = "checkboxgroup_g6" value = "" style = "border:none;border-bottom:1px solid black;"/><br>
                          <input  type = "text" name = "others3" id = "others3" class = "checkboxgroup_g6"value = "" style = "border:none;border-bottom:1px solid black;"/><br>

                          </td> 

                          </tr>
                          </table>
                          <table border = 1 style = "margin-top:20px;width:100%;">
                            <tr>
                              <td colspan = 4 class = "center-text label-text" style = "width:50%;"><i>END-USER</i></td>
                                <td colspan = 4 class = "center-text label-text"><i>RICTU</i></td>
                                  </tr>
                          <tr>
                            <td colspan = 4 class = "label-text">ISSUE/PROBLEM/ERROR DETAILS:<span style = "color:red;">*</span></td>
                              <td colspan = 4 class = "label-text">FINDINGS AND RESOLUTION/RECOMMENDATION</td>
                                </tr>
                          <tr>
                              <td colspan = 4 >
                                <textarea rows="23" name = "issue" cols="56"  style ="border:1px solid white;resize:none;width:100%;text-align:left;" >
                                </textarea>
                              </td>

                              <td colspan = 4 rowspan= 2>
                                <textarea rows="25" cols="56" style ="border:1px solid white;resize:none;width:100%;text-align:left;background-color:#EEEEEE;" name = "status" class = "disabletxtarea">
                                </textarea>
                              </td>
                             
                          </tr>
                          <tr>
                          <td colspan = 4 class = "label-text">ACCEPTANCE OF ICT TECHNICAL ASSISTANCE RENDERED:</td>
                         
                          </tr>
                          <tr>
                          <td colspan = 4 STYLE = "text-align:center;"><u><?php echo $_SESSION['complete_name'];?></u><br><span class = "label-text">Signature over Printed Name</span></td>

                         
                          <td colspan=2 class = "label-text"><input type = "checkbox" disabled />&nbsp;&nbsp;&nbsp;&nbsp;Resolved</td>
                          <td colspan=2 class = "label-text">
                          <input type = "checkbox" disabled />&nbsp;&nbsp;&nbsp;&nbsp;Defective(to be referred to GSS for repair)
                          </td>
              
                          <tr> 
                          <td colspan = 4 class = "label-text">DEAR END USER, YOUR FEEDBACK IS IMPORTANT TO US:</td>

                   
              
                          <td style = "width:12.5%;" class = "label-text">Started Date:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "started_date" placeholder = "Started Date" class="datePicker1" value="" required>
                          </div>
                          </td>
                          <td style = "width:12.5%;" class = "label-text">Completed Date:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "completed_time" placeholder = "Completed Time"  value="" required>
                          </div>
                          </td>

                          </tr>
                          <tr>
                          <td colspan = 4>
                          <td style = "width:12.5%;" class = "label-text">Started Time:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "started_time" placeholder = "Started Time"  value="" required>
                          </div>
                          </td>
                          <td style = "width:12.5%;" class = "label-text">Completed Time:</td>
                          <td style = "width:12.5%;">
                          <div class="input-group date">
                          <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                          </div>
                          <input required disabled type="text" name = "completed_time" placeholder = "Completed Time"  value="" required>
                          </div>
                          </td>
                          </tr>
                          <tr>
                          <td colspan =4>
                          <ol>
                            <li class = "label-text">Timeliness
                            <p style = "font-weight:normal;">Was the ICT Staff able to provide immediate assistance within three (3) hours or agreed timeline?(Yes/No) ___________________________ </p>
                            </li>
                            <li class = "label-text">Quality
                            <p style = "font-weight:normal;">At a rating scale of 1 to 5, kindly rate the service rendered?<br>(5-Outstanding, 4- Very Satisfactory, 3 - Satisfactory, 2 - Unsatisfactory, 1 - Poor) ____________
                            </li>
                          </ol>
                          </td>
                          <td colspan = 4 style = "text-align:center;">
                          _____________________________________________________
                          <p class = "label-text">Signature over Printer Name</p>
                          
                          </td>
                          </tr>






                          </table><br>

                      <input id = 'submit' style ="float:right;" type = "submit" value = "Submit" class="btn btn-primary btn-s sweet-14" />
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
$('#submit').click(function(){
  var cb1 = document.getElementById("checkboxgroup_g1").checked;
  var cb2 = document.getElementById("checkboxgroup_g2").checked;
  var cb3 = document.getElementById("checkboxgroup_g3").checked;
  var cb4 = document.getElementById("checkboxgroup_g4").checked;
  var cb5 = document.getElementById("checkboxgroup_g5").checked;
  var cb6 = document.getElementById("checkboxgroup_g6").checked;


if(cb1 == '' && cb2 == '' && cb3 == '' && cb4 == '' && cb5 == '' && cb6 == '' )
{
  alert('Required Field:Choose atleast one on Type of Request');
  return false;
}
return true;
})

</script>




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
    $(".datePicker1").datepicker().datepicker("setDate", new Date());


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
    document.getElementById("site").disabled = true;
    document.getElementById("purpose").disabled = true;
    document.getElementById("purpose2").disabled = true; 
    document.getElementById("softwares").disabled = true;
    document.getElementById("changeaccount").disabled = true; 
    document.getElementById("others1").disabled = true ; 
    document.getElementById("others2").disabled = true; 
    document.getElementById("others3").disabled = true; 
    

      enable_cb1();
      enable_cb2();
      enable_cb3();
      enable_cb4();
      enable_cb5();
      enable_cb6();
    $("#checkboxgroup_g1").click(enable_cb1);
    $("#checkboxgroup_g2").click(enable_cb2);
    $("#checkboxgroup_g3").click(enable_cb3);
    $("#checkboxgroup_g4").click(enable_cb4);
    $("#checkboxgroup_g5").click(enable_cb5);
    $("#checkboxgroup_g6").click(enable_cb6);
    
  });
  function enable_cb6() {
    if (this.checked) {
      $(".checkboxgroup_g6").removeAttr("disabled");
    } else {
      $(".checkboxgroup_g6").attr("disabled", true);
    }
  }

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
      document.getElementById("site").disabled = false; 
      document.getElementById("purpose").disabled = false; 
      document.getElementById("purpose2").disabled = false; 


    } else {
      $(".checkboxgroup_g2").attr("disabled", true);
      document.getElementById("site").disabled = true; 
      document.getElementById("purpose").disabled = true; 
      document.getElementById("purpose2").disabled = true; 


    }
  }
  function enable_cb3() {
    if (this.checked) {
      $(".checkboxgroup_g3").removeAttr("disabled");
      document.getElementById("softwares").disabled = false; 

    } else {
      $(".checkboxgroup_g3").attr("disabled", true);
      document.getElementById("softwares").disabled = true; 

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
      document.getElementById("changeaccount").disabled = false; 

    } else {
      $(".checkboxgroup_g5").attr("disabled", true);
      document.getElementById("changeaccount").disabled = true; 
      

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


