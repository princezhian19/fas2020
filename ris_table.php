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
          
      
            <h1 align="">Requisition and Issue Slip</h1>
             <div class="box-header">
    </div>
  
    <li class="btn btn-success"><a href="CreateRIS.php" style="color:white;text-decoration: none;">Create</a></li>
     
    


        <br>
        <br>
        <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;font-family: Arial, Helvetica, sans-serif;">
                      
                        <th width="80">RIS NO.</th>
                        <th width="80">PO NO.</th>
                        <th>DIVISION</th>
                        <th>PURPOSE</th>
                        <th>ACTION</th>
                        
                      

                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $view_query = mysqli_query($conn, "SELECT * FROM ris order by id DESC  ");

                while ($row = mysqli_fetch_assoc($view_query)) {
                    $id = $row["id"];
                    $ris_no = $row["ris_no"];  
                    $division = $row["division"];
                    $po_no = $row['po_no'];
                    $purpose = $row['purpose'];

                    // if ($request_by == 1 ) {
                    //   $request_by = "ELOISA G. ROZUL";
                    // }
                    // if ($request_by == 2 ) {
                    //   $request_by = "JOHN M. CEREZO";
                    // }
                    // if ($request_by == 3 ) {
                    //   $request_by = "DR. CARINA S. CRUZ";
                    // }
                    
                    echo "<tr align = ''>
                  
                    <td>$ris_no</td>
                    <td>$po_no</td>
                    <td>$division</td>
                    <td>$purpose</td>
                    <td>
                    <a href='export_ris.php?id=$id' ><i style='font-size:20px' class='fa'>&#xf06e;</i> </a>
                  
                    <a href='UpdateRIS.php?id=$id' ><i style='font-size:20px' class='fa'>&#xf044;</i> </a>
                    
                  
                    <a href='deleteRIS.php?id=$id' ><i style='font-size:24px' class='fa fa-trash-o'></i> </a>
                    
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
        $('').DataTable();
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



