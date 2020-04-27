<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Phone Directory</h1>
        <br>
        <li class="btn btn-success"><a href="CreateDirectory.php" style="color:white;text-decoration: none;">Add</a></li>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th width="150">GROUP</th>
                <th>AGENCY/OFFICE</th>
                <th>CONTACT PERSON</th>
                <th>CONTACT NO.</th>
                <th>EMAIL ADDRESS</th>
                <th>OFFICE ADDRESS</th>
                <th width="150">ACTION</th>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT * FROM phone_directory");

            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $group = $row["group"];
              $agency = $row["agency"];  
              $head_director = $row["head_director"];  
              $contact_no = $row["contact_no"];
              $email = $row["email"];
              $address = $row["address"];
              ?>
              <tr>
                <td ><?php echo $group;?></td>
                <td ><?php echo $agency;?></td>
                <td ><?php echo $head_director;?></td>
                <td ><?php echo $contact_no;?></td>
                <td ><?php echo $email;?></td>
                <td ><?php echo $address;?></td>
                <td >
                 <a  href='UpdateDirectory.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a> | <a onclick="return confirm('Are you sure you want to Delete this Account now?');" href='delete_directory.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
             </tr>
           <?php } ?>
       </table>
     </div>
   </div>
 </div>
</div>



