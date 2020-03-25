<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$hostname = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$databaseName = "fascalab_2020";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);
$query = "SELECT po_no FROM `iar`";
$result1 = mysqli_query($connect, $query);
$result2 = mysqli_query($connect, $query);
$options = "";
while($row2 = mysqli_fetch_array($result2))
{
  $options = $options."<option>$row2[0]</option>";
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Asset Management System</title>
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- try for bg-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
  <div class="">
    <div class="panel panel-default">
      <div class=""> 
        <div class="">
          <br>
          <br>
          <br>
          <h1 align="">&nbspRIS Issue to Many</h1>
          <div class="box-header with-border">
          </div>
          <br>
          &nbsp &nbsp &nbsp   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Issue to Many
          </button>
          <br>
          <br>
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color: lightgray;">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create RIS many</h4>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="CreateRISmany.php">

                      <div >
                        <!-- <input type="text" name="id" id="txtCountry" class="typeahead form-control"/> -->
                        <div class="col-xs-12" >
                          <label>SELECT PO : </label>
                          <select  required class="form-control" name="po_no">
                            <?php while($row1 = mysqli_fetch_array($result1)):;?>
                              <option value="<?php echo $row1[0];?>"><?php echo $row1[0];?></option>
                            <?php endwhile;?>
                          </select>
                        </div>
                        <p>&nbsp</p>
                        <div class="col-xs-12">
                          <label>RIS NO. : </label>
                          <input required type="text"  class="form-control" name="ris_no" autocomplete="off"></input>
                        </div>
                        <p>&nbsp</p>
                        <div class="col-xs-12">
                          <label>DIVISION : </label>
                          <input required type="text" class="form-control" name="dept" autocomplete="off"></input>
                        </div>
                        <p>&nbsp</p>
                        <div class="col-xs-12">
                          <label>REQUEST BY : </label>
                          <input required type="text" class="form-control" name="request_by" autocomplete="off"></input>
                        </div>
                        <p>&nbsp</p>
                        <div class="col-xs-12">
                          <label>RECIEVED BY : </label>
                          <input required type="text" class="form-control" name="recieved_by" autocomplete="off"></input>
                        </div>
                        <p>&nbsp</p>
                        <div class="col-xs-12">
                          <label>PURPOSE : </label>
                          <textarea required type="text" class="form-control" name="purpose" autocomplete="off"></textarea>
                        </div>

                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit" class="btn btn-primary">Continue</button>
                    </div>
                  </form>
                </div>  
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>




          <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th width="0"></th>
                <th>RIS NO.</th>
                <th>PO NO.</th>
                <th>DIVISION</th>
                <th>PURPOSE</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
                <th width="0"></th>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT * FROM ris_stock_issuetomany GROUP BY ris_no DESC  ");

            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $status = $row["status"];
              $dept = $row["dept"];  
              $ris_no = $row["ris_no"];
              $po_no = $row["po_no"];
              $purpose = $row["purpose"];


              echo "<tr>";
              echo "<td></td>";
              echo "<td>$ris_no</td>";
              echo "<td>$po_no</td>";
              echo "<td>$dept</td>";
              echo "<td>$purpose</td>";
              if ($status == 1) {
                echo "<td>&nbsp&nbsp&nbsp&nbsp&nbsp<i class='fa fa-fw fa-check' style='color:green;'>OK</i></td>";
              }
              if ($status == 0) {
               echo "<td>&nbsp&nbsp&nbsp&nbsp&nbsp<a href='UpdateQty.php?id=$id' class='btn btn-success' >Confirm</a></td>";
             }

             echo "<td>
             &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_ris_many.php?id=$id' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
             </td>";
             echo "<td>
             &nbsp&nbsp&nbsp&nbsp&nbsp<a href='UpdateRISmany.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
             </td>";
             echo "<td></td>";


             echo "</tr>"; 
           }
           echo "</table>";

           ?>
         </table>
       </div>
     </div>

   </div>
 </div>

</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example1').DataTable();
  } );
</script>
</div>
</div>

    <!-- <div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
</div> -->
<div class="panel-footer"></div>
</div>
</div>

</body>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="typeahead.js"></script>
<script>
  $(document).ready(function () {
    $('#txtCountry').typeahead({
      source: function (query, result) {
        $.ajax({
          url: "server.php",
          data: 'query=' + query,            
          dataType: "json",
          type: "POST",
          success: function (data) {
            result($.map(data, function (item) {
              return item;
            }));
          }
        });
      }
    });
  });
</script>
<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script> -->
</html>



