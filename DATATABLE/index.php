<link rel="shortcut icon" type="../image/png" href="dilg.png">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>First name</th>

  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>First name</th>
                <th>First name</th>

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
        "serverSide": true,
        "ajax": "server_processing.php",
        columnDefs:   
                [
                          {"className": "dt-center", "targets": "_all"},
                    {
                    targets: [-1], render: function (a, b, data, d) {
                      
                        if(data == 2563 || data == 2577 )
            {
              return "<button class = 'btn btn-primary'>Activate</button>";
                
            }else{
              return "<button>Inactive</button>";

            }
                    }
                }],
    } );
} );
    </script>