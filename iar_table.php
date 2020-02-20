<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>


<!DOCTYPE html>
<html>
<head>
  <title>Asset Management System</title>


</head>
<body>

<div class="box">
  <div class="box-body">
        <div class=""> 
          <div class="">
           
            <h1 align="">Inspection Acceptance Report</h1>
    <div class="box-header">
    </div>
  

     <li class="btn btn-success"><a href="CreateIAR.php" style="color:white;text-decoration: none;">Create</a></li>
      <br>
      <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->
           <!-- <input type="text" style="height: 35px; width: 500px; margin-left: 40px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" > -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
                  <!--   <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example1 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script> -->
                    <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white; color:blue;">
                        
                        <th>PO NUMBER</th>
                        <th>PO DATE</th>
                        <th>IAR NUMBER</th>
                        <th>IAR DATE</th>
                        <th>REQUISITION DEPT.</th>
                        <th>ACTION</th>
                      
                        
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $view_query = mysqli_query($conn, "SELECT * FROM iar order by id DESC  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $po_no = $row["po_no"];  
                    $po_date = $row["po_date"];
                    $dept = $row["dept"];
                    $ccode = $row["ccode"];
                    $iar_no = $row['iar_no'];
                    $iar_date = $row['iar_date'];
                    $invoice_no = $row['invoice_no'];
                    $invoice_date = $row['invoice_date'];
                    $stock_no = $row['stock_no'];
                    
                    echo "<tr align = ''>
                   
                    <td>$po_no</td>
                    <td>$po_date</td>
                    <td>$iar_no</td>
                    <td>$iar_date</td>
                    <td>$dept</td>
                    
                    <td>
                    <a href='export_iar.php?getiar=$id' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                    <a href='UpdateIAR.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    </td>

                    </tr>"; 
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
<?php
if (isset($_POST['submit'])) 
{
  $rfq_id=$_POST['rfq_id'];
  $app_id=$_POST['app_id'];
  $sup_id=$_POST['sup_id'];
  $sup=$_POST['sup'];
  $po=$_POST['po'];
  $date=$_POST['date'];
  $dept=$_POST['rd'];
  $rcode=$_POST['rcode'];
  $iar_no=$_POST['iar_no'];
  $iar_date=$_POST['iar_date'];
  $invoice=$_POST['invoice'];
  $invoice_date=$_POST['invoice_date'];
  $sn=$_POST['sn'];

  $query = $mydb->execute('INSERT INTO iar (rfq_id,app_id,sup_id,supplier,po_no,po_date,dept,ccode,iar_no,iar_date,invoice_no,invoice_date,stock_no) 
    VALUES ("'.$rfq_id.'","'.$app_id.'","'.$sup_id.'","'.$sup.'","'.$po.'","'.$date.'","'.$dept.'","'.$rcode.'","'.$iar_no.'","'.$iar_date.'","'.$invoice.'","'.$invoice_date.'","'.$sn.'")');
  if (!empty($query)) 
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successful!')
      window.location.href='iar.php';
      </SCRIPT>");
} else {
    echo "Error: " ;
}
}   
?>
<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



