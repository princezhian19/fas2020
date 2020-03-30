  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- datatable lib -->
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>


    
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
            <th>CONTROL NO.</th>
                        <th>REQUESTED DATE</th>
                        <th>REQUESTED TIME</th>
                        <th>RECEIVED DATE</th>
                        <th>RECEIVED TIME</th>
                        <th>END USER</th>
                        <th>OFFICE</th>
                        <th>ISSUE/CONCERN</th>
                        <th>MODE OF REQUEST</th>
                        <th>Assigned Person</th>
                        <th>STATUS</th>
                        <th style = "text-align:center;">ACTION</th>

  
            </tr>
        </thead>
       
    </table>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
<button id = "sweet-14">a</button>
    <script>
           
$(document).ready(function() {

    
    var table = $('#example').DataTable( {
        "processing": true,
        "serverSide": false,
        "ajax": "server_processing.php",
        columnDefs:   
            [
                {"className": "dt-center", "targets": "_all"},  
                    {
                        targets: [-1], render: function (a, b, data, d) 
                        {
                            if(data[0] == 2563 || data[0] == 2577 )
                            {
                                return '<a class="btn btn-info btn-sm" id="sweet-14">' + 'Edit' + '</a>';
                            }else{
                            return "<button class = 'btn btn-danger'>Inactive</button>";
                            }
                            
            }
            }],
    } );
    $('#example tbody').on( 'click', '#sweet-14', function () {
    var data = table.row( $(this).parents('tr') ).data();
    alert( data[0] +"'s salary is: "+ data[ 5 ] );
    } );
} );

    </script>