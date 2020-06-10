label

<input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Instructions:" >



value


<input  required type="text" class="" style="margin-top:40px;text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 120px; width:100%;" name="purpose" id="purpose" value = "" placeholder="Remarks/Instructions" >


<?php if($uc=='yes'):?>
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input <?php echo "checked='checked'"; ?> onclick="myFunction()"  style = "margin-bottom:10px;" type = "checkbox" id= "checkboxyes" name = "checkboxyes" class = "checkboxgroup_g1" value ="Yes"> <b>Yes <label style="color:red">*</label></b>
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input onclick="myFunction()"  style = "margin-bottom:10px;" type = "checkbox" id= "checkboxno" name = "checkboxno" class = "checkboxgroup_g2" value ="No"><b>No <label style="color:red">*</label></b>
<?php else:?>
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input onclick="myFunction()"  style = "margin-bottom:10px;" type = "checkbox" id= "checkboxyes" name = "checkboxyes" class = "checkboxgroup_g1" value ="Yes"> <b>Yes <label style="color:red">*</label></b>
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input  <?php echo "checked='checked'"; ?>  onclick="myFunction()"  style = "margin-bottom:10px;" type = "checkbox" id= "checkboxno" name = "checkboxno" class = "checkboxgroup_g2" value ="No"><b>No <label style="color:red">*</label></b>
<?php endif?>