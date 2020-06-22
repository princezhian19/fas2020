
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
</style>
</head>
<div class="box">
  <div class="box-body">
    <h1 align="">&nbsp<b>Create Itenerary</b></h1>
    <div class="box-header with-border">
    </div>
    <br>
    &nbsp &nbsp &nbsp   <li class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <br>
        <div class="box-body">
            <div class="well" style = "padding:20px;">

            <center>
            <h1>ITENERARY OF TRAVEL </h1>
            
            <table class="equalDivide" cellpadding="0" cellspacing="0" width="80%" border="1">
                    <tr>
                      <td class = "label-text">
                        <label>Entity Name: <label style="color: Red;" >*</label>
                      </td>
                      <td colspan = 8>
                      <input type = "text" class = "form-control" value = "DILG Region IV-A" readonly/>
                      </td>
                    </tr>
                    <tr>
                      <td class = "label-text">
                        <label>Fund Cluster: <label style="color: Red;" >*</label> </label>
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
                    <label>Name: <label style="color: Red;" >*</label>
                    
                    </td>
                    <td colspan = 4><input type = "text" class = "form-control" value = "<?php echo getCompleteName();?>" readonly/></td>
                    <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                    <td colspan = 2><input type = "text" class = "form-control datepicker1" id = "datepicker1" /></td>
                  </tr>
                  
                  <tr>
                    <td class = "label-text">  <label>Position: <label style="color: Red;" >*</label></td>
                    <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo getPosition();?>" readonly/></td>
                    <td colspan = 4 rowspan = 2>
                    <label>Purpose:</label> <label style="color: Red;" >*</label><textarea rows = 4 col=10 style = "width:100%;resize:none;" id = "or"></textarea></td>
                  </tr>
                  <tr>
                    <td class = "label-text">  <label>Official Station: <label style="color: Red;" >*</label></td>
                    <td colspan = 4>
                    <select required id="mySelect2" class="form-control" name="office">
                    <option selected disabled></option>
                <option value="1" selected>Regional Office</option>
                <option value="2">Provincial/HUC Office</option>
                <option value="3">Cluster Office</option>
                <option value="4">City/Municipal Office</option>
                    </select>

                    
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
              <tr>
              <td colspan = 9>
               <?php echo showData();?>
              </td>
              </tr>
              <tr>
              <td colspan = 9>
              <button
              class = "btn btn-primary btn-md"
              >
              Add Travel Dates
              </button>
              </td>

                <!-- <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td> -->
                
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
             <b> NOEL R. BARTOLABAC, CESO V		</b>			
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
                        <input  type = "hidden" name = "eventid" id = "eventid">
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
<script>
$(document).on('click','#editbtn',function(e){

var purpose = $('#or').val();
$('#ro_txt').val(purpose);
});
</script>

