<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
     <?php 
             $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $rfq_id = $_GET['rfq_id'];
                
             

                $select_rfqitems = mysqli_query($conn,"SELECT id,rfq_id FROM rfq_items WHERE id = $rfq_id");
                $r1 = mysqli_fetch_array($select_rfqitems);
                $rfqitemsid = $r1['id'];

                $rfqid = $r1['rfq_id'];


                   /* Getting RFQ_NO */
                   $select_rfq1= mysqli_query($conn,"SELECT rfq_no,rfq_date FROM rfq WHERE id = $rfqid");

                   $r11 = mysqli_fetch_array($select_rfq1);
                   $rfqno = $r11['rfq_no'];
                   $rfqdate1 = $r11['rfq_date'];
                   $rfqdate = date('F d, Y', strtotime($rfqdate1));
                  /*  echo "SELECT rfq_no FROM rfq WHERE id = $rfqid"; */
                    /* Getting RFQ_NO */

                 $view_query = mysqli_query($conn, "SELECT sq.supplier_id,rq.rfq_id,sq.id,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on s.id = sq.supplier_id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rfqitemsid ");



               /*   $getPrice = mysqli_query($conn, "SELECT a.id,a.qty,b.ppu,b.rfq_item_id from rfq_items as a left join supplier_quote as b on a.id = b.rfq_item_id");
                
                 while($rowGet = mysqli_fetch_assoc($getPrice )){

                  $qty = $rowGet['qty'];
                  $ppu = $rowGet['ppu'];

                  $ans = $qty*$ppu;

                  $final = number_format($ans,2);

                 } */



            ?>
<body>
<div class="box">
  <div class="box-body">
        <div class=""> 
          <div class="">
       
            <h1 align="">Supplier Quote</h1>
            <div class="box-header">
            </div>
          

          <!--   <h3 align="">RFQ No.  <?php echo $rfqno?></h3> -->
            <br>
            <?php
            $selectRFQ = mysqli_query($conn,"SELECT rfq_id FROM rfq_items WHERE id = $rfq_id");
            $rowRFQ = mysqli_fetch_array($selectRFQ);
            $rfq_id1 = $rowRFQ['rfq_id'];
            ?>
            <li class="btn btn-success"><a href="CreateSupplierQuote.php?rfq=<?php echo $rfq_id;?>&rfq_id=<?php echo $rfq_id1;?>" style="color:white;text-decoration: none;">Create Supplier</a></li>

          
<!--              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" > -->
            <br>
            <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th>RFQ No.</th>
                        <th>DATE</th>
                        <th>SUPPLIER</th>
                       <!--  <th>SUPPLIER ADDRESS</th>
                        <th>SUPPLIER CONTACT</th> -->
                      
                        <th>REMARKS</th>
                        <th>ACTION</th>

                        
                    </tr>
                </thead>
                  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example1 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script> --> 
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


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



