<?php 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_items_id = $_GET['rfq_id'];
$select_rfqitems = mysqli_query($conn,"SELECT id,rfq_id FROM rfq_items WHERE id = $rfq_items_id");
$r1 = mysqli_fetch_array($select_rfqitems);
$rfqitemsid = $r1['id'];
$rfqid = $r1['rfq_id'];
$select_rfq1= mysqli_query($conn,"SELECT rfq_no,rfq_date FROM rfq WHERE id = $rfqid");
$r11 = mysqli_fetch_array($select_rfq1);
$rfqno = $r11['rfq_no'];
$rfqdate1 = $r11['rfq_date'];
$rfqdate = date('F d, Y', strtotime($rfqdate1));
$view_query = mysqli_query($conn, "SELECT sq.supplier_id,rq.rfq_id,sq.id,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on s.id = sq.supplier_id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rfqitemsid ");
$selectRFQ = mysqli_query($conn,"SELECT rfq_id FROM rfq_items WHERE id = $rfq_items_id");
$rowRFQ = mysqli_fetch_array($selectRFQ);
$rfq_id1 = $rowRFQ['rfq_id'];
?>
<body>
  <div class="box">
    <div class="box-body">
      <div class=""> 
        <div class="">
          <h1 align="">Supplier Quote</h1>
          <div class="box-header">
          </div>
          <br>
          <li class="btn btn-success"><a href="CreateSupplierQuote.php?rfq=<?php echo $rfq_items_id;?>&rfq_id=<?php echo $rfq_id1;?>" style="color:white;text-decoration: none;">Create Supplier</a></li>
          <br>
          <br>
          <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>RFQ No.</th>
                <th>DATE</th>
                <th>SUPPLIER</th>
                <th>REMARKS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($view_query)) {
              $rfq_id = $row["rfq_id"]; 
              $supplier_id = $row["supplier_id"]; 
              $ids = $row["id"]; 
              $supplier_title = $row["supplier_title"];  
              $supplier_address = $row["supplier_address"];
              $contact_details = $row["contact_details"];
              $remarks = $row["remarks"];
              ?>
              <tr>
                <td><?php echo $rfqno;?></td>
                <td><?php echo $rfqdate;?></td>
                <td><?php echo $supplier_title;?></td>
                <td><?php echo $remarks;?></td>
                <td>
                 &nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-primary btn-xs" style="border-radius: 50px;" href='UpdateSupplierQuote.php?rfq_id=<?php echo $rfq_id; ?>&supplier_id=<?php echo $supplier_id?>' title="View"> update </a>
               </td>
             </tr>
           <?php } ?>
         </table>
       </div>
     </div>

   </div>
 </div>

</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#exmaple1').DataTable();

  } );
</script>
</div>
</div>
</div>
</div>



