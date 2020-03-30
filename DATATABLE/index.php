  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <!-- <th>First name</th> -->

  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <!-- <th>First name</th> -->

            </tr>
        </tfoot>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
           
$(document).ready(function() {
    var data = 1;

    $('#example').DataTable( {
        "processing": true,
        "serverSide": false,
        "ajax": "server_processing.php",


    //     columnDefs:   
    //             [
    //                       {"className": "dt-center", "targets": "_all"},
    //                 {
    //                 targets: [-1], render: function (a, b, data, d) {
                      
    //                     if(data == 2563 || data == 2577 )
    //         {
    //           return "<button class = 'btn btn-primary'>Activate</button>";
                
    //         }else{
    //           return "<button>Inactive</button>";

    //         }
    //                 }
    //             }],
    } );
} );
    </script>