<form method = "POST" action = "ro_export_date.php">
<td class="col-md-1">
<b>Month</b>

<select class="" name="month" id = "selectMonth" style="width: 150px; Height:30px;">
<?php 
$current_month =  date('F');
switch($current_month){
case 'January':
echo '
<option value="01" selected>January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'February':
echo '
<option value="01">January</option>
<option value="02" selected>February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'March':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03" selected>March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'April':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04" selected>April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'May':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05" selected>May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'June':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06" selected>June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'July':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07" selected>July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'August':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08" selected>August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'September':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09" selected>September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'October':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10" selected>October</option>
<option value="11">November</option>
<option value="12">December</option>';
break;
case 'November':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11" selected>November</option>
<option value="12">December</option>';
break;
case 'December':
echo '
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12" selected>December</option>';
break;
}
?>

</select>
</td>
<td class="col-md-1" >
<b>Year</b>
<select class="" id="year" name="year" style="width: 150px; Height:30px;">
<!-- <option value="">Year</option> -->
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
<option value="2026">2026</option>
<option value="2027">2027</option>
<option value="2028">2028</option>
<option value="2029">2029</option>
<option value="2030">2030</option>

</select>

</td>

<td class="col-md-1" >

<b>Office</b>
<select class="" id="office" name="office" style="width: 150px; Height:30px;">

<option value="ALL">ALL</option>
<option value="ORD">ORD</option>
<option value="FAD">FAD</option>
<option value="LGCDD">LGCDD</option>
<option value="MBRTG">MBRTG</option>
<option value="LGMED">LGMED</option>
<option value="PDMU">PDMU</option>
<option value="Batangas">Batangas</option>
<option value="Cavite">Cavite</option>
<option value="Laguna">Laguna</option>
<option value="Rizal">Rizal</option>
<option value="Quezon">Quezon</option>
<option value="Lucena City">Lucena City</option>

</select>
</td>
<td class="col-md-1" >
<br>
<button style="  Height:30px;"  id="" name="export" type="submit"  class="btn btn-success pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Export&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
</td>
</form>