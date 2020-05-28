<?php 
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");

$sel = mysqli_query($conn,"SELECT * FROM phone_directory LIMIT 1");
$rows = mysqli_fetch_array($sel);
$posted_date = $rows['posted_date'];
$month = date('M',strtotime($posted_date));
$div = $_GET['division'];

if (isset($_POST['update'])) {
  $id =$_POST['idC'];
  $group =$_POST['group'];
  $agency =$_POST['agency'];
  $head_director =$_POST['head_director'];
  $contact =$_POST['contact'];
  $email =$_POST['email'];
  $address =$_POST['address'];

  $INSERT = mysqli_query($conn,"UPDATE `phone_directory` SET `group`='$group',`agency`='$agency',`head_director`='$head_director',`contact_no`='$contact',`email`='$email',`address`='$address' WHERE id = $id");

  if ($INSERT) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Updated!')
      window.location.href='Directory.php?division=$div';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!')
      </SCRIPT>");

  }

}

if (isset($_POST['add'])) {
  $group =$_POST['group'];
  $agency =$_POST['agency'];
  $head_director =$_POST['head_director'];
  $contact =$_POST['contact'];
  $email =$_POST['email'];
  $address =$_POST['address'];
  $posted_by =$_POST['posted_by'];
  $posted_date =$_POST['posted_date'];

  $INSERT = mysqli_query($conn,"INSERT INTO `phone_directory`(`group`, `agency`, `head_director`, `contact_no`, `email`, `address`, `posted_by`, `posted_date`) VALUES ('$group','$agency','$head_director','$contact','$email','$address','$posted_by','$posted_date')");

  if ($INSERT) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Added!')
      window.location.href='Directory.php';
      </SCRIPT>");
  }else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!')
      </SCRIPT>");

  }

}
?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Phone Directory</h1>
        <br>
        <?php if ($username == 'mmmonteiro' ||$username == 'charlesodi' || $username == 'masacluti' || $username == 'seolivar' || $username == 'rggutierrez' || $username == 'cvferrer'): ?>

          <li class="btn btn-success"><a data-toggle="modal" data-target="#modal-infu" style="color:white;text-decoration: none;">Add</a></li>
          <?php else: ?>

          <?php endif ?>
          <a href="export_phone.php" class="btn btn-success pull-right">Export</a>
       <!--  <form method="POST">
          <div class="row" id="boxed">
            <div class="col-xs-2">
              <?php if ($username == 'mmmonteiro' ||$username == 'charlesodi' || $username == 'masacluti' || $username == 'seolivar' || $username == 'rggutierrez' || $username == 'cvferrer'): ?>

                <li class="btn btn-success"><a data-toggle="modal" data-target="#modal-infu" style="color:white;text-decoration: none;">Add</a></li>
                <?php else: ?>

                <?php endif ?>
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
                <a href="export_phone.php" class="btn btn-success">Export</a>
              </div>

            </div>
          </div>
        </form> -->
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
              <?php if ($username == 'mmmonteiro' ||$username == 'charlesodi' || $username == 'masacluti' || $username == 'seolivar' || $username == 'rggutierrez' || $username == 'cvferrer'): ?>
                <th width="150">ACTION</th>
                <?php else: ?>
                <?php endif ?>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT * FROM `phone_directory`ORDER BY `phone_directory`.`group`  ASC");

            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["id"];
              $group = $row["group"];
              $agency = $row["agency"];  
              $head_director = $row["head_director"];  
              $contact_no = $row["contact_no"];
              $email = $row["email"];
              $address = $row["address"];
              $posted_by =$row['posted_by'];
              $posted_date1 =$row['posted_date'];
              if ($posted_date1 == NULL) {
                $posted_date ='';
              }else{
                $posted_date =date('Y-m-d',strtotime($posted_date1));
              }
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
                   <!-- <a  href='UpdateDirectory.php?id=<?php echo $id; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a> -->
                   <a data-toggle="modal"  data-target="#modal-info_<?php echo $row['id']; ?>"   class = "btn btn-primary btn-xs"><i class='fa'>&#xf044;</i>Edit</a>  

                   | <a onclick="return confirm('Are you sure you want to Delete this Contact now?');" href='delete_directory.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
                   <?php else: ?>
                   <?php endif ?>
                 </tr>
                 <div class="modal modal-default fade" id="modal-info_<?php echo $row['id']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Contact</h4>
                        </div>
                        <div class="modal-body">
                          <form method="POST" >
                <div class="row">
                  <div class="col-md-3">
                   <div class="form-group" >
                    <p></p>
                            <label>Group <font style="color: Red;" >*</font></label>

                  </div>
                   <div class="form-group" >
                           <label style="padding-top: 10px;">Agency/Office <label style="color: Red;" >*</label></label>

                  </div>
                  <div class="form-group" >
                           <label style="padding-top: 5px;">Contact/Person <label style="color: Red;" >*</label></label>

                  </div>
                   <div class="form-group" >
                           <label>Contact No. <label style="color: Red;" >*</label></label>

                  </div>
                   <div class="form-group" >
                           <label style="padding-top: 5px;">Email Address <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Office Address <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Posted by <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Posted Date <label style="color: Red;" >*</label></label>
                           <br>
                           <br>
                           
                          <button type="submit" class="btn btn-success" name="update">Save Changes</button>
                  </div>
                </div>
                 <div class="col-md-8">
                 <div class="form-group" >
                 <select class="form-control "  name="group" >
                             <option value="<?php echo $group?>"><?php echo $group?></option>
                             <option value="DILG Central">DILG Central</option>
                             <option value="DILG Region">DILG Region</option>
                             <option value="Local Government Units">Local Government Units</option>
                             <option value="Private Sector Representatives">Private Sector Representatives</option>
                             <option value="Regional Line Agencies">Regional Line Agencies</option>
                             <option value="REGULAR GUESTS">REGULAR GUESTS </option>
                             <option value="States, Universities and Colleges">States, Universities and Colleges </option>
                           </select>

                </div>
                <div class="form-group" >
                           <input required value="<?php echo $agency ;?>" type="text" class="form-control"  name="agency"  >

                </div>
                 <div class="form-group" >
                           <input required value="<?php echo $head_director ;?>"  class="form-control" name="head_director" type="text" >

                </div>
                 <div class="form-group" >
                           <input required value="<?php echo $contact_no ;?>"  class="form-control" name="contact" type="text" >

                </div>
                 <div class="form-group" >
                           <input required value="<?php echo $email ;?>"  class="form-control" name="email" type="text" >

                </div>
                <div class="form-group" >
                           <input required value="<?php echo $address ;?>"  class="form-control" name="address" type="text" >

                </div>
                <div class="form-group" >
                           <input readonly required class="form-control" name="posted_by" type="text" value="<?php echo $posted_by?>">

                </div>
                <div class="form-group" >
                  <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <div hidden>
                            <input readonly value="<?php echo $posted_date?>" type="text" class="form-control pull-right" name="posted_date" id="datepicker15"  required placeholder="mm/dd/yyyy">
                            </div>
                            <input readonly value="<?php echo date('F d, Y',strtotime($posted_date))?>" type="text" class="form-control pull-right"  >
                          </div>
                          <input type="text" name="idC" hidden  value="<?php echo $id?>">

                </div>
              </div>
              </div>
        

          </form>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-default fade" id="modal-infu">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Contact</h4>
            </div>
            <div class="modal-body">
              <form method="POST" >
                <div class="row">
                  <div class="col-md-3">
                   <div class="form-group" >
                    <p></p>
                            <label>Group <font style="color: Red;" >*</font></label>

                  </div>
                   <div class="form-group" >
                           <label style="padding-top: 10px;">Agency/Office <label style="color: Red;" >*</label></label>

                  </div>
                  <div class="form-group" >
                           <label style="padding-top: 5px;">Contact/Person <label style="color: Red;" >*</label></label>

                  </div>
                   <div class="form-group" >
                           <label>Contact No. <label style="color: Red;" >*</label></label>

                  </div>
                   <div class="form-group" >
                           <label style="padding-top: 5px;">Email Address <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Office Address <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Posted by <label style="color: Red;" >*</label></label>

                  </div>
                    <div class="form-group" >
                           <label style="padding-top: 5px;" >Posted Date <label style="color: Red;" >*</label></label>
                           <br>
                           <br>
                           
                          <button type="submit" class="btn btn-success" name="add">Save</button>
                  </div>
                </div>
                 <div class="col-md-8">
                 <div class="form-group" >
                  <select required class="form-control "  name="group" >
                             <option disabled selected></option>
                             <option value="DILG Central">DILG Central</option>
                             <option value="DILG Region">DILG Region</option>
                             <option value="Local Government Units">Local Government Units</option>
                             <option value="Private Sector Representatives">Private Sector Representatives</option>
                             <option value="Regional Line Agencies">Regional Line Agencies</option>
                             <option value="REGULAR GUESTS">REGULAR GUESTS </option>
                             <option value="States, Universities and Colleges">States, Universities and Colleges </option>
                           </select>

                </div>
                <div class="form-group" >
                           <input required type="text" class="form-control"  name="agency"  >

                </div>
                 <div class="form-group" >
                           <input required class="form-control" name="head_director" type="text" >

                </div>
                 <div class="form-group" >
                           <input required class="form-control" name="contact" type="text" >

                </div>
                 <div class="form-group" >
                           <input required class="form-control" name="email" type="text" >

                </div>
                <div class="form-group" >
                           <input required class="form-control" name="address" type="text" >

                </div>
                <div class="form-group" >
                           <input readonly required class="form-control" name="posted_by" type="text" value="<?php echo $username?>">

                </div>
                <div class="form-group" >
                  <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <div hidden>
                            <input readonly value="<?php echo date('Y-m-d')?>" type="text" class="form-control pull-right" name="posted_date" id="datepicker15"  required placeholder="mm/dd/yyyy">
                            </div>
                            <input readonly value="<?php echo date('F d, Y')?>" type="text" class="form-control pull-right"    placeholder="mm/dd/yyyy">
                          </div>
                          <input type="text" name="idC" hidden  value="<?php echo $id?>">

                </div>
              </div>
              </div>
        

          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



<!-- <form method="POST" >
              

                           
                        
                           <label>Office Address <label style="color: Red;" >*</label></label>
                           <input required class="form-control" name="address" type="text" >
                           <br>
                           <label>Posted by <label style="color: Red;" >*</label></label>
                           <input readonly required class="form-control" name="posted_by" type="text" value="<?php echo $username?>">
                           <br>
                           <label>Posted Date <label style="color: Red;" >*</label></label>
                           <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input readonly value="<?php echo date('Y-m-d')?>" type="text" class="form-control pull-right" name="posted_date" id="datepicker15"  required placeholder="mm/dd/yyyy">
                          </div>
                          <input type="text" name="idC" hidden  value="<?php echo $id?>">
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </form> -->