<?php 
  date_default_timezone_set('Asia/Manila');
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
  $username = $_GET['username'];
  function tblpersonnel($connect)
  { 
    $output = '';
    $query = "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision` WHERE DIVISION_N = 1 || DIVISION_N = 10 || DIVISION_N = 18 || DIVISION_N = 17 || DIVISION_N = 9 || DIVISION_N = 7 || DIVISION_N = 19 || DIVISION_N = 20 || DIVISION_N = 21 || DIVISION_N = 22 || DIVISION_N = 23 || DIVISION_N = 24 AND DIVISION_M IS NOT NULL ORDER BY DIVISION_M ASC  ";

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DIVISION_N"].'">'.$row["DIVISION_M"].'</option>';
    }
    return $output;
  }



  $sel = mysqli_query($conn,"SELECT * FROM phone_directory LIMIT 1");
  $rows = mysqli_fetch_array($sel);
  $posted_date = $rows['posted_date'];
  $month = date('M',strtotime($posted_date));

  if (isset($_POST['submit'])) {
     // $month_export = $_POST['month'];
     // $year_export = $_POST['year'];
     $office_export = $_POST['office'];

     // $full_date = $year_export.'-'.$month_export;

   echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='export_employee.php?office=$office_export';
        </SCRIPT>");
  }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Directory of DILG-IV-A Employees</h1>
        <br>
         <form method="POST">
        <div class="row" id="boxed">
          <div class="col-xs-2">
            <br>
        <li class="btn btn-success"><a href="CreateEmployee.php" style="color:white;text-decoration: none;">Add</a></li>

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
              <label>Office <font style="color:red;">*</font></label>
              <select required class="form-control select2" name="office" id="office">
                 <option value="0" selected></option>
                 <?php echo tblpersonnel($connect)?>
              </select>
            </div>
              <div class="col-xs-1" style="padding-top: 5px;">
              <br>
            <a href="javascript:void(0);" class="btn btn-success link" data-id="<=$data['id']?>">Export</a>
            </div>

          </div>
        </div>
        </form>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>FIRST NAME</th>
                <th>MIDDLE NAME</th>
                <th>LAST NAME</th>
                <th>OFFICE</th>
                <th>POSITION</th>
                <th>DESIGNATION</th>
                <th>MOBILE NO</th>
                <th>PERSONAL EMAIL ADDRESS</th>
                <th>OFFICE CONTACT NO</th>
                <th>OFFICE EMAIL ADDRESS</th>
                <th>BIRTHDAY</th>
                <th>ACTION</th>
                <th></th>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT tblempdetails.office_contact,tblemployee.EMP_N,tblemployee.FIRST_M,tblemployee.MIDDLE_M,tblemployee.LAST_M,tblemployee.BIRTH_D,tblemployee.EMAIL,tblemployee.ALTER_EMAIL,tblemployee.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployee.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployee.DESIGNATION LEFT JOIN tblempdetails on tblempdetails.EMP_N = tblemployee.EMP_N");

                $sele = mysqli_query($conn,"SELECT ACCESSTYPE FROM tblemployee WHERE UNAME = '$username'");
                $rowU = mysqli_fetch_array($sele);
                $ACCESSTYPE = $rowU['ACCESSTYPE'];
            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["EMP_N"];
              $FIRST_M = $row["FIRST_M"];  
              $MIDDLE_M = $row["MIDDLE_M"];  
              $LAST_M = $row["LAST_M"];
              $DIVISION_M = $row["DIVISION_M"];
              $POSITION_M = $row["POSITION_M"];
              $DESIGNATION_M = $row["DESIGNATION_M"];
              $office_contact = $row["office_contact"];
              $MOBILEPHONE = $row["MOBILEPHONE"];
              $ALTER_EMAIL = $row["ALTER_EMAIL"];
              $EMAIL = $row["EMAIL"];
              $BIRTH_D = $row["BIRTH_D"];
              $BIRTH = date('F d',strtotime($BIRTH_D));
              ?>
              <tr>
                <td width=""><?php echo $FIRST_M;?></td>
                <td width=""><?php echo $MIDDLE_M;?></td>
                <td width=""><?php echo $LAST_M;?></td>
                <td width=""><?php echo $DIVISION_M;?></td>
                <td width=""><?php echo $POSITION_M;?></td>
                <td width=""><?php echo $DESIGNATION_M;?></td>
                <td width=""><?php echo $MOBILEPHONE;?></td>
                <td width=""><?php echo $EMAIL;?></td>
                <td width=""><?php echo $office_contact;?></td>
                <td width=""><?php echo $ALTER_EMAIL;?></td>
                <td width=""><?php echo $BIRTH;?></td>

            
                <?php if ($ACCESSTYPE == 'admin'): ?>
                <td width="150">
                 <a href='UpdateEmployee.php?id=<?php echo $id; ?>&division=<?php echo $_GET['division']; ?>&username=<?php echo $_GET['username']; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a>
               </td>
               <td><a onclick="return confirm('Are you sure you want to Delete this Account now?');" href='delete_account2.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
               <?php else: ?>
                <td>
                 <a href='UpdateEmployee.php?id=<?php echo $id; ?>&view=1' title="View" class="btn btn-info btn-xs">View</a>
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
<script>
  $(document).ready(function(){

    $('.link').click(function(){

      var f = $(this);
      var id = f.data('id');

      var office = $('#office').val();

      window.location = 
      'export_employee.php?office='+office;
  });
}) ;
</script>


