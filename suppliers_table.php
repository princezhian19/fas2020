<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body"> 
        <h1 align="">Suppliers</h1>
        <br>
        <li class="btn btn-success"><a href="CreateSuppliers.php" style="color:white;text-decoration: none;">Create</a></li>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
          <thead>
            <tr style="background-color: white;color:blue;">
              <th>SUPPLIER</th>
              <th>ADDRESS</th>
              <th>CONTACT</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <?php
          $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
          $view_query = mysqli_query($conn, "SELECT * FROM supplier order by id desc");
          while ($row = mysqli_fetch_assoc($view_query)) {
            $id = $row["id"];
            $supplier_title = $row["supplier_title"];
            $supplier_address = $row["supplier_address"];  
            $contact = $row["contact_details"];
            ?>
            <tr>
              <td><?php echo $supplier_title;?></td>
              <td><?php echo $supplier_address;?></td>
              <td><?php echo $contact;?></td>
              <td>
                <a href='UpdateSuppliers.php?id=<?php echo $id; ?>' class = "btn btn-primary btn-xs"> <i style='font-size:20px' class='fa'>&#xf044;</i> Edit</a>
             </td>
           </tr>
         <?php } ?>
       </table>
     </div>
   </div>
 </div>
</div>



