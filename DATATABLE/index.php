<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>First name</th>

            </tr>
        </tfoot>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "server_processing.php"
    } );
} );
    </script>