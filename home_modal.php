
<div class="modal fade" id="welcome-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header" style = "background-color:#B0BEC5;">
        <h5 class="modal-title" id="exampleModalLabel" style = "font-weight:bold;text-align:center;font-size:30px;">HEALTH DECLARATION FORM</h5>
        To change your information (Employee No, Name, Mobile Number, Email Address, Current Residential Address, Sex, Birth Date and Office), please update your PROFILE.
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method = "POST" action = "health_monitoring_functions.php?action=add">
      <div class="modal-body"  style = "max-height: calc(100vh - 210px);
    overflow-y: auto;">
      <div>

      <table border =1 style = "width:100%;" class="table table-bordered table-hover">
        <tbody>
        <tr>
        <td style = "background-color:#B0BEC5;">Employee No.:</td>
        <td>
        <input style = "border: none;" type ="text" class = "form-control" value = "<?php getEmpNo();?>"   readonly/> 
        
        </td>
        <td style = "background-color:#B0BEC5;">Date:</td>
        <td><input  type = "text" class = "form-control datepicker2" id = "datepicker2" value = "<?php echo date('F d, Y');?>" disabled/></td>
        </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Name:</td>
            <td> 
            <input style = "border: none;" type ="text" class = "form-control" value = "<?php getLast();?>"  name = "lastname" readonly/> 
              
            </td>
            <td> 
              <input style = "border: none;" type ="text" class = "form-control" value = "<?php getFirst();?>"  name = "firstname" readonly/> 
            </td>
            <td> 
              <input style = "border: none;" type ="text" class = "form-control" value = "<?php getMiddle();?>"  name = "middlename" readonly/> 
            </td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Mobile Number:</td>
            <td> <input style = "border: none;" type ="text" class = "form-control" value = "<?php getContact();?>"  name = "contact_number" readonly/> </td>
            <td style = "background-color:#B0BEC5;"> Body Temp. </td> 
            <!-- id = "temp" oninput="temperatureConverter(this.value)" onchange="temperatureConverter(this.value) -->
            <td> <input type ="text"  class = "form-control" required name = "body_temp" /> 
            <!-- pattern="^\d*(\.\d{0,2})?$" min = 0 maxlength = 5 -->

            </td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Email Address:</td>
            <td> <input type ="text" style = " border: none;" class = "form-control" value = "<?php getEmail();?>"  name = "email" readonly/> </td>
            <td style = "background-color:#B0BEC5;"> Nationality: </td>
            <td> <input type ="text" style = " border: none;" class = "form-control" value = "Filipino" name = "nationality" readonly/> </td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;" rowspan = 2>Current Residential Address:</td>
            <td rowspan = 2><textarea   cols = 25 rows=3  style = "resize:none;background-color:#ECEFF1;border:none;" name = "curraddress" readonly><?php getAddress();?></textarea></td>
            <td style = "background-color:#B0BEC5;" rowspan = 2>Sex:<br><br>Age</td>
            <td> <input type ="text" style = " border: none;" class = "form-control" name = "gender" id = "gender" value = "<?php getGender(); ?>" readonly /> </td>
          </tr>
          <tr>
          <td><input type ="text" style = " border: none;" class = "form-control" name = "age" VALUE = "<?php calculateAge();?>" name = "age" readonly/> </td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Office/Unit:</td>
            <td> <input type ="text" style = " border: none;" class = "form-control" value = "<?php getOffice()?>" name= "office" readonly/> </td>
            <td style = "background-color:#B0BEC5;">Work Arrangement:</td>
            <td> 
                <select required class="form-control" style="width: 100%;" name="work_arrangement" id="sched" >
                    <option value="" selected></option>
                    <option value="SWF" >Skeletal Work Force</option>
                    <option value="AWA" >Alternate Work Arrangement</option>
                </select>
                <!-- <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name = "sched" required>
                </div> -->
            </td>

          </tr>
         
          <tr>
            <td style = "background-color:#B0BEC5;">Did you have any of the following in the last 14 days: fever, cough, colds, sore throat, diarrhea or difficulty in breathing?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox1" id="cb1" name = "ans1" value = "YES" required>
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox1" id="cb2"  name = "ans1" value = "NO" >
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2>Please provide details:<center><textarea  required cols = 56 rows=5  style = "resize:none;" id = "txt1" name = "ans1_details"></textarea></center></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Have you worked, visited or travelled to any foreign countries in the past 14 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox2" id="cb3" name = "ans2" value = "YES" required>
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox2" id="cb4" name = "ans2" value = "NO" >
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2>Please provide specific details on the name of places and date of visit: (i.e. June 2- Mc Donald’s, Panay Ave, SM Hypermarket – Centris)<center>
            <textarea required name = "ans2_details" cols = 56 rows=6 style = "resize:none;" id = "txt2"></textarea></center></td>
          </tr>
          <tr>
            <td style = "background-color:#B0BEC5;">Have you worked, visited or travelled to other places in the Philippines in the past 7 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox3" id="cb5" name = "ans3" value = "YES" required> 
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox3" id="cb6" name = "ans3" value = "NO" >
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2>Please provide specific details on the name of places and date of visit: (i.e. June 2- Mc Donald’s, Panay Ave, SM Hypermarket – Centris)<center>
            <textarea required name = "ans3_details" cols = 56 rows=6 style = "resize:none;" id = "txt3"></textarea></center></td>
          </tr>
          <tr>
          <td style = "background-color:#B0BEC5;">Have you been in close contact with farm animals or exposed to wild animals in the past 14 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox4" id="cb7" name = "ans4" value = "YES" required>
              <label class="form-check-label" for="exampleCheck1 checkbox4">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox4" id="cb8" name = "ans4" value = "NO" >
              <label class="form-check-label" for="exampleCheck1 checkbox4">No</label>
            </div>
            </td>
            <td colspan = 2>Please provide details:<center><textarea required name = "ans4_details" cols = 56 rows=5  style = "resize:none;" id = "txt4"></textarea></center></td>
          </tr>
          <tr>
          <td style = "background-color:#B0BEC5;">Have you been exposed to a person with COVID-19 or person under investigation for COVID-19?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox5" id="cb9" name = "ans5" value = "YES" required>
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input checkbox5" id="cb10" name = "ans5" value = "NO" >
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2>Please provide details:<center><textarea required name = "ans5_details" cols = 56 rows=5  style = "resize:none;" id = "txt5"></textarea></center></td>
          </tr>
          <tr>
          <td colspan = 4><b>FOR WOMEN:</b><br> When was your last menstruation period? 
          <input style = "width:20%;"type = "text" class = "form-control datepicker1 period" id = "datepicker1" name = "lastperiod"/></td>
          </tr>
          <tr>
          <td style = "text-align:justify;" colspan = 4>Declaration:<br><br>
            The information I have given herein is true, correct and complete, I understand that failure to answer any question or any falsified response may have serious consequences. (Article 171 and 172 of the revised Penal Code of the Philippines).
            <br><br><span class = "pull-right" STYLE = "margin-left:50px;"> 
                <br><u STYLE  = "font-weight:bold;"><?php echo date('F d, Y');?></u><br>
                <input type = "hidden" value="<?php echo date('F d, Y');?>" name = "date_today" />
                <center>DATE</center>
            </span>                                            
            <span class = "pull-right" > <br><u STYLE  = "font-weight:bold;"><?php getSignature();?></u><br>NAME AND SIGNATURE </span>                                            
          </td>
          </tr>

        </tbody>
      </table>
      </div>
      </div >
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>