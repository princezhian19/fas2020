
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Inspection Acceptance Report</h1>
            <li class="btn btn-success"><a href="CreateIAR.php" style="color:white;text-decoration: none;">Create</a></li>
            <br>
            <br>
            <table id="example1" class="table table-bordered" style="background-color: white;" align="left">
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
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT * FROM iar order by id DESC  ");
                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $po_no = $row["po_no"];  
                    $po_date = $row["po_date"];
                    $dept = $row["dept"];
                    $ccode = $row["ccode"];
                    $iar_no = $row['iar_no'];
                    $iar_date = date('F d, Y',strtotime($row['iar_date']));
                    if ($iar_date == 'January 01, 1970') {
                      # code...
                      $iar_date='';
                    }
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
                    <a href='UpdateIAR.php?id=$id' ' class='btn btn-primary btn-xs'> <i class='fa'>&#xf044;</i> Edit</a> | 
                    <a href='export_iar.php?getiar=$id' class='btn btn-success btn-xs' > <i class='fa fa-fw fa-download'></i> Export</a>
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
  </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>

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



