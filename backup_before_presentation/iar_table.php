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
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            <h1 align="">&nbspInspection Acceptance Report</h1>
    <div class="box-header with-border">
    </div>
    <br>

      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="CreateIAR.php" style="color:white;text-decoration: none;">Create</a></li>
      <br>
      <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="0"></th>
                        <th>PO NUMBER</th>
                        <th>PO DATE</th>
                        <th>IAR NUMBER</th>
                        <th>IAR DATE</th>
                        <th>REQUISITION DEPT.</th>
                        <th>&nbsp</th>
                        <th>&nbsp</th>
                        <th width="0"></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","fascalab_2020");
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
                    <td></td>
                    <td>$po_no</td>
                    <td>$po_date</td>
                    <td>$iar_no</td>
                    <td>$iar_date</td>
                    <td>$dept</td>
                    <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_iar.php?id=$id' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                    
                    </td>
                     <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='UpdateIAR.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                    </td>
                    <td></td>

                    
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



