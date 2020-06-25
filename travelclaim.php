
<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'travelclaim_functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
  button{
    font-family:'Arial';

  }
  table tr{ 
    font-family:'Cambria';
  }
  .table-header{
    color:black;
    background-color:#B0BEC5; 

  }
  td{
    padding:5px;
  }
  td.label-text{ 
    background-color:#B0BEC5; 

  }
  .borderless {
  outline: 0;
  border-width: 0 0 2px;
  border-color: blue
}
.borderless:focus {
  border-color: green
}
</style>
</head>
<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>Create Itinerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
        <div class="box-body">
            <div class="well" style = "padding:20px;">
            <H5 style = "margin-left:1300px;"><i>Appendix 45</i></H5>

            <center>
            
            <h1>ITINERARY OF TRAVEL </h1>

             

           
            
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1">
                    <tr>
                      <td class = "label-text">
                        <label>Entity Name: 
                      </td>
                      <td colspan = 8>
                      <input type = "text" class = "form-control" value = "DILG Region IV-A" readonly/>
                      </td>
                    </tr>
                    <tr>
                      <td class = "label-text">
                        <label>Fund Cluster:</label>
                      </td>
                      <td colspan = "4">
                      <input type = "text" class = "form-control" readonly/>
</td>
                      <td class = "label-text">
                        <label>No:</label>
                      </td>
                      <td colspan = 4>
                      <input type = "text" class = "form-control" readonly/>

</td>
                    </tr>
                </thead>
              <tbody>
                  <tr>
                    <td class = "label-text">
                    <label>Name: 
                    
                    </td>
                    <td colspan = 4><input type = "text" class = "form-control" value = "<?php echo getCompleteName();?>" readonly/></td>
                    <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                    <td colspan = 2><input type = "text" class = "form-control datepicker1" id = "datepicker1" /></td>
                  </tr>
                  
                  <tr>
                    <td class = "label-text">  <label>Position:</label></td>
                    <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo getPosition();?>" readonly/></td>
                    <td colspan = 4 rowspan = 2>
                    <label>Purpose:</label> <label style="color: Red;" >*</label><textarea rows = 4 col=10 style = "width:100%;resize:none;" id = "or"></textarea></td>
                  </tr>
                  <tr>
                    <td class = "label-text">  <label>Official Station: </label></td>
                    <td colspan = 4>
                    <input type = "text" class = "form-control" readonly/>
                    <!-- <select required id="mySelect2" class="form-control" name="office">
                    <option selected disabled></option>
                <option value="1" selected>Regional Office</option>
                <option value="2">Provincial/HUC Office</option>
                <option value="3">Cluster Office</option>
                <option value="4">City/Municipal Office</option>
                    </select> -->

                    
                    </td>
                  </tr>
                 
                  <tr>
                  <th class = "table-header" style = "text-align:center;" rowspan = 2>
                    Date
                  </th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Places to be visited (Destination)</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" colspan = 2>Time</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Means of Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Transportation</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Per Diem</th>
                  <th class = "table-header" style = "text-indent:10px;text-align:center;" rowspan = 2>Others</th>
                  <th class = "table-header"  style = "text-indent:10px;text-align:center;" rowspan = 2>Total Amount</th>
              </tr>
              <tr>

              <th class = "table-header"  style = "text-align:center;">Arrival</th>
              <th class = "table-header"  style = "text-align:center;">Departure</th>

              </tr>
              
               <?php echo showData();?>
            
            

             
                
              </tr>
             
              <tr>
              <td colspan = 8>TOTAL</td>
              <td >1500</td>
              </tr>
              <tr>
              <td rowspan = 5 colspan = 5 style = "text-align:justify;"> 
              I certify that : (1) I have reviewed the foregoing  itinerary,    (2)  the  travel  is necessary to  the service, (3) the period covered   is   reasonable   and   (4)  the expenses claimed are proper.   
              <CENTER><br>_____________________________________________<br>
              <b>DR. CARINA S. CRUZ</b></CENTER>
               </td>
              <br>
              <td colspan = 5 rowspan = 2>Prepared by:
              <CENTER><br>_____________________________________________<br>
              <?php echo '<b>'.getCompleteName().'</b>';?></CENTER>
              </td>
              
              </tr>
              <tr>
              </tr>
              <tr>
              <td colspan = 5 rowspan = 2>Approved By
              <CENTER><br>_____________________________________________<br>
             <b> ARIEL O. IGLESIA	</b>			
</CENTER>
              </td>
              </tr>
              <tr>
              </tr>



                                
              </tbody>
            </table>
        
           
            
            </center>
                

</div>  
</div>  


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>
<!-- ================= add travel =================== -->
<div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add Travel</h4>
                <button type="button" class="close" data-dismiss="modal">&times; 
                </button>
                </div>
                <div class="modal-body">
                <form method = "POST" action = "addTravelData.php">
                        <table class="table table-bordered" style = "width:100%;"> 
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">RO/TO/OB No.<span style = "color:red;">*</span></td>
                                    <td class="col-md-5"><input  type = "text" class = "form-control" name = "rto" id = "ro_txt"    /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">No. of Travel Days<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type="text" class = "form-control" name = "ntd" autocomplete = off  >
                                            </td>
                                                </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                                    <td class="col-md-5">
                                        <input  type = "text"  class = "form-control datepicker2" id = "datepicker2" name = "start"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                            </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">End Date</td>
                                    <td class="col-md-5"><input  type = "text"  class = "form-control datepicker3" id = "datepicker3" name = "end"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Origin<span style = "color:red;">*</span></td>
                                    <td class="col-md-5"><input  type = "text" class = "form-control" name = "origin"  value = "" /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Destination<span style = "color:red;">*</span></td>
                                    <td class="col-md-5"><input  type = "text" name = "destination" class = "form-control" value = ""  /></td>
                                        </tr>
                            <tr>
                                <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>  
                                    <td class="col-md-5">
                                    <input  type = "text" class = "form-control" name = "venue" alue = "" />
                                        </td>
                                            </tr>
                        
                        </table>
                        <input type = "submit" class = "pull-right btn btn-success btn-md" value = "Save" name = "submit"/>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
      </div>
      <!-- ================ travel dates ============== -->
      <div class="modal fade" id="add_travel_dates">
        <div class="modal-dialog" style = "width:50%;">
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Add Travel Dates</h4>
                <button type="button" class="close" data-dismiss="modal">&times; </button>
            </div>
            <div class="modal-body" style = " max-height: calc(100vh - 200px); overflow-y: auto;">
              <div class="box-body">
              <form method = "POST" action = "saveTravelInfo.php">
                <div class="well" style = "padding:10px;">
                  <div class="box-body">
                    <div class="row">
                     
                      
                       
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name = "date" class="form-control datepicker4" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Time Going to Venue</label>
                            <input type = "time" name = "from1" class = "form-control "/>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type = "time" name = "to1" class = "form-control"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>
                        Meals
                        </label><br>
                        <input type="checkbox" name="meals"  class="minimal-red checkboxgroup" > <b>Without Meals</b><br>

                        <input type="checkbox" name="meals" class="minimal-red checkboxgroup" > Breakfast
                        <input type="checkbox" name="meals" class="minimal-red checkboxgroup" > Lunch
                        <input type="checkbox" name="meals"  class="minimal-red checkboxgroup" > Dinner
                      </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label style = "font-size:13px;">Time Going to Home or back to Official Station</label>
                            <input type = "time" name = "from2" class = "form-control"/>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type = "time" name = "to2" class = "form-control" style = "margin-top:15px;"/>
                        </div>
                      </div>
                    </div>  
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>
                          Accomodation
                          </label><br>
                          <input type="checkbox"  name = "accomodation" class="minimal-red checkboxgroup1" id = "wa" value = "With Accomodation"><b> With Accomodation</b><br>
                          <input type="checkbox"  name = "accomodation" class="minimal-red checkboxgroup1" id = "wr"> With Receipt<br>
                          <input type="checkbox"  name = "accomodation" class="minimal-red checkboxgroup1" id = "wor"> Without Receipt
                          <input type="text" disabled name="wor_txt"  id = "wor_txt" class = "borderless" style = "width:50%;"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Others</label>
                          <input type="text" name = "others" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask><br>
                          <span class = "btn btn-success btn-md pull-right" id = "add_fair"><i class = "fa fa-plus"></i>&nbsp;Add Fair </span>
                        </div>
                      </div>
                    </div>                  
                    </div>
                  </div>
                <div class="well" style = "padding:10px;" id = "travelPanel">

                  <div class="box-body myTemplate2">
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
                    </div>
                  </div>
                  <button type = "submit" class = "btn btn-success btn-md pull-right">Save </button>
              </form>
                  </div>
                </div>
                 
              </div>
              
            </div>
          
          
        </div>
      </div>
    </div>

<script>
 var myCounter = 1;

 $('#add_fair').click(function(){
    $('.myTemplate2')
   .clone()
   .removeClass("myTemplate2")
   .addClass("additionalDate")
   .show()
   .appendTo('#travelPanel');
   
  myCounter++;
     
  $(".datepicker6").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 

  $(".datepicker5").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 


});
$(document).on('click','#editbtn',function(e){
 

var purpose = $('#or').val();
$('#ro_txt').val(purpose);
if(purpose == '' || purpose == null)
{
  alert('Required Field:All fields with * are required!.');
$('#ro').prop('required',true);
exit();

}else{

}
});

$('.checkboxgroup').on('change', function() { 
      $('.checkboxgroup').not(this).prop('checked', false);  
  });

  $('.checkboxgroup1').on('change', function() { 
      $('.checkboxgroup1').not(this).prop('checked', false);  
  });
  // checkbox validation
  $(document).ready(function(){
        $('#wor').click(function(){
            if($(this).prop("checked") == true){
              
        $("#wor_txt").prop('disabled',false);

            }
            else if($(this).prop("checked") == false){
              $("#wor_txt").prop('disabled',true);
            }
        });
        $('#wa').click(function(){
            if($(this).prop("checked") == true){
        $("#wor_txt").prop('disabled',true);
              
            }
        });
        $('#wr').click(function(){
            if($(this).prop("checked") == true){
        $("#wor_txt").prop('disabled',true);
              
            }
        });
    });
</script>

