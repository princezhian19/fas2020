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
                $id = $_GET['rfq'];

                 $view_query = mysqli_query($conn, "SELECT sq.id,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on s.id = sq.supplier_id WHERE sq.rfq_item_id = $id ");

            ?>
<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            <h1 align="">&nbsp&nbsp&nbsp&nbspSupplier Quote</h1>
            <div class="box-header with-border">
            </div>
            <br>
            <br>
     &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp   <li class="btn btn-success"><a href="/pmis/frontend/web/supplier-quote/encode?rfq=<?php echo $id;?>" style="color:white;text-decoration: none;">Create Supplier</a></li>

            <br>
            <br>
             &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="height: 35px; width: 400px" id="myInput" onkeyup="myFunction()" placeholder="Search Here" >
            <br>
            <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="30"></th>
                        <th>SUPPLIER</th>
                        <th>Supplier Address</th>
                        <th>Supplier Contact</th>
                        <th>Remarks</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example1 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script>
                <?php
                while ($row = mysqli_fetch_assoc($view_query)) {
                    $ids = $row["id"];  
                    $supplier_title = $row["supplier_title"];  
                    $supplier_address = $row["supplier_address"];
                    $contact_details = $row["contact_details"];
                    $remarks = $row["remarks"];
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $supplier_title;?></td>
                        <td><?php echo $supplier_address;?></td>
                        <td><?php echo $contact_details;?></td>
                        <td><?php echo $remarks;?></td>
                        <td>
                         &nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-primary btn-xs" style="border-radius: 50px;" href='/pmis/frontend/web/supplier-quote/update?id=<?php echo $ids; ?>' title="View"> update </a>
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



