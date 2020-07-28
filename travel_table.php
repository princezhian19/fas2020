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
           <a href = "CreateTravelClaim.php?step=1&ro=&ui=1&username=<?php echo $username;?>" ><button class = "btn btn-md btn-success">Create</button></a><br><br><br>
                
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
               <div id = "travelDate_panel">
               </div>
                

            
<!-- 
                  <div class = "well" style = "padding:10px;" id = "travelPanel">
                  </div> -->

                  <button type = "submit" class = "btn btn-success btn-md pull-right">Save Changes</button>
                  <button class = "btn btn-primary btn-md pull-right" id= "add_fare" style = "margin-right:10px">Add Fare</button>

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
                          action = "<button  class = 'btn btn-md btn-success' id = 'view' style = 'font-family:Arial'><i class = 'fa fa-eye'></i>View</button> &nbsp;<button class = 'btn btn-md btn-primary' style = 'font-family:Arial' id = 'edit'><i class = 'fa fa-edit'></i>Edit</button>&nbsp;<button class = 'btn btn-md btn-danger' id = 'delete' style = 'font-family:Arial;'><i class = 'fa fa-trash'></i> Delete</button> ";
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
                var RO = data[0];
                var username = data[1];
                $('#add_travel_dates').modal({ keyboard: false });
                $('#or').val(data[2]);
                $.ajax({
                  type: 'POST',
                  url: 'editTravelData.php',
                  data: (
                    {
                      ro:RO,
                      uname:username,
                    }),
                  cache: false,
                  success: function(data)
                  {
                    $('#travelDate_panel').html(data);

                  }
                });
              
                // $.ajax({
                //   type: 'POST',
                //   url: 'getTable1.php',
                //   data: ({
                //     "username":username,
                //     "purpose":RO
                //     }),
                //   cache: false,
                //   success: function(data2)
                //   {
                //     $('#tbl1').html(data2);

                //   }
                // });
                // $.ajax({
                //   type: 'POST',
                //   url: 'getTable3.php',
                //   data: ({
                //     "username":username,
                //     "purpose":RO,
                //     "action":"edit"
                //     }),
                //   cache: false,
                //   success: function(data3)
                //   {
                //     $('#tbl3').html(data3);

                //   }
                // });
              });
              // when users click delete button
              $('#example tbody').on( 'click', '#delete', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var RO = data[2];
                var username = data[1];
                var id = data[0];
                
                swal({
                      title: "Are you sure?",
                      text: "Your will not be able to recover this entry!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      closeOnConfirm: false
                      },
                      function(){
                      swal("Deleted!", "Your travel date  has been deleted.", "success");
                          $.ajax({
                              url:"travelclaim_functions.php",
                              method:"POST",
                              data:{
                              'action': 'deleteAll',
                              "ro": RO,
                              "id":id
                          },
                          success:function(data)
                          {
                      
                                setTimeout(function () {
                                window.location = "CreateTravelClaim.php?username=<?php echo $_GET['username'];?>&division=<?php echo $_GET['division'];?>";
                                }, 1000);

                            
                          }
                          });

                      }
                      );
             
              });





          });
              </script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
