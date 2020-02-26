<?php


function dbConnect() {
	$DB = new mysqli('localhost','root','','db_dilg_pmis');            //{^-LouqU_vpV
	if (mysqli_connect_errno()) {
		echo 'Cannot connect to database: ' . mysqli_connect_error();
		//mail("ber2x@yahoo.com", "URGENT ATTENTION: PCF Website Cannot Connect to the Database","Development Team, Please give attention! The PCF Website cannot connect to the database!".mysqli_connect_error(),"CC: phagemaster@gmail.com");
    }

	return $DB;
        // $DB->close();

}
function getControlNo()
{
    
    $data = '';
    $DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}
    	$query = "SELECT count(*) as 'count' from tbltechnical_assistance";
	$rowRs = $DBConn->query( $query );
	if ($rowRs->num_rows)
	{
		$rs = $rowRs->fetch_assoc();
	
		$data = $rs['count']+1;
		
	}
	else $data = '';
	$rowRs->close();

	return $data;
    
}
function usersData($user)
{
    
    $data = '';
    $DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}
    	$query = "SELECT FIRST_M, MIDDLE_M, LAST_M,EMAIL  FROM `tblemployee` WHERE EMP_N = '".$user."' ";
	$rowRs = $DBConn->query( $query );
	if ($rowRs->num_rows)
	{
		$rs = $rowRs->fetch_assoc();
	
		$data = $rs ['FIRST_M'].' '.$rs['MIDDLE_M'].' '.$rs['LAST_M'];
		
	}
	else $data = '';
	$rowRs->close();

	return $data;
    
}
function division($division_c)
{
    $DBConn = dbConnect();
    if (!$DBConn)
    {
    return false;
    }

    $query = "SELECT DIVISION_N, DIVISION_M FROM tblpersonneldivision where DIVISION_N = '".$division_c."' ";
    $data = "";
    $isSelected = "";
    $rowRs = $DBConn->query($query);
    if ($rowRs->num_rows)
    {
    if ($row = $rowRs->fetch_assoc())
        {

        $data.= $row['DIVISION_M'];
        }
    }

    $rowRs->close();
    return $data;
}
function position($position_c)
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
	
	$query = "SELECT POSITION_ID, POSITION_M FROM `tbldilgposition` WHERE POSITION_ID = '".$position_c."' ";						
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		if ($row = $rowRs->fetch_assoc()) {
						
			$data .= $row['POSITION_M'];
		}
				
	}	
	$rowRs->close();
	
	return $data;
}
function setPhoneNo($user)
{
    $data = '';
    $DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}
    	$query = "SELECT MOBILEPHONE  FROM `tblemployee` WHERE EMP_N = '".$user."' ";
	$rowRs = $DBConn->query( $query );
	if ($rowRs->num_rows)
	{
		$rs = $rowRs->fetch_assoc();
		$data = $rs ['MOBILEPHONE'];
	}
	else $data = '';
	$rowRs->close();

	return $data;
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
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
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
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="box-body">      
                    <div>
                        <h1>Technical Assistance Request Form</h1>
                    </div>
                    <form method="POST" enctype="multipart/form-data" class="myformStyle" action = "JASPER/phpjasperxml-master/sample/sample1.php" >    
                        <input type = "hidden" name = "curuser" value = "<?php echo $currentuser;?>" />
                        <table  border = 1 class = "center-text" style = "padding:20%;width:100%;">
                            <tbody>
                                <tr>
                                    <td colspan = 4>ICT TECHNICAL ASSISTANCE REQUEST FORM</span></td>
                                    <td class = "label-text left-text">Control<br>Number.</td>
                                    <td colspan = 2><input readonly  placeholder = "Control No."  text="text" name = "control_no" class = "sizeMax alphanum subtxt" value="2020-00<?php echo getControlNo();?>"/></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Request Date:</td>
                                    <td style = "width:15%;padding:5px 5px 5px 5px;"><input type = "text"  placeholder = "Request Date" name = "request_date" class = "datePicker1 setDateIcon sizeMax alphanum subtxt" value = "" /></td>
                                    <td style = "width:15%;"class = "label-text">Request Time:</td>
                                    <td style = "width:15%;  padding:5px 5px 5px 5px;"><input placeholder = "Request Time" type = "text" name = "request_time" class = "sizeMax alphanum subtxt" value ="<?php echo date("g:i a");?>"/></td>
                                    <td colspan = 4 class = "label-text">HARDWARE INFORMATION</td>
                                </tr>
                                <tr>
                                    <td colspan = 4 class = "label-text">END-USER INFORMATION </td>
                                    <td class = "label-text left-text">Equipment</td>
                                    <td colspan = 3 class = "left-text " style = "padding:5px 5px 5px 5px;"><input  style ="max-width:500%;" placeholder = "Equipment Type" type = "text" name = "equipment_type" class = "alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Requested By:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly placeholder = "Requested By" type="text" name = "requested_by" class = "sizeMax alphanum subtxt"  value = "<?php echo usersData($currentuser);?>" readonly /></td>
                                    <td class = "label-text left-text">Brand Model:</td>
                                    <td colspan =3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Brand Model" type = "text" name = "brand_model" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td class = "label-text left-text">Office:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly placeholder = "Office" type = "text" name = "office" class = "sizeMax alphanum subtxt" value = "<?php echo division($division_c);?>" readonly/></td>
                                    <td class = "label-text left-text">Property No.:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Property No." type = "text" name = "property_no" class = "sizeMax alphanum subtxt" /> </td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Position/Designation:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input readonly placeholder = "Position/Designation" type = "text" name = "position" class = "sizeMax alphanum subtxt" value = "<?php echo position($position_c);?>"  /></td>
                                    <td class = "label-text left-text">Serial No.:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "Serial No." type = "text" name = "serial_no" class = "sizeMax alphanum subtxt" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Contact Number:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input placeholder = "Contact Number" type = "text" name = "contact_no" class = "sizeMax alphanum subtxt" value = "<?php echo setPhoneNo($currentuser);?>" /></td>
                                    <td class = "label-text left-text">IP Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "IP Address" type = "text" name = "ip_address" class = "sizeMax alphanum subtxt" value = "" /></td>
                                </tr>
                                <tr>
                                    <td style = "width:15%;" class = "label-text left-text">Email Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input placeholder = "Email Address" type = "text" name = "email_address" class = "sizeMax alphanum subtxt" value = "<?php echo $email;?>"/></td>
                                    <td class = "label-text left-text">MAC Address:</td>
                                    <td colspan = 3 style = "  padding:5px 5px 5px 5px;"><input  placeholder = "MAC Address" type = "text" name = "mac_address" class = "sizeMax alphanum subtxt" value = "" /></td>
                                </tr>
                            </tbody>
                        </table><br>
                        <u style = "margin-top:20px;">TYPE OF REQUEST</u>

                        <table style = "margin-top:20px;">
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
                                    <input type = "text" name = "site" value = "" style = "width:30%;" /><br>
                                    Purpose:<input type = "text" name = "purpose" value = ""/><br>
                                    <input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g2" value = "Internet for Personal Phone/Tablet/Laptop"> Internet for Personal Phone/Tablet/Laptop<br>
                                    Purpose:<input type = "text" name = "purpose2" value = ""/><br>
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
                                    <br><input type = "text" name = "softwares" value = ""/><br>
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
<input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Change Account to"> Change Account to <input type = "text" name = "changeaccount" value = "" style = "width:30%;" /><br>
<input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_subcategory[]" class = "checkboxgroup_g5" value = "Password Reset"> Password Reset<br>
</div>
</td> 
<td>
<input style = "margin-bottom:10px;" type = "checkbox" name = "req_type_category[]" value = "Others"><b>Others</b><br>
<input type = "text" name = "others1" value = "" /><br>
<input type = "text" name = "others2" value = ""/><br>
<input type = "text" name = "others3" value = ""/><br>

</td> 

</tr>
</table>
<table border = 1 style = "margin-top:20px;">
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
<textarea rows="20" name = "issue" cols="56"  style ="resize:none;text-align:left;" >

</textarea>
</td>
<td colspan = 4>
<textarea rows="20" cols="56" style ="resize:none;" name = "status" class = "disabletxtarea">

</textarea>
</td>
</tr>
<tr>
<td style = "width:12.5%;">Timeliness</td>
<td style = "width:12.5%;">
<select name="timeliness" class="dropdown" style = "width:60%;text-align:center;">
<option value = "YES">YES</option>
<option value = "NO">NO</option>
</select>
</td>
<td style = "width:12.5%;">Quality</td>
<td style = "width:12.5%;text-align:center">
<select name="quality" class="dropdown size250">
<option value = "5">Outstanding</option>
<option value = "4">Very-Satisfatory</option>
<option value = "3">Satisfatory</option>
<option value = "2">Unsatisfatory</option>
<option value = "1">Poor</option>
</select>

</td>
<td style = "width:12.5%;">Started Date:</td>
<td style = "width:12.5%;"><input readonly placeholder = "Started Date" type = "text" name = "started_date"  class = "datePicker2 setDateIcon sizeMax alphanum subtxt" /></td>
<td style = "width:12.5%;">Completed Date:</td>
<td style = "width:12.5%;"><input readonly placeholder = "Completed Date" ttype = "text" name = "completed_date" class = "datePicker3 setDateIcon sizeMax alphanum subtxt" /></td>
</tr>
<tr> 
<td colspan = 4>
Assisted By:
<select name="assisted_by" class="dropdown size250">
<option value = "Charles Adrian T. Odi">Charles Adrian T. Odi</option>
<option value = "Christian Paul V. Ferrer">Christian Paul V. Ferrer</option>
<option value = "Mark Kim A. Sacluti">Mark Kim A. Sacluti</option>
</select>
</td>
<td style = "width:12.5%;">Started Time:</td>
<td style = "width:12.5%;"><input readonly placeholder = "Started Time" type = "text" name = "started_time"  class = "sizeMax alphanum subtxt" value =""/></td>
<td style = "width:12.5%;">Completed Time:</td>
<td style = "width:12.5%;"><input readonly placeholder = "Completed Time" type = "text" name = "completed_time" class = "sizeMax alphanum subtxt" /></td>
</tr>





</table><br>
<input type = "submit" value = "Submit" class="button white normalrounded" />
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



