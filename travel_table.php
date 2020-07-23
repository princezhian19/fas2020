<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location:index.php');
  }else{
    error_reporting(0);
  ini_set('display_errors', 0);
  $username = $_SESSION['username'];
  $_SESSION['unique_id'] = 1;
  
  }
include('db.class.php'); // call db.class.php
include('travelclaim_functions.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
  

echo '<input type = "hidden" id = "hidden_url" value = "'.$link.'"/>';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="panel panel-defasult">
          <div class="box-body"> 
          
            <div>
                <h1>Monitoring of Travel Claim Request</h1><br>
           <a href = "CreateTravelClaim.php?ro=&ui=1&username=<?php echo $username;?>" ><button class = "btn btn-md btn-success">Create</button></a><br><br><br>
                
            </div>
            
     
            
         
        
              <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                    <thead>
                        <th>NO</th>
                        <th>EMPLOYEE NAME</th>
                        <th>RO/OT/OB</th>
                        <th>NO. OF TRAVEL DAYS</th>

                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>ORIGIN</th>
                        <th>DESTINATION</th>
                        <th>DISTANCE</th>
                        <th>VENUE</th>

                        
                        <th style = "text-align:center;max-width:20%;">ACTION</th>
                    </thead>

                </table>

    

      <script src="jquery.min.js"></script>

</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style = "width:60%;">
    <div class="modal-content">
      <div class="modal-header">
      <span class = "pull-right"><i>Appendix 45 </i></span>

        <h2 class="modal-title" id="exampleModalLabel" style = "text-align:center;">ITINERARY OF TRAVEL</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id = "table1" border="1"  width="100%" >
              
      </table>
      <table id = "results" border="1" >
      </table>
      <table id = "table3" class="equalDivide" width="100%" border="1">          
      </table>
  
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-dismiss = "modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="add_travel_dates">
        <div class="modal-dialog" style = "width:50%;">
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Edit Travel Dates</h4>
                <span type="span" class="close" data-dismiss="modal">&times; </span>
            </div>
            <div class="modal-body" style = " max-height: calc(100vh - 200px); overflow-y: auto;">
              <div class="box-body">
              <form method = "POST" action = "">
            <input type = "hidden" name = "hidden_ro" value = "<?php echo $_GET['ro'];?>" />

                <div class="well" style = "padding:10px;">

                  <div class="box-body">
                    <div class = "row">
                      <div class = "col-sm-12 col-md-12 col-lg-12">
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                          <div class="col-md-12">
                                <div class="form-group">
                                  <label>Activity Title</label>
                                 <?php showActivityTitle();?> 
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Date</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name = "date" class="form-control datepicker4" data-inputmask="'alias': 'dd/mm/yyyy'" id = "datepicker4" data-mask required>
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
                                    <input type="text" name = "others" class="form-control" >
                                </div>
                              </div>
                          </div>
                          <div class = "col-sm-6 col-md-6 col-lg-6">
                            <div class="col-md-12 well perdiem">
                            <div>
        <!-- <img src="images/50km.png" alt="Flying Kites" style = "width:100%;height:auto;"> -->
        <div class="form-group">
                                  <label>
                                  Per Diem
                                  </label>
                                  <label class = "pull-right">
                                  <input type ="hidden" value = "<?php echo getDistance();?>" id = "distance"/>
                                  Distance: <?php echo getDistance();?>
                                  </label>
                              </div>
                              <div class="form-group">
                                <label>
                                Meals
                                </label><br>
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
                    <span class = "btn btn-success btn-md pull-right" id= "add_fare">Add Fare</span>
                  </div>



                  </div>

            

                  <div class = "well" style = "padding:10px;" id = "travelPanel">
                  </div>
                  <button type = "submit" class = "btn btn-success btn-md pull-right">Save </button>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

              </form>
                  </div>
                </div>
                 
              </div>
              
            </div>
          
          
        </div>
      </div>
<script>
          $(document).ready(function() {
            
        
              var action = '';
              var table = $('#example').DataTable( {
        
                'scrollX'     : true,
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                  "processing": true,
                  "serverSide": false,
                  "ajax": "DATATABLE/travel_claim.php"
                  ,
                  "columnDefs": [ {
                      "targets":10,
                      "width": "15%", "targets": 10,

                      "render": function (data, type, row, meta ) {  
                        if(row[1] == "<?php echo $_SESSION['complete_name2'];?>"){
                          action = "<button  class = 'btn btn-md btn-success' id = 'view' style = 'font-family:Arial'><i class = 'fa fa-eye'></i>View</button> &nbsp;<button class = 'btn btn-md btn-primary' style = 'font-family:Arial' id = 'edit'><i class = 'fa fa-edit'></i>Edit</button>&nbsp;<button class = 'btn btn-md btn-danger'><i class = 'fa fa-trash'></i> Delete</button> ";
                        }else{
                          action = "<center><button  class = 'btn btn-md btn-success' id = 'view' style = 'font-family:Arial'><i class = 'fa fa-eye'></i>View</button></center>";
                        }
                          return action;
                      }
                  }]
                

              } );



              // when users click view button
              $('#example tbody').on( 'click', '#view', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var RO = data[2];
                var username = data[1];
                $('#exampleModal').modal({ keyboard: false });
                $('#or').val(data[2]);
                $.ajax({
                  type: 'POST',
                  url: 'testtime.php',
                  data: (
                    {
                      ro:RO,
                      uname:username,
                      action:"view",
                    }),
                  cache: false,
                  success: function(data)
                  {
                    $('#results').html(data);

                  }
                });
                $.ajax({
                  type: 'POST',
                  url: 'getTable1.php',
                  data: ({
                    "username":username,
                    "purpose":RO
                    }),
                  cache: false,
                  success: function(data2)
                  {
                    $('#table1').html(data2);

                  }
                });
                $.ajax({
                  type: 'POST',
                  url: 'getTable3.php',
                  data: ({
                    "username":username,
                    "purpose":RO,
                    "action":"view",
                    }),
                  cache: false,
                  success: function(data3)
                  {
                    $('#table3').html(data3);

                  }
                });
              });
              // when users click edit button
              $('#example tbody').on( 'click', '#edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var RO = data[2];
                var username = data[1];
                $('#add_travel_dates').modal({ keyboard: false });
                $('#or').val(data[2]);
                $.ajax({
                  type: 'POST',
                  url: 'testtime.php',
                  data: (
                    {
                      ro:RO,
                      uname:username,
                      action:"edit",
                    }),
                  cache: false,
                  success: function(data)
                  {
                    $('#tbl2').html(data);

                  }
                });
              
                $.ajax({
                  type: 'POST',
                  url: 'getTable1.php',
                  data: ({
                    "username":username,
                    "purpose":RO
                    }),
                  cache: false,
                  success: function(data2)
                  {
                    $('#tbl1').html(data2);

                  }
                });
                $.ajax({
                  type: 'POST',
                  url: 'getTable3.php',
                  data: ({
                    "username":username,
                    "purpose":RO,
                    "action":"edit"
                    }),
                  cache: false,
                  success: function(data3)
                  {
                    $('#tbl3').html(data3);

                  }
                });
              });




          });
              </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
