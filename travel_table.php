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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
                      "render": function (data, type, row, meta ) {  
                      action = "<button  class = 'btn btn-sm btn-success' id = 'view' style = 'font-family:Arial'><i class = 'fa fa-eye'></i>View</button>";
                      // &nbsp;<button class = 'btn btn-md btn-primary'><i class = 'fa fa-edit'></i>Edit</button>&nbsp;<button class = 'btn btn-md btn-danger'><i class = 'fa fa-trash'></i> Delete</button>
                      return action;
                      }
                  }]
                

              } );



              
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
                      uname:username
                    }),
                  cache: false,
                  success: function(data)
                  {
                    $('#results').html(data);

                  }
                });
                $.ajax({
                  type: 'POST',
                  url: 'getTotal.php',
                  data: ({ro:RO}),
                  cache: false,
                  success: function(data1)
                  {
                    $('#total').html(data1);

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
                    "purpose":RO
                    }),
                  cache: false,
                  success: function(data3)
                  {
                    $('#table3').html(data3);

                  }
                });



          




              });
          });
              </script>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
