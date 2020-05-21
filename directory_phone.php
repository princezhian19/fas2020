<?php 
  date_default_timezone_set('Asia/Manila');
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

  $sel = mysqli_query($conn,"SELECT * FROM phone_directory LIMIT 1");
  $rows = mysqli_fetch_array($sel);
  $posted_date = $rows['posted_date'];
  $month = date('M',strtotime($posted_date));

  if (isset($_POST['submit'])) {
     // $month_export = $_POST['month'];
     // $year_export = $_POST['year'];
     // $office_export = $_POST['office'];
     // $date = "01";

     // $full_date = $year_export.'-'.$month_export;
        // window.location.href='export_phone.php?e_date=$full_date&office=$office_export';

   echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='export_phone.php';
        </SCRIPT>");
  }
?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Phone Directory</h1>
        <br>
        <form method="POST">
        <div class="row" id="boxed">
          <div class="col-xs-2">
            <br>
            <li class="btn btn-success"><a href="CreateDirectory.php" style="color:white;text-decoration: none;">Add</a></li>

          </div>
          <div class="">
            <div>
           <div class="col-xs-2">
            </div>
             <div class="col-xs-1">
            </div>
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-2">
            </div>
              <div class="col-xs-1" style="padding-top: 5px;">
              <br>
              <button type="submit" name="submit" id="submit" class="btn btn-success">Export</button>
            </div>

          </div>
        </div>
        </form>
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
                <?php if ($username == 'mmmonteiro' ||$username == 'charlesodi' || $username == 'masacluti' || $username == 'seolivar' || $username == 'rggutierrez' || $username == 'cvferrer'): ?>

              <td >
               <a  href='UpdateDirectory.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a> | <a onclick="return confirm('Are you sure you want to Delete this Contact now?');" href='delete_directory.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
               <?php else: ?>
                <td>
                 <!-- <a href='UpdateDirectory.php?id=<?php echo $id; ?>&view=1' title="View" class="btn btn-info btn-xs">View</a> -->
                </td>
                <td></td>


                <?php endif ?>

             </tr>
           <?php } ?>
         </table>
       </div>
     </div>
   </div>
 </div>



