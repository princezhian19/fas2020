<?php 
session_start();

     include 'connection.php';
     $query1 = "
     SELECT * FROM `tbltravel_claim_info` 
     INNER JOIN `tbltravel_claim_info2` on `tbltravel_claim_info`.TC_ID = `tbltravel_claim_info2`.ID 
     INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.ID = `tbltravel_claim_ro`.ID
     where `RO_TO_OB` = '".$_POST['ro']."' ";
     $result1 = mysqli_query($conn, $query1);
     if(mysqli_num_rows($result1) > 0)    
     {
        while($row1 = mysqli_fetch_array($result1))
        {


    
     $query = "SELECT * FROM `tbltravel_claim_info` 
          INNER JOIN `tbltravel_claim_info2` on `tbltravel_claim_info`.TC_ID = `tbltravel_claim_info2`.ID 

          INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID

     WHERE `TC_ID` ='".$row1['ID']."' ";
     
     $result = mysqli_query($conn, $query);
     if(mysqli_num_rows($result) > 0)    
     {
        while($row = mysqli_fetch_array($result))
        {
            ?>
             <div class="well" style = "padding:10px;">
                  <div class="box-body">
                    <div class = "row">
                      <div class = "col-sm-12 col-md-12 col-lg-12">
                        <div class = "col-sm-6 col-md-6 col-lg-6">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Activity Title</label>
                              <input type = "text" name = "ro" class = "form-control " value = "<?php echo $row['RO_OT_OB']?>" required/>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Date</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name = "date" class="form-control datepicker4" value = "<?php echo $row['DATE'];?>" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Time Going to Venue</label>
                                <input type = "time" name = "from1" class = "form-control "/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <input type = "time" name = "to1" class = "form-control"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style = "font-size:13px;">Time Going Home or back to Official Station</label>
                                <input type = "time" name = "from2" class = "form-control"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>&nbsp;</label>
                              <input type = "time" name = "to2" class = "form-control" style = "margin-top:15px;"/>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Others</label>
                                <input type="text" name = "others" value = "<?php echo $row['OTHERS'];?>" class="form-control" >
                            </div>
                          </div>
                          </div>
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                            <div class="col-md-12 well perdiem">
                              <div>
                                <div class="form-group">
                                    <label> Per Diem </label>
                                    <label class = "pull-right">
                                    <input type ="hidden" value = "<?php echo $row['PLACE'];?>" id = "distance"/>
                                    <?php echo $row['DISTANCE'];?>
                                    </label>
                                </div>
                                <div class="form-group">
                                  <label> Meals </label><br>
                                  <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1" id = "cb1"> <b>Will Claim Meals</b><br>
                                  <input style = "margin-left:14px" type="checkbox" name="breakfast" class="minimal-red checkboxgroup" id = "breakfast" value = "breakfast"> Breakfast
                                  <input type="checkbox" name="lunch" class="minimal-red checkboxgroup" id= "lunch" value = "lunch"> Lunch
                                  <input type="checkbox" name="dinner"  class="minimal-red checkboxgroup" id="dinner" value = "dinner"> Dinner
                                </div>
                                <div class="form-group">
                                  <label>
                                  Accomodation
                                  </label><br>
                                  <input type="checkbox"  name = "accomodation" class="minimal-red" id = "wa" value = "With Accomodation accomodation_chkbox"><b> Will Claim Accomodation</b><br>
                                  <input style = "margin-left:14px" type="checkbox"  name = "with_receipt" class="minimal-red receipt" id = "wr" value ="With Receipt"> With Receipt
                                  <input type="text" disabled name="wor_txt"  id = "wor_txt" class = "borderless" style = "width:50%;"/>
                                  <br>
                                  <input style = "margin-left:14px"type="checkbox"  name = "wor_txt" class="minimal-red receipt" id = "wor" value ="Without Receipt"> Without Receipt
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                      <div style = "padding:10px;" >
                      <!-- <div class="box-body myTemplate2">
                        <div class="row ">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>From</label>
                                <input type="text" name = "from3[]" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>To</label>
                                <input type = "text" name = "to3[]" class = "form-control"/>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Means of Transportation</label>
                                
                                <input type="text" name = "mot[]" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Transportation Fare</label>
                                <input type = "text" name = "transpo_fare[]" class = "form-control"  />
                            </div>
                          </div>
                        </div>
                      </div> -->
                      </div>
                  </div>
                </div>
            <?php
        }
    }
        }
    }
 
?>

